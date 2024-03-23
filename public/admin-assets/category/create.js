$('#categoryForm').submit(function(event) {
    event.preventDefault();
    let element = $(this);
    $('button[type=submit]').prop('disabled',true);
    $.ajax({
         url: element.attr('action'),
        type:'post',
        data:element.serializeArray(),
        dataType:'json',
        success:function(response) {
            $('button[type=submit]').prop('disabled', false);

            if(response['status'] == true) {
                window.location.href = redirectToList;
                $('#slug').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");
                $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

            } else {
            let errors =response['errors'];
            if(errors['name']) {
                $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['name']);
            } else {
                $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

            }
            if(errors['slug']) {
                $('#slug').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors['slug']);
            } else {
                $('#slug').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html("");

            }
        }
        },
        error:function(jqXHR,exception) {
            console.log('something went wrong');
        }
    })
})

// $('#name').on('input', function (event) {
    //use above line instead of next line if you want to reflect slug value while typing
$('#name').change(function(event) {
    let element = $(this);
    $('button[type=submit]').prop('disabled', true);

$.ajax({
    url:getSlugRoute,
    type:'get',
    data :{title:element.val()},
    dataType:'json',
    success:function(response) {
        $('button[type=submit]').prop('disabled', false);

        if(response['status'] == true) {
            $('#slug').val(response['slug']);
        }
    }
});
});

Dropzone.autoDiscover = false;    
const dropzone = $("#image").dropzone({ 
    init: function() {
        this.on('addedfile', function(file) {
            if (this.files.length > 1) {
                this.removeFile(this.files[0]);
            }
        });
    },
    url:tempImage,
    maxFiles: 1,
    paramName: 'image',
    addRemoveLinks: true,
    acceptedFiles: "image/jpeg,image/png,image/gif,image/webp",
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }, success: function(file, response){
        $("#image_id").val(response.image_id);
        //console.log(response)
    }
});