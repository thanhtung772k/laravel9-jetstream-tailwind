<?php

namespace App\Http\Livewire\User;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithPagination;

use Livewire\Component;

class UserIndex extends Component
{
    public function render()
    {
        return view('livewire.user.user-index',[
            'users' => User::all()
        ]);
    }
}
