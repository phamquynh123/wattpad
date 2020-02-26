$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$('#category').DataTable({
    processing: true,
    serverSide: true,
    ajax: $('#category').attr('data-url'),
    columns: [
        { data: 'id', name: 'id' },
        { data: 'title', name: 'title' },
        { data: 'parent', name: 'parent' },
        { data: 'created_at', name: 'created_at' },
        { data: 'action', name: 'action' },
    ],
});

$(document).on('submit', '#submitAdd', function(e) {
    e.preventDefault();
    $.ajax({
        dataType: 'JSON',
        method: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        url: route('category.add'),
        success: function(response) {
            toastr.info(response.success);
            location.reload();
        },
        error:function(jqXHR, textStatus, errorThrown){
            if (jqXHR.responseJSON.errors.title !== undefined){
                toastr.error(jqXHR.responseJSON.errors.title[0]);
            }
        }
    })
});

$(document).on('click', '.category-tran', function(e) {
    e.preventDefault();
    var parent_language_id = $(this).attr('data-id'); //get id of record that want to translate
    $('#parent_language_id').attr('value', parent_language_id); //set id to record
    var data_name = $(this).attr('data-name');

    var parent_id = $(this).attr('data-parent-id'); //get id of record that want to translate
    $('#parent_id').attr('value', parent_id);

    $('.bangoc').text(data_name);
    $.ajax({
        dataType: 'JSON',
        method: 'get',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        url: route('category.gettrans', $(this).attr('data-id')),
        success: function(response){
            $.each(response, function($key, $value1) {
                $.each($value1, function($key, $value) {
                    var html = `<tr>
                                    <td>`+ $value.id +`</td>
                                    <td>`+ $value.language +`</td>
                                    <td>`+ $value.title +`</td>
                                </tr>`;
                    $('.trans_ed').append(html);
                })
            })
        }
    });
})

$('#transData').on('submit', function(e) {
    alert('a');
    e.preventDefault();
    $.ajax({
        dataType: 'JSON',
        method: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        url: route('category.trans'),
        success: function(response){
            toastr.info(response.success);
            location.reload();
        },
        error:function(jqXHR, textStatus, errorThrown){
            if (jqXHR.responseJSON.errors.title !== undefined){
                toastr.error(jqXHR.responseJSON.errors.title[0]);
            }
        }
    })
})
