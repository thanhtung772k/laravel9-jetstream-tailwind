@extends('layouts.main')
@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('project-create') }}
    </div>
@endsection
@section('content')
    <div class="nav__sub-header absolute w-full" style="background-color: #ebedef;">
        <!-- Page Heading -->
        <header class=" shadow pt-[120px] p-8">
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8 m-auto">
                <div class="row py-8">
                    <div class="col">
                        <div class="header-search__text-date ">
                            <span class="cus_font-text cus_font-size">@lang('lang.project_create')</span>
                        </div>
                    </div>
                </div>

                <div class="row pb-4">
                    <div class="col-sm-3">
                        <div class="header-search__text-date pb-3">
                            <span class="font-semibold cus_font-text text-sm">@lang('lang.project_name')</span>
                        </div>
                        <div class="header-search__text-date ">
                            <input class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="header-search__text-date pb-3">
                            <span class="font-semibold cus_font-text text-sm">@lang('lang.customer')</span>
                        </div>
                        <div class="header-search__text-date ">
                            <select class="form-control text-sm" id="FormControlSelect" name="paginate"
                                    onchange="this.form.submit()">
                                <option value="0">Đang triển khai</option>
                                <option value="1">Đã xong</option>
                                <option value="0">Chưa triển khai</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="header-search__text-date pb-3">
                            <span class="font-semibold cus_font-text text-sm">@lang('lang.project_type')</span>
                        </div>
                        <div class="header-search__text-date ">
                            <select class="form-control text-sm" id="FormControlSelect" name="paginate"
                                    onchange="this.form.submit()">
                                <option value="0">Đang triển khai</option>
                                <option value="1">Đã xong</option>
                                <option value="0">Chưa triển khai</option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="header-search__text-date pb-3">
                            <span class="font-semibold cus_font-text text-sm">@lang('lang.value_contract') (mm)</span>
                        </div>
                        <div class="header-search__text-date ">
                            <input class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row pb-4">
                    <div class="col-sm-3">
                        <div class="header-search__text-date pb-3">
                            <span class="font-semibold cus_font-text text-sm">@lang('lang.division')</span>
                        </div>
                        <div class="header-search__text-date ">
                            <select class="form-control text-sm" id="FormControlSelect" name="paginate"
                                    onchange="this.form.submit()">
                                <option value="0">Đang triển khai</option>
                                <option value="1">Đã xong</option>
                                <option value="0">Chưa triển khai</option>
                            </select>
                        </div>
                    </div>


                    <div class="col-sm-3">
                        <div class="header-search__text-date pb-3">
                            <span class="font-semibold cus_font-text text-sm">@lang('lang.start_date')</span>
                        </div>
                        <div class="header-search__date">
                            <section>
                                <div class="input-group date" id="datepicker">
                                    <input class="form-control" id="fromDate" name="fromDate" readonly style="background-color: #fff">
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-white">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="header-search__text-date pb-3">
                            <span class="font-semibold cus_font-text text-sm">@lang('lang.end_date')</span>
                        </div>
                        <div class="header-search__text-date">
                            <section>
                                <div class="input-group date" id="datepicker-end">
                                    <input class="form-control" id="toDate" name="toDate" readonly style="background-color: #fff">
                                    <span class="input-group-append">
                                        <span class="input-group-text bg-white">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                </div>
                            </section>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <div class="header-search__text-date pb-3">
                            <span class="font-semibold cus_font-text text-sm">@lang('lang.status')</span>
                        </div>
                        <div class="header-search__text-date ">
                            <select class="form-control text-sm" id="FormControlSelect" name="paginate"
                                    onchange="this.form.submit()">
                                <option value="0">Đang triển khai</option>
                                <option value="1">Đã xong</option>
                                <option value="0">Chưa triển khai</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row pb-4">
                    <div class="col-sm-3">
                        <div class="header-search__text-date pb-3">
                            <span class="font-semibold cus_font-text text-sm">@lang('lang.dicription')</span>
                        </div>
                        <div class="header-search__text-date ">
                        <textarea class="form-control">

                        </textarea>
                        </div>
                    </div>

                </div>

                <div class="row py-8">
                    <div class="col">
                        <div class="header-search__text-date ">
                            <span class="cus_font-text cus_font-size">@lang('lang.staff_create')</span>
                        </div>
                    </div>
                </div>

                <table id="dynamic_input">
                    <tr>
                        <td>
                            <div class="row pb-4">
                                <div class="col-sm-2">
                                    <div class="header-search__text-date pb-3">
                                        <span class="font-semibold cus_font-text text-sm">@lang('lang.staff')</span>
                                    </div>
                                    <div class="header-search__text-date ">
                                        <select class="form-control text-sm" id="FormControlSelect" name="paginate"
                                                onchange="this.form.submit()">
                                            <option value="0">Đang triển khai</option>
                                            <option value="1">Đã xong</option>
                                            <option value="0">Chưa triển khai</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-sm-2">
                                    <div class="header-search__text-date pb-3">
                                        <span class="font-semibold cus_font-text text-sm">@lang('lang.location')</span>
                                    </div>
                                    <div class="header-search__text-date " id="dcm">
                                        <select class="form-control text-sm" name="paginate"
                                                onchange="this.form.submit()">
                                            @foreach($getLocation as $value)
                                                <option value="">{{$value->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="header-search__text-date pb-3">
                                        <span class="font-semibold cus_font-text text-sm">@lang('lang.start_date')</span>
                                    </div>
                                    <div class="header-search__date">
                                        <section>
                                            <div class="input-group date" id="datepicker">
                                                <input class="form-control" id="fromDate" name="fromDate" readonly style="background-color: #fff">
                                                <span class="input-group-append">
                                                    <span class="input-group-text bg-white">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </section>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="header-search__text-date pb-3">
                                        <span class="font-semibold cus_font-text text-sm">@lang('lang.end_date')</span>
                                    </div>
                                    <div class="header-search__text-date">
                                        <section>
                                            <div class="input-group date" id="datepicker-end">
                                                <input class="form-control" id="toDate" name="toDate" readonly style="background-color: #fff">
                                                <span class="input-group-append">
                                                    <span class="input-group-text bg-white">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </section>
                                    </div>
                                </div>

                                <div class="col-sm-1">
                                    <div class="header-search__text-date pb-3">
                                        <span class="font-semibold cus_font-text text-sm whitespace-nowrap">@lang('lang.effort') (%)</span>
                                    </div>
                                    <div class="header-search__text-date">
                                        <input class="form-control">
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>

                <div class="row pb-8">
                    <div class="col">
                        <div class="header-search__text-date ">
                            <span class="cus_font-text cus_font-color pointer-events-auto" name="add_input" id="add_input">+ @lang('lang.staff_create')</span>
                        </div>
                    </div>
                </div>

                <div class="row pt-4">
                    <div class="col-4">
                    </div>
                    <div class="col-3">
                        <button type="submit"
                                class="btn btn-primary cus-btn-style bg-[#c2f2ff] cus-with-btn">
                            @lang('lang.save_info')
                        </button>
                    </div>
                    <div class="col-5">
                        <button type="submit" class="btn cus-btn-style bg-[##f8f9fa] cus-border-btn">
                            @lang('lang.cancel')
                        </button>
                    </div>
                </div>
            </div>

        </header>
        <main>
            <div>
                Copyright © 2022 Fabbi JSC. All rights reserved.
            </div>
        </main>

    </div>
    <script src="{{ asset('js/timesheet/add-timesheet.js') }}"></script>
    <script>
        $(document).ready(function() {

        });
    </script>
@stop
