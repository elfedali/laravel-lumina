<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Locale extends Model
{
    use HasFactory;

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
}
