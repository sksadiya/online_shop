
@extends('admin.includes.default2')

@section('content')
<section class="content-header">					
					<div class="container-fluid my-2">
              @include('admin.message')
						<div class="row mb-2">
							<div class="col-sm-6">
								<h1>Order: {{ $order->id }}</h1>
							</div>
              
							<div class="col-sm-6 text-right">
                                <a href="{{ route('admin.orders') }}" class="btn btn-primary">Back</a>
							</div>
						</div>
					</div>
					<!-- /.container-fluid -->
				</section>
				<!-- Main content -->
				<section class="content">
					<!-- Default box -->
					<div class="container-fluid">
						<div class="row">
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header pt-3">
                                        <div class="row invoice-info">
                                            <div class="col-sm-4 invoice-col">
                                            <h1 class="h5 mb-3">Shipping Address</h1>
                                            <address>
                                                <strong>{{ $order->first_name }} {{ $order->last_name }}</strong><br>
                                                {{ $order->address }}<br>
                                                {{ $order->city }}, {{ $order->zip }} {{ $order->country_name }}<br>
                                                Phone: {{ $order->mobile }}<br>
                                                Email: {{ $order->email }}
                                            </address>
                                            <strong>Shipped date</strong>
                                            @if(!empty($order->shipped_date))
                                            {{ \carbon\Carbon::parse($order->shipped_date)->format('d M, Y') }}
                                            @else
                                            n/a
                                            @endif
                                            </div>
                                            
                                            
                                            
                                            <div class="col-sm-4 invoice-col">
                                                <!-- <b>Invoice #007612</b><br>
                                                <br> -->
                                                <b>Order ID:</b> {{ $order->id }}<br>
                                                <b>Total:</b> {{ number_format($order->grand_total ,2) }}<br>
                                                <b>Status:</b> 
                                                @if($order->status == 'delivered')
                                                <span class=" badge bg-success">Delivered</span>
                                                @elseif($order->status == 'pending')
                                                <span class=" badge bg-danger">Pending</span>
                                                @elseif($order->status == 'shipped')
                                                <span class=" badge bg-info">shipped</span>
                                                @else
                                                <span class=" badge bg-danger">Cancelled</span>
                                            @endif
                                                
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body table-responsive p-3">								
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Product</th>
                                                    <th width="100">Price</th>
                                                    <th width="100">Qty</th>                                        
                                                    <th width="100">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($orderItems->isNotEmpty())
                                                @foreach ($orderItems as $item)
                                                <tr>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->price }}</td>                                        
                                                    <td>{{ $item->qty }}</td>
                                                    <td>{{ $item->total }}</td>
                                                </tr>
                                                @endforeach
                                                @endif
                                                <tr>
                                                    <th colspan="3" class="text-right">Subtotal:</th>
                                                    <td>{{ number_format($order->subtotal,2) }}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <th colspan="3" class="text-right">Shipping:</th>
                                                    <td>{{ number_format($order->shipping,2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3" class="text-right">Discount: {{ !empty($order->coupon_code ) ? '('.$order->coupon_code.')' : ''}}</th>
                                                    <td>{{ number_format($order->discount,2) }}</td>
                                                </tr>
                                                <tr>
                                                    <th colspan="3" class="text-right">Grand Total:</th>
                                                    <td>{{ number_format($order->grand_total,2) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>								
                                    </div>                            
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card">
                                  <form action="{{ route('admin.changeOrderStatus',$order->id) }}" method="post" id="changeOrderStatusForm" name="changeOrderStatusForm">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Order Status</h2>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control">
                                                <option {{ ($order->status == 'pending') ? 'selected' : ''}} value="pending">Pending</option>
                                                <option {{ ($order->status == 'shipped') ? 'selected' : ''}} value="shipped">Shipped</option>
                                                <option {{ ($order->status == 'delivered') ? 'selected' : ''}} value="delivered">Delivered</option>
                                                <option {{ ($order->status == 'cancelled') ? 'selected' : ''}} value="cancelled">Cancelled</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                          <label for="">Shipped Date</label>
                                            <input type="text" placeholder="shipped Date" id="shipped_date" name="shipped_date" value="{{ $order->shipped_date }}" class="form-control demodate">
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary">Update</button>
                                        </div>
                                        </div>
                                  </form>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h2 class="h4 mb-3">Send Inovice Email</h2>
                                        <div class="mb-3">
                                            <select name="status" id="status" class="form-control">
                                                <option value="">Customer</option>                                                
                                                <option value="">Admin</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-primary">Send</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
					</div>
					<!-- /.card -->
				</section>
        @endsection
                @section('customScript')
                <script>
                $("#changeOrderStatusForm").submit(function(event) {
                  event.preventDefault();
                  $.ajax({
                    url:'{{ route('admin.changeOrderStatus',$order->id) }}',
                    type:'POST',
                    data:$(this).serializeArray(),
                    dataType:'json',
                    success:function(response){
                     window.location.href = "{{ route('admin.orderDetail',$order->id) }}";
                    },
                    error:function(response){
                      console.log(response);
                    }
                  })
                })
                </script>
                @endsection
