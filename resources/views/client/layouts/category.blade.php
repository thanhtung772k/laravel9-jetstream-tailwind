@extends('client.layouts.main')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/client/detail.css') }}">
    <section>
        <div class="row mb-[100px] post-detail-banner">
            <div class="col-12 theme-breacrumb-title pl-0 bg-[#f9f9f9] rounded-[24px]">
                <label class="text-[45px] font-bold mb-[20px] py-[45px] pl-[30px]" for="Search">Category :
                    {{$category->name}}</label>
            </div>
        </div>
        <div class="row post-detail-wapper">
            <div class="col-7 post-detail-wapper__column">
                @foreach($posts as $post)
                    <div class="row mb-[100px]">
                        <div class="post-detail">
                            <div class="post-detail__img mb-[40px]">
                                <img src="{{asset('storage/imgPost')}}/{{$post->image}}" alt=""
                                     class="post-gridthumbnail__img w-full max-h-[294px] rounded-3xl object-cover">
                            </div>
                            <div class="post-detail__tag w-[160px] bg-[#ffecef] rounded-[14px]  py-[16px] px-[33px] text-[18px]">
                                <a href="" class="">
                                    <i class="fa-solid fa-tag rotate-90"></i>
                                    {{$post->categoryName}}
                                </a>
                            </div>
                            <div class="post-detail__title pt-2">
                                <h1>{{$post->title}}</h1>
                            </div>
                            <div class="post-detail__author mt-[25px] mb-[30px] flex items-start">
                                <div class="post-detail__author-img">
                                    @if(isset($post->avatarUser))
                                        <img src="{{asset('storage/avatarUser')}}/{{$post->avatarUser}}"
                                             alt="" loading="lazy">
                                    @else
                                        <img src="{{asset('upload/default.jpg')}}" alt="">
                                    @endif
                                </div>
                                <div class="post-detail__author-content ml-[18px] mt-[10px]">
                                    <div class="post-detail__author-name">
                                        <span>{{$post->authorName}}</span>
                                    </div>
                                    <div class="post-detail__author-date">
                                        <span>{{now()->parse($post->created_at)->isoFormat('MMMM D, Y')}}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="post-detail__continue">
                                <p>
                                    {{$post->description}}
                                </p>
                                <div class="continue-hover text-[#8f8f8f]">
                                    <a href="{{route('client.detail_post',$post->slug)}}" class="font-semibold text-2xl">
                                        Continue Reading
                                        <i class="fa-solid fa-arrow-right text-[#FF4063] text-[20px]"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
            <div class="col-5 post-category-wapper">
                <div class="pl-[70px] post-category">
                    <form class="row">
                        <div class="col-md-12">
                            <label class="text-[30px] font-semibold mb-[20px]" for="Search">Search</label>
                        </div>
                        <div class="row col-md-12 ">
                            <div class="col-md-9 py-[10px]">
                                <input class="form-control py-3 rounded-[14px]" name="form_name">
                            </div>
                            <div class="col-md-3 py-[10px]">
                                <input type="submit"
                                       class="bg-[#FF4063] flex justify-center w-full py-[16px] px-[23px] rounded-[14px] text-white hover:bg-[#279EFF] hover:cursor-pointer"
                                       value="Search">
                            </div>
                        </div>
                    </form>
                    <div class="row mt-[47px]">
                        <div class="col-md-12">
                            <label class="text-[30px] font-semibold mb-[20px]" for="Search">Categories</label>
                        </div>
                        <div class="col-md-12">
                            <ul class="category-menu">
                                @foreach($categories as $category)
                                    <li class="flex justify-between mb-[16px]">
                                        <a href="" class="font-semibold text-xl">{{$category->name}}</a>
                                        <span class="h-[35px] bg-[#FF4063] text-white w-[40px] mr-[30px] leading-[35px] text-center text-[20px] rounded-xl">{{$category->posts_count}}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-[35px]">
                        <div class="row col-md-12">
                            <div class="col-md-12">
                                <img src="https://flawlessdigitalagency.com/elior/wp-content/uploads/2022/02/ads-design.png"
                                     alt="" height="353" width="100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
@stop
