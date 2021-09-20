<?php

namespace App\Http\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Login extends Component
{
    public  $email, $password;

    protected $rules = [
        'email' =>['required', 'email'],
        'password' =>['required']
    ];

    public function render()
    {
        return view('livewire.auth.login');
    }

    public function login()
    {
        $this->validate();

        try {
            DB::transaction(function () {
                $user = User::where('email', $this->email)->first();

                if ($user) {
                    if (Hash::check($this->password, $user->password)) {
                        // dd('true');
                        session()->put('UserLogged', $user->id);
                        return redirect()->route('dashboard');
                    }
                }else{
                    $this->alert('error', 'User not found', [
                        'position' =>  'top-end',
                        'timer' =>  3000,
                        'toast' =>  true,
                        'text' =>  '',
                        'confirmButtonText' =>  'Ok',
                        'cancelButtonText' =>  'Cancel',
                        'showCancelButton' =>  false,
                        'showConfirmButton' =>  false,
                  ]);
                }

            });
        } catch (\Throwable $th) {
            $this->alert('error', 'Oops! Something went wrong', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
          ]);
        }
    }
}