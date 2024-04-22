<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Models\Country;
use App\Models\CustomerAddress;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\product;
use App\Models\productImage;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use Str;
use Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view('account.login');
    }
    public function register()
    {
        return view('account.register');
    }
    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->passes()) {
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = Hash::make($request->password);
            $user->save();

            session()->flash('success', 'you have been registered successfully');
            return response()->json([
                'status' => true,
                'message' => "Account created successfully"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        if ($validator->passes()) {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

                return redirect()->intended(route('account.profile'));
                // return redirect()->route('account.profile');
            } else {
                session()->flash('error', 'Please provide valid email and password');
                return redirect()->route('account.login')->withInput($request->only('email'));

            }
        } else {
            return redirect()->route('account.login')->withErrors($validator)->withInput($request->only('email'));
        }
    }

    public function profile()
    {
        $userId = Auth::user()->id;
        $user = User::where('id',$userId)->first();
        $countries = Country::orderBy('name' ,'ASC')->get();
        $address = CustomerAddress::where('user_id',$userId)->first();
        return view('account.profile',compact('user','countries','address'));
    }
    public function updatePersonalInfo(Request $request) {
        $user = User::where('id',Auth::user()->id)->first();
        $userId = $user->id;
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,'.$userId.'id',
            'phone' => 'required|digits:10'
        ]);
        if ($validator->passes()) {
            $user->name = $request->name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->save();

            session()->flash('success', 'you updated your profile successfully');
            return response()->json([
                'status' => true,
                'message' => "Account updated successfully"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function updateAddressInfo(Request $request) {
        $user = User::where('id',Auth::user()->id)->first();
        $userId = $user->id;
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|min:5',
            'last_name' => 'required',
            'emailAddress' => 'required|email',
            'country' => 'required',
            'address' => 'required|min:30',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'required',
            'mobile' => 'required|digits:10',
        ]);
        if($validator->passes()) {
            $customerAddress = CustomerAddress::updateOrCreate(
                ['user_id' => $userId],
                [
                    'user_id' => $userId,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->emailAddress,
                    'mobile' => $request->mobile,
                    'address' => $request->address,
                    'apartment' => $request->apartment,
                    'city' => $request->city,
                    'state' => $request->state,
                    'zip' => $request->zip,
                    'country_id' => $request->country,
                ]
            );
            session()->flash('success', 'Address updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'Address updated successfully'
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('account.login')->with('success', "You are logged out");
    }

    public function orders()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)->orderBy('created_at', 'DESC')->get();
        return view('account.order', compact('orders'));
    }

    public function orderDetail($id)
    {
        $user = Auth::user();
        $order = Order::where('user_id', $user->id)->where('id', $id)->first();
        $orderItems = OrderItems::where('order_id', $id)->get();
        $orderItemsCount = OrderItems::where('order_id', $id)->count();
        $productImages = [];

        // Iterate over each order item to get the product image
        foreach ($orderItems as $orderItem) {
            // Get the product image for each order item
            $productImage = productImage::where('product_id', $orderItem->product_id)->first();
            // Push the product image to the array
            $productImages[] = $productImage;
        }
        return view('account.orderdetail', compact('order', 'orderItems', 'productImage', 'orderItemsCount'));
    }

    public function wishlists()
    {
        $wishlists = Wishlist::where('user_id', Auth::user()->id)->with('product')->get();
    
        return view('account.wishlist',compact('wishlists'));

    }

    public function removeFromWish(Request $request) {
        $item = Wishlist::where('user_id',Auth::user()->id)->where('product_id',$request->id)->first();
        if ($item == null) {
           // session()->flash('error', "Item does not exist in Wishlist");
            return response()->json([
                'status' => false,
                'message' => 'Item does not exist in Wishlist or it already removed'
            ]);
        }
        $item->delete();
       // session()->flash('success', "wish product removed successfully");

        return response()->json([
            'status' => true,
            'message' => "wish product removed successfully"
        ]);
    }
    public function changePassword() {
        return view('account.change-password');
    }
    public function changePasswordPost(Request $request) {
        $validator = Validator::make($request->all() ,[
            'old_password' => 'required',
            'password' => 'required|min:6|confirmed'
            // 'password_confirmation' => 'required|min:6',
        ]);

        if($validator->passes()) {
            $user = User::select('id','password')->where('id', Auth::user()->id)->first(); 
            if(!Hash::check($request->old_password ,$user->password)) {
                session()->flash('error','your old password is incorrect');
                return response()->json([
                    'status' => true
                ]);
            }
           User::where('id',$user->id)->update([
            'password' => Hash::make($request->new_password)
           ]);

           session()->flash('success','You Updated your password');
           return response()->json([
            'status' => true
        ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
       
    }

    public function forgotPassword() {
        return view('account.forgot-password');        
    } 
    public function processForgotPassword(Request $request) {
               $validator = Validator::make($request->all() ,[
                'email' => 'required|email|exists:users,email'
               ]);

               if($validator->fails()) {
                    return redirect()->route('account.forgot-password')->withErrors($validator->errors())->withInput();
               }

               $token = Str::random(60);
               \DB::table('password_reset_tokens')->where('email',$request->email)->delete();
               \DB::table('password_reset_tokens')->insert([
                'email' =>$request->email,
                'token' => $token,
                'created_at' => now()
               ]);

               $user = User::where('email',$request->email)->first();
               $mailData = [
                'token' => $token,
                'user' => $user,
                'subject' => 'You have requested to reset your Password.'
               ];
               
               //send email to user
               Mail::to($request->email)->send(new ResetPasswordMail($mailData));
               return redirect()->route('account.forgot-password')->with('success','password reset link sent to your email.');
    } 
    public function resetPassword($token) {
        $tokenExist = \DB::table('password_reset_tokens')->where('token',$token)->first();

        if($tokenExist == null) {
            return redirect()->route('account.forgot-password')->with('error','Invalid Request.');
        }
        return view('account.reset-password' ,[
            'token' => $token
        ]);
    }

    public function processRestPassword(Request $request) {
        $token = $request->token;
        $tokenExist = \DB::table('password_reset_tokens')->where('token',$token)->first();

        if($tokenExist == null) {
            return redirect()->route('account.forgot-password')->with('error','Invalid Request.');
        }
        $user = User::where('email',$tokenExist->email)->first();
        $validator = Validator::make($request->all(),[
            'new_password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:new_password',
        ]);
        if($validator->passes()) {
            User::where('id',$user->id)->update([
                'password' => Hash::make($request->new_password)
            ]);
            \DB::table('password_reset_tokens')->where('email',$user->email)->delete();
            return redirect()->route('account.login')->with('success','password reset successfully');
        } else {
            return redirect()->route('account.reset-password',$token)->withErrors($validator->errors())->withInput();
        }
    }
}
