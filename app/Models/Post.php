<?php

namespace App\Models;

use App\Concerns\HasSlug;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Post extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;

    public const MEDIA_FEATURED = 'featured';
    public const MEDIA_OG = 'og';

    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'body',
        'author_name',
        'author_role',
        'meta_title',
        'meta_description',
        'is_featured',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'published_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /* ---------- Media (Spatie) ---------- */

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_FEATURED)
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection(self::MEDIA_OG)
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('card')
            ->fit(Fit::Crop, 800, 600)
            ->nonQueued();

        $this->addMediaConversion('hero')
            ->fit(Fit::Crop, 1600, 900)
            ->nonQueued();

        $this->addMediaConversion('og')
            ->fit(Fit::Crop, 1200, 630)
            ->nonQueued();
    }

    /* ---------- Scopes ---------- */

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')->where('published_at', '<=', Carbon::now());
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderByDesc('published_at');
    }

    /* ---------- Accessors ---------- */

    public function readTimeMinutes(): int
    {
        $words = str_word_count(strip_tags($this->body ?? ''));

        return max(1, (int) ceil($words / 200));
    }
}
