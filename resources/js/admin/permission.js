$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#permissionn').DataTable({
    processing: true,
    serverSide: true,
    destroy:true,
    ajax: $('#permissionn').attr('data-url'),
    columns: [
        { data: 'id', name: 'id' },
        { data: 'display_name', name: 'display_name' },
        { data: 'description', name: 'description' },
        { data: 'action', name: 'action' },
    ],
});

$('#role').DataTable({
    processing: true,
    serverSide: true,
    destroy:true,
    ajax: $('#role').attr('data-url'),
    columns: [
        { data: 'id', name: 'id' },
        { data: 'display_name', name: 'display_name' },
        { data: 'description', name: 'description' },
        { data: 'action', name: 'action' },
    ],
});

$('#permissionrole').DataTable({
    processing: true,
    serverSide: true,
    destroy:true,
    ajax: $('#permissionrole').attr('data-url'),
    columns: [
        { data: 'id', name: 'id' },
        { data: 'display_name', name: 'display_name' },
        { data: 'permission', name: 'permission' },
        { data: 'action', name: 'action' },
    ],
});

$(document).on('click', '.permissionrole-add', function() {
    var type = $(this).attr('data-type');
    $('#form_validation').attr('data-type', type);
})

$(document).on('click', '#form_validation', function(e) {
    e.preventDefault();
    $('.type-add').val($(this).attr('data-type'));

    $.ajax({
        dataType: 'JSON',
        method: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        url: route('permission.add'),
        success: function(response){
            if(response.error){
                toastr.error(response.error);
            }
            toastr.info(response.success);
            $('#permissionrole-add').modal('hide');
            $('#role').DataTable().ajax.reload(null, false);
            $('#permission').DataTable().ajax.reload(null, false);
        },
        error:function(jqXHR, textStatus, errorThrown){
            if (jqXHR.responseJSON.errors.name !== undefined){
                toastr.error(jqXHR.responseJSON.errors.name[0]);
            }
            if (jqXHR.responseJSON.errors.display_name !== undefined){
                toastr.error(jqXHR.responseJSON.errors.display_name[0]);
            }
            if (jqXHR.responseJSON.errors.description !== undefined){
                toastr.error(jqXHR.responseJSON.errors.description[0]);
            }
        }
    })
});

$(document).on('click', '.permission-edit', function() {
    var id = $(this).attr('data-id');

    $.ajax({
        dataType: 'JSON',
        method: 'get',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        url: route('permission.edit', id),
        success: function(response){
            $('#permission-id').val(response.id);
            $('#permission-name').val(response.name);
            $('#permission-display_name').val(response.display_name);
            $('#permission-description').val(response.description);
        },
        error:function(jqXHR, textStatus, errorThrown){
        }
    })
});

$(document).on('submit', '#permission-editt', function(e) {
    e.preventDefault();
    $('.type-add').val($(this).attr('data-type'));
    $.ajax({
        dataType: 'JSON',
        method: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        url: route('permission.update'),
        success: function(response) {
            toastr.info(response.success);
            $('#permissionn').DataTable().ajax.reload(null, false);
            $('#permission-edit').modal('hide');
        },
    });
})

$(document).on('click', '.role-edit', function() {
    var id = $(this).attr('data-id');

    $.ajax({
        dataType: 'JSON',
        method: 'get',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        url: route('permission.roleedit', id),
        success: function(response){
            $('#role-id').val(response.id);
            $('#role-name').val(response.name);
            $('#role-display_name').val(response.display_name);
            $('#role-description').val(response.description);
        },
        error:function(jqXHR, textStatus, errorThrown){
        }
    })
});

$(document).on('submit', '#role-editt', function(e) {
    e.preventDefault();
    $('.type-add').val($(this).attr('data-type'));
    $.ajax({
        dataType: 'JSON',
        method: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        url: route('permission.roleupdate'),
        success: function(response) {
            toastr.info(response.success);
            $('#role').DataTable().ajax.reload(null, false);
            $('#role-edit').modal('hide');
        },
    });
})

$(document).on('click', '.permission-role-edit', function() {
    var id = $(this).attr('data-id');

    $.ajax({
        dataType: 'JSON',
        method: 'get',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        url: route('permission.permissionRoleEdit', id),
        success: function(response) {
            $('#rolename').html(response.display_name);
            $.each(response.permission, function(key, value) {
                $('.list-permission-per-people'). append(`<p>` + value['display_name'] + `</p>`);
            })
            if(response.permissionToAdd == '') {
                 $('.selectpermission').append(`<option value="">Người dùng đã đủ quyền</option>`)
            } else {
                $.each(response.permissionToAdd, function(key, value) {
                    $('.selectpermission').append(`<option value="" data-roleid="` + response.id + `" data-permissionid="` + value.id +`">` + value.display_name + `</option>`)
                })
            }
        },
    });
})

$(document).on('click', '#addPermissionRole', function(e) {
    e.preventDefault();
    var role_id = $('.selectpermission'). children("option:selected").attr('data-roleid');
    var permission_id = $('.selectpermission').children("option:selected").attr('data-permissionid');
    var formdata = new FormData();
    formdata.append('role_id', role_id);
    formdata.append('permission_id', permission_id);
    formdata.append('_token', $('input[name="_token"]').val());
    $.ajax({
        dataType: 'JSON',
        method: 'post',
        cache: false,
        contentType: false,
        processData: false,
        data: formdata,
        url: route('permission.permissionRoleUpdatee'),
        success: function(response) {
            toastr.info(response.success);
            // location.reload();
        },
    });
});

$('#addVip').DataTable({
    processing: true,
    serverSide: true,
    destroy:true,
    ajax: $('#addVip').attr('data-url'),
    columns: [
        { data: 'id', name: 'id' },
        { data: 'email', name: 'email' },
        { data: 'name', name: 'name' },
        { data: 'avatar', name: 'avatar' },
        { data: 'role', name: 'role' },
        { data: 'action', name: 'action' },
    ],
});

$(document).on('change', '#selectRole', function() {
    Swal.fire({
        title: 'Thay đổi vai trò người dùng ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, !'
    }).then((result) => {
        if (result.value) {
            var user_id = $('#selectRole').attr('data-userId');
            var role_id = $('#selectRole').children("option:selected").attr('data-roleId');
            var formData = new FormData();
            formData.append('role_id', role_id);
            formData.append('id' , user_id);
            formData.append('_token', $('input[name="_token"]').val());
            $.ajax({
                dataType: 'JSON',
                method: 'post',
                cache: false,
                contentType: false,
                processData: false,
                data: formData,
                url: route('permission.changeRole'),
                success: function(response) {
                    toastr.info(response.success);
                    $('#addVip').DataTable().ajax.reload(null, false);
                },
            });
        }
    })
})
