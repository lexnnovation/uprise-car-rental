<?php

namespace App\Concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * Lightweight slug trait — auto-fills the model's `slug` column on save
 * when blank, deriving from a configurable source attribute (defaults to
 * `name`, falls back to `title`).
 *
 * Avoids pulling cviebrock/eloquent-sluggable for a 30-line need.
 *
 * Usage:
 *   Just `use HasSlug;` on a Model that has a `slug` column and either
 *   a `name` or `title` column. Override `slugSource()` for custom sources.
 *
 * NOTE: intelephense cannot resolve `static::saving()` / `static::query()`
 * from inside a trait because it doesn't know the consuming class will be
 * an Eloquent Model. This is canonical Laravel boot-trait usage; the
 * warnings are IDE-only and do not affect runtime.
 *
 * @mixin Model
 *
 * @method static void saving(\Closure $callback)
 * @method static \Illuminate\Database\Eloquent\Builder query()
 */
trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::saving(function (Model $model): void {
            /** @var Model&self $model */
            if (! empty($model->slug)) {
                return;
            }

            $source = $model->slugSource();
            $value = $model->{$source} ?? null;

            if (blank($value)) {
                return;
            }

            $base = Str::slug((string) $value);
            $slug = $base;
            $i = 2;

            // Ensure uniqueness. Excludes the current row when updating.
            while (
                static::query()
                ->where('slug', $slug)
                ->when($model->getKey(), fn($q) => $q->where($model->getKeyName(), '!=', $model->getKey()))
                ->exists()
            ) {
                $slug = "{$base}-{$i}";
                $i++;
            }

            $model->slug = $slug;
        });
    }

    /**
     * Column name used to derive the slug. Override this method on the
     * model if your source column is neither `name` nor `title`.
     */
    protected function slugSource(): string
    {
        return isset($this->title) && ! isset($this->name)
            ? 'title'
            : 'name';
    }
}
