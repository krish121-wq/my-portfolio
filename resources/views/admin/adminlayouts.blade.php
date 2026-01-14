<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="icon" href="{{ asset('admin_assest/images/favicon.png') }}" type="image/png">
    <link rel="stylesheet" href="{{ asset('admin_assest/css/style.css') }}">
    @stack('styles')
</head>
<body>

    @include('admin.header')

    <div class="content-wrapper">
        @yield('content')
    </div>

    <script src="{{ asset('admin_assest/js/script.js') }}"></script>
    @stack('scripts')
</body>
</html>