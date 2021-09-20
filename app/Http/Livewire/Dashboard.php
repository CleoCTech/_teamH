<?php

namespace App\Http\Livewire;

use App\Models\DeptMember;
use App\Models\User;
use App\Models\UserDesignation;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $user;
    public $getDept;
    public $designation;
    public $varView;

    protected $listeners = ['varView' => 'updateVar'];

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

    }
    public function updateVar($value)
    {
        $this->varView = $value;
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
    public function showCreateRpt()
    {
        $this->varView = 'create-report';
    }
}