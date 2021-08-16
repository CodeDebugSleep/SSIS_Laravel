<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SS Inventory System')</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>
<body>
    <main>
    <div class = "container slide2">
        @include('includes.messages2')
    </div>
        @yield('myBody')
    </main>
</body>
</html>