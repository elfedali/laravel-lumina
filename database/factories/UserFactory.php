<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'password' =>  Hash::make('password'),
            'firstname' => fake()->randomElement(['Mohamed', 'Youssef', 'Omar', 'Ali', 'Fatima', 'Khadija', 'Aicha', 'Hassan']),
            'lastname' => fake()->randomElement(['Rehmani', 'Ait Ougadir', 'Ben Yahya', 'Al alaoui', 'Alami', 'Taybi', 'Makhloufi', 'Lahrichi']),
            'bio' => 'I am a user',
            'birthdate' => fake()->date(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->randomElement(['Rue', 'Avenue', 'Boulevard', 'Place']) . ' ' . fake()->randomElement(['Mohamed V', 'Hassan II', 'Allal Ben Abdellah', 'Abdelkrim El Khattabi', 'Oued Laou', 'Oued Martil',]),
            'city' => fake()->randomElement(['Marrakech', 'Casablanca', 'Rabat', 'Tanger']),
            'neighborhood' => fake()->randomElement(['Guiliz', 'Massira', 'Targa', 'Majorelle']),
            'country' => 'Morocco',
            'zip_code' => fake()->randomNumber(5),
            'role' => User::ROLE_USER,
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ];
    }


    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
