@extends('admin.includes.default2')

@section('content')
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shipping Management</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <form action="{{ route('shipping.update',$shipping->id) }}" id="shippingForm" name="shippingForm" method="post">
        @csrf
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <select name="country" id="country" class="form-control @error('country') is-invalid @enderror" >
                                    <option value="" selected disabled>Select Country</option>
                                        @if($countries->isNotEmpty())
                                               @foreach($countries as $country)
                                               <option {{($shipping->country_id == $country->id) ? 'selected' : " "}} value="{{$country->id}}">{{$country->name}}</option>
                                               @endforeach 
                                               <option value="rest_of_world">Rest of the world</option>
                                        @endif
                                    </select>
									    @error('country')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="text" name="amount" id="amount" value="{{ $shipping->amount }}" class="form-control @error('amount') is-invalid @enderror" placeholder="amount">
                                    @error('amount')
                                <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                            </div>
                            <div class="col-md-4">
                            <button type="submit" class="btn btn-primary mt-sm-2">Create</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- /.card -->
    </section>
@endsection

@section('customJs')

@endsection
