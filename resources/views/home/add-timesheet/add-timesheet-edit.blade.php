@extends('layouts.main')

@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('add_timesheet-update') }}
    </div>
@endsection

@section('content')
    <div class="nav__sub-header absolute w-full" style="background-color: #ebedef;">
        <!-- Page Heading -->
        <header class=" pt-[120px]">
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8 flex justify-center m-auto">
                <div class="bg-white row relative w-[730px]">
                    <header class="h-[54px] border rounded-t w-full">
                        <label class="add_timesheet-title pt-[0.7rem] pl-6">Update Additional TimeSheet</label>
                    </header>
                    <div class="carb-body border rounded-b ">
                        <form action="{{route('update_addtimesheet',$dataEditAddTimesheet->id)}}" method="POST" class="p-6"
                              enctype="multipart/form-data">
                            @csrf
                            <div >
                                <div class="row add_timesheet-title">
                                    <div class="col-6">
                                        <label>@lang('lang.add_date') <span class="text-red-500">*</span></label>
                                        <section>
                                            <div class="input-group date" id="dateUpdateAddTimesheet">
                                                <input class="form-control" id="fromDate" name="timesheet_date"
                                                       value="{{$dataEditAddTimesheet->date}}">
                                                <span class="input-group-append">
                                                        <span class="input-group-text bg-white">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                            </div>
                                        </section>
                                        <input type="hidden" name="timesheet_id" value="{{$dataEditAddTimesheet->timesheet_id}}">
                                        </script>
                                    </div>
                                    <div class="col-6">
                                        <label>@lang('lang.add_date') <span class="text-red-500">*</span></label>
                                        <input class="form-control" name="checkinReal" value="{{$dataEditAddTimesheet->created_at->format('Y-m-d')}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="pt-4 add_timesheet-title">
                                    <label class="">@lang('lang.admin') <span class="text-red-500">*</span></label>
                                    <div class="w-[40%]">
                                        <select class="form-control text-xs" id="exampleFormControlSelect1"
                                                name="adminID">
                                            @foreach($dataUserAdmin as $valueAdmin)
                                                @if($valueAdmin->id == $dataEditAddTimesheet->user_id)
                                                    @php
                                                        $select = 'selected';
                                                    @endphp
                                                @else
                                                    {{$select = ''}}
                                                @endif
                                                <option value="{{$valueAdmin->id}}" {{$select}} >{{$valueAdmin->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="row pt-4 add_timesheet-title">
                                    <div class="col-6">
                                        <label>@lang('lang.checkin_real')
                                            <span class="text-red-500">*</span></label>
                                        <div>
                                            <input class="form-control" name="checkinReal" value="{{$dataEditAddTimesheet->check_in_real}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>@lang('lang.checkin_request')
                                            <span class="text-red-500">*</span></label>
                                        <div>
                                            <input class="form-control" name="checkinRequest" value="{{$dataEditAddTimesheet->check_int_request}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="row pt-4 add_timesheet-title">
                                    <div class="col-6">
                                        <label>@lang('lang.checkout_real')
                                            <span class="text-red-500">*</span></label>
                                        <div>
                                            <input class="form-control" name="checkoutReal" value="{{$dataEditAddTimesheet->check_out_real}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <label>@lang('lang.checkout_request')
                                            <span class="text-red-500">*</span></label>
                                        <div>
                                            <input class="form-control" name="checkoutRequest" value="{{$dataEditAddTimesheet->check_out_request}}" >
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="row pt-4 add_timesheet-title">
                                    <div class="col-6">
                                        <label>@lang('lang.evidence')
                                            <span class="text-red-500">*</span></label>
                                        <div class="form-group">
                                            <input type="hidden" name="old_evidence_image" value="{{$dataEditAddTimesheet->evidence}}">
                                            <input type="file" name="evidence_image"
                                                   class="file_upload1 form-control-file" id="fileImageEvidence">
                                            <span id="file_error"></span>
                                        </div>
                                        @error('evidence_image')
                                        <div class="text-red-500"></div>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label></label>
                                        <div>
                                            <div class="old_image">
                                                <img src="{{asset('storage/images')}}/{{$dataEditAddTimesheet->evidence}}" class="image-evidence">
                                            </div>
                                        </div>
                                        <div class="img-holder"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="pt-4 add_timesheet-title">
                                    <label>@lang('lang.reason') <span class="text-red-500">*</span></label>
                                    <div>
                                        <textarea class="form-control" name="reason" rows="3">{{$dataEditAddTimesheet->description}}</textarea>
                                    </div>
                                    @error('reason')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="row pt-4">
                                    <div class="col-2">
                                    </div>
                                    <div class="col-5">
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
                        </form>
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
    <script src="{{ asset('js/timesheet/add-timesheet-edit.js') }}"></script>
    <script type="text/javascript">

    </script>
@stop
