<?php

namespace NootPro\ContentManagement\Enums;

use Filament\Support\Contracts\HasLabel;
use Illuminate\Contracts\Support\Arrayable;

enum TagType: string implements HasLabel
{
    case Tag = 'tag';
    case Category = 'category';
    case Library = 'library';
    case Faq = 'faq';

    public static function toArray(): array
    {
        $data = [];

        foreach (self::cases() as $case) {
            $data[$case->value] = $case->getLabel();
        }

        return $data;
    }

    public function getLabel(): ?string
    {
        return __($this->value);
    }
}
