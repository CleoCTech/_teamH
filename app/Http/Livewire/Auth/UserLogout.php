<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

class UserLogout extends Component
{

    public function mount()
    {
        session()->forget('UserLogged');
        return redirect('/');
    }
    // public function render()
    // {
    //     return view('livewire.auth.user-logout');
    // }
}