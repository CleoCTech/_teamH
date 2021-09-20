<?php

namespace App\Http\Livewire;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Report;
use App\Models\ReportGroup;
use App\Models\User;
use App\Models\UserDesignation;
use Livewire\Component;

class CreateReport extends Component
{

    public $userType;
    public $dept;
    public $reportTo=false;
    public $employees = [];

    public $getDept;
    public $report;
    public $userId;
    public $user_id;

    public function mount($userType, $dept)
    {


        $this->dept = $dept;
        $this->userType = $userType;
        $this->user_id = session()->get('UserLogged');
        $this->getDept =  Department::where('name', $this->dept)->first();
        // dd($getDesignationId);
        $this->employees = UserDesignation::with('user', 'designation')
                                            ->where('department_id', $this->getDept->id)
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
    public function back()
    {
        $this->emit('varView', '');
    }
    public function store()
    {
        // dd(session()->get('UserLogged'));
        $report = Report::create([
            'report' =>$this->report,
            'sender_id' =>session()->get('UserLogged'),
        ]);

        if (!$this->reportTo) {
            //to department
            $this->getDept->toable()->create([
                'report_id' => $report->id,
            ]);


        }else{
            //to user specific
            $reportTo = User::find($this->userId);
            // dd($reportTo);
            $reportTo->toable()->create([
                'report_id' => $report->id,
            ]);

        }

        return redirect()->route('dashboard');
    }
}