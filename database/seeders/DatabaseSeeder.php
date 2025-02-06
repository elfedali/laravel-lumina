<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'email' => 'webmaster@lumina.ma',
            'role' => 'admin'
        ]);

        \App\Models\User::factory()->create([
            'email' => 'client@lumina.ma',
            'role' => 'user'
        ]);
    }
}
