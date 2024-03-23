<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\subCategory;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;

class subCategoryController extends Controller
{
    public function index(Request $request)
    {
        //instead of using orderBy('created_at',DESC) use latest
        $subCat = subCategory::select('sub_categories.*', 'categories.name as catName')
            ->latest()
            ->leftJoin('categories', 'categories.id', 'sub_categories.category_id');

        if (!empty($request->get('search'))) {
            $subCat = $subCat->where('sub_categories.name', 'like', '%' . $request->get('search') . '%');
            $subCat = $subCat->orWhere('categories.name', 'like', '%' . $request->get('search') . '%');
        }
        $subCat = $subCat->paginate(10);
        return view('admin.subcategory.list', compact('subCat'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.subcategory.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:sub_categories',
            'category' => 'required',
            'status' => 'required',
        ]);
        if ($validator->passes()) {
            $subCat = new subCategory;
            $subCat->name = $request->name;
            $subCat->slug = $request->slug;
            $subCat->category_id = $request->category;
            $subCat->status = $request->status;
            $subCat->showHome = $request->showHome;
            $subCat->save();

            $request->session()->flash('success', 'subCategory created successfully');
            return response()->json([
                'status' => true,
                'message' => 'subCategory created successfully',
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
        $subcategory = subCategory::find($id);
        if (empty($subcategory)) {
            $request->session()->flash('error', "Record not found");
            return redirect()->route('subCat.index');
        }
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $subcategory = subCategory::find($id);

        if (empty($subcategory)) {
            $request->session()->flash('error', 'sub-category not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'sub-category not found'
            ]);
        }

        $validator = validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:sub_categories,slug,' . $subcategory->id . ',id',
            'category' => 'required',
        ]);
        if ($validator->passes()) {
            $subcategory->name = $request->name;
            $subcategory->slug = $request->slug;
            $subcategory->status = $request->status;
            $subcategory->category_id = $request->category;
            $subcategory->showHome = $request->showHome;
            $subcategory->save();

            $request->session()->flash('success', 'sub-category updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'sub-category updated successfuly',
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
        $category = subCategory::find($id);
        if (empty($category)) {
            $request->session()->flash('error', 'sub-category not found');
            return response()->json([
                'status' => false,
                'message' => 'sub-category not found'
            ]);
        }
        $category->delete();
        $request->session()->flash('success', 'deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'category deleted successfully'
        ]);
    }
}
