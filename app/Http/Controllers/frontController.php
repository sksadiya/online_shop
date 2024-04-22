<?php

namespace App\Http\Controllers;

use App\Mail\ContactEmail;
use App\Models\Page;
use App\Models\product;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Mail;
use Validator;

class frontController extends Controller
{
    public function index() {
        $products = product::where('is_featured','Yes')->orderBy('id','DESC')->where('status',1)->take(8)->get();
        $latestProducts = product::orderBy('id','DESC')->where('status',1)->take(8)->get();
        $pages = Page::where('status',1)->get();
        return view('front.home', compact('products' ,'latestProducts','pages') );
    }

    public function addToWishlist(Request $request) {
       if(Auth::check() == false) {
       // session(['url.intended' => url()->previous()]);
        return response()->json([
            'status' => false,
            'message' => 'Please login to continue'
        ]);
       }
    //    $wishlist = new Wishlist();
    //    $wishlist->user_id = Auth::user()->id;
    //    $wishlist->product_id = $request->id;
    //    $wishlist->save();

       $product = product::where('id',$request->id)->first();
       if($product == null) {
        return response()->json([
            'status' => true,
            'message' => '<div class="alert alert-success">product not found. </div>'
        ]);
       }

       Wishlist::updateOrCreate([
        'user_id' => Auth::user()->id,
        'product_id' => $request->id
       ],[
        'user_id' => Auth::user()->id,
        'product_id' => $request->id
       ]);
       return response()->json([
        'status' => true,
        'message' => '<div class="alert alert-success">'.$product->title .' added to wishlists</div>'
    ]);
    }

    public function page($slug) {
        $page = Page::where('slug', $slug)
        ->where('status', 1)
        ->first();
        $pages = Page::where('status',1)->get();
        return view('front.page' ,compact('page','pages'));
    }

    public function sendContactEmail(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'msg_subject' => 'required|min:10',
            'email' => 'required|email'
        ]);
        if($validator->passes()) {
            $admins = User::where('role',2)
                    ->where('status',1)
                    ->get();

                    if ($admins->isNotEmpty()) {
                        // Loop through each admin and send the email
                        foreach ($admins as $admin) {
                            $mailData = [
                                'name' => $request->name,
                                'email' => $request->email,
                                'msg_subject' => $request->msg_subject,
                                'message' => $request->message,
                                'mail_subject' => 'You have received a contact.'
                            ];
            
                            // Send email to the admin
                            Mail::to($admin->email)->send(new ContactEmail($mailData));
                        }
            
                        session()->flash('success', 'Thank you for contacting us. We will get back to you soon.');
            
                        return response()->json([
                            'status' => true,
                            'message' => 'Email sent successfully to all admins'
                        ]);
                    } else {
                        // No active admin found
                        return response()->json([
                            'status' => false,
                            'message' => 'No active admin found'
                        ], 404);
                    }
                } else {
            return response()->json([
                'status' => false ,
                'errors' => $validator->errors()
            ]);
        }
    }
}

