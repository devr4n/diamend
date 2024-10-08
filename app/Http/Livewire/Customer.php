<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Customers extends Component
{
    public $name;
    public $email;

    public function submit()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);


        session()->flash('message', 'Customer successfully added.');
    }

    public function render()
    {
        return view('livewire.customer.index');
    }
}
