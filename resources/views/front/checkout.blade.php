@extends('front.layouts.app')
@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item"><a class="white-text" href="{{route('shop')}}">Shop</a></li>
                    <li class="breadcrumb-item">Checkout</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-9 pt-4">
        <div class="container">
            <form action="" method="post" id="orderForm" name="orderForm">
            <div class="row">
                <div class="col-md-8">
                    <div class="sub-title">
                        <h2>Shipping Address</h2>
                    </div>
                    <div class="card shadow-lg border-0">
                        <div class="card-body checkout-form">
                            <div class="row">
                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="First Name" value="{{ (!empty($adds)) ? $adds->first_name : ''}}">
                                    <p></p>          
                                    </div>  
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Last Name" value="{{ (!empty($adds)) ? $adds->last_name : ''}}">
                                    <p></p>          

                                    </div>            
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" value="{{ (!empty($adds)) ? $adds->email : ''}}">
                                    <p></p>          

                                    </div>            
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <select name="country" id="country" class="form-control">
                                            <option value="">Select a Country</option>
                                            @if($countries->isNotEmpty())
                                            @foreach($countries as $country)
                                            <option {{( !empty($adds) && $adds->country_id == $country->id) ? "selected" : " "}} value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    <p></p>          

                                    </div>            
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <textarea name="address" id="address" cols="30" rows="3" placeholder="Address" class="form-control">{{ (!empty($adds)) ? $adds->address : ''}}</textarea>
                                    <p></p>          

                                    </div>            
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="appartment" id="appartment" class="form-control" value="{{ (!empty($adds)) ? $adds->apartment : ''}}" placeholder="Apartment, suite, unit, etc. (optional)">
                                    <p></p>          

                                    </div>            
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="city" id="city" class="form-control" value="{{ (!empty($adds)) ? $adds->city : ''}}" placeholder="City">
                                    <p></p>          
                                    </div>            
                                </div>

                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="state" id="state" class="form-control" value="{{ (!empty($adds)) ? $adds->state : ''}}" placeholder="State">
                                    <p></p>          
                                    </div>            
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <input type="text" name="zip" id="zip" class="form-control" value="{{ (!empty($adds)) ? $adds->zip : ''}}" placeholder="Zip">
                                    <p></p>          
                                    </div>            
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <input type="text" name="mobile" id="mobile" class="form-control" value="{{ (!empty($adds)) ? $adds->mobile : ''}}" placeholder="Mobile No.">
                                    </div>            
                                </div>
                                

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <textarea name="order_notes" id="order_notes" cols="30" rows="2" placeholder="Order Notes (optional)" class="form-control">{{ (!empty($adds)) ? $adds->notes : ''}}</textarea>
                                    <p></p>          

                                    </div>            
                                </div>

                            </div>
                        </div>
                    </div>    
                </div>
                <div class="col-md-4">
                    <div class="sub-title">
                        <h2>Order Summery</h3>
                    </div>                    
                    <div class="card cart-summery">
                        <div class="card-body">
                            @foreach( Cart::content() as $item) 
                            <div class="d-flex justify-content-between pb-2">
                                <div class="h6">{{$item->name}} X {{$item->qty}}</div>
                                <div class="h6">${{$item->price}}</div>
                            </div>
                            @endforeach
                            
                            </div>
                            <div class="d-flex justify-content-between summery-end">
                                <div class="h6"><strong>Subtotal</strong></div>
                                <div class="h6"><strong>${{Cart::Subtotal()}}</strong></div>
                            </div>
                            <div class="d-flex justify-content-between summery-end">
                                <div class="h6"><strong>Discount</strong></div>
                                <div class="h6"><strong id="discount_value">{{ $discount }}</strong></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <div class="h6"><strong>Shipping</strong></div>
                                <div class="h6"><strong id="shippingAmount">${{number_format($shippingCharge,2)}}</strong></div>
                            </div>
                            <div class="d-flex justify-content-between mt-2 summery-end">
                                <div class="h5"><strong>Total</strong></div>
                                <div class="h5"><strong id="grandTotal">${{number_format($grandTotal ,2)}}</strong></div>
                            </div>                            
                        </div>
                     <div class="input-group apply-coupan mt-4">
                        <input type="text" placeholder="Coupon Code" class="form-control" name="discount_code" id="discount_code">
                        <button class="btn btn-dark" type="button" id="apply-coupon">Apply Coupon</button>
                    </div> 
                    <div id="coupon-wrapper">
                    @if (session()->has('code'))
                    <div class="mt-4" id="coupon-container">
                        <strong>{{ Session::get('code')->code }}</strong>
                        <button class="btn btn-sm btn-danger" id="remove-discount" ><i class="fa fa-times"></i></button>
                    </div> 
                    @endif
                    </div>
                   

                    <div class="card payment-form ">  
                    <h3 class="card-title h5 mb-3">Payment Method</h3>

                        <div class="">
                            <input checked type="radio" name="payment_method" id="payment1" value="cod">
                            <label for="payment1" class="form-check-label">COD</label>
                        </div>                      
                        <div class="">
                            <input type="radio" name="payment_method" id="payment2" value="stripe">
                            <label for="payment2" class="form-check-label">Stripe</label>
                        </div>  
                        
                        
                        <div class="card-body p-0 d-none" id="payment-form">
                            <div class="mb-3">
                                <label for="card_number" class="mb-2">Card Number</label>
                                <input autocomplete='off' class='form-control card-number' size='20' type='text' name="card_number" id="card_number" placeholder="Valid Card Number">
                                <p></p>
                            </div>
                            <div class="row justify-content-center align-items-center p-0">
                                <div class="col-md-4">
                                    <label for="expiry_month" class="mb-2">Expiry Month</label>
                                    <input type="text" name="expiry_month" id="expiry_month" placeholder="MM" class="form-control card-expiry-month" size='2'>
                                    <p></p>
                                </div>
                                <div class="col-md-4">
                                    <label for="expiry_year" class="mb-2">Expiry Year</label>
                                    <input type="text" name="expiry_year" id="expiry_year" placeholder="YYYY" class="form-control card-expiry-month" size='2'>
                                    <p></p>
                                </div>
                                <div class="col-md-4">
                                    <label for="card_cvc" class="mb-2">CVV Code</label>
                                    <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' name="card_cvc" id="card_cvc" size='4' type='text'>
                                    <p></p>
                                </div>
                            </div>
                        </div> 
                        <div class="pt-4">
                                <!-- <a href="#" class="btn-dark btn btn-block w-100">Pay Now</a> -->
                                <button type="submit" class="btn-dark btn btn-block w-100">Pay Now</button>
                            </div>                       
                    </div>
                </div>
            </div>
