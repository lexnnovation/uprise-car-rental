<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    public const CACHE_KEY = 'uprise.settings.all';
    public const CACHE_TTL = 86400; // 24h

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    protected static function booted(): void
    {
        static::saved(fn() => Cache::forget(self::CACHE_KEY));
        static::deleted(fn() => Cache::forget(self::CACHE_KEY));
    }

    /**
     * Fetch a setting value by key, with type-aware casting and caching.
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $all = Cache::remember(
            self::CACHE_KEY,
            self::CACHE_TTL,
            fn() => self::query()->get(['key', 'value', 'type'])->keyBy('key'),
        );

        $row = $all->get($key);

        if (! $row) {
            return $default;
        }

        return match ($row->type) {
            'int' => (int) $row->value,
            'bool' => filter_var($row->value, FILTER_VALIDATE_BOOLEAN),
            'json' => json_decode((string) $row->value, true),
            default => $row->value,
        };
    }

    /**
     * Upsert a setting value with explicit type.
     */
    public static function set(string $key, mixed $value, string $type = 'string', string $group = 'general'): self
    {
        $stored = match ($type) {
            'json' => json_encode($value),
            'bool' => $value ? '1' : '0',
            default => (string) $value,
        };

        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $stored, 'type' => $type, 'group' => $group],
        );
    }
}
