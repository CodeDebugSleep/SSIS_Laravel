<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //CODE FOR CONFIRM ARCHIVE
        $('body').on('click', '#btnArchive', function() {
            console.log($(this).attr('data_id'));
            data_id = $(this).attr('data_id');
            swal({
                    title: "Are you sure?",
                    text: "Confirm if you want to archive user!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('users.index') }}" + '/' + data_id + '/archive',

                        success: function() {
                            $('#record_id_' + data_id).remove();
                            swal("User's account is successfully archived!", {
                                icon: "success",
                            });
                        },

                        error: function(data) {
                            console.log("Error:", data);
                        }
                    });

                } else {
                    swal("User's account is not archived!");
                }
            });
        });

        //CODE FOR CONFIRM DELETE
        $('body').on('click', '#btnDelete', function() {
            console.log($(this).attr('data_id'));
            data_id = $(this).attr('data_id');
            swal({
                    title: "Are you sure?",
                    text: "Confirm if you want to delete user!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('users.index') }}" + '/' + data_id,

                        success: function() {
                            $('#record_id_' + data_id).remove();
                            swal("User's account is successfully deleted!", {
                                icon: "success",
                            });
                        },

                        error: function(data) {
                            console.log("Error:", data);
                        }
                    });

                } else {
                    swal("User's account is not deleted!");
                }
            });
        });

        //CODE FOR RESTORE CONFIRMATION
        $('body').on('click', '#btnRestore', function() {
            console.log($(this).attr('data_id'));
            data_id = $(this).attr('data_id');
            swal({
                title: "Are you sure?",
                text: "Once confirmed, user account will be restored",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax ({
                        type: "GET",
                        url: "/users/" + data_id + "/restore",

                        success: function() {
                            swal("Poof! User account has been restored!", {
                                icon: "success",
                            })
                        },
                        error: function(data) {
                            console.log("Error:", data);
                        }
                    })
                }
                else {
                    swal("User account is not restored")
                }
            });
        });
    });
</script>