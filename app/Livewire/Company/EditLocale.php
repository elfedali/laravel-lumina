<?php

namespace App\Livewire\Company;

use Livewire\Component;

class EditLocale extends Component
{
    public $title = 'Ajouter une adresse';

    // mount
    public function mount() {}

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

        \App\Models\Locale::create(
            array_merge($data, ['company_id' => auth()->user()->id])
        );
    }

    public function render()
    {
        return view('livewire.company.edit-locale');
    }
}
