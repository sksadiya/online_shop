@extends('admin.includes.default2')

@section('content')
                <section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Coupon</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('coupons.index') }}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<form action="{{ route('coupons.store') }}" name="couponForm" id="couponForm" method="post">
					<div class="container-fluid">
						<div class="card">
							<div class="card-body">								
								<div class="row">
									<div class="col-md-6">
										<div class="mb-3">
											<label for="code">Code</label>
											<input type="text" name="code" id="code" class="form-control" placeholder="coupon code">
											<p></p>	
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Name</label>
											<input type="text" name="name" id="name" class="form-control" placeholder="Name">	
											<p></p>
										</div>
									</div>									
									
                                    <div class="col-md-6">
										<div class="mb-3">
											<label for="max_uses">Max_uses</label>
											<input type="number" name="max_uses" id="max_uses" class="form-control" placeholder="Max Uses">	
											<p></p>
										</div>
									</div>									
                                    <div class="col-md-6">
										<div class="mb-3">
											<label for="max_uses_user">Max_uses User</label>
											<input type="number" name="max_uses_user" id="max_uses_user" class="form-control" placeholder="Max Uses User">	
											<p></p>
										</div>
									</div>									
									<div class="col-md-6">
										<div class="mb-3">
											<label for="type">Type</label>
											<select name="type" id="type" class="form-control">
												<option value="percent">Percent</option>
												<option value="fixed">Fixed</option>
                                    		</select>
											<p></p>
										</div>
									</div>	
                                    <div class="col-md-6">
										<div class="mb-3">
											<label for="discount_amount">Discount Amount</label>
											<input type="text" name="discount_amount" id="discount_amount" class="form-control" placeholder="Discount Amount">	
											<p></p>
										</div>
									</div>									
                                    <div class="col-md-6">
										<div class="mb-3">
											<label for="min_amount">minimum Amount</label>
											<input type="text" name="min_amount" id="min_amount" class="form-control" placeholder="minimum Amount">	
											<p></p>
										</div>
									</div>									
									<div class="col-md-6">
										<div class="mb-3">
											<label for="status">Status</label>
											<select name="status" id="status" class="form-control">
												<option value="1">Active</option>
												<option value="0">Block</option>
                                    		</select>
											<p></p>
										</div>
									</div>	
                                    <div class="col-md-6">
										<div class="mb-3">
											<label for="starts_at">Starts At </label>
											<input type="text" name="starts_at" id="starts_at" class="form-control demodate">	
											<p></p>
										</div>
									</div>									
                                    <div class="col-md-6">
										<div class="mb-3">
											<label for="expires_at">Expires At </label>
											<input type="text" name="expires_at" id="expires_at" class="form-control demodate">	
											<p></p>
										</div>
									</div>
                                    <div class="col-md-6">
										<div class="mb-3">
											<label for="description">Description</label>
                                            <textarea name="description" id="description" class="form-control" cols="30" rows="5"></textarea>
											<p></p>
										</div>
									</div>										
								</div>
							</div>							
						</div>
						<div class="pb-5 pt-3">
							<button type="submit" class="btn btn-primary">Create</button>
							<a href="{{ route('coupons.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</div>
					</form>
					<!-- /.card -->
				</section>
				<!-- /.content -->
@endsection
@section('customJs')
<script>
   $('#couponForm').submit(function(event) {
    event.preventDefault();
    let element = $(this);
    $('button[type=submit]').prop('disabled',true);
    $.ajax({
         url: element.attr('action'),
        type:'post',
        data:element.serializeArray(),
        dataType:'json',
        success:function(response) {
            $('button[type=submit]').prop('disabled', false);

            if(response['status'] == true) {
                const redirectToList = '{{ route("coupons.index") }}';
                window.location.href = redirectToList ;
                $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

            } else {
            let errors =response['errors'];
            if(errors['name']) {
                $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
            } else {
                $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

            }
        }
        },
        error:function(jqXHR,exception) {
            console.log('something went wrong');
        }
    })
})  
</script>
@endsection
