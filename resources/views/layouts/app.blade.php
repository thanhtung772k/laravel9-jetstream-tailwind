<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('css/all.min.css') }}" rel="stylesheet"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ecs/style.css') }}">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    @livewireStyles

    <!-- Scripts -->
    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body class="font-sans antialiased">
<x-jet-banner/>
<div class="flex">
    <div class="nav__menu fixed">
        <div class="w-[256px] bg-[#303c54] flex items-center">
            <a href="" class="text-center w-full left-16">
                <img src="https://ecs.fabbi.io/img/fabbi_logo.031027dd.jpeg" alt="" width="118px" height="50px"
                     class="text-center custom-center">
            </a>
        </div>
        <div class="menu-items__backgound">
            <ul>
                <li class="menu-items__list">
                            <span>
                                <i class="menu-items__icon fa-solid fa-gauge-high pr-3 "></i>
                                <a href="">Dashboard</a>
                            </span>
                </li>
                <li class="menu-items__list1">
                    <span class="menu-items__title">MANAGEMENT</span>

                </li>
                <li class="menu-items__list">
                            <span>
                                <i class="menu-items__icon fa-solid fa-gauge-high pr-3"></i>
                                <a href="">Công số</a>
                            </span>
                    <i class="fa-solid fa-angle-left text-xs pr-3"></i>

                </li>
                <li class="menu-items__list2 text-center w-full">
                    Danh sách công số
                </li>
                <li class="menu-items__list">
                            <span>
                                <i class="menu-items__icon fa-solid fa-clock  pr-3"></i>
                                <a href="">Làm thêm (OT)</a>
                            </span>
                    <i class="fa-solid fa-angle-left text-xs pr-3"></i>
                </li>
                <li class=" menu-items__list">
                            <span>
                                <i class="menu-items__icon fa-solid fa-file-circle-plus pr-3"></i>
                                <a href="">Bổ sung công số</a>
                            </span>
                    <i class="fa-solid fa-angle-left text-xs pr-3"></i>
                </li>
                <li class=" menu-items__list">
                            <span>
                                <i class="menu-items__icon fa-solid fa-file pr-3"></i>
                                <a href="">Nghỉ phép</a>
                            </span>
                    <i class="fa-solid fa-angle-left text-xs pr-3"></i>
                </li>
                <li class=" menu-items__list">
                            <span>
                                <i class="menu-items__icon fa-solid fa-file pr-3"></i>
                                <a href="">Hướng dẫn sử dụng</a>
                            </span>
                    <i class="fa-solid fa-angle-left text-xs pr-3"></i>
                </li>
            </ul>
        </div>
        <div class="menu-items__footer h-[56px] bg-[#303c54] pr-4">
            <i class="fa-solid fa-angle-left text-xl opacity-50"></i>
        </div>
    </div>
    <div class="nav__sub-menu min-h-screen bg-gray-100 ml-64">
        <div class="fixed z-10 w-full">
            @livewire('navigation-menu')
        </div>

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow pt-[120px]">
                <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
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
<script>
    $(document).ready(function (event) {
        $('.menu-items__list2').slideUp();
        $('.menu-items__list').click(function () {
            $(this).next().slideToggle(300);
            $(this).toggleClass('bg-[#303c54]');
            $(this).children('i').toggleClass('menu-items__icon--tranform ')
        });
        $('.header__list-bar').click(function () {
            console.log(12312)
            $('.nav__menu').toggleClass('menu-items__nav');
            $('.nav__sub-menu').toggleClass('ml-64', 200);
        });
    });
</script>
@stack('modals')

@livewireScripts
</body>
</html>
