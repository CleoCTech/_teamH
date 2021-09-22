<?php

namespace App\Http\Livewire;

use App\Models\DeptMember;
use App\Models\File;
use App\Models\Report;
use App\Models\ReportGroup;
use App\Models\User;
use App\Models\UserDesignation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Dashboard extends Component
{
    public $user;
    public $getDept;
    public $designation;
    public $varView;
    public $myRpts =[];
    public $depRpts =[];
    public $sentToMes =[];
    public $toDelete;
    public $toComment;
    public $comment;

    protected $listeners = ['varView' => 'updateVar'];

    public function mount()
    {
        session()->forget('files');
        $this->user = User::with('dept_membership', 'designation')
                            ->where('id', session()->get('UserLogged'))->first();
                            // dd($this->user->designation->designation_id);
        $this->getDept = DeptMember::with('user', 'department')
                                ->where('user_id', $this->user->id)
                                ->first();
// dd($this->getDept->department->id);
        $this->designation = UserDesignation::with('user', 'designation')
                                        ->where('user_id', $this->user->id)
                                        ->first();


        if ($this->designation->designation->name == 'Supervisor') {
            // $this->myRpts = ReportGroup::where('toable_id', session()->get('UserLogged'))
            // ->where('toable_type', 'App\Models\User')
            // ->get();

            $this->myRpts = Report::where('sender_id', session()->get('UserLogged'))
                                    ->get();
            $this->depRpts = ReportGroup::where('toable_id', $this->getDept->department->id)
            ->where('toable_type', 'App\Models\Department')
            ->get();

        }elseif($this->designation->designation->name == 'Employee'){
            $this->myRpts = Report::where('sender_id', session()->get('UserLogged'))
                                    ->get();
            $this->depRpts = ReportGroup::where('toable_id', $this->getDept->department->id)
            ->where('toable_type', 'App\Models\Department')
            ->get();
            $this->sentToMes = ReportGroup::where('toable_id', session()->get('UserLogged'))
            ->where('toable_type', 'App\Models\User')
            ->get();
            // dd($this->depRpts);
        }


        // $this->depRpts =
        // dd($this->myRpts);

    }
    public function loadFiles($id)
    {
        $files = File::where('report_id', $id)
                            ->get();

                            // dd($files);
        return $files;
    }
    public function getDownload($value)
    {

            $file= 'storage/employees/' .$value;
            if (file_exists($file)) {
                return response()->download($file);
            } else {
                $this->alert('error', 'File Does Not Exist', [
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
    public function test()
    {
        dd('test');
    }
    public function dropFile($id, $folder, $filename)
    {
        
        Storage::delete('employees/'.$folder . '/' .$filename);
        // rmdir('storage/employees/' .$folder );
        DB::beginTransaction();
        try {
            File::where('id', $id)->delete();
            DB::Commit();
            $this->alert('success', 'File Deleted Successfully.', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
          ]);
        } catch (\Exception $e) {
            DB::rollback();
            $this->alert('error', $e->getMessage(), [
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
    public function updateVar($value)
    {
        $this->varView = $value;
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
    public function showEdit($id)
    {
        // dd($id);
        $this->reportIdE = $id;
        $this->varView = '';
        $this->varView = 'edit-report';
    }
    public function showCreateRpt()
    {
        $this->varView = 'create-report';
    }
    public function comment($id)
    {
        $this->toComment = $id;
        try {
            DB::transaction(function () {
                Report::where('id', $this->toComment)
                        ->update([
                            'comment' =>$this->comment,
                        ]);
            });
            $this->alert('success', 'Comment Sent Successfully', [
                'position' =>  'top-end',
                'timer' =>  3000,
                'toast' =>  true,
                'text' =>  '',
                'confirmButtonText' =>  'Ok',
                'cancelButtonText' =>  'Cancel',
                'showCancelButton' =>  false,
                'showConfirmButton' =>  false,
          ]);
          $this->reset('comment');
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
    public function delete($id)
    {
        $this->toDelete = $id;
        try {
            DB::transaction(function () {
                $deletedRows = ReportGroup::where('report_id', $this->toDelete)->delete();

                $report = Report::find($this->toDelete);

                $report->delete();

                // $deletedRows = ReportGroup::where('report_id', $this->toDelete)->delete();
            });

            $this->alert('success', 'Deleted Successfully', [
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
            //Oops! Something went wrong
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