<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUserStoreRequest;
use App\Http\Requests\AdminUserUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    { // search =  by name, email, phone,  firstname, lastname
        $search = $request->get('search');
        $users = User::where('name', 'like', '%' . $search . '%')
            ->orWhere('email', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%')
            ->orWhere('firstname', 'like', '%' . $search . '%')
            ->orWhere('lastname', 'like', '%' . $search . '%')
            ->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminUserStoreRequest $request)
    {
        DB::transaction(function () use ($request) {
            $user = User::create($request->validated());
            $user->company()->create(array_merge(
                $request->validated()['company'],
                ['owner_id' => $user->id],
                $request->file('company.logo') ? ['logo' => $request->file('company.logo')->store('logos', 'public')] : []
            ));
        });

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user): View
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminUserUpdateRequest $request, User $user)
    {
        DB::transaction(function () use ($request, $user) {
            $user->update($request->validated());
            if ($user->company) {
                $user->company()->update(array_merge(
                    $request->validated()['company'],
                    $request->file('company.logo') ? ['logo' => $request->file('company.logo')->store('logos', 'public')] : []
                ));
            }
            $user->company()->create(array_merge(
                $request->validated()['company'],
                ['owner_id' => $user->id],
                $request->file('company.logo') ? ['logo' => $request->file('company.logo')->store('logos', 'public')] : []
            ));
        });

        return redirect()->route('users.index')->with('success', 'Utilisateur modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès');
    }
}
