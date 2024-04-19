@extends('front.layouts.app')
@section('content')
    <section class="section-5 pt-3 pb-3 mb-3 bg-white">
        <div class="container">
            <div class="light-font">
                <ol class="breadcrumb primary-color mb-0">
                    <li class="breadcrumb-item"><a class="white-text" href="{{ route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Shop</li>
                </ol>
            </div>
        </div>
    </section>

    <section class="section-6 pt-5">
        <div class="container">
            <div class="row">            
                <div class="col-md-3 sidebar">
                    <div class="sub-title">
                        <h2>Categories</h3>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="accordion accordion-flush" id="accordionExample">
                                @if ($categories->isNotEmpty())
                                    @foreach ($categories as $key => $cat)
                                    <div class="accordion-item">
                                    @if ($cat->sub_category->isNotEmpty())
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-{{ $key }}" aria-expanded="false" aria-controls="collapseOne-{{ $key }}">
                                            {{ $cat->name }}
                                        </button>
                                    </h2>
                                    @else
                                    <a href="{{ route('shop',$cat->slug) }}" class="nav-item nav-link {{ ($catSelected == $cat->id) ? 'text-primary' : '' }}">{{$cat->name}}</a>                                            
                                    @endif

                                    @if ($cat->sub_category->isNotEmpty())
                                    <div id="collapseOne-{{ $key }}" class="accordion-collapse collapse {{($catSelected == $cat->id) ? 'show' : ''}}" aria-labelledby="headingOne" data-bs-parent="#accordionExample" style="">
                                        <div class="accordion-body">
                                            <div class="navbar-nav">
                                               
                                                 @foreach ($cat->sub_category as $sub)
                                                <a href="{{ route('shop',[$cat->slug ,$sub->slug]) }}" class="nav-item nav-link {{ ($subSelected == $sub->id) ? 'text-primary' : '' }}">{{ $sub->name}}</a>                                            
                                                 @endforeach   
                                              
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>  
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Brand</h3>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                            @if($brands->isNotEmpty())
                            @foreach ($brands as $brand)
                            <div class="form-check mb-2">
                                <input {{ (in_array($brand->id ,$brandsArray)) ? 'checked' : '' }} class="form-check-input brand-label" type="checkbox" name="brand[]" value="{{ $brand->id }}" id="brand-{{ $brand->id }}">
                                <label class="form-check-label" for="brand-{{ $brand->id }}">
                                    {{ $brand->name }}
                                </label>
                            </div>
                            @endforeach
                            @endif
            
                        </div>
                    </div>

                    <div class="sub-title mt-5">
                        <h2>Price</h3>
                    </div>
                    
                    <div class="card">
                        <div class="card-body">
                        <input type="text" class="js-range-slider" name="my_range" value="" />              
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="row pb-3">
                        
                        <div class="col-12 pb-1">
                            <div class="d-flex align-items-center justify-content-end mb-4">
                                <div class="ml-2">
                                    <select name="sort" id="sort" class="form-control">
                                        <option {{($sort == 'latest' ) ? 'selected' : ''}} value="latest">Latest</option>
                                        <option {{($sort == 'price_desc' ) ? 'selected' : ''}} value="price_desc">Price High</option>
                                        <option {{($sort == 'price_asc' ) ? 'selected' : ''}} value="price_asc">Price Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        @if($products->isNotEmpty())
                   
                    @foreach($products as $pro)
                    @php
        $productImage = $pro->product_images->first();
										@endphp
                        <div class="col-md-4">
                            <div class="card product-card">
                                <div class="product-image position-relative">
                                @if(!empty($productImage->image))
                                    <a href="{{ route('front.product', $pro->slug) }}" class="product-img"><img class="card-img-top" src="{{ asset('uploads/products/small/'.$productImage->image) }}" alt=""></a>
                                    @else
                                    <a href="{{ route('front.product', $pro->slug) }}" class="product-img"><img class="card-img-top" src="{{ asset('admin-assets/img/default-150x150.png') }}" alt=""></a>
                                    @endif
                                    <a class="whishlist" href="javascript:void(0)" onclick="addToWishlist({{ $pro->id }});"><i class="far fa-heart"></i></a>                            

                                    <div class="product-action">
                                    @if ($pro->track_qty == 'Yes')
                                @if($pro->qty > 0)
                                <a class="btn btn-dark" href="javascript:void(0)" onclick="addToCart({{ $pro->id }});">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </a>   
                                @else
                                <a class="btn btn-dark" href="javascript:void(0)" >
                                     Out Of Stock
                                </a>  
                                @endif
                                @else
                                <a class="btn btn-dark" href="javascript:void(0)" onclick="addToCart({{ $pro->id }});">
                                    <i class="fa fa-shopping-cart"></i> Add To Cart
                                </a>
                                @endif                            
                                    </div>
                                </div>                        
                                <div class="card-body text-center mt-3">
                                    <a class="h6 link" href="product.php">{{ $pro->title }}</a>
                                    <div class="price mt-2">
                                        <span class="h5"><strong>${{ $pro->price }}</strong></span>
                                        @if($pro->compare_price > 0)
                                        <span class="h6 text-underline"><del>${{ $pro->compare_price }}</del></span>
                                        @endif
                                    </div>
                                </div>                        
                            </div>                                               
                        </div>  
    @endforeach
    @endif
                        <div class="col-md-12 pt-5">
                       {{ $products->withQueryString()->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    
    @endsection
    @section('customJs')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ asset('front-assets/js/ion.rangeSlider.min.js') }}"></script>
    <script>
        let rangeSlider = $(".js-range-slider").ionRangeSlider({
            type : "double",
            min : 0,
            max : 1000,
            from :{{ ($priceMin) }},
            step:10,
            to :{{ ($priceMax) }},
            skin : "round",
            max_postfix : "+",
            prefix : "$",
            onFinish : function() {
                apply_filters();
            }
        });

        let slider = $(".js-range-slider").data("ionRangeSlider");

        $(".brand-label").change(function() {
            apply_filters();
        });

        $("#sort").change(function() {
            apply_filters();
        })
        function apply_filters() {
            let brands = [];
            $(".brand-label").each(function() {
                if($(this).is(":checked") == true) {
                    brands.push($(this).val());
                }
            });
            
            let url = '{{ url()->current() }}?';

            url +='&price_min='+slider.result.from+'&price_max='+slider.result.to;

            if(brands.length > 0) {
               url += '&brand='+brands.toString()
            }
            var search = $("#searchP").val();
            if(search != '') {
                url += '&search='+search;
            }
            //sorting
            url += '&sort='+$("#sort").val();
            window.location.href = url;
        }
    </script>
    <script type="text/javascript">
function  addToCart(id) {
    $.ajax({
        url: "{{ route('front.addToCart')}}",
        type:'post',
        data:{id:id},
        dataType:'json',
        success : function(response) {
            if(response.status == true){
                window.location.href = "{{ route('front.cart') }}";
        } else {
            alert(response.message);
        }
    }
    })
 }
</script>
    @endsection