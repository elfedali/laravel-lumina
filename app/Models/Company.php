<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category',
        'description',
        'phone',
        'address',
        'city',
        'neighborhood',
        'country',
        'zip_code',
        'logo',
        'website',
        'social_media',
        'owner_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'social_media' => 'array',
        'owner_id' => 'integer',
    ];

    public function locales(): HasMany
    {
        return $this->hasMany(Locale::class)
            ->orderBy('is_primary', 'desc')
            ->orderBy('created_at', 'desc');
    }

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // logoIMG
    public function getLogoIMGAttribute(): string
    {
        return '<img src="' . asset('storage/' . $this->logo) . '" alt="' . $this->name . '" class="img-fluid" />';
    }
    // Logo URL
    public function getLogoURLAttribute(): string
    {
        return asset('storage/' . $this->logo);
    }
    // // get logo
    // public function getLogoAttribute($value): string
    // {
    //     return $value ? asset('storage/' . $value) : asset('img/defaults/company.png');
    // }
}
