<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Locale;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        $date = $this->faker->dateTimeBetween('-7 days', '+30 days');

        return [
            'locale_id'    => Locale::inRandomOrder()->first()?->id ?? Locale::factory(),
            'full_name'    => $this->faker->name(),
            'phone'        => $this->faker->numerify('06########'),
            'email'        => $this->faker->optional(0.5)->safeEmail(),
            'party_size'   => $this->faker->numberBetween(1, 10),
            'booking_date' => $date->format('Y-m-d'),
            'booking_time' => $this->faker->randomElement(['12:00','12:30','13:00','13:30','19:00','19:30','20:00','20:30','21:00']),
            'status'       => $this->faker->randomElement([
                Booking::STATUS_PENDING,
                Booking::STATUS_CONFIRMED,
                Booking::STATUS_CONFIRMED,
                Booking::STATUS_COMPLETED,
                Booking::STATUS_CANCELLED,
            ]),
            'notes' => $this->faker->optional(0.3)->sentence(6),
        ];
    }
}
