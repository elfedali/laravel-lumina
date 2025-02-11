<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
        'media',

        'is_primary',
        'cover',
        'hours', # JSON
        'company_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'is_primary' => 'boolean',
        'company_id' => 'integer',
        'hours' => 'array',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
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
