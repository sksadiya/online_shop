@extends('admin.includes.default2')

@section('content')
    	<!-- Content Header (Page header) -->
      <section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Edit User</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('users.index') }}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
          <form action="{{ route('users.update',$user->id) }}" method="post" name="UsersUpdateForm" id="UsersUpdateForm">
            <div class="container-fluid">
              <div class="card">
                <div class="card-body">								
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ $user->name }}" class="form-control" placeholder="Name">
                        <p></p>	
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" value="{{ $user->email }}" class="form-control" placeholder="Email">
                        <p></p>	
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="password">
                        <p>To change password you have to enter a value,otherwise leave this blank</p>	
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" value="{{ $user->phone }}" class="form-control" placeholder="Phone">	
                        <p></p>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" placeholder="Status" class="form-control"> 
                          <option {{ ($user->status == 1 ) ? 'selected' : ''}} value="1">Active</option>
                          <option {{ ($user->status == 0 ) ? 'selected' : ''}} value="0">Block</option>
                        </select>
                        <p></p>
                      </div>
                    </div>
                    
                  </div>
                </div>							
              </div>
              <div class="pb-5 pt-3">
                <button class="btn btn-primary">update</button>
                <a href="{{ route('users.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
              </div>
            </div>
          </form>
					<!-- /.card -->
				</section>
				<!-- /.content -->
@endsection

@section('customScript')
<script>
  $("#UsersUpdateForm").submit( function(event) {
    event.preventDefault(); // Prevent default form submission
    $('button[type=submit]').prop('disabled', true);
    $.ajax({
      url: "{{ route('users.update' ,$user->id) }}",
      type: 'post',
      data: $(this).serializeArray(),
      dataType: 'json',
      success: function(response) {
        $('button[type=submit]').prop('disabled', false);
        if (response['status'] == true) {
          const redirectToList = '{{ route("users.index") }}';
          window.location.href = redirectToList;
          // Clear error messages if successful
          $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
          $('#email').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
          $('#phone').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
          $('#password').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
        } else {
          if(response['notFound'] == true) {
            const redirectToList = '{{ route("users.index") }}';
          window.location.href = redirectToList;
                }
          let errors = response['errors'];
          if (errors['name']) {
            $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
          } else {
            $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
          }
          if (errors['email']) {
            $('#email').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['email']);
          } else {
            $('#email').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
          }
          if (errors['phone']) {
            $('#phone').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['phone']);
          } else {
            $('#phone').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
          }
          if (errors['password']) {
            $('#password').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['password']);
          } else {
            $('#password').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
          }
        }
      },
      error: function(jqXHR, exception) {
        console.log('Something went wrong');
      }
    });
  });
</script>
@endsection
