<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUserStoreRequest;
use App\Http\Requests\AdminUserUpdateRequest;
use App\Models\Company;
use App\Models\Locale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\ImageManager;


class AdminLocaleController extends Controller
{
    const LOGO_SIZE = 400;
    const LOGO_QUALITY = 60;
    const LOGO_PATH = 'logos';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $companies = Company::with(['locales' => function ($query) use ($search) {
            if ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('address', 'like', "%$search%")
                    ->orWhere('city', 'like', "%$search%");
            }
        }])->get();



        return view('admin.locales.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.locales.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminUserStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create($request->validated());

            $companyData = $request->validated()['company'];
            $companyData['logo'] = $this->handleCompanyLogo($request);

            $user->company()->create(array_merge($companyData, ['owner_id' => $user->id]));
        });

        return redirect()->route('locales.index')->with('success', 'Utilisateur créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    // public function show(Locale $locale): View
    // {
    //     return view('admin.locales.show', compact('locale'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Locale $locale): View
    {
        return view('admin.locales.edit', compact('locale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUserUpdateRequest $request, Locale $locale)
    {
        DB::transaction(function () use ($request, $locale) {
            $locale->update($request->validated());

            $companyData = $request->validated()['company'];
            $companyData['logo'] = $this->handleCompanyLogo($request, $locale->company);

            $locale->company()->update($companyData);
        });

        return redirect()->route('users.edit', $locale)->with('success', 'Utilisateur mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Locale $locale)
    {
        /**
         * @var User $user
         */
        $user = auth()->user();
        if ($user->isAdmin()) {
            return redirect()->route('locales.index')->with('error', 'Vous ne pouvez pas supprimer un administrateur');
        }

        $this->deleteCompanyLogo($user);

        $user->delete();

        return redirect()->route('locales.index')->with('success', 'Utilisateur supprimé avec succès');
    }

    /**
     * Handle company logo upload.
     */
    private function handleCompanyLogo(Request $request, User $user = null): ?string
    {
        if (!$request->hasFile('company.logo')) {
            return $user?->company->logo ?? null;
        }

        // Delete old logo if updating
        $this->deleteCompanyLogo($user);

        $logo = $request->file('company.logo');
        $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
        $image = $manager->read($logo)->scale(width: self::LOGO_SIZE);

        $year = date('Y');
        $month = date('m');
        $logoPath = self::LOGO_PATH . "/{$year}/{$month}/" . uniqid() . '.jpg';

        Storage::disk('public')->put($logoPath, $image->toJpeg(self::LOGO_QUALITY));

        return $logoPath;
    }

    /**
     * Delete company logo if it exists.
     */
    private function deleteCompanyLogo(?User $user): void
    {
        if ($user?->company?->logo) {
            try {
                Storage::disk('public')->delete($user->company->logo);
            } catch (\Exception $e) {
                // Log error or handle silently
            }
        }
    }
}
