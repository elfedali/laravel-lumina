<?php

namespace Database\Factories;

use App\Models\Locale;
use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReviewFactory extends Factory
{
    protected $model = Review::class;

    private static array $comments = [
        'Excellent restaurant, je recommande vivement !',
        'Très bon accueil et cuisine délicieuse.',
        'Les plats marocains sont authentiques et savoureux.',
        'Service rapide et personnel agréable.',
        'La meilleure pastilla de la ville !',
        'Cadre agréable, cuisine correcte sans plus.',
        'Un peu cher mais la qualité est au rendez-vous.',
        'Tajine exceptionnel, je reviendrai.',
        'Menu varié, adapté pour toute la famille.',
        'Couscous royal généreux et bien épicé.',
    ];

    public function definition(): array
    {
        return [
            'locale_id'    => Locale::inRandomOrder()->first()?->id ?? Locale::factory(),
            'user_id'      => null,
            'author_name'  => $this->faker->name(),
            'rating'       => $this->faker->numberBetween(3, 5),
            'content'      => $this->faker->randomElement(self::$comments),
            'is_published' => $this->faker->boolean(80),
        ];
    }
}
