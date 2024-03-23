
		<!-- ./wrapper -->
		<!-- jQuery -->
		<script src="{{ asset('admin-assets/plugins/jquery/jquery.min.js') }}"></script>
		<!-- Bootstrap 4 -->
		<script src="{{ asset('admin-assets/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
		<!-- AdminLTE App -->
		<script src="{{ asset('admin-assets/js/adminlte.min.js') }}"></script>
        <script src="{{ asset('admin-assets/plugins/dropzone/dropzone.js') }}"></script>


        <script src="{{ asset('admin-assets/plugins/summernote/summernote.min.js') }}"></script>

		<!-- AdminLTE for demo purposes -->
		<!-- <script src="{{ asset('js/demo.js') }}"></script> -->
		
		<script type="text/javascript">
   			$.ajaxSetup({
        		headers: {
            		'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        		}
    		});
		
   $(document).ready(function() {
	$('.summernote').summernote({
                    height: '300px'
                });
   });
        </script>
	</body>
</html>