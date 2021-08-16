<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //CODE FOR ADD
        $('#btnSave').click(function() {
            buttonType = $(this).val();
            $.ajax({
                data: $('#updateProfileForm').serialize(),
                url: "{{ route('profiles.store') }}",
                type: "POST",

                success: function(data) {
                    $('#editProfileModal').modal('hide');
                    if (buttonType == "Create") {
                        swal("Success!", "Item is added successfully!", "success");
                    } else if (buttonType = "Update") {
                        swal("Success!", "Profile is updated successfully!", "success");
                    }
                },

                error: function(data) {
                    console.log('Error:', data);
                    swal("Error!", "Please fill all required fields", "warning");
                }
            });
        });

        $('body').on('click', '#btnEdit', function() {
            $('#editProfileModal').modal('show');
            $('btnSave').val("Update");
            $('#updateProfileForm').trigger("reset");

            data_id = $(this).attr('data_id');

            $.get("{{ route('profiles.index') }}" + '/' + data_id + '/edit', function(data) {
                $('#id').val(data.id);
                $('#contact').val(data.contact);
                $('#email').val(data.email);
                $('#picture_url').val(data.picture_url);
                //try lang
            });
        });
    });
</script>