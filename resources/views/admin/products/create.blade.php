@extends('admin.includes.default2')

@section('content')
<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Create Product</h1>
							</div>
							<div class="col-sm-6 text-right">
								<a href="{{ route('product.index') }}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
                    <form action="{{ route('product.store') }}" name="productForm" id="productForm" method="post">
					<div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="title">Title</label>
                                                    <input type="text" name="title" id="title" class="form-control" placeholder="Title">
                                                    <p class="error"></p>	
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="slug">Slug</label>
                                                    <input type="text" readonly name="slug" id="slug" class="form-control" placeholder="Title">	
                                                    <p class="error"></p>	

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                                                    <p class="error"></p>	

                                                </div>
                                            </div>                                            
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="short_description">Short Description</label>
                                                    <textarea name="short_description" id="short_description" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                                                    <p class="error"></p>	

                                                </div>
                                            </div>                                            
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="shipping">Shipping and Returns</label>
                                                    <textarea name="shipping" id="shipping" cols="30" rows="10" class="summernote" placeholder="Description"></textarea>
                                                    <p class="error"></p>	

                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Media</h2>								
                                        <div id="image" class="dropzone dz-clickable">
                                            <div class="dz-message needsclick">    
                                                <br>Drop files here or click to upload.<br><br>                                            
                                            </div>
                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="row" id="product-gallery">

                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Pricing</h2>								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="price">Price</label>
                                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price">
                                                    <p class="error"></p>	

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="compare_price">Compare at Price</label>
                                                    <input type="text" name="compare_price" id="compare_price" class="form-control" placeholder="Compare Price">
                                                    <p class="text-muted mt-3">
                                                        To show a reduced price, move the product’s original price into Compare at price. Enter a lower value into Price.
                                                    </p>	
                                                </div>
                                            </div>                                            
                                        </div>
                                    </div>	                                                                      
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Inventory</h2>								
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="sku">SKU (Stock Keeping Unit)</label>
                                                    <input type="text" name="sku" id="sku" class="form-control" placeholder="sku">
                                                    <p class="error"></p>	

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="barcode">Barcode</label>
                                                    <input type="text" name="barcode" id="barcode" class="form-control" placeholder="Barcode">	
                                                    <p class="error"></p>	

                                                </div>
                                            </div>   
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="hidden" name="track_qty" value="No">
                                                        <input class="custom-control-input" type="checkbox" id="track_qty" name="track_qty" value="Yes" checked>
                                                        <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                                    <p class="error"></p>	

                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="number" min="0" name="qty" id="qty" class="form-control" placeholder="Qty">
                                                    <p class="error"></p>	
                                                </div>
                                            </div>                                         
                                        </div>
                                    </div>	                                                                      
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Product status</h2>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control">
                                                <option value="1">Active</option>
                                                <option value="0">Block</option>
                                            </select>
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                </div> 
                                <div class="card">
                                    <div class="card-body">	
                                        <h2 class="h4  mb-3">Product category</h2>
                                        <div class="mb-3">
                                            <label for="category">Category</label>
                                            <select name="category" id="category" class="form-control">
                                            <option value="">Select a category</option>
                                            @if($categories->isNotEmpty())
                                               @foreach ($categories as $cat)
                                               <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                               @endforeach
                                               @endif
                                            </select>
                                            <p class="error"></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category">Sub category</label>
                                            <select name="sub_category" id="sub_category" class="form-control">
                                               <option value="">select a sub-category</option>
                                            </select>
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                </div> 
                                <div class="card mb-3">
                                    <div class="card-body">	
                                        <h2 class="h4 mb-3">Product brand</h2>
                                        <div class="mb-3">
                                            <select name="brand" id="brand" class="form-control">
                                              <option value="">Select Brand</option>
                                              @if ($brands->isNotEmpty() )
                                              @foreach ($brands as $brand)
                                               <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                               @endforeach
                                              @endif
                                            </select>
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                </div> 
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Featured product</h2>
                                        <div class="mb-3">
                                            <select name="is_featured" id="is_featured" class="form-control">
                                                <option value="No">No</option>
                                                <option value="Yes">Yes</option>
                                            </select>
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Related products</h2>
                                        <div class="mb-3">
                                            <select multiple class="related-product w-100" name="related_products[]" id="related_products">

                                            </select>
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                </div>
                                                                
                            </div>
                        </div>
						
						<div class="pb-5 pt-3">
							<button type="submit" class="btn btn-primary">Create</button>
							<a href="{{ route('product.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</div>
                    </form>
					<!-- /.card -->
				</section>
@endsection

@section('customScript')
<script src="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.js') }}"></script>
<script src="{{ asset('admin-assets/plugins/select2/js/select2.min.js') }}"></script>
<script>

$('.related-product').select2({
    ajax: {
        url: '{{ route('products.getProducts') }}',
        dataType: 'json',
        tags: true,
        multiple: true,
        minimumInputLength: 3,
        processResults: function (data) {
            return {
                results: data.tags
            };
        }
    }
}); 
    const getSlugRoute = '{{ route("getSlug") }}';
        // $('#name').on('input', function (event) {
        // use above line instead of next line if you want to reflect slug value while typing
        $('#title').change(function(event) {
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

        $('#productForm').submit(function (e) {
            e.preventDefault();
            let formData = $(this).serializeArray();
            $('button[type=submit]').prop('disabled',true);
            $.ajax({
                type: 'POST',
                url: '{{ route("product.store") }}',
                data: formData,
                dataType:'json',
                success: function (response) {
                   // console.log(response);
                   $('button[type=submit]').prop('disabled', false);

                   if(response['status'] == true) {
                    $(".error").removeClass('invalid-feedback').html("");
            $("input[type='text'] , select , input[type='number']").removeClass('is-invalid');
                    const redirectToList = '{{ route("product.index") }}';
                window.location.href = redirectToList ;
                   } else {
                    let errors =response['errors'];
            
            $(".error").removeClass('invalid-feedback').html("");
            $("input[type='text'] , select , input[type='number']").removeClass('is-invalid');
            $.each(errors, function(key, value) {
    $(`#${key}`).addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(value);
});
                   }
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });

        $('#category').change(function () {
            let category_id = $(this).val();
            $.ajax({
                type: 'get',
                url: '{{ route('product-sub.index') }}',
                data: {category_id:category_id},
                dataType:'json',
                success: function (response) {
                   // console.log(response);
                   $('#sub_category').find('option').not(':first').remove();
                   $.each(response['subcategories'] , function(key ,item) {
                        $('#sub_category').append(`<option value='${item.id}'>${item.name}</option>`)
                   });
                },
                error: function (error) {
                    console.error(error);
                }
            });
        });

        Dropzone.autoDiscover = false;    
const dropzone = $("#image").dropzone({ 
    url:"{{ route('temp-image.create') }}",
    maxFiles: 10,
    paramName: 'image',
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg,image/png,image/gif,image/webp",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }, success: function(file, response){
       // $("#image_id").val(response.image_id);
        //console.log(response)

    let html = `<div class="col-md-3" id="image-row-${response.image_id}">
    <div class="card">
    <input type="hidden" name="image_array[]" value="${response.image_id}">
  <img src="${response.imagePath}" class="card-img-top" alt="...">
  <div class="card-body">
    <a href="javascript:void(0)" onclick="deleteImage(${response.image_id})"  class="btn btn-danger">Delete</a>
  </div>
  </div>
</div>`;

$("#product-gallery").append(html);
    },
    complete: function(file) {
        this.removeFile(file);
    }
});

function deleteImage(id)  {
    $("#image-row-"+id).remove();
}
</script>
@endsection