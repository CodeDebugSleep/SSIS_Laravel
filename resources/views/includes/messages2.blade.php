@if(count($errors) > 0)
    @foreach($errors->all() as $error)
    <script>
        swal({
            title: "Error!",
            text: "These credentials do not match our records.",
            icon: "warning",
            className: "swal-text",
        })
    </script>
       
    @endforeach
@endif

@if(session('success'))
    <script>
        swal({
            title: "Success!",
            text: "Item is added successfully!",
            icon: "success",
            className: "swal-text",
        })
    </script>
@endif

@if(session('error'))
     <script>
        swal("Error!", "Something went wrong", "warning");
     </script>
@endif