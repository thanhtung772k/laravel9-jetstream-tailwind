<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('client.layouts.css')
</head>
<body class="font-sans antialiased">
@include('client.layouts.header')

<div class="pt-[28px] pb-[100px] theme-page-spacing" role="main">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="p-0 m-0">
                    <div class="p-0 m-0">
                        <article id="post-5" class="post-5 page type-page status-publish hentry">
                            <div class="post-body clearfix">
                                <!-- Article content -->
                                <div class="entry-content clearfix">
                                    <div data-elementor-type="wp-page" data-elementor-id="5"
                                         class="elementor elementor-5">
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('client.layouts.footer')

@push('script')
    <script src="{{ asset('js/home.js') }}"></script>
@endPush

@include('client.layouts.script')

@stack('modals')
</body>
</html>
