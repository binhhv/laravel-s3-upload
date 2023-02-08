<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
  
class ImageUploadController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()
    {
        return view('imageUpload');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:20048',
        ]);
    
        $this->validate($request, ['image' => 'required|image']);
        if($request->hasfile('image'))
         {
            $file = $request->file('image');
            $name=time().$file->getClientOriginalName();
            $filePath = 'images/' . $name;

            Storage::disk('s3')->put($filePath, file_get_contents($file));

            return back()->with('success','Image Uploaded successfully');
         }
    }
}