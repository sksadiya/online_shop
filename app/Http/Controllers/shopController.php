<?php

namespace App\Http\Controllers;

use App\Models\Brands;
use App\Models\Category;
use App\Models\Page;
use App\Models\product;
use App\Models\subCategory;
use Illuminate\Http\Request;

class shopController extends Controller
{
    public function index(Request $request ,$catSlug = null ,$subSlug =null) {
        $catSelected = "";
        $subSelected = "";
        $brandsArray = [];
        

        $categories = Category::orderBy('name','ASC')->with('sub_category')->where('status',1)->get();
        $brands = Brands::orderBy('name','ASC')->where('status',1)->get();
        $products = product::where('status',1);
        //apply filters here
        if(!empty($catSlug)) {
            $category = Category::where('slug',$catSlug)->first();
            $products= $products->where('category_id',$category->id);
            $catSelected = $category->id;
        }
        if(!empty($subSlug)) {
            $subcategory = subCategory::where('slug',$subSlug)->first();
            $products= $products->where('sub_category_id',$subcategory->id);
            $subSelected = $subcategory->id;
        }
        if(!empty($request->get('brand'))) {
            $brandsArray = explode(',',$request->get('brand'));
            $products = $products->whereIn('brand_id',$brandsArray);
        }

        if(!empty($request->get('price_max')) && !empty($request->get('price_min'))) {
            if($request->get('price_max') == 1000) {
                $products =$products->whereBetween('price',[intval($request->get('price_min')) ,1000000]);
            } else {
                $products =$products->whereBetween('price',[intval($request->get('price_min')) ,intval($request->get('price_max'))]);
            }
        }
        if(!empty($request->get('searchP'))) {
            $products =$products->where('title','like','%'.$request->get('searchP').'%');
        }
        if(!empty($request->get('sort'))) {
            if($request->get('sort') == 'latest') {
                $products =$products->orderBy('id','DESC');
            }
           else if($request->get('sort') == 'price_asc') {
                $products =$products->orderBy('id','ASC');
            } else {
                $products =$products->orderBy('id','DESC');
            }
        } else {
            $products =$products->orderBy('id','DESC');
        }
        $products =$products->paginate(6);
        $priceMax = (intval($request->get('price_max')) == 0) ? 1000 : $request->get('price_max');
        $priceMin = intval($request->get('price_min'));
        $sort = $request->get('sort');
        $pages = Page::where('status',1)->get();
        return view('front.shop' ,compact('categories' ,'brands','products' ,'catSelected','subSelected','brandsArray','priceMax','priceMin','sort' ,'pages'));
    }

    public function product($slug) {
        $product = product::where('slug',$slug)->with('product_images')->first();
        //dd($product);
        if($product == null) {
            abort(404);
        }
        $relatedProducts =[];
        if($product->related_products != '') {
            $productArray = explode(',', $product->related_products);
           $relatedProducts = product::whereIn('id', $productArray)->where('status',1)->with('product_images')->get();                
        }
        $pages = Page::where('status',1)->get();
        return view('front.product', compact('product','relatedProducts','pages'));
    }
}
