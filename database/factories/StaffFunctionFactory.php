<?php

namespace Database\Factories;

use App\Models\StaffFunction;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFunctionFactory extends Factory
{
    protected $model = StaffFunction::class;

    private static array $functions = [
        ['name' => 'Chef cuisinier', 'color' => '#dc3545'],
        ['name' => 'Sous-chef',      'color' => '#fd7e14'],
        ['name' => 'Serveur',        'color' => '#0d6efd'],
        ['name' => 'Serveuse',       'color' => '#6f42c1'],
        ['name' => 'Caissier',       'color' => '#198754'],
        ['name' => 'Manager',        'color' => '#0dcaf0'],
        ['name' => 'Barman',         'color' => '#6610f2'],
        ['name' => 'Livreur',        'color' => '#ffc107'],
    ];

    private static int $index = 0;

    public function definition(): array
    {
        $fn = self::$functions[self::$index % count(self::$functions)];
        self::$index++;
        return $fn;
    }
}
