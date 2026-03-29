<?php

namespace App\Policies;

use App\Models\MenuItem;
use App\Models\User;

class MenuItemPolicy
{
    public function viewAny(User $user): bool  { return true; }
    public function view(User $user, MenuItem $item): bool { return $this->ownsLocale($user, $item->locale_id); }
    public function create(User $user): bool { return true; }
    public function update(User $user, MenuItem $item): bool { return $this->ownsLocale($user, $item->locale_id); }
    public function delete(User $user, MenuItem $item): bool { return $this->ownsLocale($user, $item->locale_id); }

    private function ownsLocale(User $user, int $localeId): bool
    {
        if ($user->isAdmin()) return true;
        return $user->companies()
            ->whereHas('locales', fn ($q) => $q->where('id', $localeId))
            ->exists();
    }
}
