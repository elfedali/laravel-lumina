<?php

namespace App\Http\Controllers;

use App\Models\Locale;
use App\Traits\ActiveTrait;

class ActiveLocaleController extends Controller
{
    use ActiveTrait;
    /**
     * Set the active locale.
     * 
     */
    public function setActive(Locale $locale)
    {

        $this->setActiveLocale($locale);
        return $this->redirectToActiveLocale($locale->displayName2 . ' est maintenant actif.');
    }

    public function setActiveJson(Locale $locale)
    {
        session()->flash('success', $locale->displayName2 . ' est maintenant actif.');
        $this->setActiveLocale($locale);
        return response()->json(['success' => true]);
    }
}
