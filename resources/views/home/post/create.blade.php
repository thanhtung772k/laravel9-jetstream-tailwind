@extends('layouts.main')
@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('add_timesheet-create') }}
    </div>
@endsection
@push('css')
    <link rel="stylesheet" href="{{ asset('css/timesheet/post.css') }}">
@endpush
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
                        <form action="{{route('insert_post')}}" method="POST" class="p-6" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <div class="add_timesheet-title">
                                    <label>@lang('client/lang.title') <span class="text-red-500">*</span></label>
                                    <div>
                                        <section>
                                            <div class="input-group date">
                                                <input class="form-control" id="title" name="title" value="">
                                            </div>
                                        </section>
                                    </div>
                                </div>
                                @error('title')
                                <div class="text-red-500">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <div class="pt-4 add_timesheet-title">
                                    <label>@lang('client/lang.slug')</label>
                                    <div>
                                        <section>
                                            <div class="input-group date">
                                                <input class="form-control" id="slug" name="slug" value="">
                                            </div>
                                        </section>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="row pt-4 add_timesheet-title">
                                    <div class="col-6">
                                        <label class="">@lang('client/lang.category') <span
                                                    class="text-red-500">*</span></label>
                                        <div>
                                            <select class="form-control text-xs" name="category">
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-6 flex justify-between items-end">
                                        <div>
                                            <label class="switch">
                                                <input type="checkbox" id="togBtn" name="toggleBtn">
                                                <div class="slider"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                            <div class="old_image">
                                                <img src="https://ecs.fabbi.io/img/no-image-available.d704bd89.jpg"
                                                     width="100" height="100">
                                            </div>
                                        </div>
                                        <div class="img-holder"></div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <div class="pt-4 add_timesheet-title">
                                    <label>@lang('client/lang.about_author')</label>
                                    <div>
                                        <textarea class="form-control" name="author" rows="3">{{isset($author->author_info) ? $author->author_info : ''}}</textarea>
                                    </div>
                                    @error('reason')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div>
                                <div class="pt-4 add_timesheet-title">
                                    <label>@lang('lang.description')</label>
                                    <div>
                                        <textarea class="form-control" name="description" rows="3"></textarea>
                                    </div>
                                    @error('description')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="">
                                <div class="pt-4 add_timesheet-title">
                                    <label>@lang('client/lang.content') <span class="text-red-500">*</span></label>
                                    <div id="container" class=" w-full">
                                        <textarea class="form-control min-h-[270px]" id="editor" name="content"></textarea>
                                    </div>
                                    @error('reason')
                                    <div class="text-red-500">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <input id="routeToken" type="hidden" value="{{ route('ckeditor.upload').'?_token='.csrf_token() }}" >
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
    <script src="https://cdn.ckeditor.com/ckeditor5/35.0.1/classic/ckeditor.js"></script>
@stop
