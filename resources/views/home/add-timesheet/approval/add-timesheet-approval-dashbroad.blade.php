@extends('layouts.main')

@section('content')
    <script src="{{ asset('js/timesheet/add-timesheet.js') }}"></script>
    <div class="nav__sub-header absolute w-full" style="background-color: #fffafa;">
        <!-- Page Heading -->
        <header class="bg-white pt-[120px]">
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8">
                <form action="{{route('addtimesheet_approval')}}" method="GET">
                    <div class="w[110%]">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="header-search__text-date">
                                    <span class="text-sm">@lang('lang.id_name')</span>
                                </div>
                                <div class="header-search__date">
                                    <section>
                                        <div class="input-group date">
                                            <input class="form-control" name="idName">
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="header-search__text-date">
                                    <span class="text-sm">@lang('lang.start_date')</span>
                                </div>
                                <div class="header-search__date">
                                    <section>
                                        <div class="input-group date" id="datepicker">
                                            <input class="form-control" id="fromDate" name="fromDate"
                                                   placeholder="{{now()->startOfMonth()->format('Y-m-d')}}">
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-white">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </section>
                                </div>

                            </div>
                            <div class="col-sm-4">
                                <div class="header-search__text-date">
                                    <span class="text-sm">@lang('lang.end_date')</span>
                                </div>
                                <div class="header-search__text-date">
                                    <section>
                                        <div class="input-group date" id="datepicker-end">
                                            <input class="form-control" id="toDate" name="toDate">
                                            <span class="input-group-append">
                                        <span class="input-group-text bg-white">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                        </div>
                                    </section>
                                </div>
                            </div>
                            <div class="col-sm-12 mt-[24px] text-center">
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
                        @include('home.add-timesheet.approval.add-timesheet-approval')
                    </div>
                </div>
            </div>

        </main>
    </div>
@stop
