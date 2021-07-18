<!doctype html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}" class="no-js h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Admin | @yield('title', config('app.name'))</title>
    <link href="{{asset_url('images/favicon.ico')}}" rel="icon">
    <link href="{{asset_url('css/app.css')}}" rel="stylesheet">

    @stack('css')
</head>

<body>
<div class="container">
    <main class="main-content">@yield('content')</main>
</div>

<script src="{{asset_url('js/app.js')}}"></script>
@stack('js')
</body>

</html>
