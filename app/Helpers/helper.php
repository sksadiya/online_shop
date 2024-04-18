<?php 
use App\Mail\orderEmail;
use App\Models\Category;
use App\Models\Country;
use App\Models\Order;
use Illuminate\Support\Facades\Mail;
function get_categories() {
    return Category::orderBy('name','DESC')
    ->with('sub_category')
    ->where('status',1)
    ->where('showHome','Yes')->get();
}

function OrderEmail($orderId) {
    $order = Order::where('id',$orderId)->with('items')->first();
    $mailData =[
        'subject' => 'Thanks for your order',
        'order' => $order
    ];
    Mail::to($order->email)->send(new orderEmail($mailData));
}
 function countryInfo($id) {
return Country::where('id',$id)->first();
}
?>