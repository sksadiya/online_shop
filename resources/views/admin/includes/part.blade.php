<script src="{{ asset('admin-assets/plugins/dropzone/min/dropzone.min.js') }}"></script>
<script>
    const getSlugRoute = '{{ route("getSlug") }}';

    // $('#name').on('input', function (event) {
    // use above line instead of next line if you want to reflect slug value while typing
    $('#title').change(function (event) {
        let element = $(this);
        $('button[type=submit]').prop('disabled', true);

        $.ajax({
            url: getSlugRoute,
            type: 'get',
            data: { title: element.val() },
            dataType: 'json',
            success: function (response) {
                $('button[type=submit]').prop('disabled', false);

                if (response['status'] == true) {
                    $('#slug').val(response['slug']);
                }
            }
        });
    });
    $('#productForm').submit(function (e) {
    e.preventDefault();
    let formData = $(this).serializeArray();
    $('button[type=submit]').prop('disabled', true);
    $.ajax({
        type: 'put',
        url: '{{ route("product.update" ,$products->id) }}',
        data: formData,
        dataType: 'json',
        success: function (response) {
            // console.log(response);
            $('button[type=submit]').prop('disabled', false);

            if (response['status'] == true) {
                const redirectToList = '{{ route("product.index") }}';
                window.location.href = redirectToList;
            } else {
                if(response['notFound'] == true) {
                    window.location.href = '{{ route('product.index') }}';
                }
                let errors = response['errors'];

                $(".error").removeClass('invalid-feedback').html("");
                $("input[type='text'] , select , input[type='number']").removeClass('is-invalid');
                $.each(errors, function (key, value) {
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
            data: { category_id: category_id },
            dataType: 'json',
            success: function (response) {
                // console.log(response);
                $('#sub_category').find('option').not(':first').remove();
                $.each(response['subcategories'], function (key, item) {
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
        url: "{{ route('product-images.update')}}",
        maxFiles: 10,
        paramName: 'image',
        params: {'product_id': '{{ $products->id }}'},
        addRemoveLinks: true,
        acceptedFiles: "image/jpeg,image/png,image/gif,image/webp",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (file, response) {
            // $("#image_id").val(response.image_id);
            // console.log(response)

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
        complete: function (file) {
            this.removeFile(file);
        }
    });

    function deleteImage(id) {
        $("#image-row-"+id).remove();
       if(confirm('are you sure to want to delete image?')) {
        $.ajax({
        url : '{{ route('product-images.delete') }}',
        type : 'delete',
        data : {id:id},
        success : function(response)  {
                if(response.status == true) {
                    alert(response.message)
                } else {
                    alert(response.message)
                }
        }
       });
       }
    }
</script>
