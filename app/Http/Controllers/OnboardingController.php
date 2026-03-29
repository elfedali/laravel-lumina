<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OnboardingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show()
    {
        $user = auth()->user();

        // Already onboarded — has at least one locale
        if ($user->company && $user->company->locales()->count() > 0) {
            return redirect()->route('dashboard');
        }

        return view('onboarding.setup');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'business_name' => ['required', 'string', 'max:100'],
            'locale_name'   => ['nullable', 'string', 'max:100'],
            'address'       => ['required', 'string', 'max:100'],
            'city'          => ['required', 'string', 'max:60'],
            'neighborhood'  => ['required', 'string', 'max:100'],
            'phone'         => ['required', 'string', 'max:50'],
        ]);

        $user    = auth()->user();
        $company = $user->company;

        // Update business name
        $company->update([
            'name' => $data['business_name'],
        ]);

        // Create the primary locale
        $localeName = $data['locale_name'] ?: $data['business_name'];

        $company->locales()->create([
            'name'         => $localeName,
            'slug'         => Str::slug($localeName) . '-' . Str::random(4),
            'address'      => $data['address'],
            'city'         => $data['city'],
            'neighborhood' => $data['neighborhood'],
            'phone'        => $data['phone'],
            'is_primary'   => true,
        ]);

        return redirect()->route('dashboard')->with('success', 'Welcome! Your business is all set up.');
    }
}
