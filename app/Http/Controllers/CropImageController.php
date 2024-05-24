<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class CropImageController extends Controller
{
    public function updateProfileImage($id)
    {
        return view('image.imagecropper', compact('id'));
    }

    public function cropImageUploadAjax(Request $request)
    {
        $folderPath = public_path('upload/');

        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);

        $imageName = uniqid() . '.png';

        $imageFullPath = $folderPath . $imageName;

        file_put_contents($imageFullPath, $image_base64);

        $saveFile = Contact::find($request->user_id);
        $saveFile->profile_image = env('APP_URL').'contact-profile-image/'.$imageName;
        $saveFile->save();

        return response()->json(['success' => 'Crop Image Uploaded Successfully']);
    }
}
