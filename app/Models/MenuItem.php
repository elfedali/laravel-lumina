<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'locale_id',
        'section_id',
        'name',
        'description',
        'price',
        'photo',
        'is_halal',
        'is_vegetarian',
        'is_vegan',
        'is_gluten_free',
        'is_spicy',
        'is_featured',
        'is_new',
        'is_active',
        'sort_order',
        'preparation_time',
    ];

    protected $casts = [
        'locale_id'        => 'integer',
        'section_id'       => 'integer',
        'price'            => 'decimal:2',
        'is_halal'         => 'boolean',
        'is_vegetarian'    => 'boolean',
        'is_vegan'         => 'boolean',
        'is_gluten_free'   => 'boolean',
        'is_spicy'         => 'boolean',
        'is_featured'      => 'boolean',
        'is_new'           => 'boolean',
        'is_active'        => 'boolean',
        'sort_order'       => 'integer',
        'preparation_time' => 'integer',
    ];

    public function locale(): BelongsTo
    {
        return $this->belongsTo(Locale::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(MenuSection::class, 'section_id');
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'menu_item_tag');
    }

    public function getPhotoUrlAttribute(): string
    {
        return $this->photo
            ? asset('storage/' . $this->photo)
            : asset('assets/images/dish-placeholder.png');
    }

    public function getDietaryBadgesAttribute(): array
    {
        $badges = [];
        if ($this->is_halal)       $badges[] = ['label' => 'Halal',       'color' => '#198754'];
        if ($this->is_vegetarian)  $badges[] = ['label' => 'Vegetarian',  'color' => '#0d6efd'];
        if ($this->is_vegan)       $badges[] = ['label' => 'Vegan',       'color' => '#20c997'];
        if ($this->is_gluten_free) $badges[] = ['label' => 'Gluten-free', 'color' => '#ffc107'];
        if ($this->is_spicy)       $badges[] = ['label' => 'Spicy',       'color' => '#dc3545'];
        return $badges;
    }
}
