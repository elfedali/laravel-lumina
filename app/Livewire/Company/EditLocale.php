<?php

namespace App\Livewire\Company;

use Livewire\Component;
use App\Models\Locale;

class EditLocale extends Component
{
    public $title = 'Ajouter une adresse';

    public $address;
    public $city;
    public $neighborhood;
    public $phone;
    public $phone2;

    public $hours = [];

    // Initialize the hours array with default values
    public function mount()
    {
        $this->hours = [
            'monday' => ['open' => false, 'start' => '09:00', 'end' => '21:00'],
            'tuesday' => ['open' => false, 'start' => '09:00', 'end' => '21:00'],
            'wednesday' => ['open' => false, 'start' => '09:00', 'end' => '21:00'],
            'thursday' => ['open' => false, 'start' => '09:00', 'end' => '21:00'],
            'friday' => ['open' => false, 'start' => '09:00', 'end' => '21:00'],
            'saturday' => ['open' => false, 'start' => '09:00', 'end' => '21:00'],
            'sunday' => ['open' => false, 'start' => '09:00', 'end' => '21:00'],
        ];
    }

    public function save()
    {

        $data =  $this->validate([

            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'neighborhood' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'phone2' => 'nullable|string|max:255',

            'hours' => 'required|array',
            'hours.*.open' => 'required|boolean',
            'hours.*.start' => 'required_if:hours.*.open,true|date_format:H:i',
            'hours.*.end' => 'required_if:hours.*.open,true|date_format:H:i|after:hours.*.start',

        ]);

        $locale =   \App\Models\Locale::create(
            array_merge($data, ['company_id' => auth()->user()->company->id])
        );


        // TODO: activate the locale by default if is_lastactive is true
        session()->put(Locale::ACTIVE_LOCALE_NAME, $locale->displayName2);
        session()->put(Locale::ACTIVE_LOCALE, $locale->id);

        return redirect()->route('dashboard')->with('success', $locale->displayName2 . 'est maintenant actif.');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.company.edit-locale');
    }
}
