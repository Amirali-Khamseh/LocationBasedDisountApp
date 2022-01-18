<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;

class UploadImageController extends Controller
{
    public function index()
    {
        return view('panel.image');
    }
 
    public function save(Request $request)
    {
        
 
        return redirect('upload-image')->with('status', 'Image Has been uploaded');
 
    }
}
