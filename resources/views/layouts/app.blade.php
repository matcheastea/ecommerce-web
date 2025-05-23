
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('asset/css/custom.css') }}">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="{{asset('css/custom.css')}}">

    @livewireStyles
</head>
<body>
    <div id="app">
        @include('layouts.inc.admin.frontend.navbar')
        
        <main>
            @yield('content')
        </main>
    </div>
<script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<script>
    window.addEventListener('message', event => {
        alert(event.detail.text);
    });
</script>

@livewireScripts
 <!-- window.addEventListener('message', event => {
        alert(event.detail.text);
        // Bisa kamu ganti pakai toastr, sweetalert, dsb.
    }); -->
</body>
</html>
