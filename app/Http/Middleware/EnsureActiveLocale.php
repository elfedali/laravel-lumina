<?php

namespace App\Http\Middleware;

use App\Models\Locale;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureActiveLocale
{
    /**
     * Ensure a non-admin authenticated user always has an active locale in session.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return $next($request);
        }

        $user = auth()->user();

        if (($user->role ?? null) === 'admin') {
            return $next($request);
        }

        $activeLocaleId = $request->session()->get(Locale::ACTIVE_LOCALE);

        if (!$activeLocaleId) {
            $company = $user->company;

            if ($company) {
                $defaultLocale = $company->locales()->orderByDesc('is_primary')->orderBy('id')->first();

                if ($defaultLocale) {
                    $request->session()->put(Locale::ACTIVE_LOCALE, $defaultLocale->id);
                    $request->session()->put(Locale::ACTIVE_LOCALE_NAME, $defaultLocale->displayName2);
                }
            }
        }

        return $next($request);
    }
}
