@extends('layouts.main')
@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('project-update') }}
    </div>
@endsection
@section('content')
    <div class="nav__sub-header absolute w-full" style="background-color: #fffafa;">
        <!-- Page Heading -->
        <header class=" shadow pt-[120px] p-8">
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8 m-auto">
                <form action="{{route('update_project',$projectById->id)}}" method="post">
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
                                <input class="form-control" name="project_name" value="{{$projectById->name}}">
                            </div>
                            @error('project_name')
                            <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-sm-3">
                            <div class="header-search__text-date pb-3">
                                <span class="font-semibold cus_font-text text-sm">@lang('lang.customer')</span>
                            </div>
                            <div class="header-search__text-date ">
                                <select class="form-control text-sm" name="customer"
                                        value="{{$projectById->customer}}">
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
                                    @foreach($projectTypes as $projectType)
                                        @if($projectById->project_type_id == $projectType->id)
                                            @php
                                                $select = 'selected';
                                            @endphp
                                        @else
                                            {{$select = ''}}
                                        @endif
                                        <option value="{{$projectType->id}}" {{$select}}>{{$projectType->name}}</option>
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
                                <input class="form-control" name="value_contract"
                                       value="{{$projectById->value_contract}}">
                            </div>
                            @error('value_contract')
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
                                    @foreach($departments as $department)
                                        @if($projectById->department_id == $department->id)
                                            @php
                                                $select = 'selected';
                                            @endphp
                                        @else
                                            {{$select = ''}}
                                        @endif
                                        <option value="{{$department->id}}" {{$select}}>{{$department->name}}</option>
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
                                        <input class="form-control" name="start_date_project" readonly
                                               style="background-color: #fff" value="{{$projectById->start_date}}">
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-white">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                </section>
                            </div>
                            @error('start_date_project')
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
                                        <input class="form-control" name="end_date_project" readonly
                                               style="background-color: #fff" value="{{$projectById->end_date}}">
                                        <span class="input-group-append">
                                            <span class="input-group-text bg-white">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                        </span>
                                    </div>
                                </section>
                            </div>
                            @error('end_date_project')
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
                                <textarea class="form-control"
                                          name="description">{{$projectById->description}}</textarea>
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
                        @php
                            $oldStartDateUser = old('start_date_user') ?? [];
                        @endphp
                        @if($oldStartDateUser == null)
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="header-search__text-date pb-3">
                                                <span
                                                    class="font-semibold cus_font-text text-sm">@lang('lang.staff')</span>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="header-search__text-date pb-3">
                                                <span
                                                    class="font-semibold cus_font-text text-sm">@lang('lang.location')</span>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="header-search__text-date pb-3">
                                                <span
                                                    class="font-semibold cus_font-text text-sm">@lang('lang.start_date')</span>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="header-search__text-date pb-3">
                                                <span
                                                    class="font-semibold cus_font-text text-sm">@lang('lang.end_date')</span>
                                            </div>
                                        </div>

                                        <div class="col-sm-1">
                                            <div class="header-search__text-date pb-3">
                                                <span class="font-semibold cus_font-text text-sm whitespace-nowrap">@lang('lang.effort') (%)</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @foreach($userProjects as $userProject)
                                <tr>
                                    <td>
                                        <div class="row pb-4">
                                            <div class="col-sm-2">
                                                <div class="header-search__text-date ">
                                                    <select class="form-control text-sm selectUser" name="user_id[]">
                                                        @foreach($users as $user)
                                                            @if($userProject->user_id == $user->id)
                                                                @php
                                                                    $select = 'selected';
                                                                @endphp
                                                            @else
                                                                {{$select = ''}}
                                                            @endif
                                                            <option
                                                                value="{{$user->id}}" {{$select}}>{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="header-search__text-date">
                                                    <select class="form-control text-sm" name="locationID[]"
                                                            id="selectLocation">
                                                        @foreach($locations as $location)
                                                            @if($userProject->role_id == $location->id)
                                                                @php
                                                                    $select = 'selected';
                                                                @endphp
                                                            @else
                                                                {{$select = ''}}
                                                            @endif
                                                            <option
                                                                value="{{$location->id}}" {{$select}}>{{$location->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="header-search__date">
                                                    <section>
                                                        <div class="input-group date" id="datepicker">
                                                            <input class="form-control" name="start_date_user[]" readonly
                                                                   style="background-color: #fff"
                                                                   value="{{$userProject->start_date}}">
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
                                                            <input class="form-control" id="toDate" name="end_date_user[]"
                                                                   readonly style="background-color: #fff"
                                                                   value="{{$userProject->end_date}}">
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
                                                           value="{{$userProject->effort}}">
                                                </div>
                                            </div>

                                            <div class="col-sm-1 flex items-end">
                                                <div class="mt-[3px]">
                                                    <span
                                                        class="text-xs btn btn-outline-danger mt-0.5 input_remove">X</span>
                                                    <input type="hidden" value="{{$userProject->id}}"
                                                           name="user_has_id_old[]">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="header-search__text-date pb-3">
                                                <span
                                                    class="font-semibold cus_font-text text-sm">@lang('lang.staff')</span>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="header-search__text-date pb-3">
                                                <span
                                                    class="font-semibold cus_font-text text-sm">@lang('lang.location')</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="header-search__text-date pb-3">
                                                <span
                                                    class="font-semibold cus_font-text text-sm">@lang('lang.start_date')</span>
                                            </div>
                                        </div>

                                        <div class="col-sm-2">
                                            <div class="header-search__text-date pb-3">
                                                <span
                                                    class="font-semibold cus_font-text text-sm">@lang('lang.end_date')</span>
                                            </div>
                                        </div>

                                        <div class="col-sm-1">
                                            <div class="header-search__text-date pb-3">
                                                <span class="font-semibold cus_font-text text-sm whitespace-nowrap">@lang('lang.effort') (%)</span>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @foreach($oldStartDateUser as $key => $valueDateUser)
                                <tr>
                                    <td>
                                        <div class="row pb-4">
                                            <div class="col-sm-2">
                                                <div class="header-search__text-date ">
                                                    <select class="form-control text-sm selectUser" id="selectUser"
                                                            name="user_id[]">
                                                        @foreach($users as $user)
                                                            @if(old('user_id')[$key] == $user->id)
                                                                @php
                                                                    $select = 'selected';
                                                                @endphp
                                                            @else
                                                                {{$select = ''}}
                                                            @endif
                                                            <option
                                                                value="{{$user->id}}" {{$select}}>{{$user->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @error("user_id.$key")
                                                <div class="text-red-500">{{ $message }}</div>
                                                @enderror

                                            </div>


                                            <div class="col-sm-2">
                                                <div class="header-search__text-date">
                                                    <select class="form-control text-sm" name="locationID[]"
                                                            id="selectLocation">
                                                        @foreach($locations as $location)
                                                            @if(old('locationID')[$key] == $location->id)
                                                                @php
                                                                    $select = 'selected';
                                                                @endphp
                                                            @else
                                                                {{$select = ''}}
                                                            @endif
                                                            <option
                                                                value="{{$location->id}}" {{$select}}>{{$location->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="header-search__date">
                                                    <section>
                                                        <div class="input-group date" id="datepicker">
                                                            <input class="form-control" name="start_date_user[]"
                                                                   value="{{ old('start_date_user')[$key] }}" readonly
                                                                   style="background-color: #fff">
                                                            <span class="input-group-append">
                                                                    <span class="input-group-text bg-white">
                                                                        <i class="fa fa-calendar"></i>
                                                                    </span>
                                                                </span>
                                                        </div>
                                                    </section>
                                                </div>
                                                @error("start_date_user.$key")
                                                <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="header-search__text-date">
                                                    <section>
                                                        <div class="input-group date" id="datepicker-end">
                                                            <input class="form-control" id="toDate" name="end_date_user[]"
                                                                   value="{{ old('end_date_user')[$key] }}" readonly
                                                                   style="background-color: #fff">
                                                            <span class="input-group-append">
                                                                <span class="input-group-text bg-white">
                                                                    <i class="fa fa-calendar"></i>
                                                                </span>
                                                            </span>
                                                        </div>
                                                    </section>
                                                </div>
                                                @error("end_date_user.$key")
                                                <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-sm-1">
                                                <div class="header-search__text-date">
                                                    <input class="form-control" value="{{ old('effort')[$key] }}"
                                                           name="effort[]">
                                                </div>
                                                @error("effort.$key")
                                                <div class="text-red-500 w-[114px]">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="col-sm-1 flex">
                                                <div class="mt-[3px]">
                                                    <button type="button"
                                                            class="text-xs btn btn-outline-danger mt-0.5 input_remove"
                                                            name="js-remove-input" id="' + i + '">X
                                                    </button>
                                                    <input type="hidden" value="" name="user_has_id_old[]">
                                                </div>
                                            </div>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
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
@stop
