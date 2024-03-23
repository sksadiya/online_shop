
@extends('admin.includes.default2')

@section('content')
				<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Edit Brand</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('brands.index') }}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<form action="{{ route('brands.update', $brand->id) }}" name="brandForm" id="brandForm" method="post">
					<div class="container-fluid">
						<div class="card">
							<div class="card-body">								
								<div class="row">
									<div class="col-md-6">
										<div class="mb-3">
											<label for="name">Name</label>
											<input type="text" value="{{ $brand->name }}" name="name" id="name" class="form-control" placeholder="Name">
											<p></p>	
										</div>
									</div>
									<div class="col-md-6">
										<div class="mb-3">
											<label for="email">Slug</label>
											<input type="text"  value="{{ $brand->slug }}" name="slug" id="slug" class="form-control" placeholder="Slug">	
											<p></p>
										</div>
									</div>									
									<div class="col-md-6">
										<div class="mb-3">
											<label for="status">Status</label>
											<select name="status" id="status" class="form-control">
												<option {{($brand->status) == 1 ? 'selected' : '' }} value="1">Active</option>
												<option {{($brand->status) == 0 ? 'selected' : '' }} value="0">Block</option>
                                    		</select>
											<p></p>
										</div>
									</div>									
								</div>
							</div>							
						</div>
						<div class="pb-5 pt-3">
							<button type="submit" class="btn btn-primary">Create</button>
							<a href="{{ route('brands.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</div>
					</form>
					<!-- /.card -->
				</section>
				<!-- /.content -->
			@endsection
            @section('customScript')
			<script>
				const getSlugRoute = '{{ route("getSlug") }}';
        // $('#name').on('input', function (event) {
        // use above line instead of next line if you want to reflect slug value while typing
        $('#name').change(function(event) {
            let element = $(this);
            $('button[type=submit]').prop('disabled', true);

            $.ajax({
                url: getSlugRoute,
                type: 'get',
                data: { title: element.val() },
                dataType: 'json',
                success: function(response) {
                    $('button[type=submit]').prop('disabled', false);

                    if(response['status'] == true) {
                        $('#slug').val(response['slug']);
                    }
                }
            });
        });

		$('#brandForm').submit(function(event) {
    event.preventDefault();
    let element = $(this);
    $('button[type=submit]').prop('disabled',true);
    $.ajax({
         url: element.attr('action'),
        type:'put',
        data:element.serializeArray(),
        dataType:'json',
        success:function(response) {
            $('button[type=submit]').prop('disabled', false);

            if(response['status'] == true) {
                const redirectToList = '{{ route("brands.index") }}';
                window.location.href = redirectToList ;
                $('#slug').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

            } else {
            let errors =response['errors'];
            if(errors['name']) {
                $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
            } else {
                $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

            }
            if(errors['slug']) {
                $('#slug').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
            } else {
                $('#slug').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

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