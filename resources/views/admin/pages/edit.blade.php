
@extends('admin.includes.default2')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Edit Page</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('page.index') }}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<form action="{{ route('page.update',$page->id) }}" method="post" id="pageUpdateForm" name="pageUpdateForm">
						<div class="container-fluid">
							<div class="card">
								<div class="card-body">								
									<div class="row">
										<div class="col-md-4">
											<div class="mb-3">
												<label for="name">Name</label>
												<input type="text" name="name" id="name" value="{{ $page->name }}" class="form-control" placeholder="Name">	
												<p></p>
											</div>
										</div>
										<div class="col-md-4">
											<div class="mb-3">
												<label for="email">Slug</label>
												<input type="text" readonly name="slug" id="slug" value="{{ $page->slug }}" class="form-control" placeholder="Slug">	
												<p></p>
											</div>
										</div>	
										<div class="col-md-4">
											<div class="mb-3">
												<label for="status">Status</label>
												<select name="status" id="status" class="form-control" placeholder="Status">
													<option {{ ($page->status == 1) ? 'selected' : '' }} value="1">Active</option>
													<option {{ ($page->status == 0) ? 'selected' : '' }} value="0">Inactive</option>
												</select>
												<p></p>
											</div>
										</div>	
											<div class="col-md-12">
													<div class="mb-3">
															<label for="content">Content</label>
															<textarea name="content" id="content" class="summernote" cols="30" rows="10">{{ $page->content }}</textarea>
													</div>								
											</div>                                    
									</div>
								</div>							
							</div>
							<div class="pb-5 pt-3">
								<button class="btn btn-primary">Update</button>
								<a href="{{ route('page.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
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

				$("#pageUpdateForm").submit( function(event) {
					event.preventDefault();
					let csrfToken = $('meta[name="csrf-token"]').attr('content');
					$.ajax({
							url : "{{ route("page.update" ,$page->id) }}",
							type : 'POST',
							data : $(this).serializeArray(),
							dataType : 'json',
							headers: {
            'X-CSRF-TOKEN': csrfToken // Include CSRF token in the headers
						},
							success : function(response) {
								if(response['status'] == true) {
                const redirectToList = '{{ route("page.index") }}';
                window.location.href = redirectToList ;
                $('#slug').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#status').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

            } else {
              if(response['notFound'] == true) {
                const redirectToList = '{{ route("page.index") }}';
                window.location.href = redirectToList ;
               }
            let errors =response['errors'];
            if(errors['name']) {
                $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
            } else {
                $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['status']) {
                $('#status').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['status']);
            } else {
                $('#status').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
            if(errors['slug']) {
                $('#slug').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
            } else {
                $('#slug').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
            }
           
            
        }
							},
							error: function(jqXHR, textStatus, errorThrown) {
            // Handle error response here
            alert('Error: ' + errorThrown);
            console.log(jqXHR.responseText);
        }
					});
				});
		</script>
@endsection

			