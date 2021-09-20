<?php

namespace App\Http\Livewire\Inc;

use App\Models\Department;
use App\Models\DeptMember;
use App\Models\User;
use App\Models\UserDesignation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DashNav extends Component
{

    public $user;
    public $getDept;
    public $designation;
    public function mount()
    {
        $this->user = User::with('dept_membership', 'designation')
                            ->where('id', session()->get('UserLogged'))->first();
                            // dd($this->user->designation->designation_id);
        $this->getDept = DeptMember::with('user', 'department')
                                ->where('user_id', $this->user->id)
                                ->first();
        $this->designation = UserDesignation::with('user', 'designation')
                                        ->where('user_id', $this->user->id)
                                        ->first();
                                // dd($designation->designation->name);

    }

    public function render()
    {
        return view('livewire.inc.dash-nav');
    }
    public function showCreateRpt()
    {
        $this->emit('varView', 'create-report');
        // $this->varView = 'create-report';
    }
}
