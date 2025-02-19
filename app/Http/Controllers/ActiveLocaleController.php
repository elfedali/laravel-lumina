<?php

namespace App\Http\Controllers;

use App\Models\Locale;

class ActiveLocaleController extends Controller
{

    /**
     * Set the active locale.
     * 
     */
    public function setActive(Locale $locale)
    {

        // TODO: activate the locale by default if is_lastactive is true
        session()->put(Locale::ACTIVE_LOCALE_NAME, $locale->displayName2);
        session()->put(Locale::ACTIVE_LOCALE, $locale->id);

        return redirect()->route('dashboard')->with('success', $locale->displayName2 . 'est maintenant actif.');
    }
}
