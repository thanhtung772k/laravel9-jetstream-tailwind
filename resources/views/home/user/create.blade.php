@extends('layouts.main')
@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('user-create') }}
    </div>
@endsection
@section('content')

    <div class="nav__sub-header absolute w-full" style="background-color: #fffafa;">
        <!-- Page Heading -->
        <header class=" shadow pt-[120px] p-8">
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8 m-auto">
                <form action="{{route('insert_user')}}" method="post" enctype="multipart/form-data">
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
                                            <input class="form-control" name="user_id" value="{{old('user_id')}}">
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
                                            <input class="form-control" name="email" value="{{old('email')}}">
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
                                            <input class="form-control" name="name" value="{{old('name')}}">
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
                                                    <input class="form-control bg-white" name="date_of_birth" value="{{old('date_of_birth')}}" readonly>
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
                                    <input class="form-control" name="homeTown" value="{{old('homeTown')}}">
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.current_residence')
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <input class="form-control" name="currentResidence" value="{{old('currentResidence')}}">
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.university')
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <input class="form-control" name="university" value="{{old('university')}}">
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
                                        <option value="{{config('constant.VALUE_DEFAULT_ONE')}}" {{ old('workForm') == config('constant.VALUE_DEFAULT_ONE') ? 'selected' : '' }} >Full time</option>
                                        <option value="{{config('constant.VALUE_DEFAULT_TWO')}}" {{ old('workForm') == config('constant.VALUE_DEFAULT_TWO') ? 'selected' : '' }} >Partime</option>
                                        <option value="{{config('constant.VALUE_DEFAULT_THREE')}}" {{ old('workForm') == config('constant.VALUE_DEFAULT_THREE') ? 'selected' : '' }} >Remote</option>
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
                                                    <input class="form-control bg-white" name="time_start" value="{{old('time_start')}}" readonly>
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
                                                <option value="{{config('constant.VALUE_DEFAULT_ONE')}}" {{ old('member_comp') == config('constant.VALUE_DEFAULT_ONE') ? 'selected' : '' }} >Fabbi Ha Noi</option>
                                                <option value="{{config('constant.VALUE_DEFAULT_TWO')}}" {{ old('member_comp') == config('constant.VALUE_DEFAULT_TWO') ? 'selected' : '' }} >Fabbi Japan</option>
                                                <option value="{{config('constant.VALUE_DEFAULT_THREE')}}" {{ old('member_comp') == config('constant.VALUE_DEFAULT_THREE') ? 'selected' : '' }} >Fabbi CRM</option>
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
                                                    <option value="{{$position->id}}" {{ old('position') == $position->id ? 'selected' : '' }} >{{$position->name}}</option>
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
                                            <option value="{{$department->id}}" {{ old('dept') == $department->id ? 'selected' : '' }} >{{$department->name}}</option>
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
                                                    <option value="{{$role->id}}" {{ old('location') == $role->id ? 'selected' : '' }} >{{$role->name}}</option>
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
                                        <option value="">__chọn__</option>
                                        <option value="{{config('constant.VALUE_DEFAULT_ONE')}}" {{ old('japanese') == config('constant.VALUE_DEFAULT_ONE') ? 'selected' : '' }} >N1</option>
                                        <option value="{{config('constant.VALUE_DEFAULT_TWO')}}" {{ old('japanese') == config('constant.VALUE_DEFAULT_TWO') ? 'selected' : '' }} >N2</option>
                                        <option value="{{config('constant.VALUE_DEFAULT_THREE')}}" {{ old('japanese') == config('constant.VALUE_DEFAULT_THREE') ? 'selected' : '' }} >N3</option>
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
                                        <div class="old_image">
                                            <img src="https://ecs.fabbi.io/img/no-image-available.d704bd89.jpg"
                                                 width="100" height="100">
                                        </div>
                                    </div>
                                    <div class="img-holder"></div>
                                    <div class="form-group pt-3">
                                        <input type="file" name="evidence_image"
                                               class="file_upload1 form-control-file">
                                        <span id="file_error"></span>
                                    </div>
                                    @error('evidence_image')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
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
                                        <option value="{{config('constant.VALUE_DEFAULT_ZERO')}}" {{ old('gender') == config('constant.VALUE_DEFAULT_ZERO') ? 'selected' : '' }} >@lang('lang.male')</option>
                                        <option value="{{config('constant.VALUE_DEFAULT_ONE')}}" {{ old('gender') == config('constant.VALUE_DEFAULT_ONE') ? 'selected' : '' }} >@lang('lang.female')</option>
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
                                    <input class="form-control" name="nationality" value="{{old('nationality')}}">
                                </div>
                            </div>

                            <div class="row py-3">
                                <div class="col-sm-3 text-sm flex items-center">
                                    <div class="row cus_font-text">
                                        @lang('lang.ethnic')
                                    </div>
                                </div>
                                <div class="col-sm-7 text-sm">
                                    <input class="form-control" name="ethnic" value="{{old('ethnic')}}">
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
                                            <input class="form-control" name="phone" value="{{old('phone')}}">
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
                                            <input class="form-control" name="relativePhone" value="{{old('relativePhone')}}">
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
                                            <input class="form-control" name="passport" value="{{old('passport')}}">
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
                                            <input class="form-control bg-white" name="dateRange" value="{{old('dateRange')}}" readonly>
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
                                    <input class="form-control" name="placeOfIssue" value="{{old('placeOfIssue')}}">
                                </div>
                            </div>

                            <div class="row py-3 ">
                                <div class="col text-sm">
                                    <div class="row cus_font-text">
                                        Visa (@lang('lang.if'))
                                    </div>
                                    <div class="row pt-2">
                                        <div class="col-sm-6 p-0">
                                            <input class="form-control" name="visa" value="{{old('visa')}}">
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
                                            <input class="form-control bg-white" name="duration" value="{{old('duration')}}" readonly>
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
                                            <input class="form-control" name="linkFB" value="{{old('linkFB')}}">
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
