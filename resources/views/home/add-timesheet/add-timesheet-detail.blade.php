@extends('layouts.main')

@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('add_timesheet-detail') }}
    </div>
@endsection

@section('content')
    <div class="nav__sub-header absolute w-full" style="background-color: #ebedef;">
        <!-- Page Heading -->
        <header class="pt-[120px]">
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8 flex justify-center m-auto">
                <div class="row relative w-[730px]">
                    <header class="h-[54px] w-full carb-body-title">
                        <label class=" pt-[0.7rem] pl-6 uppercase"> @lang('lang.add_timesheet')</label>
                    </header>
                        <div class="carb-body pt-[10px]">
                        <div class="flex mb-2.5">
                            <label class="carb-body_header-title">@lang('lang.add_date')</label>
                            <div class="carb-body_header-content">{{$dataDetailAddTimesheet->date}}</div>
                        </div>

                        <div class="flex mb-2.5">
                            <label class="carb-body_header-title">@lang('lang.registration_date')</label>
                            <div class="carb-body_header-content">{{$dataDetailAddTimesheet->created_at->format('Y-m-d')}}</div>
                        </div>

                        <div class="flex mb-2.5">
                            <label class="carb-body_header-title">@lang('lang.admin')</label>
                            <div class="carb-body_header-content">{{$dataDetailAddTimesheet->name}}</div>
                        </div>

                        <div class="flex mb-2.5">
                            <label class="carb-body_header-title">@lang('lang.checkin_real')</label>
                            <div class="carb-body_header-content">{{$dataDetailAddTimesheet->check_in_real}}</div>
                        </div>

                        <div class="flex mb-2.5">
                            <label class="carb-body_header-title">@lang('lang.checkout_real')</label>
                            <div class="carb-body_header-content">{{$dataDetailAddTimesheet->check_out_real}}</div>
                        </div>

                        <div class="flex mb-2.5">
                            <label class="carb-body_header-title">@lang('lang.checkin_request')</label>
                            <div class="carb-body_header-content">{{$dataDetailAddTimesheet->check_int_request}}</div>
                        </div>

                        <div class="flex mb-2.5">
                            <label class="carb-body_header-title">@lang('lang.checkout_request')</label>
                            <div class="carb-body_header-content">{{$dataDetailAddTimesheet->check_out_request}}</div>
                        </div>

                        <div class="flex mb-2.5">
                            <label class="carb-body_header-title">@lang('lang.reason')</label>
                            <div class="carb-body_header-content">{{$dataDetailAddTimesheet->description}}</div>

                        </div>

                        <div class="flex mb-2.5 items-center">
                            <label class="carb-body_header-title">@lang('lang.evidence')</label>
                            <div class="w-full">
                                <img src="{{asset('storage/images')}}/{{$dataDetailAddTimesheet->evidence}}" class="image-evidence">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </header>

    </div>
@stop
