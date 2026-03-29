<?php

namespace App\Http\Controllers;

use App\Models\Locale;
use App\Models\MenuSection;
use Illuminate\Http\Request;

class MenuSectionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $localeId = $request->session()->get(Locale::ACTIVE_LOCALE);

        $section = MenuSection::create([
            'locale_id'  => $localeId,
            'name'       => $request->name,
            'sort_order' => $request->sort_order ?? MenuSection::where('locale_id', $localeId)->max('sort_order') + 1,
        ]);

        return response()->json(['success' => true, 'section' => $section]);
    }

    public function update(Request $request, MenuSection $menuSection)
    {
        $request->validate([
            'name'       => ['required', 'string', 'max:100'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'is_active'  => ['boolean'],
        ]);

        $menuSection->update($request->only('name', 'sort_order', 'is_active'));

        return response()->json(['success' => true, 'section' => $menuSection->fresh()]);
    }

    public function destroy(MenuSection $menuSection)
    {
        // Re-assign its items to no section before deleting
        $menuSection->menuItems()->update(['section_id' => null]);
        $menuSection->delete();

        return redirect()->route('service.index')->with('success', 'Rubrique supprimée.');
    }
}
