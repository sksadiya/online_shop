<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class cartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product = Product::with('product_images')->find($request->id);
        $status = false; // Define the $status variable here

        if ($product == null) {
            return response()->json([
                'status' => false,
                'message' => 'Product Not Found'
            ]);
        }

        if (Cart::count() > 0) {
            $cartContent = Cart::content();
            $exist = false;
            foreach ($cartContent as $row) {
                if ($row->id == $product->id) {
                    $exist = true;
                }
            }
            if ($exist == false) {
                Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty ($product->product_images)) ? $product->product_images->first() : '']);
                $status = true;
                $message = $product->title . "Added in cart";
                session()->flash('success', $message);
            } else {
                $status = false;
                $message = $product->title . "already Added in cart";
            }

        } else {
            Cart::add($product->id, $product->title, 1, $product->price, ['productImage' => (!empty ($product->product_images)) ? $product->product_images->first() : '']);
            $status = true;
            $message = $product->title . "Added Successfully!";
            session()->flash('success', $message);
        }

        return response()->json([
            "status" => $status,
            'message' => isset ($message) ? $message : '' // Make sure $message is defined before accessing it
        ]);
    }

    public function cart()
    {
        $cartContent = Cart::content();
        return view('front.cart', compact('cartContent'));
    }

    public function updateCart(Request $request)
    {
        $rowId = $request->rowId;
        $qty = $request->qty;

        //check stock
        $info = Cart::get($rowId);
        $product = product::find($info->id);
        if ($product->track_qty == 'Yes') {
            if ($qty <= $product->qty) {
                Cart::update($rowId, $qty);
                $message = 'Cart updated successfully';
                $status = true;
                session()->flash('success', $message);

            } else {
                $message = 'Requested quantity not available';
                $status = false;
                session()->flash('error', $message);

            }
        } else {
            Cart::update($rowId, $qty);
            $message = 'Cart updated successfully';
            $status = true;
            session()->flash('success', $message);

        }

        return response()->json([
            'status' => $status,
            'message' => $message
        ]);
    }

    public function  removeFromCart(Request $request) {
        $itemInfo = Cart::get($request->rowId);
        if($itemInfo == null) {
            session()->flash('error', "Item does not exist in cart");
            return response()->json([
                'status'=> false,
                'message' =>'Item not found in cart'
            ]);
        }
        Cart::remove($request->rowId);
        session()->flash('success', "item removed successfully");

        return response()->json([
            'status'=> true ,
            'message' => "item removed successfully"
        ]);
    }
}
