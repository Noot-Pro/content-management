<?php

namespace NootPro\ContentManagement\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'noot-pro-content-management:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install components and resources';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('publishing configuration...');

        $this->call('vendor:publish', ['--tag' => 'noot-pro-content-management-config']);

        $this->info('publishing migrations...');

        $this->call('vendor:publish', ['--tag' => 'noot-pro-content-management-migrations']);

        $this->call('vendor:publish', [
            '--provider' => 'Spatie\Tags\TagsServiceProvider',
            '--tag' => 'tags-migrations',
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'medialibrary-migrations',
        ]);

        $this->info('publishing zeus assets...');

        $this->call('vendor:publish', ['--tag' => 'zeus-config']);
        $this->call('vendor:publish', ['--tag' => 'zeus-assets']);

        if ($this->confirm('Do you want to run the migration now?', true)) {
            $this->info('running migrations...');
            $this->call('migrate');
        }

        $this->output->success('Content management has been Installed successfully, consider ⭐️ the package in filament site :)');
    }
}
