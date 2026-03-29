<?php

namespace App\Policies;

use App\Models\Booking;
use App\Models\User;

class BookingPolicy
{
    public function viewAny(User $user): bool  { return true; }
    public function view(User $user, Booking $booking): bool  { return $this->ownsLocale($user, $booking->locale_id); }
    public function create(User $user): bool { return true; }
    public function update(User $user, Booking $booking): bool { return $this->ownsLocale($user, $booking->locale_id); }
    public function delete(User $user, Booking $booking): bool { return $this->ownsLocale($user, $booking->locale_id); }

    private function ownsLocale(User $user, int $localeId): bool
    {
        if ($user->isAdmin()) return true;
        return $user->companies()
            ->whereHas('locales', fn ($q) => $q->where('id', $localeId))
            ->exists();
    }
}
