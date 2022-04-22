@extends('layouts.main')

@section('title','Mail Compose')

@section('content')
    <header class="w-[100%] bg-white h-[56px] px-5 justify-between flex items-center">
        <div>
            <img src="https://ecs.fabbi.io/img/fabbi_logo.031027dd.jpeg" alt="" width="82px" height="35px" class="">
        </div>

        <div class="w-[115px]">
            <select class="form-control w-[112px]" name="" id="">
                <option value="en">Tiếng Anh</option>
                <option value="jp">Tiếng Việt</option>
                <option value="vi">Tiếng Nhật</option>
            </select>
        </div>
    </header>




@endsection
