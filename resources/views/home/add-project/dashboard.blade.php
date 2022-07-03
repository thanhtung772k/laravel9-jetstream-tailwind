@extends('layouts.main')

@section('content')
    <script src="{{ asset('css/project/project.css') }}"></script>
    <div class="nav__sub-header absolute w-full" style="background-color: #ebedef;">
        <!-- Page Heading -->
        <header class="bg-white pt-[120px]">
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                <form action="" method="GET" class="p-8">
                    <div class="w[100%]">
                        <div class="row pb-2.5">
                            <div class="col">
                                <div class="header-search__text-date ">
                                    <span class="cus_font-size">@lang('lang.search')</span>
                                </div>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <div class="col-sm-2 header-search__text-date">
                                <span class="text-sm">@lang('lang.project_name')</span>
                            </div>
                            <div class="col-sm-5 header-search__text-date">
                                <div class="input-group date" id="">
                                    <input class="form-control" placeholder="@lang('lang.project_name')">
                                </div>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <div class="col-sm-2 header-search__text-date">
                                <span class="text-sm">@lang('lang.status')</span>
                            </div>
                            <div class="col-sm-4 header-search__text-date">
                                <div class="input-group date" id="">
                                    <select class="form-control text-sm" id="FormControlSelect" name="paginate" onchange="this.form.submit()">
                                        <option value="0">Đang triển khai</option>
                                        <option value="1">Đã xong</option>
                                        <option value="0">Chưa triển khai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <div class="col-sm-2 header-search__text-date">
                                <span class="text-sm">@lang('lang.project_type')</span>
                            </div>
                            <div class="col-sm-4 header-search__text-date">
                                <div class="input-group date" id="">
                                    <select class="form-control text-sm" id="FormControlSelect" name="paginate" onchange="this.form.submit()">
                                        <option value="0">Tất cả</option>
                                        <option value="1">Đã xong</option>
                                        <option value="0">Chưa triển khai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <div class="col-sm-2 header-search__text-date">
                                <span class="text-sm">@lang('lang.division')</span>
                            </div>
                            <div class="col-sm-4 header-search__text-date">
                                <div class="input-group date" id="">
                                    <select class="form-control text-sm" id="FormControlSelect" name="paginate" onchange="this.form.submit()">
                                        <option value="0">Tất cả</option>
                                        <option value="1">Đã xong</option>
                                        <option value="0">Chưa triển khai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col center">
                                <button type="submit" class="btn btn-primary cus-btn-style bg-[#c2f2ff]"
                                        id="search">@lang('lang.search')</button>
                                <button type="reset"
                                        class="btn btn-secondary cus-btn-style  bg-[#c5c8cc]">@lang('lang.reset')</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </header>
        <main>
            <div class="py-8">
                <div class="max-w-[100%] px-[12px]">
                    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                        @include('home.add-project.list-project')
                    </div>
                </div>
            </div>

        </main>
    </div>
@stop
