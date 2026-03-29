<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    const STATUS_PENDING   = 'pending';
    const STATUS_CONFIRMED = 'confirmed';
    const STATUS_CANCELLED = 'cancelled';
    const STATUS_COMPLETED = 'completed';

    protected $fillable = [
        'locale_id',
        'full_name',
        'phone',
        'email',
        'party_size',
        'booking_date',
        'booking_time',
        'status',
        'notes',
    ];

    protected $casts = [
        'locale_id'    => 'integer',
        'party_size'   => 'integer',
        'booking_date' => 'date:Y-m-d',
    ];

    public function locale(): BelongsTo
    {
        return $this->belongsTo(Locale::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING   => 'Pending',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_COMPLETED => 'Completed',
            default                => $this->status,
        };
    }

    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            self::STATUS_PENDING   => 'warning',
            self::STATUS_CONFIRMED => 'success',
            self::STATUS_CANCELLED => 'danger',
            self::STATUS_COMPLETED => 'secondary',
            default                => 'light',
        };
    }

    public static function statuses(): array
    {
        return [
            self::STATUS_PENDING   => 'Pending',
            self::STATUS_CONFIRMED => 'Confirmed',
            self::STATUS_CANCELLED => 'Cancelled',
            self::STATUS_COMPLETED => 'Completed',
        ];
    }

    public static function sources(): array
    {
        return [
            'online'   => 'Online',
            'phone'    => 'Phone',
            'walk-in'  => 'Walk-in',
            'platform' => 'Platform',
        ];
    }
}
