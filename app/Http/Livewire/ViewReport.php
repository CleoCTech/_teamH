<?php

namespace App\Http\Livewire;

use App\Models\Report;
use Livewire\Component;

class ViewReport extends Component
{

    public $data;

    public function mount()
    {
        $this->data =Report::where('id', 24)->first();
    }
    public function render()
    {
        return view('livewire.view-report');
    }
}