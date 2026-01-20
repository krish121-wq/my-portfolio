<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'My Laravel Site')</title>
  
  <link rel="icon" href="{{ asset('assest/images/favicon.png') }}" type="image/png">
  <link rel="stylesheet" href="{{ asset('assest/css/style.css') }}">
</head>
<body>
  @include('layouts.header')   <!-- optional -->
  
  <div class="content">
    @yield('content')
  </div>
  @include('layouts.footer')  

  <script src="{{ asset('assest/js/script.js') }}"></script>
</body>
</html>
