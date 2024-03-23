@extends('admin.includes.default')

@section('content')
    <!-- Content Header -->
    <section class="content-header">
        <div class="container-fluid my-2">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Category</h1>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Back</a>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <form action="{{ route('categories.update',$category->id) }}" method="post" id="categoryForm" name="categoryForm">

            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <!-- Name Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name">Name</label>
                                    <input type="text" value="{{ $category->name }}" name="name" id="name" class="form-control" placeholder="Name">
                                    <p></p>
                                </div>
                            </div>

                            <!-- Slug Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug">Slug</label>
                                    <input type="text" readonly value="{{ $category->slug }}" name="slug" id="slug" class="form-control" placeholder="Slug">
                                    <p></p>
                                </div>
                            </div>

                            <!-- Image Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="hidden" id="image_id" name="image_id" value="">
                                    <label for="image">Image</label>
                                    <div id="image" class="dropzone dz-clickable">
                                        <div class="dz-message needsclick">    
                                            <br>Drop files here or click to upload.<br><br>                                            
                                        </div>
                                    </div>
                                </div>
                                @if(!empty($category->image))
                                <div>
                                    <img width="250" src="{{ asset('uploads/category/'.$category->image) }}" alt="">
                                </div>
                                @endif
                            </div>

                            <!-- Status Field -->
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option {{ ($category->status == 1) ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ ($category->status == 0) ? 'selected' : '' }}  value="0">Block</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="showHome">Show on Home</label>
                                    <select name="showHome" id="showHome" class="form-control">
                                        <option {{ ($category->showHome == 'Yes') ? 'selected' : '' }} value="Yes">Yes</option>
                                        <option {{ ($category->showHome == 'No') ? 'selected' : '' }} value="No">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buttons -->
                <div class="pb-5 pt-3">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('categories.create') }}" class="btn btn-outline-dark ml-3">Cancel</a>
                </div>
            </div>
        </form>
        <!-- /.card -->
    </section>
		<script src="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.js') }}"></script>
    <script type="text/javascript">
        const getSlugRoute = '{{ route("getSlug") }}';
        const redirectToList = '{{ route("categories.index") }}';
        const tempImage = '{{ route("temp-image.create") }}';
        const updateRoute = '{{ route("categories.update" ,$category->id) }}';

    </script>
    <script src="{{ asset('admin-assets/category/update.js') }}"></script>
@endsection
