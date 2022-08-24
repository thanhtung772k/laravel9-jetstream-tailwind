@extends('layouts.main')
@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('add_timesheet-create') }}
    </div>
@endsection
@section('content')
    <div class="nav__sub-header absolute w-full" style="background-color: #fffafa;">
        <!-- Page Heading -->
        <header class=" shadow pt-[120px]">
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8 flex justify-center m-auto">
                <div class="bg-white row relative w-[730px]">
                    <header class="h-[54px] border rounded-t w-full">
                        <label class="add_timesheet-title pt-[0.7rem] pl-6">@lang('client/lang.post_create')</label>
                    </header>
                    <div class="carb-body border rounded-b ">
                        <form action="{{route('update_post', $post->id)}}" method="POST" class="p-6" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <div class="add_timesheet-title">
                                    <label>@lang('client/lang.title') <span class="text-red-500">*</span></label>
                                    <div>
                                        <section>
                                            <div class="input-group date">
                                                <input class="form-control" id="title" name="title" value="{{$post->title}}">
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                @error('timesheet_id')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <div class="pt-4 add_timesheet-title">
                                    <label>@lang('client/lang.slug')</label>
                                    <div>
                                        <section>
                                            <div class="input-group date">
                                                <input class="form-control" id="slug" name="slug" value="{{$post->slug}}">
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                @error('timesheet_id')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <div class="row pt-4 add_timesheet-title">
                                    <div class="col-6">
                                        <label class="">@lang('client/lang.category') <span
                                                    class="text-red-500">*</span></label>
                                        <div>
                                            <select class="form-control text-xs" name="category">
                                                @foreach($categories as $category)
                                                    @if($post->category_id == $category->id)
                                                        @php
                                                            $select = 'selected';
                                                        @endphp
                                                    @else
                                                        {{$select = ''}}
                                                    @endif
                                                    <option value="{{$category->id}}" {{$select}}>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 flex justify-between items-end">
                                        <div>
                                            <label class="switch">
                                                @if($post->status == config('constant.STATUS_PUBLIC'))
                                                    @php
                                                        $checked = 'checked';
                                                    @endphp
                                                @else
                                                    {{$checked = ''}}
                                                @endif
                                                <input type="checkbox" id="togBtn" name="toggleBtn" {{$checked}}>
                                                <div class="slider"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <style>
                                .switch {
                                    position: relative;
                                    display: inline-block;
                                    width: 90px;
                                    height: 36px;
                                }

                                .switch input {
                                    display: none;
                                }

                                .slider {
                                    position: absolute;
                                    cursor: pointer;
                                    top: 0;
                                    left: 0;
                                    right: 0;
                                    bottom: 0;
                                    background-color: #ca2222;
                                    -webkit-transition: .4s;
                                    transition: .4s;
                                    border-radius: 6px;
                                }

                                .slider:before {
                                    position: absolute;
                                    content: "";
                                    height: 34px;
                                    width: 32px;
                                    top: 1px;
                                    left: 1px;
                                    right: 1px;
                                    bottom: 1px;
                                    background-color: white;
                                    transition: 0.4s;
                                    border-radius: 6px;
                                }

                                input:checked + .slider {
                                    background-color: #2ab934;
                                }

                                input:focus + .slider {
                                    box-shadow: 0 0 1px #2196F3;
                                }

                                input:checked + .slider:before {
                                    -webkit-transform: translateX(26px);
                                    -ms-transform: translateX(26px);
                                    transform: translateX(55px);
                                }

                                .slider:after {
                                    content: 'Draff';
                                    color: white;
                                    display: block;
                                    position: absolute;
                                    transform: translate(-10%, -50%);
                                    top: 50%;
                                    left: 50%;
                                    font-size: 10px;
                                    font-family: Verdana, sans-serif;
                                }

                                input:checked + .slider:after {
                                    content: 'Public';
                                    transform: translate(-90%, -50%);
                                }
                            </style>

                            <div>
                                <div class="row pt-4 add_timesheet-title">
                                    <div class="col-6">
                                        <label>@lang('client/lang.img')
                                            <span class="text-red-500">*</span></label>
                                        <div class="form-group">
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
                                            <input type="hidden" name="old_evidence_image" value="{{$post->image}}">
                                            @if(isset($post->image))
                                                <div class="old_image">
                                                    <img src="{{asset('storage/imgPost')}}/{{$post->image}}" width="200" height="auto">
                                                </div>
                                            @else
                                                <div class="old_image">
                                                    <img src="https://ecs.fabbi.io/img/no-image-available.d704bd89.jpg">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="img-holder"></div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="pt-4 add_timesheet-title">
                                    <label>@lang('client/lang.content') <span class="text-red-500">*</span></label>
                                    <div>
                                        <textarea class="form-control min-h-[270px]" name="content" rows="3">{{$post->content}}</textarea>
                                    </div>
                                    @error('reason')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <div class="pt-4 add_timesheet-title">
                                    <label>@lang('client/lang.about_author')</label>
                                    <div>
                                        <textarea class="form-control" name="author" rows="3">{{$author->author_info}}</textarea>
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
    <script src="{{ asset('js/timesheet/post.js') }}"></script>
    <script src="{{ asset('js/timesheet/add-timesheet.js') }}"></script>
@stop
