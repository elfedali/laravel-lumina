<?php

namespace Database\Factories;

use App\Models\Locale;
use App\Models\MenuSection;
use Illuminate\Database\Eloquent\Factories\Factory;

class MenuItemFactory extends Factory
{
    private static array $dishes = [
        'Tajine de poulet aux olives',
        'Couscous royal',
        'Tanjia marrakchia',
        'Pastilla au poulet',
        'Harira',
        'Brochettes de kefta',
        'Méchoui d\'agneau',
        'Salade marocaine',
        'Zaalouk d\'aubergines',
        'Brick à l\'œuf',
        'Msemen au miel',
        'Loubia',
        'Rfissa',
        'Bastila aux fruits de mer',
        'Pizza margherita',
        'Burger artisanal',
        'Thé à la menthe',
        'Jus d\'orange pressé',
        'Café marocain',
        'Cornes de gazelle',
    ];

    public function definition(): array
    {
        return [
            'locale_id'        => Locale::inRandomOrder()->first()?->id ?? Locale::factory(),
            'section_id'       => MenuSection::inRandomOrder()->first()?->id,
            'name'             => $this->faker->randomElement(self::$dishes),
            'description'      => $this->faker->optional(0.7)->sentence(12),
            'price'            => $this->faker->randomFloat(2, 15, 250),
            'photo'            => null,
            'is_halal'         => $this->faker->boolean(80),
            'is_vegetarian'    => $this->faker->boolean(25),
            'is_vegan'         => $this->faker->boolean(10),
            'is_gluten_free'   => $this->faker->boolean(15),
            'is_spicy'         => $this->faker->boolean(30),
            'is_featured'      => $this->faker->boolean(20),
            'is_new'           => $this->faker->boolean(15),
            'is_active'        => $this->faker->boolean(90),
            'sort_order'       => $this->faker->numberBetween(0, 20),
            'preparation_time' => $this->faker->optional(0.6)->numberBetween(5, 45),
        ];
    }
}
