<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/style-homepage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/profile.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin_mod.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin-style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin_reports.css') }}" rel="stylesheet">
    <link href="{{ asset('css/inbox.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-tagsinput.css') }}" rel="stylesheet">
    <link href="{{ asset('css/createPost.css') }}" rel="stylesheet">
    <link href="{{asset('css/signin.css') }}" rel="stylesheet">
    <link href="{{asset('css/sub-params.css')}}" rel="stylesheet">
    @yield('style-homepage')

</head>
<body>
    <div id="app">
    
        @include('inc.navbar')
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>
    </div>

    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>


    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap-tagsinput.js') }}"></script>
</body>
</html>
