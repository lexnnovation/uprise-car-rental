<?php

namespace App\Models;

use App\Enums\InquirySource;
use App\Enums\InquiryStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    use HasFactory;

    protected $table = 'inquiries';

    /**
     * Model-level defaults mirror the DB column defaults so enum casts
     * resolve on freshly-instantiated models without a ->fresh() round-trip.
     */
    protected $attributes = [
        'source' => 'web_form',
        'status' => 'new',
    ];

    protected $fillable = [
        'full_name',
        'email',
        'phone',
        'pickup_location',
        'destination',
        'travel_date_start',
        'travel_date_end',
        'passenger_count',
        'vehicle_id',
        'service_id',
        'notes',
        'source',
        'status',
        'ip',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'travel_date_start' => 'date',
            'travel_date_end' => 'date',
            'passenger_count' => 'integer',
            'source' => InquirySource::class,
            'status' => InquiryStatus::class,
        ];
    }

    /* ---------- Relationships ---------- */

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    /* ---------- Scopes ---------- */

    public function scopeStatus(Builder $query, InquiryStatus|string $status): Builder
    {
        return $query->where('status', $status instanceof InquiryStatus ? $status->value : $status);
    }

    public function scopeNew(Builder $query): Builder
    {
        return $query->where('status', InquiryStatus::New_->value);
    }

    public function scopeRecent(Builder $query): Builder
    {
        return $query->orderByDesc('created_at');
    }
}
