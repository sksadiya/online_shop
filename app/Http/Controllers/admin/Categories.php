<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\tempImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use Illuminate\Support\Facades\File;



class Categories extends Controller
{
    public function index(Request $request)
    {
        //instead of using orderBy('created_at',DESC) use latest
        $categories = Category::latest();

        if (!empty($request->get('search'))) {
            $categories = $categories->where('name', 'like', '%' . $request->get('search') . '%');
        }
        $categories = $categories->paginate(10);
        return view('admin.category.list', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories',
        ]);
        if ($validator->passes()) {
            $category = new Category();
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();

            //save image
            if (!empty($request->image_id)) {
                $tempImage = tempImage::find($request->image_id);
                $extension = explode('.', $tempImage->name);
                $ext = last($extension);

                $newImageName = $category->id . '.' . $ext;
                $sourcePath = public_path() . '/temp/' . $tempImage->name;
                $destinationPath = public_path() . '/uploads/category/' . $newImageName;
                File::copy($sourcePath, $destinationPath);

                $category->image = $newImageName;
                $category->save();
            }

            $request->session()->flash('success', 'category created successfully');
            return response()->json([
                'status' => true,
                'message' => 'category created successfuly',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
    public function edit($id, Request $request)
    {
        $category = Category::find($id);
        if (empty($category)) {
            return redirect()->route('categories.index');
        }
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            $request->session()->flash('error', 'category not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'category not found'
            ]);
        }

        $validator = validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,' . $category->id . ',id',
        ]);
        if ($validator->passes()) {
            $category->name = $request->name;
            $category->slug = $request->slug;
            $category->status = $request->status;
            $category->showHome = $request->showHome;
            $category->save();

            $oldImage = $category->image;

            //save image
            if (!empty($request->image_id)) {
                $tempImage = tempImage::find($request->image_id);
                $extension = explode('.', $tempImage->name);
                $ext = last($extension);

                $newImageName = $category->id . '-' . time() . '.' . $ext;
                $sourcePath = public_path() . '/temp/' . $tempImage->name;
                $destinationPath = public_path() . '/uploads/category/' . $newImageName;
                File::copy($sourcePath, $destinationPath);

                //$manager = new ImageManager(new Driver());
                //generate image thumbnail
                // $destinationPath = public_path().'/uploads/category/thumb'.$newImageName;
                // $img = Image::make(public_path($sourcePath));
                // $img->resize(450,600);
                // $img->save($destinationPath);


                $category->image = $newImageName;
                $category->save();

                //delete old image here
                if (!empty($oldImage)) {
                    $oldImagePath = public_path('uploads/category/' . $oldImage);
                    if (File::exists($oldImagePath)) {
                        File::delete($oldImagePath);
                    }
                }
                // File::delete(public_path().'uploads/category/'. $oldImage);
            }

            $request->session()->flash('success', 'category updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'category updated successfuly',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
    public function destroy(Request $request, $id)
    {
        $category = Category::find($id);
        if (empty($category)) {
            $request->session()->flash('error', 'category not found');
            return response()->json([
                'status' => false,
                'message' => 'category not found'
            ]);
        }
        $image = public_path('uploads/category/' . $category->image);
        if (File::exists($image)) {
            File::delete($image);
        }

        $category->delete();
        $request->session()->flash('success', 'deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'category deleted successfully'
        ]);
    }
}
