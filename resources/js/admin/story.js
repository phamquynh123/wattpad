$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#story').DataTable({
    processing: true,
    serverSide: true,
    ajax: $('#story').attr('data-url'),
    columns: [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'public_status', name: 'public_status' },
        { data: 'original', name: 'original' },
        { data: 'img', name: 'img' },
        // { data: 'use_status', name: 'use_status' },
        // { data: 'view_count', name: 'view_count' },
        // { data: 'total_vote', name: 'total_vote' },
        { data: 'action', name: 'action' },
    ],
});

$(document).on('click', '.story_detail', function(e) {
    e.preventDefault();
    $id = $(this).attr('data-id');
    $.ajax({
        dataType: 'JSON',
        method: 'get',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        url: route('story.detail', $id),
        success: function(response){
            console.log(response);
            if(response.use_status == 0 ){
                $('#use_status').html('Normal');
            } else {
                $('#use_status').html('Vip');
            }

            if(response.public_status == 1 ){
                $('#public_status').html('Public');
            } else {
                $('#public_status').html('Draft');
            }

            $('#view_count').html(response.view_count);
            $('.total_vote').html(response.total_vote);
                console.log(response.img);
                // var $a = '{{ URL::asset(' + response.img + ') }}';
                // console.log($a);
            $('.image-area').children().attr('src', response.img);
            $('#titlee').html(response.title);
            $('#created').html(response.created_at);
            $('#description').html(response.description);
            $('.comment').html(response.numComment);
            $.each(response.authors, function(key, value) {
                $('.authors').append("<span>" + value.name + "</span> - ");
            });

        },
        error:function(jqXHR, textStatus, errorThrown){
            if (jqXHR.responseJSON.errors.title !== undefined){
                toastr.error(jqXHR.responseJSON.errors.title[0]);
            }
        }
    })
});

$('#myStory').DataTable({
    processing: true,
    serverSide: true,
    ajax: $('#myStory').attr('data-url'),
    columns: [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'public_status', name: 'public_status' },
        { data: 'original', name: 'original' },
        { data: 'img', name: 'img' },
        { data: 'use_status', name: 'use_status' },
        { data: 'action', name: 'action' },
    ],
});

$(document).on('change', '.public-status', function() {
    $id = $(this).data('id');
    $.ajax({
        dataType: 'JSON',
        method: 'get',
        cache: false,
        contentType: false,
        processData: false,
        url: route('myStory.changPublicStatus', $id),
        success: function(response){
            toastr.info(response.success);
        }
    })
});

$(document).on('click', '.use-status', function() {
    $id = $(this).data('id');
    var classs = $(this);
    $.ajax({
        dataType: 'JSON',
        method: 'get',
        cache: false,
        contentType: false,
        processData: false,
        url: route('myStory.changUseStatus', $id),
        success: function(response){
            if(response.errors == false) {
                toastr.info(response.success);
                if( classs.text() == "Vip") {
                    classs.text('Normal');
                } else {
                    classs.text('Vip');
                }
            } else {
                toastr.error(response.errors);
            }
        }
    })
})

$(document).on('submit', '#submitAdd', function(e) {
    e.preventDefault();
    $.ajax({
        dataType: 'JSON',
        method: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        url: route('myStory.addStory'),
        success: function(response){
            toastr.info(response.success);
        },
        error:function(jqXHR, textStatus, errorThrown){
            if (jqXHR.responseJSON.errors.title !== undefined){
                toastr.error(jqXHR.responseJSON.errors.title[0]);
            }
            if (jqXHR.responseJSON.errors.description !== undefined){
                toastr.error(jqXHR.responseJSON.errors.description[0]);
            }
            if (jqXHR.responseJSON.errors.original !== undefined){
                toastr.error(jqXHR.responseJSON.errors.original[0]);
            }
            if (jqXHR.responseJSON.errors.public_status !== undefined){
                toastr.error(jqXHR.responseJSON.errors.public_status[0]);
            }
            if (jqXHR.responseJSON.errors.use_status !== undefined){
                toastr.error(jqXHR.responseJSON.errors.use_status[0]);
            }
            if (jqXHR.responseJSON.errors.file !== undefined){
                toastr.error(jqXHR.responseJSON.errors.file[0]);
            }
        }
    })
})

// $(document).on('click', '.my-story-detail', function() {
//     alert('a');
// })
 function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('.image_upload_preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

    $(".inputFile").change(function () {
        readURL(this);
    });
$(document).on('click', '.story-fix', function() {
    $id = $(this).attr('data-id');
    $('#submitEdit').attr('data-id', $id);
    $.ajax({
        dataType: 'JSON',
        method: 'get',
        cache: false,
        contentType: false,
        processData: false,
        url: route('myStory.editStory', $id),
        success: function(response){
            $('#title-edit').val(response.title);
            $('#description-edit').val(response.description);
            $('#original-edit').val(response.original);
            if(response.img != '') {
                var html = `<img src="` + response.img + `" alt="" id="img-edit" class="img-avatar">`;
                console.log(html);
                $('#img-edit').append(html);
            }
        }
    })
})

$(document).on('submit', '#submitEdit', function(e) {
    e.preventDefault();
    $id = $('#submitEdit').attr('data-id');
    $.ajax({
        dataType: 'JSON',
        method: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        url: route('myStory.submitEdit', $id),
        success: function(response){
            toastr.info(response.success);
            $('#story-edit').modal('hide');
            $('#myStory').DataTable().ajax.reload(null, false);
        },
        error:function(jqXHR, textStatus, errorThrown){
        }
    })
})

$(document).on('click', '.story-add-chapter', function() {
    var id = $(this).attr('data-id');
    $('#add-chapter-form').attr('data-id', id);
})

$(document).on('submit', '#add-chapter-form', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    $.ajax({
        dataType: 'JSON',
        method: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        url: route('myStory.addChapter', id),
        success: function(response) {
            toastr.info(response.success);
        },
        error:function(jqXHR, textStatus, errorThrown){
            if (jqXHR.responseJSON.errors.title !== undefined){
                toastr.error(jqXHR.responseJSON.errors.title[0]);
            }
            if (jqXHR.responseJSON.errors.content !== undefined){
                toastr.error(jqXHR.responseJSON.errors.content[0]);
            }
            if (jqXHR.responseJSON.errors.public_status !== undefined){
                toastr.error(jqXHR.responseJSON.errors.public_status[0]);
            }
        }
    })
})
