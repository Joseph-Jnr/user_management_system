/********* Delete admin *********/

$(document).ready(function () {
    fetch();

    $(document).on('click', '.delete-admin', function () {
        var id = $(this).data('id');

        swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                        url: 'assets/includes/delete-admin.php?action=delete',
                        type: 'POST',
                        data: 'id=' + id,
                        dataType: 'json'
                    })
                    .done(function (response) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: false,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: response.status,
                            title: 'Deleted!'
                        })
                        fetch();
                    })
                    .fail(function () {
                        swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                    });
            }

        })

    });
});

function fetch() {
    $.ajax({
        method: 'POST',
        url: 'assets/includes/delete.php',
        dataType: 'json',
        success: function (response) {
            $('#delete_admin_conf').html(response);
        }
    });
}




/********* Delete user *********/

$(document).ready(function () {
    fetch();

    $(document).on('click', '.delete-user', function () {
        var id = $(this).data('id');

        swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.value) {
                $.ajax({
                        url: 'assets/includes/delete.php?action=delete',
                        type: 'POST',
                        data: 'id=' + id,
                        dataType: 'json'
                    })
                    .done(function (response) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: false,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })

                        Toast.fire({
                            icon: response.status,
                            title: 'Deleted!'
                        })
                        fetch();
                    })
                    .fail(function () {
                        swal.fire('Oops...', 'Something went wrong with ajax !', 'error');
                    });
            }

        })

    });
});

function fetch() {
    $.ajax({
        method: 'POST',
        url: 'assets/includes/delete.php',
        dataType: 'json',
        success: function (response) {
            $('#delete_user_conf').html(response);
        }
    });
}