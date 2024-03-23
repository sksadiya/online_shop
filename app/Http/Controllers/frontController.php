<?php

namespace App\Http\Controllers;

use App\Models\product;
use Illuminate\Http\Request;

class frontController extends Controller
{
    public function index() {
        $products = product::where('is_featured','Yes')->orderBy('id','DESC')->where('status',1)->take(8)->get();
        $latestProducts = product::orderBy('id','DESC')->where('status',1)->take(8)->get();
        return view('front.home', compact('products' ,'latestProducts') );
    }
}
