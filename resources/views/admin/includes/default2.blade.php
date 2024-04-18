@include('admin.includes.header')
@include('admin.includes.nav')
@include('admin.includes.sidebar')

<div class="content-wrapper">
@yield('content')
</div>
			<!-- /.content-wrapper -->
			<footer class="main-footer">
				
				<strong>Copyright &copy; 2024 AmazingShop All rights reserved.
			</footer>
			
		</div>
@yield('customScript')
@include('admin.includes.footer')