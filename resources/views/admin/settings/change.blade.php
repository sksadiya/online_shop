@extends('admin.includes.default2')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Change Password</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
          <form action="{{ route('settings.changeP') }}" method="post" id="changePasswordS" name="changePasswordS">
          @csrf
					<div class="container-fluid">
            @include('admin.message')
              <div class="card">
                <div class="card-body">								
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="old_password">Old Password</label>
                        <input type="text" name="old_password" id="old_password" class="form-control @error('old_password') is-invalid @enderror" placeholder="old Password">	
                        @error('old_password')  
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="password">New Password</label>
                        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror"  placeholder="New password">	
                        @error('password')  
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>	
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="password">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm password">	
                        @error('password_confirmation')  
                        <p class="invalid-feedback">{{ $message }}</p>
                        @enderror
                      </div>
                    </div>	
                  </div>
                </div>							
              </div>
            
						<div class="pb-5 pt-3">
							<button type="submit" class="btn btn-primary">Change</button>
							<a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</div>
          </form>
					<!-- /.card -->
				</section>
				<!-- /.content -->
@endsection
@section('customJs')

@endsection