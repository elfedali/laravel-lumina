<?php

namespace App\Policies;

use App\Models\Staff;
use App\Models\User;

class StaffPolicy
{
    public function viewAny(User $user): bool  { return true; }
    public function view(User $user, Staff $staff): bool  { return $this->ownsLocale($user, $staff->locale_id); }
    public function create(User $user): bool { return true; }
    public function update(User $user, Staff $staff): bool { return $this->ownsLocale($user, $staff->locale_id); }
    public function delete(User $user, Staff $staff): bool { return $this->ownsLocale($user, $staff->locale_id); }

    private function ownsLocale(User $user, int $localeId): bool
    {
        if ($user->isAdmin()) return true;
        return $user->companies()
            ->whereHas('locales', fn ($q) => $q->where('id', $localeId))
            ->exists();
    }
}
