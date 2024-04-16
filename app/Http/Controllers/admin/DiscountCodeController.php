<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class DiscountCodeController extends Controller
{
    public function index() {
        
    }
    public function create() {

        return view('admin.coupons.create');
    }
    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'code' => 'required',
            'name' => '',
            'max_uses' => '',
            'max_uses_user' => '',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'min_amount' => '',
            'status' => 'required',
            'starts_at' => '',
            'expires_at' => '',
            'description' => '',
        ]);

        if($validator->passes()) {

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
    public function edit() {

    }
    public function update() {

    }
    public function destroy() {

    }
}
