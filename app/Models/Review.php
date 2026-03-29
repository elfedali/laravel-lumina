<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'locale_id',
        'user_id',
        'author_name',
        'rating',
        'content',
        'is_published',
    ];

    protected $casts = [
        'locale_id'    => 'integer',
        'user_id'      => 'integer',
        'rating'       => 'integer',
        'replied_at'   => 'datetime',
        'is_published' => 'boolean',
    ];

    public function locale(): BelongsTo
    {
        return $this->belongsTo(Locale::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStarsAttribute(): string
    {
        return str_repeat('★', $this->rating) . str_repeat('☆', 5 - $this->rating);
    }
}
