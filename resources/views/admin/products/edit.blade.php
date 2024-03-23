@extends('admin.includes.default2')

@section('content')
<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Edit Product</h1>
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
                    <form action="{{ route('product.update', $products->id) }}" name="productForm" id="productForm" method="post">
					<div class="container-fluid">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card mb-3">
                                    <div class="card-body">								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="title">Title</label>
                                                    <input type="text" name="title" value="{{ $products->title }}" id="title" class="form-control" placeholder="Title">
                                                    <p class="error"></p>	
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="slug">Slug</label>
                                                    <input type="text" readonly name="slug" value="{{ $products->slug }}" id="slug" class="form-control" placeholder="Title">	
                                                    <p class="error"></p>	

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" id="description" cols="30" rows="10" class="summernote" placeholder="Description">{{ $products->description }}</textarea>
                                                    <p class="error"></p>	

                                                </div>
                                            </div>                                            
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="short_description">Short Description</label>
                                                    <textarea name="short_description" id="short_description" cols="30" rows="10" class="summernote" placeholder="Description">{{ $products->short_description }}</textarea>
                                                    <p class="error"></p>	
                                                </div>
                                            </div>                                            
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="shipping">Shipping and returns</label>
                                                    <textarea name="shipping" id="shipping" cols="30" rows="10" class="summernote" placeholder="Description">{{ $products->shipping }}</textarea>
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
                                    @if($product_images->isNotEmpty())
                                        @foreach ($product_images as $images)
                                        <div class="col-md-3" id="image-row-{{$images->id}}">
                                            <div class="card">
                                                <input type="hidden" name="image_array[]" value="{{ $images->id }}">
                                                <img src="{{ asset('uploads/products/small/'.$images->image) }}" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                    <a href="javascript:void(0)" onclick="deleteImage({{ $images->id }})"  class="btn btn-danger">Delete</a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Pricing</h2>								
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="price">Price</label>
                                                    <input type="text" name="price" id="price" value="{{ $products->price }}" class="form-control" placeholder="Price">
                                                    <p class="error"></p>	

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <label for="compare_price">Compare at Price</label>
                                                    <input type="text" name="compare_price" value="{{ $products->compare_price }}" id="compare_price" class="form-control" placeholder="Compare Price">
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
                                                    <input type="text" value="{{ $products->sku }}" name="sku" id="sku" class="form-control" placeholder="sku">
                                                    <p class="error"></p>	

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="barcode">Barcode</label>
                                                    <input type="text" name="barcode" id="barcode" value="{{ $products->barcode }}" class="form-control" placeholder="Barcode">	
                                                    <p class="error"></p>	

                                                </div>
                                            </div>   
                                            <div class="col-md-12">
                                                <div class="mb-3">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="hidden" name="track_qty" value="No">
                                                        <input class="custom-control-input" type="checkbox" value="Yes" {{ $products->track_qty == 'Yes' ? 'checked' : '' }}  id="track_qty" name="track_qty" value="Yes" >
                                                        <label for="track_qty" class="custom-control-label">Track Quantity</label>
                                                    <p class="error"></p>	

                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <input type="number" min="0" name="qty" id="qty" value="{{ $products->qty }}" class="form-control" placeholder="Qty">
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
                                                <option {{($products->status) == 1 ? 'selected' : '' }} value="1">Active</option>
                                                <option {{($products->status) == 0 ? 'selected' : '' }} value="0">Block</option>
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
                                               <option {{ ($products->category_id) == $cat->id ? 'selected' : '' }} value="{{ $cat->id }}">{{ $cat->name }}</option>
                                               @endforeach
                                               @endif
                                            </select>
                                            <p class="error"></p>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category">Sub category</label>
                                            <select name="sub_category" id="sub_category" class="form-control">
                                                <option value="">Select a sub Category</option>
                                                @if ($subCat->isNotEmpty())
                                                    @foreach ($subCat as $sub)
                                               <option {{ $products->sub_category_id == $sub->id ? 'selected' : ' '}} value="{{ $sub->id }}">{{ $sub->name }}</option>
                                                    @endforeach
                                                @endif
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
                                              @if ($brands->isNotEmpty())
                                              @foreach ($brands as $brand)
                                               <option {{ ($products->brand_id) == $brand->id ? 'selected' : '' }} value="{{ $brand->id }}">{{ $brand->name }}</option>
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
        <option {{($products->is_featured) == 'No' ? 'selected' : ''}} value="No">No</option>
        <option {{($products->is_featured) == 'Yes' ? 'selected' : ''}} value="Yes">Yes</option>                                                
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
                                                @if(!empty($relatedProducts))
                                                @foreach ($relatedProducts as $product)    
                                                <option selected value="{{ $product->id }}">{{ $product->title }}</option>     
                                                @endforeach
                                                @endif
                                            </select>
                                            <p class="error"></p>
                                        </div>
                                    </div>
                                </div>                                   
                            </div>
                        </div>
						
						<div class="pb-5 pt-3">
							<button type="submit" class="btn btn-primary">Update</button>
							<a href="{{ route('product.index') }}" class="btn btn-outline-dark ml-3">Cancel</a>
						</div>
					</div>
                    </form>
					<!-- /.card -->
				</section>
@endsection

@section('customScript')
@include('admin.includes.part')
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
</script>
@endsection