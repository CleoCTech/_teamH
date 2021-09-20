<?php

namespace App\Http\Controllers;

use App\Models\TemporaryFile;
use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('paperFile')) {
            // dd('yes');
            $file = $request->file('paperFile');
            $filename = $file->getClientOriginalName();
            $folder = uniqid() . '-' .now()->timestamp;
            $file->storeAs('public/tmp/' . $folder, $filename);

            $tempFile =TemporaryFile::Create([
                'folder' =>$folder,
                'filename' => $filename
            ]);

            if(session('files') == null){
                $files = [];
            }else{
                $files = session('files');
            }
            $file = ['filename' => $filename,'folder' => $folder];
            array_push($files, $file);
            session(['files' => $files]);

            return $folder;
        }

        return '';

    }
}