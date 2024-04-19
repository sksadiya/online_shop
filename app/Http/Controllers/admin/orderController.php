<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItems;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function index(Request $request) {
        $orders = Order::latest('orders.created_at')->select('orders.*','users.name','users.email');
        $orders = $orders->leftJoin('users','users.id','orders.user_id');

        if($request->get('search') != '') {
            $orders = $orders->where('users.name','like','%'.$request->get('search').'%');
            $orders = $orders->orWhere('users.email','like','%'.$request->get('search').'%');
            $orders = $orders->orWhere('orders.id','like','%'.$request->get('search').'%');
        }
        $orders = $orders->paginate(10);
        return view('admin.orders.list',compact('orders'));
    }
    public function detail($id) {
        $order = Order::select('orders.*','countries.name as country_name')
        ->where('orders.id', $id)->leftJoin('countries','countries.id','orders.Country_id')->first();
        $orderItems = OrderItems::where('order_id',$id)->get();
        return view('admin.orders.detail',compact('order','orderItems'));
    }

    public function changeOrderStatus(Request $request ,$id) {
        $order = Order::find($id);
        $order->shipped_date = $request->shipped_date;
        $order->status = $request->status;
        $order->save();
        $request->session()->flash('success', 'status updated successfully');

        return response()->json([
            'status' =>true,
            'message' => 'status changes successfully'
        ]);
    }

    public function sendInvoiceEmail(Request $request , $orderId) {
        OrderEmail($orderId,$request->userType);
        $message = "order email sent succefully";
        session()->flash('success',$message);
        return response()->json([
            'status' =>true,
            'message' => $message
        ]);
    
    }
}
