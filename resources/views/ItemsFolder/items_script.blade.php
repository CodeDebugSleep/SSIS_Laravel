<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //CODE FOR RESTORE CONFIRMATION
        $('body').on('click', '#btnRestore', function() {
            console.log($(this).attr('data_id'));
            data_id = $(this).attr('data_id');
            swal({
                title: "Are you sure?",
                text: "Once confirmed, item will be restored",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax ({
                        type: "GET",
                        url: "/items/" + data_id + "/restore",

                        success: function() {
                            swal("Poof! Item has been restored!", {
                                icon: "success",
                            })
                        },
                        error: function(data) {
                            console.log("Error:", data);
                        }
                    })
                }
                else {
                    swal("Item is not restored")
                }
            });
        });

        //CODE FOR ARCHIVE CONFIRMATION
        $('body').on('click', '#btnArchive', function() {
            console.log($(this).attr('data_id'));
            data_id = $(this).attr('data_id');
            swal({
                    title: "Are you sure?",
                    text: "Confirm if you want to archive this item!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('items.index') }}" + '/' + data_id + '/archive',

                        success: function() {
                            $('#record_id_' + data_id).remove();
                            swal("Item is successfully archived!", {
                                icon: "success",
                            });
                        },

                        error: function(data) {
                            console.log("Error:", data);
                        }
                    });

                } else {
                    swal("Item is not archived!");
                }
            });
        });

        //CODE FOR DELTE CONFIRMATION
        $('body').on('click', '#btnDelete', function() {
            console.log($(this).attr('data_id'));
            data_id = $(this).attr('data_id');
            swal({
                    title: "Are you sure?",
                    text: "Confirm if you want to delete this item!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
            .then((willDelete) => {
                if (willDelete) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('items.index') }}" + '/' + data_id,

                        success: function() {
                            $('#record_id_' + data_id).remove();
                            swal("Item is successfully deleted!", {
                                icon: "success",
                            });
                        },

                        error: function(data) {
                            console.log("Error:", data);
                        }
                    });

                } else {
                    swal("Item is not deleted!");
                }
            });
        });
    });
</script>