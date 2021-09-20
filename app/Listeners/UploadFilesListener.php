<?php

namespace App\Listeners;

use App\Models\File;
use App\Models\TemporaryFile;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Storage;

class UploadFilesListener
{

    public function handle($event)
    {
        if (session()->has('files')) {
            foreach (session('files') as $i => $values) {

                $file = File::Create([
                    'report_id' => $event->report->id,
                    'folder' => $values['folder'],
                    'filename' => $values['filename'],
                ]);
                $temporaryFile = TemporaryFile::where('folder', $values['folder'])->first();
                if ($temporaryFile) {
                    Storage::move('public/tmp/' .$values['folder']. '/' . $values['filename'], 'public/employees/' .$values['folder']. '/' . $values['filename']);
                        Storage::deleteDirectory('public/tmp/' .$values['folder'] );
                        $temporaryFile->delete();
                }
            }

        }
        session()->forget('files');
        return redirect('dashboard');
    }
}
