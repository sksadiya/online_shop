<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\productImage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;
class productImageController extends Controller
{
    public function update(Request $request) {

        $image = $request->image;
        $ext = $image->getClientOriginalExtension();
        $sourcePath = $image->getPathName();

        $productImage = new productImage();
        $productImage->product_id = $request->product_id;
        $productImage->image = "NULL";
        $productImage->save();

        $imageName = $request->product_id.'-'.$productImage->id.'.'.$ext;
        $productImage->image = $imageName;
        $productImage->save();

        //large image
        $destPath = public_path().'/uploads/products/large/'.$imageName;
         $manager = new ImageManager(new Driver());
        $image = $manager->read($sourcePath);
       $image->resize(1400 ,null); 
        $image->save($destPath);

        //small image
        $destPath = public_path().'/uploads/products/small/'.$imageName;
         $manager = new ImageManager(new Driver());
        $image = $manager->read($sourcePath);
       $image->cover(300 ,300); 
        $image->save($destPath);

        return response()->json([
            'status' => true,
            'message' => 'image saved',
             'image_id' => $productImage->id,
             'imagePath' => asset('uploads/products/small/'.$productImage->image)
        ]);
    }

    public function destroy(Request $request) {
        $productImage = productImage::find($request->id);
        if(empty($productImage)) {
            return response()->json([
                'status' => false,
                'message' => 'image not found'
            ]);
        }
        //deleteImages
        File::delete(public_path('uploads/products/large/'.$productImage->image));
        File::delete(public_path('uploads/products/small/'.$productImage->image));

        $productImage->delete();
        return response()->json([
             'status' => true,
             'message' =>'deleted successfully'   
        ]);
    }
}
