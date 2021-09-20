<?php

namespace App\Http\Livewire\Auth;

use App\Models\Department;
use App\Models\DeptMember;
use App\Models\Designation;
use App\Models\User;
use App\Models\UserDesignation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{

    public $designations = [];
    public $departments = [];

    public $desgnationId, $name, $email, $password, $departmentId;

    protected $rules = [
        'email' =>['required', 'email'],
        'name' =>['required'],
        'desgnationId' =>['required'],
        'password' =>['required'],
        'departmentId' =>['required'],
    ];
    public function mount()
    {
        $this->designations = Designation::all();
        $this->departments = Department::all();
    }
    public function render()
    {
        return view('livewire.auth.register');
    }

    public function store()
    {
        $this->validate();
        try {
            DB::transaction(function () {
                $user= User::create([
                    'name' =>$this->name,
                    'email' =>$this->email,
                    'password' =>Hash::make($this->password),
                ]);

                $designation = UserDesignation::create([
                    'designation_id'=>$this->desgnationId,
                    'department_id'=>$this->departmentId,
                    'user_id'=>$user->id,
                ]);

                $dept =  DeptMember::create([
                    'department_id' => $this->departmentId,
                    'user_id' => $user->id
                ]);
            });
            $this->alert('success', 'Account Created Successfully', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  true,
                'showConfirmButton' =>  false,
          ]);
          return redirect()->route('login');
        } catch (\Throwable $th) {
            //'Oops! Something went wrong'
            $this->alert('error', $th->getMessage(), [
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
