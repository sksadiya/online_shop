<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class brandsController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brands::latest();

        if (!empty($request->get('search'))) {
            $brands = $brands->where('name', 'like', '%' . $request->get('search') . '%');
            $brands = $brands->orWhere('slug', 'like', '%' . $request->get('search') . '%');
        }
        $brands = $brands->paginate(10);
        return view('admin.brands.list', compact('brands'));
    }
    public function create()
    {
        return view('admin.brands.create');
    }
    public function store(Request $request)
    {
        $validator = validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:brands',
        ]);
        if ($validator->passes()) {
            $brand = new Brands();
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            $request->session()->flash('success', 'brand created successfully');
            return response()->json([
                'status' => true,
                'message' => 'brand created successfully',
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
        $brand = Brands::find($id);
        if (empty($brand)) {
            $request->session()->flash('error', "Record not found");
            return redirect()->route('brands.index');
        }
        return view('admin.brands.edit', compact('brand'));
    }
    public function update(Request $request, $id)
    {
        $brand = Brands::find($id);
        if (empty($brand)) {
            $request->session()->flash('error', 'brand not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'brand not found'
            ]);
        }

        $validator = validator::make($request->all(), [
            'name' => 'required',
            'slug' => 'required|unique:brands,slug,' . $brand->id . ',id',
        ]);
        if ($validator->passes()) {
            $brand->name = $request->name;
            $brand->slug = $request->slug;
            $brand->status = $request->status;
            $brand->save();

            $request->session()->flash('success', 'brand updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'brand updated successfuly',
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
        $brand = Brands::find($id);
        if (empty($brand)) {
            $request->session()->flash('error', 'brand not found');
            return response()->json([
                'status' => false,
                'message' => 'brand not found'
            ]);
        }
        $brand->delete();
        $request->session()->flash('success', 'deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'brand deleted successfully'
        ]);
    }
}
