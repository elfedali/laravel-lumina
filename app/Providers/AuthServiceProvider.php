<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\MenuItem;
use App\Models\Person;
use App\Models\Review;
use App\Models\Staff;
use App\Models\User;
use App\Policies\BookingPolicy;
use App\Policies\MenuItemPolicy;
use App\Policies\PersonPolicy;
use App\Policies\ReviewPolicy;
use App\Policies\StaffPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Person::class  => PersonPolicy::class,
        Booking::class => BookingPolicy::class,
        MenuItem::class => MenuItemPolicy::class,
        Review::class  => ReviewPolicy::class,
        Staff::class   => StaffPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        // Admin gate: only users with the 'admin' role may access admin routes.
        Gate::define('viewAdmin', function (User $user) {
            return $user->isAdmin();
        });
    }
}
