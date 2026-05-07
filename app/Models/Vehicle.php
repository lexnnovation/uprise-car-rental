<?php

namespace App\Models;

use App\Concerns\HasSlug;
use App\Enums\VehicleStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Vehicle extends Model implements HasMedia
{
    use HasFactory;
    use HasSlug;
    use InteractsWithMedia;
    use SoftDeletes;

    public const MEDIA_HERO = 'hero';
    public const MEDIA_GALLERY = 'gallery';
    public const MEDIA_OG = 'og';

    /**
     * Model-level defaults that mirror the DB column defaults so enum
     * casts resolve correctly on freshly-instantiated models (without
     * requiring a ->fresh() round-trip).
     */
    protected $attributes = [
        'status' => 'available',
        'is_featured' => false,
        'sort_order' => 0,
        'passenger_count' => 4,
        'luggage_count' => 2,
    ];

    protected $fillable = [
        'vehicle_category_id',
        'name',
        'slug',
        'short_description',
        'description',
        'passenger_count',
        'luggage_count',
        'status',
        'is_featured',
        'sort_order',
        'meta_title',
        'meta_description',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'status' => VehicleStatus::class,
            'is_featured' => 'boolean',
            'passenger_count' => 'integer',
            'luggage_count' => 'integer',
            'sort_order' => 'integer',
            'published_at' => 'datetime',
        ];
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    /* ---------- Relationships ---------- */

    public function category(): BelongsTo
    {
        return $this->belongsTo(VehicleCategory::class, 'vehicle_category_id');
    }

    public function features(): BelongsToMany
    {
        return $this->belongsToMany(Feature::class)->orderBy('sort_order');
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    /* ---------- Media (Spatie) ---------- */

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_HERO)
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection(self::MEDIA_GALLERY)
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);

        $this->addMediaCollection(self::MEDIA_OG)
            ->singleFile()
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/webp']);
    }

    public function registerMediaConversions(?Media $media = null): void
    {
        $this->addMediaConversion('thumb')
            ->fit(Fit::Crop, 400, 300)
            ->nonQueued();

        $this->addMediaConversion('card')
            ->fit(Fit::Crop, 800, 600)
            ->nonQueued();

        $this->addMediaConversion('hero')
            ->fit(Fit::Crop, 1600, 900)
            ->nonQueued();

        $this->addMediaConversion('og')
            ->fit(Fit::Crop, 1200, 630)
            ->nonQueued()
            ->performOnCollections(self::MEDIA_OG, self::MEDIA_HERO);
    }

    /* ---------- Scopes ---------- */

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('status', VehicleStatus::Available->value);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->whereNotNull('published_at')
            ->where('published_at', '<=', now());
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }
}
