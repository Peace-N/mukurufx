<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ url('vendor/mukurufx/css/bootstrap.min.css') }}"/>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <script src="{{ url('/vendor/mukurufx/js/bootstrap.min.js') }}"></script>
    <script src="{{ url('/vendor/mukurufx/js/angular.min.js') }}"></script>
    <script src="{{ url('/vendor/mukurufx/js/mukuru-ng.js') }}"></script>
    <script src="{{ url('/vendor/mukurufx/js/accounting.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>

</head>

<body>
<div class="container">
    @yield('content')
</div>

</body>
</html>