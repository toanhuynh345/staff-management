
<!doctype html>
<html lang="{{str_replace('_', '-', app()->getLocale())}}" class="no-js h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>Admin | @yield('title', config('app.name'))</title>
    <link href="{{asset_url('images/favicon.ico')}}" rel="icon">
    <link href="{{asset_url('css/app.css')}}" rel="stylesheet">
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>

    @stack('css')
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <aside class="main-sidebar col-12 col-md-3 col-lg-2 px-0">
            @include('admin.layouts.partials.sidebar')
        </aside>

        <main class="main-content col-lg-10 col-md-9 col-sm-12 p-0 offset-lg-2 offset-md-3">
            @include('admin.layouts.partials.sticky-top')
            @include('admin.layouts.partials.message')

            <div class="main-content-container container-fluid px-4">
                @yield('content')
            </div>

            <footer class="main-footer d-flex p-2 px-3 bg-white border-top">
          <span class="copyright ml-auto my-auto mr-2">
            Copyright © 2021
            <a href="javascript:" rel="nofollow">vtx-admin</a>
          </span>
            </footer>
        </main>
    </div>
</div>
<script src="{{asset_url('js/app.js')}}"></script>
<script src="{{asset_url('js/admin/common.js')}}"></script>

@stack('js')
</body>

</html>
