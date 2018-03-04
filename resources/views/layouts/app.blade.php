<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{config('app.name', 'LSAPP')}}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css')}}">

</head>
<body>
    <div id="app">
        
        @include('inc.navbar')
        <div class="container pt-4">
            @include('inc.messages')
            @yield('content')
        </div>

    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script>
        if(document.getElementById('article-ckeditor')){
            CKEDITOR.replace( 'article-ckeditor' );
        }
    </script>
</body>
</html>
