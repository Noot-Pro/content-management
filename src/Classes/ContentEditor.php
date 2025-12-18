<?php

namespace NootPro\ContentManagement\Classes;

use Filament\Schemas\Components\Component;

interface ContentEditor
{
    public static function component(): Component;

    public static function render(string $content): string;
}
