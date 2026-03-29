<?php

namespace App\Policies;

use App\Models\Review;
use App\Models\User;

class ReviewPolicy
{
    public function viewAny(User $user): bool  { return true; }
    public function create(User $user): bool { return true; }
    public function update(User $user, Review $review): bool { return $user->isAdmin(); }
    public function delete(User $user, Review $review): bool { return $user->isAdmin() || $this->ownsLocale($user, $review->locale_id); }

    private function ownsLocale(User $user, int $localeId): bool
    {
        return $user->companies()
            ->whereHas('locales', fn ($q) => $q->where('id', $localeId))
            ->exists();
    }
}
