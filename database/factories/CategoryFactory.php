<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    private static array $categories = [
        ['name' => 'Marocain',     'icon' => '🍲', 'color' => '#e74c3c'],
        ['name' => 'Italien',      'icon' => '🍕', 'color' => '#27ae60'],
        ['name' => 'Fast Food',    'icon' => '🍔', 'color' => '#f39c12'],
        ['name' => 'Asiatique',    'icon' => '🍜', 'color' => '#e67e22'],
        ['name' => 'Méditerranéen','icon' => '🥗', 'color' => '#16a085'],
        ['name' => 'Grill & BBQ',  'icon' => '🥩', 'color' => '#c0392b'],
        ['name' => 'Café & Snack', 'icon' => '☕', 'color' => '#8e44ad'],
        ['name' => 'Pâtisserie',   'icon' => '🥐', 'color' => '#e7c6a5'],
        ['name' => 'Fruits de mer','icon' => '🦞', 'color' => '#2980b9'],
        ['name' => 'Végétarien',   'icon' => '🥦', 'color' => '#2ecc71'],
    ];

    private static int $index = 0;

    public function definition(): array
    {
        $cat = self::$categories[self::$index % count(self::$categories)];
        self::$index++;

        return [
            'name'       => $cat['name'],
            'slug'       => Str::slug($cat['name']),
            'icon'       => $cat['icon'],
            'color'      => $cat['color'],
            'is_active'  => true,
            'sort_order' => self::$index,
        ];
    }
}
