<?php

namespace NootPro\ContentManagement\Editors;

use Filament\Schemas\Components\Component;
use Illuminate\Support\HtmlString;
use Filament\Forms\Components\MarkdownEditor as MarkdownEditorAlias;
use Filament\Forms\Components\Textarea;
use NootPro\ContentManagement\Classes\ContentEditor;

class MarkdownEditor implements ContentEditor
{
    public static function component(): Component
    {
        if (class_exists(MarkdownEditorAlias::class)) {
            return MarkdownEditorAlias::make('content')
                ->required();
        }

        return Textarea::make('content')->required();
    }

    public static function render(string $content): string
    {
        if (class_exists(MarkdownEditorAlias::class)) {
            return (new HtmlString(
                str(strip_tags($content))
                    ->replace(['prompt(', 'eval(', '&lt;script', '<script'], '')
                    ->markdown()
            ))->toHtml();
        }

        return $content;
    }
}
