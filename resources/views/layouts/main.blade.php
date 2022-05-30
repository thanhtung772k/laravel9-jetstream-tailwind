<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.css')
</head>
<body class="font-sans antialiased">
    @include('layouts.header')

    <div class="flex">
        @include('layouts.main-menu')
        <div class="nav__sub-menu cus-min-height bg-gray-100 ml-64 relative w-full">
            @include('layouts.navigation')
            @yield('content')
        </div>
    </div>

    @include('layouts.footer')

    @push('script')
        <script src="{{ asset('js/home.js') }}"></script>
    @endPush

    @include('layouts.script')

    @yield('script')

    @stack('modals')
</body>
</html>
