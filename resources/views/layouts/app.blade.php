<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" href="{{ asset('css/ecs/style.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />
        <div class="flex">
            <div style="">
                <div class="w-[256px] bg-[#303c54] ">
                    <a href="" class="text-center w-full left-16">
                        <img src="https://ecs.fabbi.io/img/fabbi_logo.031027dd.jpeg" alt="" width="118px" height="50px" class="text-center custom-center" >
                    </a>
                </div>
                <div class="w-[256px] bg-[#3c4b64]">
                        wefwe
                </div>
                <div class="">

                </div>
            </div>
            <div class="min-h-screen bg-gray-100">
                @livewire('navigation-menu')

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main>
                    {{ $slot }}
                </main>
            </div>
        </div>
        @stack('modals')

        @livewireScripts
    </body>
</html>
