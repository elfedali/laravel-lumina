<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Traits\ActiveTrait;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use \App\Models\Locale;

class ChangesController extends Controller
{
    use UploadTrait;
    use ActiveTrait;

    const LOGO_SIZE = 400; // Define logo size
    const LOGO_QUALITY = 60; // Define logo quality
    const LOGO_PATH = 'logos'; // Define logo path

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function editCompany()
    {
        $company = auth()->user()->company;

        return view('settings.company.edit', compact('company'));
    }

    public function updateCompany(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $company = Company::findOrFail(auth()->user()->company->id);

        $company->update([
            'name' => $data['name'],
            'category' => $data['category'],
        ]);

        $company->save();

        // Handle logo upload if a new logo is provided
        if ($request->hasFile('logo')) {
            $logoPath = $this->handleLogoUpload($request, $company);
            if ($logoPath) {
                $company->logo = $logoPath;
                $company->save(); // Important: Save the updated company model
            }
        }

        return redirect()->route('settings.company.edit')->with('success', 'Le salon a été mis à jour avec succès');
    }

    /**
     * Handles the logo upload using the trait.
     *
     * @param Request $request
     * @param Company $company
     * @return string|null
     */
    private function handleLogoUpload(Request $request, Company $company): ?string
    {
        return $this->upload(
            $request,
            'logo',
            self::LOGO_PATH,
            self::LOGO_SIZE,
            self::LOGO_QUALITY,
            $company->logo // Pass the existing logo path for deletion during update
        );
    }

    public function createLocale()
    {
        $locale = null;

        return view('settings.locales.create', compact('locale'));
    }

    public function storeLocale(Request $request)
    {
        $data = $request->validate([
            'address' => 'required|string',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|string',
            'phone2' => 'nullable|string',

            'hours' => 'required|array',
            'hours.*.open' => 'required|boolean',
            'hours.*.start' => 'required_if:hours.*.open,true|date_format:H:i',
            'hours.*.end' => 'required_if:hours.*.open,true|date_format:H:i|after:hours.*.start',

        ]);

        $locale =   \App\Models\Locale::create([
            'address' => $data['address'],
            'neighborhood' => $data['neighborhood'],
            'city' => $data['city'],
            'phone' => $data['phone'],
            'phone2' => $data['phone2'] ?? null,
            'hours' => $data['hours'] ?? null,
            'company_id' => auth()->user()->company->id,
            'is_primary' => false,
        ]);

        return redirect()->route('dashboard')->with('success', 'Une adresse a été ajoutée avec succès !');
    }


    /**
     * 
     * Delete locale by axios
     */

    public function editLocale(Locale $locale)
    {
        return view('settings.locales.edit', compact('locale'));
    }

    public function destroyLocale(Locale $locale)
    {
        if ($locale->is_primary)
            return redirect()->back()->with('danger', 'Impossible de supprimer le local principal');

        $locale->delete();

        // message 

        return redirect()->route('dashboard')->with('success', 'Une adresse a été supprimée avec succès !');

        // return response()->json([
        //     "success" => true,
        //     "message" => "Une adresse a été supprimée avec succès !",
        //     "locale" => $locale
        // ], 200);
    }


    public function updateLocale(Request $request, Locale $locale)
    {
        $data = $request->validate([
            'address' => 'required|string',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|string',
            'phone2' => 'nullable|string',

            'hours' => 'required|array',
            'hours.*.open' => 'required|boolean',
            'hours.*.start' => 'required_if:hours.*.open,true|date_format:H:i',
            'hours.*.end' => 'required_if:hours.*.open,true|date_format:H:i|after:hours.*.start',

        ]);

        $locale->update([
            'address' => $data['address'],
            'neighborhood' => $data['neighborhood'],
            'city' => $data['city'],
            'phone' => $data['phone'],
            'phone2' => $data['phone2'] ?? null,
            'hours' => $data['hours'] ?? null,
        ]);

        return redirect()->route('dashboard')->with('success', 'L\'adresse a été mise à jour avec succès !');
    }
}
