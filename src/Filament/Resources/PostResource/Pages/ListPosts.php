<?php

namespace LaraZeus\Sky\Filament\Resources\PostResource\Pages;

use Filament\Actions\CreateAction;
use LaraZeus\SpatieTranslatable\Actions\LocaleSwitcher;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use LaraZeus\Sky\Filament\Resources\PostResource;
use LaraZeus\Sky\SkyPlugin;
use LaraZeus\SpatieTranslatable\Resources\Pages\ListRecords\Concerns\Translatable;

class ListPosts extends ListRecords
{
    use Translatable;

    protected static string $resource = PostResource::class;

    protected function getActions(): array
    {
        return [
            CreateAction::make(),
            LocaleSwitcher::make(),
        ];
    }

    protected function getTableQuery(): Builder
    {
        return SkyPlugin::get()->getModel('Post')::query()
            ->where('post_type', 'post')
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
