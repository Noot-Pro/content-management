<?php

namespace NootPro\ContentManagement\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'content-management:publish {--force : Overwrite any existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish Command for all content management components and resources';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->callSilent('vendor:publish', ['--tag' => 'noot-pro-content-management-migrations', '--force' => $this->option('force')]);
        $this->callSilent('vendor:publish', ['--tag' => 'noot-pro-content-management-translations', '--force' => $this->option('force')]);
        $this->callSilent('vendor:publish', ['--tag' => 'noot-pro-content-management-images', '--force' => $this->option('force')]);

        $this->callSilent('vendor:publish', ['--tag' => 'zeus-config', '--force' => $this->option('force')]);
        $this->callSilent('vendor:publish', ['--tag' => 'zeus-views', '--force' => $this->option('force')]);
        $this->callSilent('vendor:publish', ['--tag' => 'zeus-assets', '--force' => $this->option('force')]);

        $this->output->success('Content management has been Published successfully');
    }
}
