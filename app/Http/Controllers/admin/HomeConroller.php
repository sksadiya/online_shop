<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\product;
use App\Models\ProductRating;
use App\Models\tempImage;
use App\Models\User;
use Carbon\Carbon;
use File;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeConroller extends Controller
{
  public function index()
  {
    $orders = Order::where('status', '!=', 'cancelled')->count();
    $customers = User::where('role', 1)->count();
    $products = product::count();
    $totalRevenue = Order::where('status', '!=', 'cancelled')->sum('grand_total');
    //this month revenue
    $startOfMonth = Carbon::now()->startOfMonth()->format('Y-m-d');
    $currentDate = Carbon::now()->format('Y-m-d');

    $monthRevenue = Order::where('status', '!=', 'cancelled')
      ->whereDate('created_at', '>=', $startOfMonth)
      ->whereDate('created_at', '<=', $currentDate)
      ->sum('grand_total');
    //last month revenue
    $lastMonthStartDate = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
    $lastMonthEndDate = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
    $lastMonthRevenue = Order::where('status', '!=', 'cancelled')
      ->whereDate('created_at', '>=', $lastMonthStartDate)
      ->whereDate('created_at', '<=', $lastMonthEndDate)
      ->sum('grand_total');

    //delete temp images here
    $dayBeforeToday = Carbon::now()->subDays(1)->format('Y-m-d H:i:s');
    $tempImages = tempImage::where('created_at', '<=', $dayBeforeToday)->get();
    foreach ($tempImages as $temp) {
      $path = public_path('/temp/' . $temp->image);
      $thumbPath = public_path('/temp/thumb/' . $temp->image);
      if (File::exists($path)) {
        File::delete($path);
      }
      if (File::exists($thumbPath)) {
        File::delete($thumbPath);
      }
      tempImage::where('id', $temp->id)->delete();
    }
    return view('admin.dashboard', compact('orders', 'customers', 'products', 'totalRevenue', 'monthRevenue', 'lastMonthRevenue'));
  }

  public function logout()
  {
    Auth::guard('admin')->logout();
    return redirect()->route('admin.login');
  }
  public function ratings(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|min:3',
      'email' => 'required|email',
      'review' => 'required|min:10',
      'rating' => 'required|numeric'
    ]);
    if ($validator->passes()) {
      $count = ProductRating::where('product_id', $id)->where('email', $request->email)->count();
      if ($count > 0) {
        session()->flash('error', 'you already rated this product.');
        return response()->json([
          'status' => true,
          'message' => 'you already rated this product.'
        ]);
      }
      $ratings = new ProductRating();
      $ratings->username = $request->name;
      $ratings->email = $request->email;
      $ratings->comment = $request->review;
      $ratings->rating = $request->rating;
      $ratings->status = 0;
      $ratings->product_id = $id;
      $ratings->save();
      session()->flash('success', 'review submitted successfully.');
      return response()->json([
        'status' => true,
        'message' => 'review submitted successfully.'
      ]);
    } else {
      return response()->json([
        'status' => false,
        'errors' => $validator->errors()
      ]);
    }
  }
}
