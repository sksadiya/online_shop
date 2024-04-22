@extends('admin.includes.default2')

@section('content')
<section class="content-header">					
					<div class="container-fluid my-2">
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Products</h1>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
                    @include('admin.message')
						<div class="card">
						<form action="" method="get">
							<div class="card-header">
							<div class="card-title">
                                    <button type="button" onclick="window.location.href='{{route('products.ratings')}}'"class="btn btn-default btn-sm">Reset</button>
                                </div>
								<div class="card-tools">
									<div class="input-group input-group" style="width: 250px;">
										<input type="text" value="{{Request::get('search')}}" name="search" class="form-control float-right" placeholder="Search">
					
										<div class="input-group-append">
										  <button type="submit" class="btn btn-default">
											<i class="fas fa-search"></i>
										  </button>
										</div>
									  </div>
								</div>
							</div>
</form>
							<div class="card-body table-responsive p-0">								
								<table class="table table-hover text-nowrap">
									<thead>
										<tr>
											<th width="60">ID</th>
											<th>Product</th>
											<th>Ratings</th>
											<th>Comment</th>
											<th>Username</th>
											<th width="100">Status</th>
										</tr>
									</thead>
									<tbody>
										@if($ratings->isNotEmpty())
										@foreach ($ratings as $rating)
										<tr>
											<td>{{ $rating->id }}</td>
											<td>{{ $rating->productTitle }}</td>
											<td>{{ number_format($rating->rating,2) }}</td>
											<td>{{ $rating->comment }}</td>
											<td>{{ $rating->username }}</td>
											<td>
											@if ($rating->status == 1)
                      <a href="javascript:void(0)" onclick="changeStatus(0 ,'{{ $rating->id }}')">
                        <svg class="text-success-500 h-6 w-6 text-success" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
													<path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
												</svg>
                      </a>
                      @else
                      <a href="javascript:void(0)" onclick="changeStatus(1,'{{ $rating->id }}')">
                        <svg class="text-danger h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
													<path stroke-linecap="round" stroke-linejoin="round" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
												</svg>
                      </a>
                      @endif
											</td>
										</tr>
										@endforeach
										@else
										<tr>
                        <td colspan="5">Records Not Found</td>
                    </tr>
										@endif
									</tbody>
								</table>										
							</div>
							<div class="card-footer clearfix">
								{{ $ratings->links() }}
							</div>
						</div>
					</div>
					<!-- /.card -->
				</section>
@endsection
@section('customScript')
<script>
function changeStatus(status ,id) {
  if(confirm("Are you sure to change status?")) {
    $.ajax({
      url: "{{ route('admin.rating.changeStatus') }}",
      type: 'get',
      data : {status : status ,id:id},
      success : function(response) {
          window.location.href = "{{ route('products.ratings') }}"
      },
    });
  }
}
</script>

@endsection