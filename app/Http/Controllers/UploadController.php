<?php

namespace App\Http\Controllers;
use Storage;
use File;
use Auth;

use Illuminate\Http\Request;

class UploadController extends Controller
{
   

    public function getUpload() {
        return view('upload');
    }

    public function get_upload_home() {
    return view('uploadhome');
    }

    public function postUpload(Request $request) {
        $file = $request->file('fileUploaded');
        $user = Auth::user();
        $filename = uniqid($user->id."_").".".$file->getClientOriginalExtension(); //will create random string after id so no dupes

        
        Storage::disk('public')->put($filename, File::get($file));

        // update user record with new profile pic filename
        $user->uploaded_file= $filename;
        $user->save();

        return redirect('/home');
    }

    public function post_upload_home(Request $request) {
    $file = $request->file('fileUploaded2');
    Storage::disk('public')->put($file->getClientOriginalName(), File::get($file));

    return redirect('/');
    }
}
