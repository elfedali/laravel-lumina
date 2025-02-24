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

    public function update(Request $request, $companyId)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'category' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $company = Company::findOrFail($companyId);

        $company->update([
            'name' => $request->input('name'),
            'category' => $request->input('category'),
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

        Session::flash('success', 'Le salon a été mis à jour avec succès');

        return response()->json([
            "success" => true,
            "message" => "Le salon a été mis à jour avec succès"
        ]);
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



    public function storeLocale(Request $request)
    {
        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $locale =   \App\Models\Locale::create([
            'address' => $request->input('address'),
            'neighborhood' => $request->input('neighborhood'),
            'city' => $request->input('city'),
            'phone' => $request->input('phone'),
            'phone2' => $request->input('phone2') ?? null,
            'hours' => $request->input('hours') ?? null,
            'company_id' => auth()->user()->company->id,
            'is_primary' => false,
        ]);

        // message 
        session::flash('success', 'Le salon a été sauvegardé avec succès');

        return response()->json(
            [
                "success" => true,
                "message" => "Le salon a été sauvegardé avec succès",
                "locale" => $locale
            ],
            201
        );
    }


    /**
     * 
     * Delete locale by axios
     */

    public function destroyLocale($id)
    {
        $locale = \App\Models\Locale::findOrFail($id);

        if (!$locale)
            return response()->json([
                "success" => false,
                "message" => "Le local n'existe pas",
            ]);

        if ($locale->is_primary)
            return response()->json([
                "success" => false,
                "message" => "Impossible de supprimer le local principal",
            ]);

        $locale->delete();

        // message 

        return redirect()->route('dashboard')->with('success', 'Le local a été supprimé avec succès');

        // return response()->json([
        //     "success" => true,
        //     "message" => "Le local a été supprimé avec succès",
        //     "locale" => $locale
        // ], 200);
    }


    public function updateLocale(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
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

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ], 422);
        }

        $locale = Locale::find($id);
        $locale->update([
            'address' => $request->input('address'),
            'neighborhood' => $request->input('neighborhood'),
            'city' => $request->input('city'),
            'phone' => $request->input('phone'),
            'phone2' => $request->input('phone2') ?? null,
            'hours' => $request->input('hours') ?? null,
        ]);

        // message

        return response()->json([
            "success" => true,
            "message" => "Le local a été mis à jour avec succès",
            "locale" => $locale
        ], 200);
    }
}
