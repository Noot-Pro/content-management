<?php

namespace LaraZeus\Sky\Editors;

use Filament\Forms\Components\MarkdownEditor as FilamentMarkdownEditor;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Component;
use Illuminate\Support\HtmlString;
use LaraZeus\Sky\Classes\ContentEditor;

class MarkdownEditor implements ContentEditor
{
    public static function component(): Component
    {
        if (class_exists(FilamentMarkdownEditor::class)) {
            return FilamentMarkdownEditor::make('content')
                ->required();
        }

        return Textarea::make('content')->required();
    }

    public static function render(string $content): string
    {
        if (class_exists(FilamentMarkdownEditor::class)) {
            return (new HtmlString(
                str(strip_tags($content))
                    ->replace(['prompt(', 'eval(', '&lt;script', '<script'], '')
                    ->markdown()
            ))->toHtml();
        }

        return $content;
    }
}
