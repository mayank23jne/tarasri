<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function postUploadView()
    {
        return view('upload-image');
    }

    public function postUpload(Request $request)
    {
		foreach($request->file as $file)
		{
			$file_name = time().'.'.$file->extension();
			$destinationPath = 'images/originals';
			$path = Storage::disk('s3')->putFileAs($destinationPath, $file, $file_name, ['visibility' => 'public']);
			echo \Config::get('app.s3_bucket_url').$path."<br/>";
		}
		die;
    }
}