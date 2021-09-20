<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Designation;
use App\Models\User;
use App\Models\UserDesignation;
use Livewire\Component;

class CreateReport extends Component
{

    public $userType;
    public $dept;
    public $reportTo=false;
    public $employees = [];
    public function mount($userType, $dept)
    {


        $this->dept = $dept;
        $this->userType = $userType;

        $getDesignationId =  Department::where('name', $this->dept)->first();
        // dd($getDesignationId);
        $this->employees = UserDesignation::with('user', 'designation')
                                            ->where('department_id', $getDesignationId->id)
                                            ->get();

        // foreach ($this->employees as $key => $value) {
        //     dump($value->user->name);
        // }

        // dd('end');
    }
    public function render()
    {
        return view('livewire.create-report');
    }

    public function reporTo()
    {
        if ($this->reportTo) {
            $this->reportTo = false;
        }else{
            $this->reportTo = true;
        }
    }
}
