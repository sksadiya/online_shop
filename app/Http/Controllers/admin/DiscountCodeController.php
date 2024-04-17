<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCoupon;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Validator;

class DiscountCodeController extends Controller
{
    public function index(Request $request) {
        $coupons = DiscountCoupon::latest();

        if (!empty($request->get('search'))) {
            $coupons = $coupons->where('name', 'like', '%' . $request->get('search') . '%');
        }
        $coupons = $coupons->paginate(10);
       return view('admin.coupons.list' ,compact('coupons')); 
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
        //starting date must be greater than current date
        if (!empty($request->starts_at)) {
            $now = Carbon::now();
            $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at);

            if ($startAt->lte($now) == true) {
                $validator->errors()->add('starts_at', 'The start date cannot be in the past.');
                return redirect()->route('coupons.create')->withErrors($validator)->withInput();
            }
        }
        //expiry date must be greater than start date 

        if (!empty($request->starts_at) && !empty($request->expires_at)) {
            $expireAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->expires_at);
            $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at);

            if ($expireAt->gt($startAt) == false) {
                $validator->errors()->add('expires_at', 'The expiry date must be greater than start date.');
                return redirect()->route('coupons.create')->withErrors($validator)->withInput();
            }
        }
        if ($validator->passes()) {
         
            $couponCode = new DiscountCoupon();
            $couponCode->code = $request->code;
            $couponCode->type = $request->type;
            $couponCode->name = $request->name;
            $couponCode->description = $request->description;
            $couponCode->max_uses = $request->max_uses;
            $couponCode->max_uses_user = $request->max_uses_user;
            $couponCode->discount_amount = $request->discount_amount;
            $couponCode->min_amount = $request->min_amount;
            $couponCode->status = $request->status;
            $couponCode->starts_at = $request->starts_at;
            $couponCode->expires_at = $request->expires_at;
            $couponCode->save();
            session()->flash('success', 'coupon created successfully');
            return redirect()->route('coupons.index');
        } else {
            return redirect()->route('coupons.create')->withErrors($validator)->withInput();
        }
    }
    public function edit($id, Request $request)
    {
        $coupon = DiscountCoupon::find($id);
        if (empty($coupon)) {
            $request->session()->flash('error', "Record not found");
            return redirect()->route('coupons.index');
        }
        return view('admin.coupons.edit', compact('coupon'));
    }
    public function update(Request $request ,$id) {
        $coupon = DiscountCoupon::find($id);
        if (empty($coupon)) {
            $request->session()->flash('error', 'Record not found');
            return redirect()->route('coupons.index');
        }
        $validator = validator::make($request->all(), [
            'code' => 'required',
            'type' => 'required',
            'discount_amount' => 'required|numeric',
            'status' => 'required',
        ]);
        //starting date must be greater than current date
        if (!empty($request->starts_at)) {
            $now = Carbon::now();
            $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at);

            if ($startAt->lte($now) == true) {
                $validator->errors()->add('starts_at', 'The start date cannot be in the past.');
                return redirect()->route('coupons.edit',$coupon->id)->withErrors($validator)->withInput();
            }
        }
        //expiry date must be greater than start date 

        if (!empty($request->starts_at) && !empty($request->expires_at)) {
            $expireAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->expires_at);
            $startAt = Carbon::createFromFormat('Y-m-d H:i:s', $request->starts_at);

            if ($expireAt->gt($startAt) == false) {
                $validator->errors()->add('expires_at', 'The expiry date must be greater than start date.');
                return redirect()->route('coupons.edit',$coupon->id)->withErrors($validator)->withInput();
            }
        }

        if ($validator->passes()) {
            $coupon->code = $request->code;
            $coupon->type = $request->type;
            $coupon->name = $request->name;
            $coupon->description = $request->description;
            $coupon->max_uses = $request->max_uses;
            $coupon->max_uses_user = $request->max_uses_user;
            $coupon->discount_amount = $request->discount_amount;
            $coupon->min_amount = $request->min_amount;
            $coupon->status = $request->status;
            $coupon->starts_at = $request->starts_at;
            $coupon->expires_at = $request->expires_at;
            $coupon->save();

            session()->flash('success', 'coupon updated successfully');
            return redirect()->route('coupons.index');
        } else {
            return redirect()->route('coupons.edit', $coupon->id)->withErrors($validator)->withInput();
        }
    }
    public function destroy(Request $request ,$id) {
        $coupon = DiscountCoupon::find($id);
        if (empty($coupon)) {
            $request->session()->flash('error', 'coupon not found');
            return response()->json([
                'status' => false,
                'message' => 'coupon not found'
            ]);
        }
        $coupon->delete();
        $request->session()->flash('success', 'deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'coupon deleted successfully'
        ]);
    }

    
}
