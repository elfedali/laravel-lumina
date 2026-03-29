<?php

namespace Database\Factories;

use App\Models\Locale;
use App\Models\Staff;
use App\Models\StaffFunction;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    protected $model = Staff::class;

    public function definition(): array
    {
        return [
            'locale_id'   => Locale::inRandomOrder()->first()?->id ?? Locale::factory(),
            'function_id' => StaffFunction::inRandomOrder()->first()?->id,
            'first_name'  => $this->faker->firstName(),
            'last_name'   => $this->faker->lastName(),
            'avatar'      => null,
            'phone'       => $this->faker->optional(0.7)->numerify('06########'),
            'email'       => $this->faker->optional(0.5)->safeEmail(),
            'is_active'   => $this->faker->boolean(85),
        ];
    }
}
