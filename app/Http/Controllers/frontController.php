<?php

namespace App\Http\Controllers;

use App\Models\product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class frontController extends Controller
{
    public function index() {
        $products = product::where('is_featured','Yes')->orderBy('id','DESC')->where('status',1)->take(8)->get();
        $latestProducts = product::orderBy('id','DESC')->where('status',1)->take(8)->get();
        return view('front.home', compact('products' ,'latestProducts') );
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
}

