<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\tempImage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class tempImagesController extends Controller
{
    public function create(Request $request) {
        $image = $request->image;
        if(!empty($image)) {
            $extension = $image->getClientOriginalExtension();
            $newName =time().'.'.$extension;
            $tempImage = new tempImage();
            $tempImage->name = $newName;
            $tempImage->save();

            
            $image->move(public_path().'/temp',$newName);
            //generate thumbnail
            $thumbnailPath = public_path() . '/temp/thumb/'.$newName;
            $manager = new ImageManager(new Driver());
            $img = $manager->read(public_path() . '/temp/' . $newName);
            $img->resize(300, 275); 
            $img->save($thumbnailPath);

            return response()->json([
                'status'=>true,
                'image_id'=>$tempImage->id,
                'imagePath' =>asset('/temp/thumb/'.$newName),
                'message'=>'image uploaded successfully'
            ]);
        }
    }
}
