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
                <form action="{{route('update_project',$getProjectById->id)}}" method="post">
                    @csrf
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
                                <input class="form-control" name="projectName" value="{{$getProjectById->name}}">
                            </div>
                            @error('projectName')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-3">
                            <div class="header-search__text-date pb-3">
                                <span class="font-semibold cus_font-text text-sm">@lang('lang.customer')</span>
                            </div>
                            <div class="header-search__text-date ">
                                <select class="form-control text-sm" name="customer"
                                        value="{{$getProjectById->customer}}">
                                    <option value="EPU software">EPU software</option>
                                    <option value="THTu Japan">THTu Japan</option>
                                    <option value="NgTu ViT">NgTu ViT</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="header-search__text-date pb-3">
                                <span class="font-semibold cus_font-text text-sm">@lang('lang.project_type')</span>
                            </div>
                            <div class="header-search__text-date ">
                                <select class="form-control text-sm" name="projectType">
                                    @foreach($getProjectType as $value)
                                        @if($getProjectById->project_type_id == $value->id)
                                            @php
                                                $select = 'selected';
                                            @endphp
                                        @else
                                            {{$select = ''}}
                                        @endif
                                        <option value="{{$value->id}}" {{$select}}>{{$value->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-3">
                            <div class="header-search__text-date pb-3">
                                <span
                                    class="font-semibold cus_font-text text-sm">@lang('lang.value_contract') (mm)</span>
                            </div>
                            <div class="header-search__text-date ">
                                <input class="form-control" name="valueContract"
                                       value="{{$getProjectById->vale_contract}}">
                            </div>
                            @error('valueContract')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row pb-4">
                        <div class="col-sm-3">
                            <div class="header-search__text-date pb-3">
                                <span class="font-semibold cus_font-text text-sm">@lang('lang.department')</span>
                            </div>
                            <div class="header-search__text-date ">
                                <select class="form-control text-sm" name="department">
                                    @foreach($getDepartment as $value)
                                        @if($getProjectById->departments_id == $value->id)
                                            @php
                                                $select = 'selected';
                                            @endphp
                                        @else
                                            {{$select = ''}}
                                        @endif
                                        <option value="{{$value->id}}" {{$select}}>{{$value->name}}</option>
                                    @endforeach
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
                                        <input class="form-control" name="startDateProject" readonly
                                               style="background-color: #fff" value="{{$getProjectById->start_date}}">
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-white">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                </section>
                            </div>
                            @error('startDateProject')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-3">
                            <div class="header-search__text-date pb-3">
                                <span class="font-semibold cus_font-text text-sm">@lang('lang.end_date')</span>
                            </div>
                            <div class="header-search__text-date">
                                <section>
                                    <div class="input-group date" id="datepicker-end">
                                        <input class="form-control" name="endDateProject" readonly
                                               style="background-color: #fff" value="{{$getProjectById->end_date}}">
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-white">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                </section>
                            </div>
                            @error('endDateProject')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-3">
                            <div class="header-search__text-date pb-3">
                                <span class="font-semibold cus_font-text text-sm">@lang('lang.status')</span>
                            </div>
                            <div class="header-search__text-date ">
                                <select class="form-control text-sm" name="statusProject">
                                    <option value="1">@lang('lang.developing')</option>
                                    <option value="2">@lang('lang.done')</option>
                                    <option value="3">@lang('lang.undeveloped')</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row pb-4">
                        <div class="col-sm-3">
                            <div class="header-search__text-date pb-3">
                                <span class="font-semibold cus_font-text text-sm">@lang('lang.description')</span>
                            </div>
                            <div class="header-search__text-date ">
                                <textarea class="form-control" name="description">{{$getProjectById->description}}</textarea>
                            </div>
                            @error('description')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
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
                                        </div>
                                    </div>

                                    <div class="col-sm-2">
                                        <div class="header-search__text-date pb-3">
                                            <span
                                                class="font-semibold cus_font-text text-sm">@lang('lang.location')</span>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @foreach($getUserHasPrjById as $valueUserHasPrjById)
                            <tr>
                                <td>
                                    <div class="row pb-4">
                                        <div class="col-sm-2">
                                            <div class="header-search__text-date ">
                                                <select class="form-control text-sm selectUser" name="userID[]">
                                                    @foreach($getUsers as $value)
                                                        @if($valueUserHasPrjById->user_id == $value->id)
                                                            @php
                                                                $select = 'selected';
                                                            @endphp
                                                        @else
                                                            {{$select = ''}}
                                                        @endif
                                                        <option value="{{$value->id}}" {{$select}}>{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                    <div class="col-sm-2">
                                        <div class="header-search__text-date pb-3">
                                            <span
                                                class="font-semibold cus_font-text text-sm">@lang('lang.start_date')</span>
                                        </div>

                                    <div class="col-sm-2">
                                        <div class="header-search__text-date pb-3">
                                            <span
                                                class="font-semibold cus_font-text text-sm">@lang('lang.end_date')</span>
                                        </div>

                                        <div class="col-sm-1">
                                            <div class="header-search__text-date">
                                                <input class="form-control" name="effort[]" value="{{$valueUserHasPrjById->effort}}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @foreach($getUserHasPrjById as $valueUserHasPrjById)
                            <tr>
                                <td>
                                    <div class="row pb-4">
                                        <div class="col-sm-2">
                                            <div class="header-search__text-date ">
                                                <select class="form-control text-sm selectUser" name="userID[]">
                                                    @foreach($getUsers as $value)
                                                        @if($valueUserHasPrjById->user_id == $value->id)
                                                            @php
                                                                $select = 'selected';
                                                            @endphp
                                                        @else
                                                            {{$select = ''}}
                                                        @endif
                                                        <option
                                                            value="{{$value->id}}" {{$select}}>{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="header-search__text-date">
                                                <select class="form-control text-sm" name="locationID[]"
                                                        id="selectLocation">
                                                    @foreach($getLocation as $value)
                                                        @if($valueUserHasPrjById->role_id == $value->id)
                                                            @php
                                                                $select = 'selected';
                                                            @endphp
                                                        @else
                                                            {{$select = ''}}
                                                        @endif
                                                        <option
                                                            value="{{$value->id}}" {{$select}}>{{$value->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="header-search__date">
                                                <section>
                                                    <div class="input-group date" id="datepicker">
                                                        <input class="form-control" name="startDateUser[]" readonly
                                                               style="background-color: #fff"
                                                               value="{{$valueUserHasPrjById->start_date}}">
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
                                            <div class="header-search__text-date">
                                                <section>
                                                    <div class="input-group date" id="datepicker-end">
                                                        <input class="form-control" id="toDate" name="endDateUser[]"
                                                               readonly style="background-color: #fff"
                                                               value="{{$valueUserHasPrjById->end_date}}">
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
                                            <div class="header-search__text-date">
                                                <input class="form-control" name="effort[]"
                                                       value="{{$valueUserHasPrjById->effort}}">
                                            </div>
                                        </div>

                                        <div class="col-sm-1 flex items-end">
                                            <div class="mt-[3px]">
                                                <span
                                                    class="text-xs btn btn-outline-danger mt-0.5 input_remove">X</span>
                                                <input type="hidden" value="{{$valueUserHasPrjById->id}}"
                                                       name="userHasIDOld[]">
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <div class="row pb-8">
                        <div class="col">
                            <div class="header-search__text-date ">
                                <span class="cus_font-text cus_font-color pointer-events-auto" name="add_input"
                                      id="add_input">+ @lang('lang.staff_create')</span>
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
                </form>
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
        $(document).ready(function () {
        });
    </script>
@stop
