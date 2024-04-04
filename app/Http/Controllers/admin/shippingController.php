<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\shipping;
use App\Models\shippingCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class shippingController extends Controller
{
    public function index(Request $request)
    {
        $shippings = shippingCharge::leftJoin('countries', 'countries.id', 'shipping_charges.country_id')
            ->select('shipping_charges.id as shipping_id', 'shipping_charges.country_id as shipping_country_id', 'countries.id as country_id', 'countries.name as country_name', 'shipping_charges.amount')
            ->get();

        if (!empty($request->get('search'))) {
            $searchTerm = $request->get('search');
            $shippings = $shippings->whereHas('country', function ($query) use ($searchTerm) {
                $query->where('name', 'like', '%' . $searchTerm . '%');
            })->orWhere('amount', 'like', '%' . $searchTerm . '%');
        }
        //  $shippings = $shippings->paginate(10);
        return view('admin.shipping.list', compact('shippings'));
    }
    public function create()
    {
        $countries = Country::get();
        return view('admin.shipping.create', compact('countries'));
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'amount' => 'required|numeric',
        ]);

        if ($validator->passes()) {
            $shipping = new shippingCharge();
            $shipping->country_id = $request->country;
            $shipping->amount = $request->amount;

            $shipping->save();

            session()->flash('success', 'shipping created successfully');
            return redirect()->route('shipping.index');

        } else {
            return redirect()->route('shipping.create')->withErrors($validator)->withInput();
        }
    }

    public function edit($id, Request $request)
    {
        $shipping = shippingCharge::find($id);
        $countries = Country::get();
        if (empty($shipping)) {
            $request->session()->flash('error', "Record not found");
            return redirect()->route('shipping.index');
        }
        return view('admin.shipping.edit', compact('shipping', 'countries'));
    }
    public function update(Request $request, $id)
    {
        $shipping = shippingCharge::find($id);
        if (empty($shipping)) {
            $request->session()->flash('error', 'shipping not found');
            return redirect()->route('shipping.index');
        }

        $validator = Validator::make($request->all(), [
            'country' => 'required',
            'amount' => 'required|numeric',
        ]);
        if ($validator->passes()) {
            $shipping->country_id = $request->country;
            $shipping->amount = $request->amount;
            $shipping->save();

            session()->flash('success', 'shipping updated successfully');
            return redirect()->route('shipping.index');
        } else {
            return redirect()->route('shipping.edit', $shipping->id)->withErrors($validator)->withInput();
        }
    }
    public function destroy(Request $request, $id)
    {
        $shipping = shippingCharge::find($id);
        if (empty($shipping)) {
            $request->session()->flash('error', 'shipping not found');
            return response()->json([
                'status' => false,
                'message' => 'shipping not found'
            ]);
        }
        $shipping->delete();
        $request->session()->flash('success', 'deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'shipping deleted successfully'
        ]);
    }
}
