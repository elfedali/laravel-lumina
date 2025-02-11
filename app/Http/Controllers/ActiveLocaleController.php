<?php

namespace App\Http\Controllers;

use App\Models\Locale;
use Illuminate\Http\Request;

class ActiveLocaleController extends Controller
{

    /**
     * Set the active locale.
     * 
     */
    public function setActive(Locale $locale)
    {
        session()->put(Locale::ACTIVE_LOCALE_NAME, $locale->displayName2);
        session()->put(Locale::ACTIVE_LOCALE, $locale->id);

        logger('Active locale set to ' . $locale);
        return redirect()->back();
    }
}
