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
                            <h2 class="h5 mb-0 pt-2 pb-2">Change Password</h2>
                        </div>
                        <form action="{{ route('account.changePasswordPost') }}" method="post" id="changePasswordPost" name="changePasswordPost">
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="mb-3">               
                                    <label for="name">Old Password</label>
                                    <input type="password" name="old_password" id="old_password" placeholder="Old Password" class="form-control">
                                    <p></p>
                                </div>
                                <div class="mb-3">               
                                    <label for="name">New Password</label>
                                    <input type="password" name="password" id="password" placeholder="New Password" class="form-control">
                                    <p></p>
                                </div>
                                <div class="mb-3">               
                                    <label for="name">Confirm Password</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Old Password" class="form-control">
                                    <p></p>
                                </div>
                                <div class="d-flex">
                                    <button id="submit" name="submit" type="submit" class="btn btn-dark">Save</button>
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
   $("#changePasswordPost").submit( function(event) {
    event.preventDefault();
    $('#submit').prop('disabled',true);
      $.ajax({
        url: "{{ route('account.changePasswordPost') }}",
        type: "POST",
        data: $("#changePasswordPost").serialize(),
        dataType :'json',
        success : function(response) {
          if(response.status == true) {
            $('#submit').prop('disabled',false);
                $('#old_password').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#password').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#password_confirmation').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

                window.location.href = "{{ route('account.changePassword') }}";
                
            } else {
                let errors =response['errors'];
            if(errors['old_password']) {
                $('#old_password').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['old_password']);
            } else {
                $('#old_password').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['password']) {
                $('#password').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['password']);
            } else {
                $('#password').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['password_confirmation']) {
                $('#password_confirmation').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['password_confirmation']);
            } else {
                $('#password_confirmation').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
          }
        }
      });
   });

</script>
@endsection
