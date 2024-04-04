<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\product;
use App\Models\shippingCharge;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\CustomerAddress;
use Validator;

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

    public function checkout() {
        //if cart is empty redirect to cart page
        if(Cart::count() == 0) {
            return redirect()->route('front.cart');
        }

        //if user is not logged in then redirect to login page
        if(Auth::check() == false ) {
            session()->put('url.intended', route('front.checkout'));
            return redirect()->route('account.login');

        }
        $user = Auth::user();
        session()->forget('url.intended');
        $adds = CustomerAddress::where('user_id', $user->id)->first(); 
        $countries = Country::orderBy('name','ASC')->get();

        //calculate shipping
        if($adds != '') {
            $userCountry = $adds->country_id;
            $shippingInfo = shippingCharge::where('country_id',$userCountry)->first();
            $totalQty = 0;
            $shippingCharge = 0;
            $grandTotal = 0;
            foreach(Cart::content() as $item) {
                $totalQty += $item->qty ;
            }
    
            $shippingCharge = $totalQty * $shippingInfo->amount;
            $grandTotal = Cart::subtotal('2','.','')+$shippingCharge;
        } else {
            $shippingCharge = 0;
            $grandTotal = Cart::subtotal('2','.','');
        }
       
        return view('front.checkout' ,compact( 'countries' ,'adds','shippingCharge','grandTotal') );
    }

    public function processCheckout(Request $request) {
        $validator = Validator::make( $request->all(), [
            'first_name' => 'required|min:5' ,
            'last_name' => 'required' ,
            'email' => 'required|email' ,
            'country' => 'required' ,
            'address' => 'required|min:30' ,
            'city' => 'required' ,
            'state' => 'required' ,
            'zip' => 'required' ,
            'mobile' => 'required' ,
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'please fix the errors',
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }


        //save user adddress
        $user = Auth::user();
        $customerAddress = CustomerAddress::updateOrCreate(
            ['user_id'  => $user->id] ,
            [
                'user_id' =>$user->id,
                'first_name' => $request->first_name,
                'last_name'=> $request->last_name,
                'email'     => $request->email,
                'mobile'     => $request->mobile,
                'address'   => $request->address,
                'apartment'   => $request->apartment,
                'city'=> $request->city,
                'state'     => $request->state,
                'zip'=> $request->zip,
                'country_id'   => $request->country,
            ]
        );

        //save data in orders table
        if($request->payment_method == "cod") { 

            $shipping = 0;
            $discount = 0;
            $subTotal = Cart::subtotal(2,'.','');
            
            $shippingInfo = shippingCharge::where('country_id',$request->country)->first();
            $totalQty = 0;
            foreach(Cart::content() as $item) {
                $totalQty += $item->qty;
             }
            if($shippingInfo != null) {
                $shipping = $totalQty*$shippingInfo->amount;
                
                $grandTotal = $subTotal+$shipping;
                    
                } else {
               $shippingInfo = shippingCharge::where('country_id','rest_of_world')->first();
               $shipping = $totalQty*$shippingInfo->amount;
                
               $grandTotal = $subTotal+$shipping;
                }

           


            $order = new Order;
            $order->subtotal = $subTotal ;
            $order->shipping = $shipping ;
            $order->grand_total = $grandTotal ;
            $order->grand_total = $grandTotal ;
            $order->user_id =  $user->id ;
            $order->first_name = $request->first_name ;
            $order->last_name = $request->last_name ;
            $order->email = $request->email ;
            $order->mobile = $request->mobile ;
            $order->address = $request->address ;
            $order->apartment = $request->apartment ;
            $order->state = $request->state ;
            $order->city = $request->city ;
            $order->zip = $request->zip ;
            $order->notes = $request->notes ;
            $order->country_id = $request->country ;
            $order->save();

            //store order items in rder item table
            foreach(Cart::content() as $item) {
                $orderItem = new OrderItems;
                $orderItem->product_id = $item->id ;
                $orderItem->order_id = $order->id ;
                $orderItem->name = $item->name ;
                $orderItem->qty = $item->qty ;
                $orderItem->price = $item->price ;
                $orderItem->total = $item->price * $item->qty;
                $orderItem->save();
             }
             
             session()->flash('success','You have placed order successfully');
             Cart::destroy();
             return response()->json([
                'status' => true ,
                'message'=> "Order Placed Successfully",
                'orderId' => $order->id
             ]);
        } else {

        }
    } 

    public function thankyou($id) {
        return view('front.thankyou',compact('id'));
    }

    public function getOrderSummary(Request $request) {
        $subtotal = Cart::subtotal(2,'.','');

        if($request->country_id > 0) {
           $shippingInfo = shippingCharge::where('country_id',$request->country_id)->first();
            $totalQty = 0;
            foreach(Cart::content() as $item) {
                $totalQty += $item->qty;
             }
           if($shippingInfo != null) {
            $shippingCharge = $totalQty*$shippingInfo->amount;
            
            $grandTotal = $subtotal+$shippingCharge;
                return response()->json([
                    'status' => true,
                    'grandTotal'=> number_format($grandTotal,2),
                    'shippingCharge' => number_format($shippingCharge,2)
                ]);
            } else {
           $shippingInfo = shippingCharge::where('country_id','rest_of_world')->first();
           $shippingCharge = $totalQty*$shippingInfo->amount;
            
           $grandTotal = $subtotal+$shippingCharge;
           return response()->json([
            'status' => true,
            'grandTotal'=> number_format($grandTotal,2),
            'shippingCharge' => number_format($shippingCharge,2)
        ]);
            }
        } else {
            return response()->json([
                'status' => true,
                'grandTotal'=> $subtotal,
                'shippingCharge' => number_format(0,2)
            ]);
        }
    }
}
