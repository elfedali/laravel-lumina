<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Models\Locale;
use App\Models\MenuItem;
use App\Models\MenuSection;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    use UploadTrait;

    public function index(Request $request)
    {
        $localeId  = $request->session()->get(Locale::ACTIVE_LOCALE);
        $search    = $request->get('search');
        $sectionId = $request->get('section_id');

        $sections = MenuSection::where('locale_id', $localeId)
            ->with(['menuItems' => function ($q) use ($search) {
                $q->when($search, fn ($q2) => $q2->where('name', 'like', "%{$search}%"))
                  ->orderBy('sort_order');
            }])
            ->orderBy('sort_order')
            ->get();

        // Items with no section
        $unsectionedItems = MenuItem::where('locale_id', $localeId)
            ->whereNull('section_id')
            ->when($search, fn ($q) => $q->where('name', 'like', "%{$search}%"))
            ->orderBy('sort_order')
            ->get();

        $activeSection = $sectionId
            ? $sections->firstWhere('id', $sectionId)
            : $sections->first();

        return view('service.index', compact('sections', 'unsectionedItems', 'activeSection', 'search'));
    }

    public function create(Request $request)
    {
        $localeId = $request->session()->get(Locale::ACTIVE_LOCALE);
        $sections = MenuSection::where('locale_id', $localeId)->orderBy('sort_order')->get();

        return view('service.create', compact('sections'));
    }

    public function store(StoreMenuItemRequest $request)
    {
        $data = $request->validated();
        $data['locale_id'] = $request->session()->get(Locale::ACTIVE_LOCALE);

        foreach (['is_halal','is_vegetarian','is_vegan','is_gluten_free','is_spicy','is_featured','is_new'] as $flag) {
            $data[$flag] = $request->boolean($flag);
        }

        if ($request->hasFile('photo')) {
            $data['photo'] = $this->upload($request, 'photo', 'menu-items', 800, 85, null);
        }

        MenuItem::create($data);

        return redirect()->route('service.index')->with('success', 'Article ajouté au menu avec succès.');
    }

    public function edit(Request $request, MenuItem $menuItem)
    {
        $localeId = $request->session()->get(Locale::ACTIVE_LOCALE);
        $sections = MenuSection::where('locale_id', $localeId)->orderBy('sort_order')->get();

        return view('service.edit', compact('menuItem', 'sections'));
    }

    public function update(UpdateMenuItemRequest $request, MenuItem $menuItem)
    {
        $data = $request->validated();

        foreach (['is_halal','is_vegetarian','is_vegan','is_gluten_free','is_spicy','is_featured','is_new','is_active'] as $flag) {
            $data[$flag] = $request->boolean($flag);
        }

        if ($request->hasFile('photo')) {
            if ($menuItem->photo) {
                $this->deleteFile($menuItem->photo);
            }
            $data['photo'] = $this->upload($request, 'photo', 'menu-items', 800, 85, null);
        }

        $menuItem->update($data);

        return redirect()->route('service.index')->with('success', 'Article mis à jour.');
    }

    public function toggleActive(MenuItem $menuItem)
    {
        $menuItem->update(['is_active' => !$menuItem->is_active]);

        return response()->json(['success' => true, 'is_active' => $menuItem->is_active]);
    }

    public function destroy(MenuItem $menuItem)
    {
        if ($menuItem->photo) {
            $this->deleteFile($menuItem->photo);
        }
        $menuItem->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('service.index')->with('success', 'Article supprimé du menu.');
    }
}
