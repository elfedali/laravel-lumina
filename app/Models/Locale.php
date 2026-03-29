<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Locale extends Model
{
    use HasFactory;

    const ACTIVE_LOCALE_NAME = 'activeLocaleName';
    const ACTIVE_LOCALE = 'activeLocaleId';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'slug',
        'description',

        'address',
        'city',
        'neighborhood',
        'country',
        'zip',

        'phone',
        'phone2',

        'email',
        'website',
        'instagram',
        'facebook',
        'media',

        'is_primary',
        'cover',
        'hours', # JSON
        'avg_rating',
        'review_count',
        'capacity',
        'company_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id'           => 'integer',
        'is_primary'   => 'boolean',
        'company_id'   => 'integer',
        'hours'        => 'array',
        'avg_rating'   => 'decimal:2',
        'review_count' => 'integer',
        'capacity'     => 'integer',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_locale');
    }

    public function menuSections(): HasMany
    {
        return $this->hasMany(MenuSection::class)->orderBy('sort_order');
    }

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class)->orderBy('sort_order');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class)->latest();
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class)->orderByDesc('booking_date');
    }

    public function staff(): HasMany
    {
        return $this->hasMany(Staff::class)->orderBy('last_name');
    }

    public function recalculateRating(): void
    {
        $avg = $this->reviews()->where('is_published', true)->avg('rating') ?? 0;
        $count = $this->reviews()->where('is_published', true)->count();
        $this->update(['avg_rating' => round($avg, 2), 'review_count' => $count]);
    }


    // displayName
    public function getDisplayNameAttribute(): string
    {
        return $this->address . ' ' . $this->neighborhood . ', <br><span class="fw-semibold">' . $this->city . '</span>';
    }

    // displayName2
    public function getDisplayName2Attribute(): string
    {
        return $this->address . ' ' . $this->neighborhood . ', ' . $this->city;
    }
}
