<?php

namespace NootPro\ContentManagement\Editors;

use Filament\Schemas\Components\Component;
use Filament\Forms\Components\Textarea;
use NootPro\ContentManagement\Classes\ContentEditor;

class TinyEditor implements ContentEditor
{
    public static function component(): Component
    {
        if (class_exists(\Filament\Forms\Components\RichEditor::class)) {
            return \Filament\Forms\Components\RichEditor::make('content')
                ->label(__('Post Content'))
                ->showMenuBar()
                ->required();
        }

        return Textarea::make('content')->required();
    }

    public static function render(string $content): string
    {
        if (class_exists(\Filament\Forms\Components\RichEditor::class)) {
            return str(html_entity_decode($content))
                ->replace(['prompt(', 'eval(', '&lt;script', '<script'], '');
        }

        return $content;
    }
}
