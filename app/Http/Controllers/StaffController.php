<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStaffRequest;
use App\Http\Requests\UpdateStaffRequest;
use App\Models\Locale;
use App\Models\Staff;
use App\Models\StaffFunction;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    use UploadTrait;

    public function index(Request $request)
    {
        $localeId = $request->session()->get(Locale::ACTIVE_LOCALE);
        $search   = $request->get('search');

        $staff = Staff::where('locale_id', $localeId)
            ->with('function')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q2) use ($search) {
                    $q2->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name',  'like', "%{$search}%")
                        ->orWhere('email',       'like', "%{$search}%");
                });
            })
            ->orderBy('last_name')
            ->paginate(15)
            ->withQueryString();

        $functions = StaffFunction::orderBy('name')->get();

        return view('staff.index', compact('staff', 'functions'));
    }

    public function create()
    {
        $functions = StaffFunction::orderBy('name')->get();

        return view('staff.create', compact('functions'));
    }

    public function store(StoreStaffRequest $request)
    {
        $data = $request->validated();
        $data['locale_id'] = $request->session()->get(Locale::ACTIVE_LOCALE);
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('avatar')) {
            $data['avatar'] = $this->upload($request, 'avatar', 'staff-avatars', 300, 85, null);
        }

        Staff::create($data);

        return redirect()->route('staff.index')->with('success', 'Collaborateur ajouté avec succès.');
    }

    public function edit(Staff $staff)
    {
        $functions = StaffFunction::orderBy('name')->get();

        return view('staff.edit', compact('staff', 'functions'));
    }

    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        $data = $request->validated();
        $data['is_active'] = $request->boolean('is_active', true);

        if ($request->hasFile('avatar')) {
            if ($staff->avatar) {
                $this->deleteFile($staff->avatar);
            }
            $data['avatar'] = $this->upload($request, 'avatar', 'staff-avatars', 300, 85, null);
        }

        $staff->update($data);

        return redirect()->route('staff.index')->with('success', 'Collaborateur mis à jour.');
    }

    public function destroy(Staff $staff)
    {
        if ($staff->avatar) {
            $this->deleteFile($staff->avatar);
        }
        $staff->delete();

        if (request()->expectsJson()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('staff.index')->with('success', 'Collaborateur supprimé.');
    }
}
