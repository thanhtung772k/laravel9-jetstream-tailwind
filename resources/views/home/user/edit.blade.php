@extends('layouts.main')
@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('user-edit') }}
    </div>
@endsection
@section('content')

    <div class="nav__sub-header absolute w-full" style="background-color: #fffafa;">
        <!-- Page Heading -->
        <header class=" shadow pt-[120px] p-8">
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8 m-auto">
                <form action="{{route('update_user' , $userById->user_id)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row py-8">
                        <div class="col-sm-6">
                            <div class="row header-search__text-date ">
                                <span class="cus_font-text cus_font-size">@lang('lang.personal_inf')</span>
                            </div>

                            <div class="row py-3">
                                <div class="col text-sm">
                                    <div class="row cus_font-text">
                                        @lang('lang.id')
                                        <span class="text-red-500">*</span>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-sm-6 p-0">
                                            <input class="form-control" name="user_id" value="{{$userById->employee_code}}" disabled>
                                        </div>
                                    </div>
                                    @error('user_id')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col text-sm">
                                    <div class="row cus_font-text">
                                        @lang('lang.email')
                                        <span class="text-red-500">*</span>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-sm-6 p-0">
                                            <input class="form-control" name="email" value="{{$userById->email}}" disabled>
                                        </div>
                                    </div>
                                    @error('email')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col text-sm">
                                    <div class="row cus_font-text">
                                        @lang('lang.name')
                                        <span class="text-red-500">*</span>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-sm-6 p-0">
                                            <input class="form-control" name="name" value="{{$userById->name}}">
                                        </div>
                                    </div>
                                    @error('name')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col text-sm">
                                    <div class="row cus_font-text">
                                        @lang('lang.date_birth')
                                        <span class="text-red-500">*</span>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-sm-6 p-0">
                                            <section>
                                                <div class="input-group date" id="datepicker">
                                                    <input class="form-control bg-white" name="date_of_birth" value="{{$userById->date_of_birth}}" readonly>
                                                    <span class="input-group-append">
                                                        <span class="input-group-text bg-white">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    @error('date_of_birth')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.home_town')
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <input class="form-control" name="homeTown" value="{{$userById->home_town}}">
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.current_residence')
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <input class="form-control" name="currentResidence" value="{{$userById->current_residence}}">
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.university')
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <input class="form-control" name="university" value="{{$userById->university}}">
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.work_form')
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <select class="form-control text-sm" name="workForm" >
                                        <option value="{{config('constant.VALUE_DEFAULT_ONE')}}" {{ $userById->working_form == config('constant.VALUE_DEFAULT_ONE') ? 'selected' : '' }} >Full time</option>
                                        <option value="{{config('constant.VALUE_DEFAULT_TWO')}}" {{ $userById->working_form == config('constant.VALUE_DEFAULT_TWO') ? 'selected' : '' }} >Partime</option>
                                        <option value="{{config('constant.VALUE_DEFAULT_THREE')}}" {{ $userById->working_form == config('constant.VALUE_DEFAULT_THREE') ? 'selected' : '' }} >Remote</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="row header-search__text-date ">
                                <span class="cus_font-text cus_font-size">@lang('lang.professional_inf')</span>
                            </div>

                            <div class="row py-3">
                                <div class="col text-sm">
                                    <div class="row cus_font-text">
                                        @lang('lang.time') start
                                        <span class="text-red-500">*</span>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-sm-6 p-0">
                                            <section>
                                                <div class="input-group date" id="datepicker">
                                                    <input class="form-control bg-white" name="time_start" value="{{$userById->time_start}}" readonly>
                                                    <span class="input-group-append">
                                                        <span class="input-group-text bg-white">
                                                            <i class="fa fa-calendar"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    @error('time_start')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col text-sm">
                                    <div class="row cus_font-text">
                                        @lang('lang.member_comp')
                                        <span class="text-red-500">*</span>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-sm-6 p-0">
                                            <select class="form-control text-sm" name="member_comp">
                                                <option value="{{config('constant.VALUE_DEFAULT_ONE')}}" {{ $userById->member_company == config('constant.VALUE_DEFAULT_ONE') ? 'selected' : '' }} >Fabbi Ha Noi</option>
                                                <option value="{{config('constant.VALUE_DEFAULT_TWO')}}" {{ $userById->member_company == config('constant.VALUE_DEFAULT_TWO') ? 'selected' : '' }} >Fabbi Japan</option>
                                                <option value="{{config('constant.VALUE_DEFAULT_THREE')}}" {{ $userById->member_company == config('constant.VALUE_DEFAULT_THREE') ? 'selected' : '' }} >Fabbi CRM</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col text-sm">
                                    <div class="row cus_font-text">
                                        @lang('lang.position')
                                        <span class="text-red-500">*</span>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-sm-6 p-0">
                                            <select class="form-control text-sm" name="position">
                                                @foreach($positions as $key => $position)
                                                    <option value="{{$position->id}}" {{ $userById->position_id == $position->id ? 'selected' : '' }} >{{$position->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.division')
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <select class="form-control text-sm" name="dept">
                                        @foreach($departments as $key => $department)
                                            <option value="{{$department->id}}" {{ $userById->department_id == $department->id ? 'selected' : '' }} >{{$department->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col text-sm">
                                    <div class="row cus_font-text">
                                        @lang('lang.location')
                                        <span class="text-red-500">*</span>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-sm-6 p-0">
                                            <select class="form-control text-sm" name="location">
                                                @foreach($roles as $key => $role)
                                                    <option value="{{$role->id}}" {{ $userById->role_id  == $role->id ? 'selected' : '' }} >{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.japanese')
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <select class="form-control text-sm" name="japanese">
                                        <option value="" {{ $userById->japanese == config('constant.VALUE_DEFAULT_NULL') ? 'selected' : '' }}>__chọn__</option>
                                        <option value="{{config('constant.VALUE_DEFAULT_ONE')}}" {{ $userById->japanese == config('constant.VALUE_DEFAULT_ONE') ? 'selected' : '' }} >N1</option>
                                        <option value="{{config('constant.VALUE_DEFAULT_TWO')}}" {{ $userById->japanese == config('constant.VALUE_DEFAULT_TWO') ? 'selected' : '' }} >N2</option>
                                        <option value="{{config('constant.VALUE_DEFAULT_THREE')}}" {{ $userById->japanese == config('constant.VALUE_DEFAULT_THREE') ? 'selected' : '' }} >N3</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row py-8">
                        <div class="col-sm-6">
                            <div class="row header-search__text-date ">
                                <span class="cus_font-text cus_font-size">@lang('lang.other_inf')</span>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.personal_photo')
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <label></label>
                                    <div>
                                        <input type="hidden" name="old_evidence_image" value="{{$userById->avatar}}">
                                        @if(isset($userById->avatar))
                                            <div class="old_image">
                                                <img src="{{asset('storage/avatarUser')}}/{{$userById->avatar}}"
                                                     width="100" height="100">
                                            </div>
                                        @else
                                            <div class="old_image">
                                                <img src="https://ecs.fabbi.io/img/no-image-available.d704bd89.jpg">
                                            </div>
                                        @endif

                                    </div>
                                    <div class="img-holder"></div>
                                    <div class="form-group pt-3">
                                        <input type="file" name="evidence_image"
                                               class="file_upload1 form-control-file">
                                        <span id="file_error"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.gender')
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <select class="form-control text-sm" name="gender">
                                        <option value="{{config('constant.VALUE_DEFAULT_ZERO')}}" {{ $userById->gender == config('constant.VALUE_DEFAULT_ZERO') ? 'selected' : '' }} >@lang('lang.male')</option>
                                        <option value="{{config('constant.VALUE_DEFAULT_ONE')}}" {{ $userById->gender == config('constant.VALUE_DEFAULT_ONE') ? 'selected' : '' }} >@lang('lang.female')</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.nationality')
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <input class="form-control" name="nationality" value="{{$userById->national}}">
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.ethnic')
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <input class="form-control" name="ethnic" value="{{$userById->ethnic}}">
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col text-sm">
                                    <div class="row cus_font-text">
                                        @lang('lang.phone')
                                        <span class="text-red-500">*</span>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-sm-6 p-0">
                                            <input class="form-control" name="phone" value="{{$userById->phone}}">
                                        </div>
                                    </div>
                                    @error('phone')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col text-sm">
                                    <div class="row cus_font-text">
                                        @lang('lang.relative_phone')
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-sm-6 p-0">
                                            <input class="form-control" name="relativePhone" value="{{$userById->relative_phone}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="col-sm-6 pt-[74px]">
                            <div class="row py-3 ">
                                <div class="col text-sm">
                                    <div class="row cus_font-text">
                                        CMND/@lang('lang.passport')
                                        <span class="text-red-500">*</span>
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-sm-6 p-0">
                                            <input class="form-control" name="passport" value="{{$userById->passport}}">
                                        </div>
                                    </div>
                                    @error('passport')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.date_range')
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <section>
                                        <div class="input-group date" id="datepicker">
                                            <input class="form-control bg-white" name="dateRange" value="{{$userById->date_range}}" readonly>
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-white">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </section>
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.place_issue')
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <input class="form-control" name="placeOfIssue" value="{{$userById->place_issue}}">
                                </div>
                            </div>

                            <div class="row py-3 ">
                                <div class="col text-sm">
                                    <div class="row cus_font-text">
                                        Visa (@lang('lang.if'))
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-sm-6 p-0">
                                            <input class="form-control" name="visa" value="{{$userById->visa}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.duration') Visa
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <section>
                                        <div class="input-group date" id="datepicker">
                                            <input class="form-control bg-white" name="duration" value="{{$userById->duration_visa}}" readonly>
                                            <span class="input-group-append">
                                                <span class="input-group-text bg-white">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                            </span>
                                        </div>
                                    </section>
                                </div>
                            </div>

                            <div class="row py-3 ">
                                <div class="col text-sm">
                                    <div class="row cus_font-text">
                                        Link Facebook
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-sm-6 p-0">
                                            <input class="form-control" name="linkFB" value="{{$userById->link_fb}}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row pt-4">
                        <div class="col-4"></div>
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
    </script>
@stop

