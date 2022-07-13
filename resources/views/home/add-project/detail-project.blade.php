@extends('layouts.main')
@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('project-detail') }}
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
                            <span class="cus_font-text cus_font-size">@lang('lang.inf_detail_prj')</span>
                        </div>
                    </div>
                </div>

                <div class="row pb-3">
                    <div class="col-sm-2">
                        <label class="carb-body_header-title cus-with-unset">@lang('lang.project_name')</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="carb-body_header-content">{{$detailPrj->name}}</div>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-2">
                        <label class="carb-body_header-title cus-with-unset">@lang('lang.department')</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="carb-body_header-content">{{$detailPrj->depart->name}}</div>
                    </div>
                </div>

                <div class="row pb-3">
                    <div class="col-sm-2">
                        <label class="carb-body_header-title cus-with-unset">@lang('lang.customer')</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="carb-body_header-content">{{$detailPrj->customer}}</div>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-2">
                        <label class="carb-body_header-title cus-with-unset">@lang('lang.status')</label>
                    </div>
                    <div class="col-sm-3">
                        @if($detailPrj->status == config('constant.status_undeveloped'))
                            <div class="carb-body_header-content">@lang('lang.undeveloped')</div>
                        @elseif($detailPrj->status == config('constant.status_doing'))
                            <div class="carb-body_header-content">@lang('lang.developing')</div>
                        @else
                            <div class="carb-body_header-content">@lang('lang.done')</div>
                        @endif
                    </div>
                </div>

                <div class="row pb-3">
                    <div class="col-sm-2">
                        <label class="carb-body_header-title cus-with-unset">@lang('lang.start_date')</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="carb-body_header-content">{{$detailPrj->start_date}}</div>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-2">
                        <label class="carb-body_header-title cus-with-unset">@lang('lang.value_contract')</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="carb-body_header-content">{{$detailPrj->vale_contract}}</div>
                    </div>
                </div>

                <div class="row pb-3">
                    <div class="col-sm-2">
                        <label class="carb-body_header-title cus-with-unset">@lang('lang.end_date')</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="carb-body_header-content">{{$detailPrj->end_date}}</div>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-2">
                        <label class="carb-body_header-title cus-with-unset">@lang('lang.description')</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="carb-body_header-content">{{$detailPrj->description}}</div>
                    </div>
                </div>

                <div class="row pb-3">
                    <div class="col-sm-2">
                        <label class="carb-body_header-title cus-with-unset">@lang('lang.project_type')</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="carb-body_header-content">{{$detailPrj->projectType->name}}</div>
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-2">
                        <label class="carb-body_header-title cus-with-unset">@lang('lang.total_member')</label>
                    </div>
                    <div class="col-sm-3">
                        <div class="carb-body_header-content">{{count($datailUserJoinPrj)}}</div>
                    </div>
                </div>

                <div class="row py-3">
                    <div class="col">
                        <div class="header-search__text-date ">
                            <span class="cus_font-text">@lang('lang.inf_member_join')</span>
                        </div>
                    </div>
                </div>

                <div class="row card mx-auto w-full">
                    <table class="table bg-white text-sm">
                        <thead>
                        <tr class="cus_font-text">
                            <th scope="col">#</th>
                            <th scope="col">@lang('lang.name')</th>
                            <th scope="col">@lang('lang.location')</th>
                            <th scope="col">@lang('lang.start_date')</th>
                            <th scope="col">@lang('lang.end_date')</th>
                            <th scope="col">@lang('lang.effort') (%)</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($datailUserJoinPrj as $key => $value)
                            <tr>
                                <th scope="row">{{$key+1}}</th>
                                <td class="max-w-[100px]">{{$value->name}}</td>
                                <td class="max-w-[100px]">{{$value->nameRole}}</td>
                                <td class="max-w-[100px]">{{$value->start_date}}</td>
                                <td class="max-w-[100px]">{{$value->end_date}}</td>
                                <td class="max-w-[100px]">{{$value->effort}}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row pt-5">
                    <div class="col-4">
                    </div>
                    <div class="col-3 text-center">
                        <a href="{{route('edit_project', $detailPrj->id)}}" class="btn btn-success text-white bg-green-500">
                            <i class="fa-solid fa-pen-to-square"></i>
                            @lang('lang.edit')
                        </a>
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
    </script>
@stop

