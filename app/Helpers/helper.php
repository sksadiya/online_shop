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

function OrderEmail($orderId ,$userType="customer") {
    $order = Order::where('id',$orderId)->with('items')->first();
    if($userType == 'customer') {
        $subject = 'Thanks for your order';
        $email = $order->email;
    } else {
        $subject = 'New Order';
        $email = env('ADMIN_EMAIL');
    }
    $mailData =[
        'subject' => $subject,
        'order' => $order,
        'userType' => $userType
    ];
    Mail::to($email)->send(new orderEmail($mailData));
}
 function countryInfo($id) {
return Country::where('id',$id)->first();
}
?>