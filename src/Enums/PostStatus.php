<?php

namespace LaraZeus\Sky\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum PostStatus: string implements HasColor, HasIcon, HasLabel
{
    case Publish = 'publish';
    case Future = 'future';
    case Draft = 'draft';
    case Auto = 'auto';
    case Pending = 'pending';
    case Private = 'private';
    case Trash = 'trash';

    public function getLabel(): string
    {
        return __($this->name);
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Publish => 'success',
            self::Future => 'warning',
            self::Draft => 'primary',
            self::Auto, self::Pending => 'info',
            self::Private, self::Trash => 'danger',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::Publish => 'heroicon-o-check-badge',
            self::Future => 'heroicon-o-calendar-days',
            self::Draft, self::Auto => 'heroicon-o-document-magnifying-glass',
            self::Pending => 'heroicon-o-document-minus',
            self::Private => 'heroicon-o-lock-closed',
            self::Trash => 'heroicon-o-trash',
        };
    }
}
