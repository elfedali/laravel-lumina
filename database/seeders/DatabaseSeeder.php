<?php

namespace Database\Seeders;

use App\Models\Booking;
use App\Models\Category;
use App\Models\Company;
use App\Models\Locale;
use App\Models\MenuItem;
use App\Models\MenuSection;
use App\Models\Person;
use App\Models\Review;
use App\Models\Staff;
use App\Models\StaffFunction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ── 1. Admin user ──────────────────────────────────────────────────
        User::factory()->create([
            'email' => 'webmaster@lumina.ma',
            'role'  => 'admin',
        ]);

        // Demo restaurant owner
        User::factory()->create([
            'email'     => 'owner@lumina.ma',
            'role'      => 'user',
            'firstname' => 'Youssef',
            'lastname'  => 'Benali',
        ]);

        // ── 2. Cuisine categories ──────────────────────────────────────────
        Category::factory(10)->create();

        // ── 3. Companies (restaurant brands) ──────────────────────────────
        Company::factory(10)->create();

        // ── 4. Locales (restaurant locations) ─────────────────────────────
        Locale::factory(60)->create();

        // Attach 1–3 categories per locale
        Category::all()->each(function ($cat) {
            $locales = Locale::inRandomOrder()->take(rand(3, 8))->pluck('id');
            $cat->locales()->sync($locales);
        });

        // ── 5. Menu sections per locale ────────────────────────────────────
        $sectionNames = ['Starters', 'Main Courses', 'Grills & Roasts', 'Pasta & Rice', 'Desserts', 'Beverages'];

        Locale::all()->each(function (Locale $locale) use ($sectionNames) {
            $count = rand(3, 5);
            $names = array_slice(array_values($sectionNames), 0, $count);
            foreach ($names as $i => $name) {
                MenuSection::create([
                    'locale_id'  => $locale->id,
                    'name'       => $name,
                    'sort_order' => $i,
                    'is_active'  => true,
                ]);
            }
        });

        // ── 6. Menu items ──────────────────────────────────────────────────
        MenuItem::factory(400)->create();

        // ── 7. Staff functions ─────────────────────────────────────────────
        StaffFunction::factory(8)->create();

        // ── 8. Staff ───────────────────────────────────────────────────────
        Staff::factory(120)->create();

        // ── 9. Clients (persons) ───────────────────────────────────────────
        Person::factory(150)->create();

        // ── 10. Reviews ────────────────────────────────────────────────────
        Review::factory(200)->create();

        // Recalculate ratings for all locales with reviews
        Locale::has('reviews')->each(fn ($locale) => $locale->recalculateRating());

        // ── 11. Bookings ───────────────────────────────────────────────────
        Booking::factory(300)->create();
    }
}

