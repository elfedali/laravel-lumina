<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Staff extends Model
{
    use HasFactory;

    protected $table = 'staff';

    protected $fillable = [
        'locale_id',
        'function_id',
        'first_name',
        'last_name',
        'avatar',
        'phone',
        'email',
        'is_active',
    ];

    protected $casts = [
        'locale_id'   => 'integer',
        'function_id' => 'integer',
        'is_active'   => 'boolean',
        'hire_date'   => 'date',
        'sort_order'  => 'integer',
    ];

    public function locale(): BelongsTo
    {
        return $this->belongsTo(Locale::class);
    }

    public function function(): BelongsTo
    {
        return $this->belongsTo(StaffFunction::class, 'function_id');
    }

    public function getFullNameAttribute(): string
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function getAvatarUrlAttribute(): string
    {
        return $this->avatar
            ? asset('storage/' . $this->avatar)
            : asset('assets/images/avatar-placeholder.png');
    }
}
