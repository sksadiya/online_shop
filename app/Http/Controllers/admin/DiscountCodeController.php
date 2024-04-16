<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;

class DiscountCodeController extends Controller
{
    public function index() {
       return view('admin.coupons.list'); 
    }
    public function create() {

        return view('admin.coupons.create');
    }
    public function store(Request $request) {
        $validator = validator::make($request->all(), [
            'code' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required',
        ]);
        if ($validator->passes()) {
            session()->flash('success', 'coupon created successfully');
            return redirect()->route('coupons.index');
        } else {
            return redirect()->route('coupons.create')->withErrors($validator)->withInput();
        }
    }
    public function edit() {

    }
    public function update() {

    }
    public function destroy() {

    }
}
