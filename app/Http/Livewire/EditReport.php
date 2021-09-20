<?php

namespace App\Http\Livewire;

use App\Models\Report;
use Livewire\Component;

class EditReport extends Component
{
    public $reportId;
    public $report;
    public $reportDetails;
    public function mount($id)
    {
        $this->reportId = $id;

        $this->reportDetails = Report::where('id', $this->reportId)
                                        ->first();
        $this->report = $this->reportDetails->report;
                                        // dd($this->reportDetails);
    }
    public function render()
    {
        return view('livewire.edit-report');
    }
    public function back()
    {
        $this->emit('varView', '');
    }
    public function store()
    {
        try {
            $update = Report::where('id', $this->reportId)
                            ->update([
                                'report' => $this->report,
                            ]);
                            $this->alert('success', 'Updated Successfully', [
                                'position' =>  'top-end',
                                'timer' =>  3000,
                                'toast' =>  true,
                                'text' =>  '',
                                'confirmButtonText' =>  'Ok',
                                'cancelButtonText' =>  'Cancel',
                                'showCancelButton' =>  false,
                                'showConfirmButton' =>  false,
                          ]);
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
