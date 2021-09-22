<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use PDF;

class ShowReportController extends Controller
{


    public function showReport()
    {
        $data = Report::where('id', 24)->first();
        return view('show-report', compact('data'));
    }
    public function generateRpt($id)
    {
        // retreive all records from db
        $data = Report::where('id', $id)->first();

        // share data to view
        // view()->share('livewire.dashboard',$data);
        $pdf = PDF::loadView('show-report', compact('data'));

        // download PDF file with download method
        return $pdf->download('report.pdf');
    }
}