</form>
        </div>
    </section>
@endsection
@section('customJs')
<script src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
$("#payment1").click(function(){ 
    if($(this).is(":checked") == true){
        $("#payment-form").addClass('d-none');
     }
});
$("#payment2").click(function(){ 
    if($(this).is(":checked") == true){
        $("#payment-form").removeClass('d-none');
     }
});


$("#orderForm").submit(function(event) {
    event.preventDefault();
    $("button[type='submit']").prop('disabled' ,true);
    $.ajax({
        url:'{{ route('front.processCheckout') }}',
        type:'post',
        data:$(this).serializeArray(),
        dataType:'json',
        success :  function(response){ 
                var errors = response.errors;
                $("button[type='submit']").prop('disabled' ,false);
                if(response.status == false) {
                if(errors.first_name){
                        $("#first_name").addClass('is-invalid')
                        .siblings("p")
                        .addClass('invalid-feedback')
                        .html(errors.first_name);
                 } else {
                    $("#first_name").removeClass('is-invalid')
                        .siblings("p")
                        .removeClass('invalid-feedback')
                        .html("");
                 }
                if(errors.last_name){
                        $("#last_name").addClass('is-invalid')
                        .siblings("p")
                        .addClass('invalid-feedback')
                        .html(errors.last_name);
                 } else {
                    $("#last_name").removeClass('is-invalid')
                        .siblings("p")
                        .removeClass('invalid-feedback')
                        .html("");
                 }
                if(errors.email){
                        $("#email").addClass('is-invalid')
                        .siblings("p")
                        .addClass('invalid-feedback')
                        .html(errors.email);
                 } else {
                    $("#email").removeClass('is-invalid')
                        .siblings("p")
                        .removeClass('invalid-feedback')
                        .html("");
                 }
                if(errors.country){
                        $("#country").addClass('is-invalid')
                        .siblings("p")
                        .addClass('invalid-feedback')
                        .html(errors.country);
                 } else {
                    $("#country").removeClass('is-invalid')
                        .siblings("p")
                        .removeClass('invalid-feedback')
                        .html("");
                 }
                if(errors.address){
                        $("#address").addClass('is-invalid')
                        .siblings("p")
                        .addClass('invalid-feedback')
                        .html(errors.address);
                 } else {
                    $("#address").removeClass('is-invalid')
                        .siblings("p")
                        .removeClass('invalid-feedback')
                        .html("");
                 }
                if(errors.state){
                        $("#state").addClass('is-invalid')
                        .siblings("p")
                        .addClass('invalid-feedback')
                        .html(errors.state);
                 } else {
                    $("#state").removeClass('is-invalid')
                        .siblings("p")
                        .removeClass('invalid-feedback')
                        .html("");
                 }
                if(errors.mobile){
                        $("#mobile").addClass('is-invalid')
                        .siblings("p")
                        .addClass('invalid-feedback')
                        .html(errors.mobile);
                 } else {
                    $("#mobile").removeClass('is-invalid')
                        .siblings("p")
                        .removeClass('invalid-feedback')
                        .html("");
                 }
                if(errors.city){
                        $("#city").addClass('is-invalid')
                        .siblings("p")
                        .addClass('invalid-feedback')
                        .html(errors.city);
                 } else {
                    $("#city").removeClass('is-invalid')
                        .siblings("p")
                        .removeClass('invalid-feedback')
                        .html("");
                 }
                if(errors.zip){
                        $("#zip").addClass('is-invalid')
                        .siblings("p")
                        .addClass('invalid-feedback')
                        .html(errors.zip);
                 } else {
                    $("#zip").removeClass('is-invalid')
                        .siblings("p")
                        .removeClass('invalid-feedback')
                        .html("");
                 }
                if(errors.mobile){
                        $("#mobile").addClass('is-invalid')
                        .siblings("p")
                        .addClass('invalid-feedback')
                        .html(errors.mobile);
                 } else {
                    $("#mobile").removeClass('is-invalid')
                        .siblings("p")
                        .removeClass('invalid-feedback')
                        .html("");
                 }
                 if(errors.card_number){
                        $("#card_number").addClass('is-invalid')
                        .siblings("p")
                        .addClass('invalid-feedback')
                        .html(errors.card_number);
                 } else {
                    $("#card_number").removeClass('is-invalid')
                        .siblings("p")
                        .removeClass('invalid-feedback')
                        .html("");
                 }
                 if(errors.expiry_month){
                        $("#expiry_month").addClass('is-invalid')
                        .siblings("p")
                        .addClass('invalid-feedback')
                        .html(errors.expiry_month);
                 } else {
                    $("#expiry_month").removeClass('is-invalid')
                        .siblings("p")
                        .removeClass('invalid-feedback')
                        .html("");
                 }
                 if(errors.expiry_year){
                        $("#expiry_year").addClass('is-invalid')
                        .siblings("p")
                        .addClass('invalid-feedback')
                        .html(errors.expiry_year);
                 } else {
                    $("#expiry_year").removeClass('is-invalid')
                        .siblings("p")
                        .removeClass('invalid-feedback')
                        .html("");
                 }
                 if(errors.card_cvc){
                        $("#card_cvc").addClass('is-invalid')
                        .siblings("p")
                        .addClass('invalid-feedback')
                        .html(errors.card_cvc);
                 } else {
                    $("#card_cvc").removeClass('is-invalid')
                        .siblings("p")
                        .removeClass('invalid-feedback')
                        .html("");
                 }
                }  else if(response.status == "stripe error") {
                    console.log(response.message)
                } else {
                    window.location.href = "{{ url('thanks/') }}/"+response.orderId; 
                }
        }
    });
});

