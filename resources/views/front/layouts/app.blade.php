<!DOCTYPE html>
<html class="no-js" lang="en_AU" />
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Laravel Online Shop</title>
	<meta name="description" content="" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1, user-scalable=no" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<meta name="HandheldFriendly" content="True" />
	<meta name="pinterest" content="nopin" />

	<meta property="og:locale" content="en_AU" />
	<meta property="og:type" content="website" />
	<meta property="fb:admins" content="" />
	<meta property="fb:app_id" content="" />
	<meta property="og:site_name" content="" />
	<meta property="og:title" content="" />
	<meta property="og:description" content="" />
	<meta property="og:url" content="" />
	<meta property="og:image" content="" />
	<meta property="og:image:type" content="image/jpeg" />
	<meta property="og:image:width" content="" />
	<meta property="og:image:height" content="" />
	<meta property="og:image:alt" content="" />

	<meta name="twitter:title" content="" />
	<meta name="twitter:site" content="" />
	<meta name="twitter:description" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:image:alt" content="" />
	<meta name="twitter:card" content="summary_large_image" />
	<script src="https://js.stripe.com/v3/"></script>
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/ratings.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/slick-theme.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/ion.rangeSlider.min.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/video-js.css') }}" />
	<link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/style.css?v=' . rand(111,999)) }}" />

    <!-- <link rel="stylesheet" type="text/css" href="{{ asset('front-assets/css/style.css?v=<?php echo rand(111,999); ?>') }}" /> -->

	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;500&family=Raleway:ital,wght@0,400;0,600;0,800;1,200&family=Roboto+Condensed:wght@400;700&family=Roboto:wght@300;400;700;900&display=swap" rel="stylesheet">

	<!-- Fav Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="#" />
</head>
<body data-instant-intensity="mousedown">

<div class="bg-light top-header">        
	<div class="container">
		<div class="row align-items-center py-3 d-none d-lg-flex justify-content-between">
			<div class="col-lg-4 logo">
				<a href="{{route('home')}}" class="text-decoration-none">
					<span class="h1 text-uppercase text-primary bg-dark px-2">Online</span>
					<span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">SHOP</span>
				</a>
			</div>
			<div class="col-lg-6 col-6 text-left  d-flex justify-content-end align-items-center">
				<a href="{{ route('account.authenticate') }}" class="nav-link text-dark">My Account</a>
				<form action="{{ route('shop') }}" method="get">					
					<div class="input-group">
						<input type="text" id="searchP" name="searchP" value="{{Request::get('searchP') }}" placeholder="Search For Products" class="form-control" aria-label="Amount (to the nearest dollar)">
						<span class="input-group-text">
							<button type="submit" class="input-group-text">
							<i class="fa fa-search"></i>
							</button>
					  	</span>
					</div>
				</form>
			</div>		
		</div>
	</div>
</div>

<header class="bg-dark">
	<div class="container">
		<nav class="navbar navbar-expand-xl" id="navbar">
			<a href="{{route('home')}}" class="text-decoration-none mobile-logo">
				<span class="h2 text-uppercase text-primary bg-dark">Online</span>
				<span class="h2 text-uppercase text-white px-2">SHOP</span>
			</a>
			<button class="navbar-toggler menu-btn" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      			<!-- <span class="navbar-toggler-icon icon-menu"></span> -->
				  <i class="navbar-toggler-icon fas fa-bars"></i>
    		</button>
    		<div class="collapse navbar-collapse" id="navbarSupportedContent">
      			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
        			<!-- <li class="nav-item">
          				<a class="nav-link active" aria-current="page" href="index.php" title="Products">Home</a>
        			</li> -->
					@if(get_categories()->isNotEmpty())
					@foreach (get_categories() as $cat)
					<li class="nav-item dropdown">
						<button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
							{{ $cat->name }}
						</button>
							@if($cat->sub_category->isNotEmpty())
							
							<ul class="dropdown-menu dropdown-menu-dark">
							@foreach ($cat->sub_category as $sub)
							<li><a class="dropdown-item nav-link" href="{{ route('shop',[$cat->slug ,$sub->slug])}}">{{ $sub->name }}</a></li>
							@endforeach
						</ul>
						@endif
					</li>
					@endforeach
					@endif
      			</ul>      			
      		</div>   
			<div class="right-nav py-0">
				<a href="{{route('front.cart')}}" class="ml-3 d-flex pt-2">
					<i class="fas fa-shopping-cart text-primary"></i>					
				</a>
			</div> 		
      	</nav>
  	</div>
</header>


<main>



@yield('content')

</main>
@yield('customJs')


<footer class="bg-dark mt-5">
	<div class="container pb-5 pt-3">
		<div class="row">
			<div class="col-md-4">
				<div class="footer-card">
					<h3>Get In Touch</h3>
					<p>No dolore ipsum accusam no lorem. <br>
					123 Street, New York, USA <br>
					exampl@example.com <br>
					000 000 0000</p>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>Important Links</h3>
					<ul>
						@if (!empty($pages))
						@foreach ($pages as $page)
						<li><a href="{{ route('front.page',$page->slug) }}" title="About">{{ $page->name }}</a></li>
						@endforeach
						@endif
					</ul>
				</div>
			</div>

			<div class="col-md-4">
				<div class="footer-card">
					<h3>My Account</h3>
					<ul>
						<li><a href="#" title="Sell">Login</a></li>
						<li><a href="#" title="Advertise">Register</a></li>
						<li><a href="#" title="Contact Us">My Orders</a></li>						
					</ul>
				</div>
			</div>			
		</div>
	</div>
	<div class="copyright-area">
		<div class="container">
			<div class="row">
				<div class="col-12 mt-3">
					<div class="copy-right text-center">
						<p>© Copyright 2022 Amazing Shop. All Rights Reserved</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button> -->

<!--Wishlist Modal -->
<div class="modal fade" id="wishlistModal" tabindex="-1" aria-labelledby="wishlistModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="wishlistModalLabel">Success</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script src="{{ asset('front-assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/bootstrap.bundle.5.1.3.min.js') }}"></script>
<script src="{{ asset('front-assets/js/instantpages.5.1.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/lazyload.17.6.0.min.js') }}"></script>
<script src="{{ asset('front-assets/js/slick.min.js') }}"></script>
<script src="{{ asset('front-assets/js/ion.rangeSlider.min.js') }}"></script>
<script src="{{ asset('front-assets/js/custom.js') }}"></script>
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

   			$.ajaxSetup({
        		headers: {
            		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        		}
    		});
				function  addToWishlist(id) {
    $.ajax({
        url: "{{ route('front.addToWishlist')}}",
        type:'post',
        data:{id:id},
        dataType:'json',
        success : function(response) {
             if(response.status == true){
							$('#wishlistModal .modal-body').html(response.message);
							$('#wishlistModal').modal('show');
         } else {
					window.location.href = "{{ route('account.login') }}";
         }
    }
    })
 }
</script>


</body>
</html>