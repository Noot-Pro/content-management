<?php

namespace NootPro\ContentManagement\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $handle
 * @property array $items
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Navigation extends Model
{
    protected $guarded = [];

    protected $casts = [
        'items' => 'json',
    ];

    public static function fromHandle(string $handle): Builder | Model | null
    {
        return static::query()->firstWhere('handle', $handle);
    }
}
