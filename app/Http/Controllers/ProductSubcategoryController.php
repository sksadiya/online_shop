<?php

namespace App\Http\Controllers;

use App\Models\subCategory;
use Illuminate\Http\Request;

class ProductSubcategoryController extends Controller
{
    public function index(Request $request) {
        if(!empty($request->category_id) ) {
            $subCat = subCategory::where('category_id',$request->category_id)
            ->orderBy('name','ASC')
            ->get();

            return response()->json([
                'status' => true,
                'subcategories' =>$subCat
            ]);
        }  else {
            return response()->json([
                'status'=>true,
                'subcategories' =>[]
            ]);
        }
     
    }
}
