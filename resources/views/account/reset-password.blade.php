@extends('front.layouts.app')
@section('content')
<section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="#">Home</a></li>
                    <li class="breadcrumb-item">Reset Password</li>
                </ol>
            </div>
        </div>
    </section>

    <section class=" section-10">
        <div class="container">
            @if(Session::has('success'))
           <div class="alert alert-success">
            {{ Session::get('success')}}
           </div>
            @endif
            @if(Session::has('error'))
           <div class="alert alert-danger">
            {{ Session::get('error')}}
           </div>
            @endif
            <div class="login-form">    
                <form action="{{ route('account.process-reset-password')}}" method="post" id="accountLogin">
                @csrf
                    <h4 class="modal-title">Reset Password</h4>
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="form-group">
                        <input type="text" class="form-control @error('new_password') is-invalid @enderror"  placeholder="New password" id="new_password" name="new_password" >
                        @error('new_password')
                                    <p class="invalid-feedback">{{ $message  }}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control @error('password_confirmation') is-invalid @enderror"  placeholder="Confirm password" id="password_confirmation" name="password_confirmation" >
                        @error('password_confirmation')
                                    <p class="invalid-feedback">{{ $message  }}</p>
                        @enderror
                    </div>
                    
                    <div class="form-group small">
                        <a href="{{ route('account.login') }}" class="forgot-link">Click here to Login</a>
                    </div> 
                    <input type="submit" class="btn btn-dark btn-block btn-lg" value="Reset">              
                </form>			
            </div>
        </div>
    </section>
@endsection
@section('customJs')


@endsection