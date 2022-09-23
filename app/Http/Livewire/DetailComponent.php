<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DetailComponent extends Component
{
    protected $listeners = [
        'getPost' => 'showPost'
    ];

    public function render()
    {
        return view('livewire.detail-component');
    }

    public function showPost($contact)
    {
        $this->name = $contact['name'];
        $this->phone = $contact['phone'];
        $this->contactId = $contact['id'];
    }
}
