<?php

namespace App\Traits;

use App\Models\Locale;

trait ActiveTrait
{
    public function setActiveLocale(Locale  $locale)
    {
        // TODO: activate the locale by default if is_lastactive is true
        session()->put(Locale::ACTIVE_LOCALE_NAME, $locale->displayName2);
        session()->put(Locale::ACTIVE_LOCALE, $locale->id);
    }

    public function redirectToActiveLocale($message)
    {
        session()->flash('success', $message);
        return redirect()->route('dashboard');
    }
}
