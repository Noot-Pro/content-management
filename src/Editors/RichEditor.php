<?php

namespace LaraZeus\Sky\Editors;

use Filament\Forms\Components\RichEditor as FilamentRichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Support\Components\Component;
use LaraZeus\Sky\Classes\ContentEditor;

class RichEditor implements ContentEditor
{
    public static function component(): Component
    {
        if (class_exists(FilamentRichEditor::class)) {
            return FilamentRichEditor::make('content')
                ->required();
        }

        return Textarea::make('content')->required();
    }

    public static function render(string $content): string
    {
        return
            str(html_entity_decode($content))
                ->replace(['prompt(', 'eval(', '&lt;script', '<script'], '');
    }
}
