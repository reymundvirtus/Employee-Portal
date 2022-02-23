$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

get_count_data();
get_user_data();

// count data
function get_count_data() {

    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: 'data_count',
        success: function(data) {

            let html;

            for (let i = 0; i < data.length; i++) {
                html += '<h1 class="h1">' + data[i].ID + '</h1>'
            }


            $('#data_counting').html(html.substr(9)) // substr() is to remove undefined
        },
    });

    return false;
}

// retreived data
function get_user_data() {

    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: 'users',
        success: function(data) {

            let html;
            let x = 1;
            let roleId = document.getElementById('roleId').value;

            for (let i = 0; i < data.length; i++) {
                html += '<tr class="card-hover">'
                html += '<td>' + x++ + '</td>'
                html += '<td>' + data[i].first_name + '</td>'
                html += '<td>' + data[i].last_name + '</td>'
                html += '<td>' + data[i].email + '</td>'
                html += '<td>' + data[i].created_at + '</td>'
                html += '<td>' + data[i].role_name + '</td>'
                html += '<td>' + data[i].encoder + '</td>'
                if (data[i].first_name != 'Reymund') {
                    if (roleId == 1 || roleId == 2) {
                        html += '<td><a href="javascript:void(0)" type="button" class="btn btn-sm rounded-lg bg-indigo-600 text-white card-hover EditPost" data-user_id="' + data[i].id + '"data-first_name="' + data[i].first_name + '"data-last_name="' + data[i].last_name + '"data-email="' + data[i].email + '"data-role_id="' + data[i].role_id + '"data-encoder="' + data[i].encoder + '"data-password="' + data[i].password + '">Edit</a></td>'
                    }
                    html += '<td><a href="javascript:void(0)" type="button" class="btn btn-sm rounded-lg bg-pink-600 text-white card-hover ReadPost" data-user_id="' + data[i].id + '"data-first_name="' + data[i].first_name + '"data-last_name="' + data[i].last_name + '"data-email="' + data[i].email + '"data-role_name="' + data[i].role_name + '"data-encoder="' + data[i].encoder + '"data-created_at="' + data[i].created_at + '"data-password="' + data[i].password + '">Read</a></td>'
                    if (roleId == 1 || roleId == 2) {
                        html += '<td><a href="javascript:void(0)" type="button" class="btn btn-sm rounded-lg bg-red-600 text-white card-hover DeletePost" data-user_id="' + data[i].id + '"data-first_name="' + data[i].first_name + '"data-last_name="' + data[i].last_name + '"data-email="' + data[i].email + '"data-role_name="' + data[i].role_name + '"data-encoder="' + data[i].encoder + '"data-created_at="' + data[i].created_at + '"data-password="' + data[i].password + '">Delete</a></td>'
                    }
                } else {
                    html += '<td></td>'
                    html += '<td></td>'
                    html += '<td></td>'
                }
                html += '</tr>'
            }

            $('#get_user_data').html(html.substr(9))
        }
    });

    return false;
}

// read data
$('#get_user_data').on('click', '.ReadPost', function() {

    let first_name = $(this).data('first_name');
    let last_name = $(this).data('last_name');
    let email = $(this).data('email');
    let role_name = $(this).data('role_name');
    let encoder = $(this).data('encoder');
    let created_at = $(this).data('created_at');
    let password = $(this).data('password');

    $('#firstnamer').val(first_name);
    $('#lastnamer').val(last_name);
    $('#emailr').val(email);
    $('#roler').val(role_name);
    $('#encodedr').val(encoder);
    $('#dater').val(created_at);
    $('#passwordr').val(password);

    $('#readAccountModal').modal('show');
});

// update data
$('#get_user_data').on('dblclick', '.EditPost', function() {

    let user_id = $(this).data('user_id');
    let first_name = $(this).data('first_name');
    let last_name = $(this).data('last_name');
    let email = $(this).data('email');
    let password = $(this).data('password');

    $('#user_idu').val(user_id);
    $('#firstnameu').val(first_name);
    $('#lastnameu').val(last_name);
    $('#emailu').val(email);
    $('#passwordu').val(password);

    if (confirm("Do you want to update this?")) {

        $('#updateAccountModal').modal('show');
    }

    return false;
});

$('#update_data').submit('click', function() {

    let user_id = $('#user_idu').val()
    let first_name = $('#firstnameu').val()
    let last_name = $('#lastnameu').val()
    let email = $('#emailu').val()
    let password = $('#passwordu').val()

    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: { user_id: user_id, first_name: first_name, last_name: last_name, email: email, password: password },
        url: 'update_data',
        success: function(data) {

            $('#successModal').modal('show');
            get_user_data();
            clear_inputs();
            $("#updateAccountModal").modal('hide');
        },
        error: function(data) {
            $('#errorModal').modal('show');
        }
    });

    return false;
});

// delete data
$('#get_user_data').on('dblclick', '.DeletePost', function() {

    let user_id = $(this).data('user_id');

    if (confirm("Do you want to delete this?")) {

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data: { user_id: user_id },
            url: 'delete_data',
            success: function(data) {

                $('#successModal').modal('show');
                get_user_data();
                get_count_data();
            },
            error: function(data) {

                $('#errorModal').modal('show');
            }
        });
    }
});



// clearing inputs
function clear_inputs() {

    $('#user_idu').val('');
    $('#firstnameu').val('');
    $('#lastnameu').val('');
    $('#emailu').val('');
    $('#role_idu').val('');
    $('#encodedu').val('');
    $('#passwordu').val('');
}