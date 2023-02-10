@extends('layouts.main')


@section('content')
    <script src="{{ asset('js/timesheet/add-timesheet.js') }}"></script>
    <div class="nav__sub-header absolute w-full">
        <!-- Page Heading -->
        <header class="bg-white pt-[120px]">
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                <form action="" method="GET" class="p-8">
                    <div class="w[100%]">
                        <div class="row pb-2.5">
                            <div class="col">
                                <div class="header-search__text-date ">
                                    <span class="cus_font-text cus_font-size">@lang('lang.search')</span>
                                </div>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <div class="col-sm-2 header-search__text-date">
                                <span class="text-sm">@lang('lang.employee_code')</span>
                            </div>
                            <div class="col-sm-5 header-search__text-date">
                                <div class="input-group date">
                                    <input class="form-control" name="user_id" value="{{ request()->get('user_id') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <div class="col-sm-2 header-search__text-date">
                                <span class="text-sm">@lang('lang.name')</span>
                            </div>
                            <div class="col-sm-5 header-search__text-date">
                                <div class="input-group date">
                                    <input class="form-control" name="user_name" value="{{ request()->get('user_name') }}">
                                </div>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <div class="col-sm-2 header-search__text-date">
                                <span class="text-sm">@lang('lang.location')</span>
                            </div>
                            <div class="col-sm-4 header-search__text-date">
                                <div class="input-group date">
                                    <select class="form-control text-sm" name="location">
                                        <option value="{{config('constant.default_number')}}">@lang('lang.all')</option>
                                        @foreach($location as $value)
                                            <option value="{{$value->id}}" {{ request()->get('location') == $value->id ? 'selected' : '' }} >{{$value->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row pb-4">
                            <div class="col-sm-2 header-search__text-date">
                                <span class="text-sm">@lang('lang.department')</span>
                            </div>
                            <div class="col-sm-4 header-search__text-date">
                                <div class="input-group date" >
                                    <select class="form-control text-sm" name="dept">
                                        <option value="{{config('constant.default_number')}}">@lang('lang.all')</option>
                                        @foreach($departments as $department)
                                            <option value="{{$department->id}}" {{ request()->get('dept') == $department->id ? 'selected' : '' }}>{{$department->name}}</option>
                                        @endforeach
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
                        @include('home.admin.management')
                    </div>
                </div>
            </div>

        </main>
    </div>
@stop
