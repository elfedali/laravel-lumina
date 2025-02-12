<?php

namespace App\Livewire\Company;

use Livewire\Component;

class EditCompany extends Component
{
    /**
     * The company instance.
     * @var \App\Models\Company
     */
    public $company;
    public $title = 'Modifer les informations du salon';

    public $name;
    public $category;


    public function mount()
    {

        $user = auth()->user();
        $company = $user->company;

        $this->name = $company->name;
        $this->category = $company->category;

        $this->company = $company;
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
        ]);

        $this->company->update([
            'name' => $this->name,
            'category' => $this->category,
        ]);

        session()->flash('success', 'Company updated successfully');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.company.edit-company');
    }
}
