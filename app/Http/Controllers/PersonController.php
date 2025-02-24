<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePersonRequest;
use App\Http\Requests\UpdatePersonRequest;
use App\Models\Locale;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $active_locale_id = $request->session()->get(Locale::ACTIVE_LOCALE);
        $search = $request->get('search');

        $clients = Person::where('locale_id', $active_locale_id)
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%")
                        ->orWhere('phone', 'like', "%$search%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('client.index', compact('clients'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePersonRequest $request)
    {
        $data = $request->all();
        $data['locale_id'] = $request->session()->get(Locale::ACTIVE_LOCALE);
        $person = Person::create($data);

        return redirect()->route('client.index')->with('success', 'Le client a été ajouté avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(Person $person)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Person $person)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateAjax(UpdatePersonRequest $request)
    {
        $person = Person::findOrFail($request->id);
        $person->update($request->all());
        session()->flash('success', 'Le client a été mis à jour avec succès');
        return response()->json(
            ['success' => 'Le client a été mis à jour avec succès', 'client' => $person]
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $clientId = $request->id;

        $person = Person::findOrFail($clientId);
        $person->delete();

        return redirect()->route('client.index')->with('success', 'Le client a été supprimé avec succès');
    }
}
