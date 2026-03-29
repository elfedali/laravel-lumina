<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStaffFunctionRequest;
use App\Models\StaffFunction;
use Illuminate\Http\Request;

class StaffFunctionController extends Controller
{
    public function index()
    {
        $functions = StaffFunction::withCount('staff')->orderBy('name')->get();

        return view('staff.function.index', compact('functions'));
    }

    public function create()
    {
        return view('staff.function.create');
    }

    public function store(StoreStaffFunctionRequest $request)
    {
        StaffFunction::create($request->validated());

        return redirect()->route('staff.function')->with('success', 'Fonction créée avec succès.');
    }

    public function edit(StaffFunction $staffFunction)
    {
        return view('staff.function.edit', compact('staffFunction'));
    }

    public function update(StoreStaffFunctionRequest $request, StaffFunction $staffFunction)
    {
        $staffFunction->update($request->validated());

        return redirect()->route('staff.function')->with('success', 'Fonction mise à jour.');
    }

    public function destroy(StaffFunction $staffFunction)
    {
        // Unlink staff members before deleting
        $staffFunction->staff()->update(['function_id' => null]);
        $staffFunction->delete();

        return redirect()->route('staff.function')->with('success', 'Fonction supprimée.');
    }
}
