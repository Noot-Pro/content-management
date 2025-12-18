<?php

namespace NootPro\ContentManagement\Editors;

use Filament\Schemas\Components\Component;
use Filament\Forms\Components\RichEditor as RichEditorAlias;
use Filament\Forms\Components\Textarea;
use NootPro\ContentManagement\Classes\ContentEditor;

class RichEditor implements ContentEditor
{
    public static function component(): Component
    {
        if (class_exists(RichEditorAlias::class)) {
            return RichEditorAlias::make('content')
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