$("#country").change(function(){ 
    $.ajax({
        url:'{{ route('front.summary')}}',
        type: 'post',
        data: {country_id : $(this).val()},
        dataType:'json',
        success : function(response) {
            if (response.status === true) {
    $("#shippingAmount").html(response.shippingCharge);
    $("#grandTotal").html(response.grandTotal);
} else {
    console.log("Status is not true");
}
        }
    })
});

$('#apply-coupon').click(function() {
    
    $.ajax({
        url:'{{ route('front.discount')}}',
        type: 'post',
        data: {code : $('#discount_code').val() ,country_id : $('#country').val()},
        dataType:'json',
        success : function(response) {
            if (response.status === true) {

                $("#shippingAmount").html(response.shippingCharge);
                $("#grandTotal").html(response.grandTotal);
                $("#discount_value").html(response.discount);
                window.location.reload();
            } else {
                $("#coupon-wrapper").html( "<span class='text-danger'>"+response.message+"</span>");
                console.error('Coupon application failed:', response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            console.log('Raw Response:', xhr.responseText);
        }
    })
});

$('#coupon-container').on('click', '#remove-discount', function(event) {
    event.preventDefault();
    $.ajax({
        url:'{{ route('remove.discount')}}',
        type: 'post',
        data: {country_id : $('#country').val()},
        dataType:'json',
        success : function(response) {
            console.log(response['status']);
            if (response.status === true) {
                $("#shippingAmount").html(response.shippingCharge);
                $("#grandTotal").html(response.grandTotal);
                $("#discount_value").html(response.discount);
                $("#coupon-container").html('');
            } else {
                console.error('Coupon application failed:',response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', error);
            console.log('Raw Response:', xhr.responseText);
            var response = JSON.parse(xhr.responseText);
        }
    })
});
</script>
@endsection