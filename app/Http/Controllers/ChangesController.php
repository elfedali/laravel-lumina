<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ChangesController extends Controller
{
    use UploadTrait;

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
}
