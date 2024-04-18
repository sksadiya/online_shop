<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItems;
use App\Models\productImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function login() {
        return  view('account.login');
    }
    public function register() {
        return view('account.register');
    }
    public function processRegister(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        if($validator->passes()) {
            $user = new  User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success','you have been registered successfully');
            return response()->json([
                'status' => true,
                'message'=> "Account created successfully"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' =>$validator->errors()
            ]);
        }
    }

    public function authenticate(Request $request) {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if($validator->passes()) {
            if(Auth::attempt(['email' => $request->email ,'password' => $request->password] ,$request->get('remember'))) {
                  
                return redirect()->intended(route('account.profile'));
               // return redirect()->route('account.profile');
            } else {
                session()->flash('error', 'Please provide valid email and password');
            return redirect()->route('account.login')->withInput($request->only('email'));

            }
         } else {
            return redirect()->route('account.login')->withErrors( $validator )->withInput($request->only('email'));
         }
     }

     public function profile() {
        return view('account.profile');
     }
     public function logout() {
        Auth::logout();
        return redirect()->route('account.login')->with('success',"You are logged out");
     }

     public function orders() {
        $user = Auth::user();
        $orders = Order::where('user_id',$user->id)->orderBy('created_at','DESC')->get();
        return view('account.order' ,compact('orders'));
     }

     public function orderDetail($id) {
        $user = Auth::user();
      $order = Order::where('user_id',$user->id)->where('id',$id)->first();
      $orderItems =OrderItems::where('order_id',$id)->get();
      $orderItemsCount =OrderItems::where('order_id',$id)->count();
      $productImages = [];

    // Iterate over each order item to get the product image
    foreach ($orderItems as $orderItem) {
        // Get the product image for each order item
        $productImage = productImage::where('product_id', $orderItem->product_id)->first();
        // Push the product image to the array
        $productImages[] = $productImage;
    }
        return view('account.orderdetail' ,compact('order','orderItems','productImage','orderItemsCount'));
     }
}
