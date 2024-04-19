@extends('front.layouts.app')
@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">My Account</a></li>
                    <li class="breadcrumb-item">Settings</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-11 ">
        <div class="container  mt-5">
            <div class="row">
                <div class="col-md-12">
                    @include('admin.message')
                </div>
                <div class="col-md-3">
          @include('account.common.sidebar')  
                </div>
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Personal Information</h2>
                        </div>
                        <form action="" method="post" id="updatePersonalInfo" name="updatePersonalInfo">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="mb-3">               
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" placeholder="Enter Your Name" value="{{ $user->name }}" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="mb-3">            
                                        <label for="email">Email</label>
                                        <input type="email" name="email" id="email" value="{{ $user->email }}" placeholder="Enter Your Email" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="mb-3">                                    
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" value="{{ $user->phone }}" placeholder="Enter Your Phone" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="d-flex">
                                        <button class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card mt-5">
                        <div class="card-header">
                            <h2 class="h5 mb-0 pt-2 pb-2">Address</h2>
                        </div>
                        <form action="" method="post" id="updateAddressInfo" name="updateAddressInfo">
                            <div class="card-body p-4">
                                <div class="row">
                                    <div class="col-md-6 mb-3">               
                                        <label for="name">First Name</label>
                                        <input type="text" name="first_name" id="first_name" placeholder="Enter Your First name" value="{{ (!empty($address)) ? $address->first_name : ''}}" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-3">               
                                        <label for="name">Last Name</label>
                                        <input type="text" name="last_name" id="last_name" placeholder="Enter Your Last name" value="{{ (!empty($address)) ? $address->last_name : ''}}" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-3">            
                                        <label for="emailAddress">Email</label>
                                        <input type="email" name="emailAddress" id="emailAddress" value="{{ (!empty($address)) ? $address->email : ''}}" placeholder="Enter Your Email" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="col-md-6 mb-3">                                    
                                        <label for="mobile">mobile</label>
                                        <input type="text" name="mobile" id="mobile" value="{{ (!empty($address)) ? $address->mobile : ''}}" placeholder="mobile" class="form-control">
                                        <p></p>
                                    </div>
                                    <div class="mb-3">                                    
                                        <label for="country">Country</label>
                                        <select name="country" id="country" class="form-control">
                                            <option value="">Select a Country</option>
                                            @if($countries->isNotEmpty())
                                            @foreach($countries as $country)
                                            <option {{( !empty($address) && $address->country_id == $country->id) ? "selected" : " "}} value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                        <p></p>
                                    </div>
                                    <div class="mb-3">
                                        <textarea name="address" id="address"  cols="30" rows="5" placeholder="Address" class="form-control">{{ (!empty($address)) ? $address->address : ''}}</textarea>
                                    <p></p>          
                                    </div> 
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="apartment" id="apartment" class="form-control" value="{{ (!empty($address)) ? $address->apartment : ''}}" placeholder="Apartment, suite, unit, etc. (optional)">
                                    <p></p>          
                                    </div> 
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="city" id="city" class="form-control" value="{{ (!empty($address)) ? $address->city : ''}}" placeholder="City">
                                    <p></p>          
                                    </div>   
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="state" id="state" class="form-control" value="{{ (!empty($address)) ? $address->state : ''}}" placeholder="State">
                                    <p></p>          
                                    </div>            
                                    <div class="col-md-6 mb-3">
                                        <input type="text" name="zip" id="zip" class="form-control" value="{{ (!empty($address)) ? $address->zip : ''}}" placeholder="Zip">
                                    <p></p>          
                                    </div>            
                                    <div class="d-flex">
                                        <button class="btn btn-dark">Update</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('customJs')
<script>
$("#updatePersonalInfo").submit(function(event) {
    event.preventDefault();
    $.ajax({
        url: "{{ route('account.updatePersonalInfo') }}",
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            if(response.status == true) {
                $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#email').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#phone').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

                window.location.href = "{{ route('account.profile') }}";
                
            } else {
                let errors =response['errors'];
            if(errors['name']) {
                $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
            } else {
                $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['email']) {
                $('#email').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['email']);
            } else {
                $('#email').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['phone']) {
                $('#phone').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['phone']);
            } else {
                $('#phone').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }

            }
        },
        error: function(response) {

        }
    });
});
$("#updateAddressInfo").submit(function(event) {
    event.preventDefault();
    $.ajax({
        url: "{{ route('account.updateAddressInfo') }}",
        type: "POST",
        data: $(this).serialize(),
        dataType: 'json',
        success: function(response) {
            if(response.status == true) {
                
                window.location.href = "{{ route('account.profile') }}";
                $('#first_name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#last_name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#emailAddress').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#mobile').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#country').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#address').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#state').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#zip').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#city').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

                
            } else {
                let errors =response['errors'];
            if(errors['first_name']) {
                $('#first_name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['first_name']);
            } else {
                $('#first_name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['last_name']) {
                $('#last_name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['last_name']);
            } else {
                $('#last_name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['emailAddress']) {
                $('#emailAddress').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['emailAddress']);
            } else {
                $('#emailAddress').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['mobile']) {
                $('#mobile').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['mobile']);
            } else {
                $('#mobile').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['country']) {
                $('#country').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['country']);
            } else {
                $('#country').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['address']) {
                $('#address').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['address']);
            } else {
                $('#address').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['state']) {
                $('#state').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['state']);
            } else {
                $('#state').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['zip']) {
                $('#zip').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['zip']);
            } else {
                $('#zip').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['city']) {
                $('#city').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['city']);
            } else {
                $('#city').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            }
        },
        error: function(response) {

        }
    });
});

</script>
@endsection