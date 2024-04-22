<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brands;
use App\Models\Category;
use App\Models\product;
use App\Models\productImage;
use App\Models\ProductRating;
use App\Models\tempImage;
use Illuminate\Http\Request;
use App\Models\subCategory;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = product::latest('id')->with('product_images');
        if ($request->get('search') != " ") {
            $products = $products->where('title', 'like', '%' . $request->get('search') . '%');
        }
        $products = $products->paginate(10);
        return view('admin.products.list', compact('products'));

    }
    public function create()
    {
        $categories = Category::all();
        $brands = Brands::all();
        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        $validation = [
            'title' => 'required',
            'slug' => 'required|unique:products',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',

        ];

        if (!empty ($request->track_qty) && $request->track_qty == 'Yes') {
            $validation['qty'] = 'required|numeric';
        }
        $validator = Validator::make($request->all(), $validation);

        if ($validator->passes()) {
            $products = new product();
            $products->title = $request->title;
            $products->slug = $request->slug;
            $products->description = $request->description;
            $products->price = $request->price;
            $products->compare_price = $request->compare_price;
            $products->category_id = $request->category;
            $products->sub_category_id = $request->sub_category;
            $products->brand_id = $request->brand;
            $products->is_featured = $request->is_featured;
            $products->sku = $request->sku;
            $products->barcode = $request->barcode;
            $products->track_qty = $request->track_qty;
            $products->qty = $request->qty;
            $products->status = $request->status;
            $products->short_description = $request->short_description;
            $products->shipping = $request->shipping;
            $products->related_products = (!empty($request->related_products)) ? implode(',' ,$request->related_products): "";

            $products->save();

            //save gallery 
            if (!empty ($request->image_array)) {
                foreach ($request->image_array as $temp_image_id) {
                    $tempImageInfo = tempImage::find($temp_image_id);
                    $extArray = explode('.', $tempImageInfo->name);
                    $ext = last($extArray);


                    $productImage = new productImage();
                    $productImage->product_id = $products->id;
                    $productImage->image = "NULL";
                    $productImage->save();

                    $imageName = $products->id . '-' . $productImage->id . '.' . $ext;
                    $productImage->image = $imageName;
                    $productImage->save();

                    //generate thumbnails

                    //large image
                    $sourcePath = public_path() . '/temp/' . $tempImageInfo->name;
                    $destPath = public_path() . '/uploads/products/large/' . $imageName;
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($sourcePath);
                    $image->resize(1400, null);
                    $image->save($destPath);

                    //small image
                    $destPath = public_path() . '/uploads/products/small/' . $imageName;
                    $manager = new ImageManager(new Driver());
                    $image = $manager->read($sourcePath);
                    $image->cover(300, 300);
                    $image->save($destPath);
                }
            }
            $request->session()->flash('success', 'product created successfully');
            return response()->json([
                'status' => true,
                'message' => 'product created successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
    public function edit(Request $request, $id)
    {
        $products = product::find($id);

        if (empty ($products)) {
            $request->session()->flash('error', "product not found");
            return redirect()->route('product.index');
        }
        //related products 
        $relatedProducts =[];
        if($products->related_products != '') {
            $productArray = explode(',', $products->related_products);
           $relatedProducts = product::whereIn('id', $productArray)->get();                
        }
        //fetch product images
        $product_images = productImage::where('product_id', $products->id)->get();
        $subCat = subCategory::where('category_id', $products->category_id)->get();

        $categories = Category::orderBy('name', 'ASC')->get();
        $brands = Brands::orderBy('name', 'ASC')->get();

        return view('admin.products.edit', compact('categories', 'brands', 'products', 'subCat', 'product_images' ,'relatedProducts'));
    }

    public function update(Request $request, $id)
    {
        $product = product::find($id);
        if (empty ($product)) {
            $request->session()->flash('error', 'product not found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Product not found'
            ]);
        }
        $validation = [
            'title' => 'required',
            'slug' => 'required|unique:products,slug,' . $product->id . ',id',
            'price' => 'required|numeric',
            'sku' => 'required|unique:products,sku,' . $product->id . ',id',
            'track_qty' => 'required|in:Yes,No',
            'category' => 'required|numeric',
            'is_featured' => 'required|in:Yes,No',
        ];


        if (!empty ($request->track_qty) && $request->track_qty == 'Yes') {
            $validation['qty'] = 'required|numeric';
        }
        $validator = Validator::make($request->all(), $validation);

        if ($validator->passes()) {
            $product->title = $request->title;
            $product->slug = $request->slug;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->compare_price = $request->compare_price;
            $product->category_id = $request->category;
            $product->sub_category_id = $request->sub_category;
            $product->brand_id = $request->brand;
            $product->is_featured = $request->is_featured;
            $product->sku = $request->sku;
            $product->barcode = $request->barcode;
            $product->track_qty = $request->track_qty;
            $product->qty = $request->qty;
            $product->status = $request->status;
            $product->short_description = $request->short_description;
            $product->shipping = $request->shipping;
            $product->related_products = (!empty($request->related_products)) ? implode(',' ,$request->related_products): "";
            $product->save();

            $request->session()->flash('success', 'product updated successfully');
            return response()->json([
                'status' => true,
                'message' => 'product updated successfully'
            ]);

        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
    }
    public function destroy(Request $request, $id)
    {
        $product = product::find($id);
        if (empty ($product)) {
            $request->session()->flash('error', 'product not found');

            return response()->json([
                'status' => false,
                'notFound' => true
            ]);
        }
        $productImage = productImage::where('product_id', $id)->get();
        if (!empty ($productImage)) {
            foreach ($productImage as $image) {
                File::delete(public_path('uploads/products/large/' . $image->image));
                File::delete(public_path('uploads/products/small/' . $image->image));
            }

            productImage::where('product_id', $id)->delete();
        }

        $product->delete();
        $request->session()->flash('success', 'product deleted successfully');
        return response()->json([
            'status' => true,
            'message' => 'product deleted'
        ]);
    }

    public function getProducts(Request $request)
    {
        $tempProuct = [];
        if ($request->term != "") {
            $products = product::where('title', 'like', '%' . $request->term . '%')->get();
            if ($products != null) {
                foreach ($products as $value) {
                    $tempProuct[] = array('id' => $value->id, 'text' => $value->title);
                }
            }
        }
        return response()->json([
            'tags' => $tempProuct,
            'status' =>true
        ]);

    }
    public function productRatings(Request $request) {
        $ratings = ProductRating::select('product_ratings.*','products.title as productTitle')->orderBy('created_at','DESC');
        $ratings = $ratings->leftJoin('products','products.id','product_ratings.product_id');
        if ($request->get('search') != "") {
            $searchTerm = $request->get('search');
            $ratings = $ratings->where(function ($query) use ($searchTerm) {
                $query->where('products.title', 'like', "%$searchTerm%")
                    ->orWhere('product_ratings.username', 'like', "%$searchTerm%")
                    ->orWhere('product_ratings.rating', 'like', "%$searchTerm%");
            });
        }
        $ratings = $ratings->paginate(10);
        return view('admin.products.ratings',compact('ratings'));
    }

    public function changeRatingStatus(Request $request) {
        $rating = ProductRating::find($request->id);
        if($rating == null) {
            session()->flash('error','rating Not fount');
            return response()->json([
                'status' => false,
                'message' => 'rating Not fount',
                'notFound' => true
            ]);
        } 
        
        $rating->status = $request->status;
        $rating->save();
        session()->flash('success','rating status updated');
        return response()->json([
            'status' => true,
            'message' => 'rating status updated',
            'notFound' => false
        ]);
    }
}
