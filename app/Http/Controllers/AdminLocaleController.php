<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminLocaleStoreRequest;
use App\Http\Requests\AdminLocaleUpdateRequest;
use App\Models\Company;
use App\Models\Locale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Intervention\Image\ImageManager;

class AdminLocaleController extends Controller
{
    const COVER_SIZE = 400;
    const COVER_QUALITY = 60;
    const COVER_PATH = 'covers';

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        // validate the search query
        $request->validate([
            'search' => 'nullable|string|max:255',
        ]);

        $search = $request->get('search');
        $companies = Company::with(['locales' => function ($query) use ($search) {
            if ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('address', 'like', "%$search%")
                    ->orWhere('city', 'like', "%$search%")
                    ->orWhere('neighborhood', 'like', "%$search%")
                    ->orWhere('phone', 'like', "%$search%")
                    ->orWhere('phone2', 'like', "%$search%");
            }
            $query->latest();
        }])

            ->get();

        return view('admin.locales.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $companies = Company::all();
        return view('admin.locales.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminLocaleStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $localeData = $request->validated();
            $localeData['cover'] = $this->handleCoverUpload($request);
            $localeData['is_primary'] = true;
            $locale = Locale::create($localeData);
        });

        return redirect()->route('locales.index')->with('success', 'Le local a été créé avec succès');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Locale $locale): View
    {
        ray($locale);

        return view('admin.locales.edit', compact('locale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminLocaleUpdateRequest $request, Locale $locale)
    {
        DB::transaction(function () use ($request, $locale) {
            $localeData = $request->validated();
            $localeData['cover'] = $this->handleCoverUpload($request, $locale);

            $locale->update($localeData);
        });

        return redirect()->route('locales.edit', $locale)->with('success', 'Le local a été mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Locale $locale)
    {
        $this->deleteCover($locale);

        $locale->delete();

        return redirect()->route('locales.index')->with('success', 'Le local a été supprimé avec succès');
    }

    /**
     * Handle cover upload.
     */
    private function handleCoverUpload(Request $request, Locale $locale = null): ?string
    {
        if (!$request->hasFile('cover')) {
            return $locale?->cover ?? null;
        }

        // Delete old cover if updating
        $this->deleteCover($locale);

        $cover = $request->file('cover');
        $manager = new ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
        $image = $manager->make($cover)->resize(self::COVER_SIZE, null, function ($constraint) {
            $constraint->aspectRatio();
        })->encode('jpg', self::COVER_QUALITY);

        $year = date('Y');
        $month = date('m');
        $coverPath = self::COVER_PATH . "/{$year}/{$month}/" . uniqid() . '.jpg';

        Storage::disk('public')->put($coverPath, (string) $image);

        return $coverPath;
    }

    /**
     * Delete cover if it exists.
     */
    private function deleteCover(?Locale $locale): void
    {
        if ($locale?->cover) {
            try {
                Storage::disk('public')->delete($locale->cover);
            } catch (\Exception $e) {
                // Log error or handle silently
            }
        }
    }
}
