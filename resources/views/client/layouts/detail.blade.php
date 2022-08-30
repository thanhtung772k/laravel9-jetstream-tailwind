@extends('client.layouts.main')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/client/detail.css') }}">
    <section>
        <div class="row post-detail-wapper p-0">
            <div class="col-7 post-detail-wapper__column">
                <div class="row">
                    <div class="post-detail w-full">
                        <div class="post-detail__img mb-[40px]">
                            <img src="https://flawlessdigitalagency.com/elior/wp-content/uploads/2021/07/lake-scene-770x470.jpg"
                                 alt="" class="">
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
                        <div class="post-detail__author mt-[25px] mb-[50px] flex items-start">
                            <div class="post-detail__author-img">
                                @if(isset($post->avatarUser))
                                    <img src="{{asset('storage/avatarUser')}}/{{$post->avatarUser}}" alt="" loading="lazy">
                                @else
                                    <img src="{{asset('storage/avatarUser/default.jpg')}}" alt="">
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
                    </div>
                </div>
                <div class="row">
                    <div class="post-content w-full">
                        {!!$post->content!!}
                    </div>
                </div>

                <div class="row bg-[#f9f9f9] mt-[60px] rounded-[24px] post-comment-wapper">
                    <div class="post-comment p-[30px] w-full">
                        <div class="post-detail__about flex items-start">
                            <div class="post-detail__about-author">
                                @if(isset($post->avatarUser))
                                    <img src="{{asset('storage/avatarUser')}}/{{$post->avatarUser}}" alt="" loading="lazy">
                                @else
                                    <img src="{{asset('storage/avatarUser/default.jpg')}}" alt="">
                                @endif
                            </div>
                            <div class="post-detail__author-content ml-[18px] mt-[10px]">
                                <div class="post-detail__about-title ">
                                    <span>About Author</span>
                                </div>
                                <div class="post-detail__author-name mb-[6px]">
                                    <span class="text-[24px]">{{$post->authorName}}</span>
                                </div>
                                <div class="post-detail__about-title">
                                    <span class="text-[20px]">{{$post->info}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row bg-[#f9f9f9] mt-[60px] rounded-[24px] post-comment-wapper">
                    <div class="post-comment p-[30px] w-full">
                        <header>
                            <div class="post-comment__title">
                                <p>1 Comment</p>
                            </div>
                            <ul class="post-comment__list w-full pt-[22px]">
                                <img class="float-left"
                                     src="https://secure.gravatar.com/avatar/4baf8d27f33c75151b378befcd1ca61f?s=60&d=mm&r=g"
                                     alt="">
                                <li class="post-comment__list-content">
                                    <div class="border-author">
                                        <div class="flex justify-between">
                                            <div class="line-hight-cus">
                                                <div class="post-comment__list-name">Thor Odinson</div>
                                                <div class="post-comment__list-date">MARCH 12, 2022 AT 4:30 AM</div>
                                            </div>
                                            <div class="post-comment__list-replyBtn">
                                                <span class="">REPLY</span>
                                            </div>
                                        </div>
                                        <div class="line-hight-cus pb-2.5">
                                            <span>
                                                Hello, guys..This is a test comment!
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <ul class="post-comment__list w-full pt-[22px]">
                                <img class="float-left"
                                     src="https://secure.gravatar.com/avatar/4baf8d27f33c75151b378befcd1ca61f?s=60&d=mm&r=g"
                                     alt="">
                                <li class="post-comment__list-content">
                                    <div class="border-author">
                                        <div class="flex justify-between">
                                            <div class="line-hight-cus">
                                                <div class="post-comment__list-name">Thor Odinson</div>
                                                <div class="post-comment__list-date">MARCH 12, 2022 AT 4:30 AM</div>
                                            </div>
                                            <div class="post-comment__list-replyBtn">
                                                <span class="">REPLY</span>
                                            </div>
                                        </div>
                                        <div class="line-hight-cus pb-2.5">
                                            <span>
                                                Hello, guys..This is a test comment! uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!uys..This is a test comment!
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <ul class="post-comment__list w-full pt-[22px]">
                                <img class="float-left"
                                     src="https://secure.gravatar.com/avatar/4baf8d27f33c75151b378befcd1ca61f?s=60&d=mm&r=g"
                                     alt="">
                                <li class="post-comment__list-content">
                                    <div class="border-author">
                                        <div class="flex justify-between">
                                            <div class="line-hight-cus">
                                                <div class="post-comment__list-name">Thor Odinson</div>
                                                <div class="post-comment__list-date">MARCH 12, 2022 AT 4:30 AM</div>
                                            </div>
                                            <div class="post-comment__list-replyBtn">
                                                <span class="">REPLY</span>
                                            </div>
                                        </div>
                                        <div class="line-hight-cus pb-2.5">
                                            <span>
                                                Hello, guys..This is a test comment!
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>

                            <ul class="post-comment__list w-full pt-[22px]">
                                <img class="float-left"
                                     src="https://secure.gravatar.com/avatar/4baf8d27f33c75151b378befcd1ca61f?s=60&d=mm&r=g"
                                     alt="">
                                <li class="post-comment__list-content">
                                    <div class="border-author">
                                        <div class="flex justify-between">
                                            <div class="line-hight-cus">
                                                <div class="post-comment__list-name">Thor Odinson</div>
                                                <div class="post-comment__list-date">MARCH 12, 2022 AT 4:30 AM</div>
                                            </div>
                                            <div class="post-comment__list-replyBtn">
                                                <span class="">REPLY</span>
                                            </div>
                                        </div>
                                        <div class="line-hight-cus pb-2.5">
                                            <span>
                                                Hello, guys..This is a test comment!
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </header>
                        <form action="" class="pt-[22px]">
                            <div class="post-comment__title">
                                <p>Leave a Reply</p>
                            </div>
                            <div class="py-[20px] row">
                                <div class="col-md-6 py-[10px]">
                                    <input class="form-control py-3.5" name="form_name">
                                </div>
                                <div class="col-md-6 py-[10px]">
                                    <input class="form-control py-3.5" name="form_email">
                                </div>
                            </div>
                            <div class="row py-[10px]">
                                <div class="col-md-12">
                                    <input class="form-control py-3.5" name="form_website">
                                </div>
                            </div>
                            <div class="row py-[10px]">
                                <div class="col-md-12">
                                    <textarea class="form-control h-[245px] rounded-3xl" name="description" placeholder="Enter Comments"></textarea>
                                </div>
                            </div>
                            <div class="row py-[10px]">
                                <div class="col-md-12">
                                    <input type="submit" class="bg-[#FF4063] w-full py-[16px] px-[28px] rounded-3xl text-white hover:bg-[#279EFF] hover:cursor-pointer" value="Post Comment">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
                                <input type="submit" class="bg-[#FF4063] flex justify-center w-full py-[16px] px-[23px] rounded-[14px] text-white hover:bg-[#279EFF] hover:cursor-pointer" value="Search">
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
                                <img src="https://flawlessdigitalagency.com/elior/wp-content/uploads/2022/02/ads-design.png" alt="" height="353" width="100%">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
