<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminUserStoreRequest;
use App\Http\Requests\AdminUserUpdateRequest;
use App\Models\User;
use App\Traits\UploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminUserController extends Controller
{
    use UploadTrait;
    const LOGO_SIZE = 400;
    const LOGO_QUALITY = 60;
    const LOGO_PATH = 'logos';

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $search = $request->get('search');
        $users = User::where(function ($query) use ($search) {
            $query->where('name', 'like', "%$search%")
                ->orWhere('email', 'like', "%$search%")
                ->orWhere('phone', 'like', "%$search%")
                ->orWhere('firstname', 'like', "%$search%")
                ->orWhere('lastname', 'like', "%$search%");
        })
            ->latest()
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

            $companyData = $request->validated()['company'];
            $companyData['logo'] = $this->handleCompanyLogo($request); // Use trait method

            $user->company()->create(array_merge($companyData, ['owner_id' => $user->id]));
        });

        return redirect()->route('users.index')->with('success', 'Utilisateur créé avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): View
    {
        return view('admin.users.show', compact('user'));
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

            $companyData = $request->validated()['company'];
            $companyData['logo'] = $this->handleCompanyLogo($request, $user); // Use trait method

            $user->company()->update($companyData);
        });

        return redirect()->route('users.edit', $user)->with('success', 'Utilisateur mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if ($user->isAdmin()) {
            return redirect()->route('users.index')->with('error', 'Vous ne pouvez pas supprimer un administrateur');
        }

        $this->deleteCompanyLogo($user); // Still needed for eventual cleanup

        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès');
    }

    /**
     * Handle company logo upload using the trait.
     */
    private function handleCompanyLogo(Request $request, User $user = null): ?string
    {

        return $this->upload($request, 'company.logo', self::LOGO_PATH, self::LOGO_SIZE, self::LOGO_QUALITY, $user?->company?->logo);
    }

    /**
     * Delete company logo if it exists.  (Still needed for cleanup during updates/deletes)
     */
    private function deleteCompanyLogo(?User $user): void
    {
        if ($user?->company?->logo) {
            $this->deleteFile($user->company->logo); // Use the trait's deleteFile method
        }
    }
}
