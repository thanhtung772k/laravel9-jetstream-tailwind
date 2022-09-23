<?php
/** @see \App\Http\Livewire\HomeComponent */
?><section class="elementor-section">
    <div class="elementor-container">
        <div class="elementor-column">
            <div class="elementor-widget-wrap">
                <div class="elementor-element">
                    <div class="elementor-widget-container">
                        <div class="theme_post_grid__Slider">
                            <img class="theme-post__banner"
                                 src="https://flawlessdigitalagency.com/elior/wp-content/uploads/2021/10/thumb-philippines.jpg"
                                 style="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="flex justify-center mb-5 mt-[100px]" wire:loading.remove>
    <div class="max-w-[1170px] w-full">
        <div class="row post">
            <div class="col-8 post-list-wapper">
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col-lg-6 post-list-content">
                            <div class="post-grid-wrapper mb-[40px]">
                                <div class="post-gridthumbnail">
                                    <a href="{{route('client.detail_post',$post->slug)}}">
                                        <img src="{{asset('storage/imgPost')}}/{{$post->image}}" alt=""
                                             class="post-gridthumbnail__img w-full h-[294px] rounded-3xl object-cover">
                                    </a>
                                    <div class="grid-two-meta flex">
                                        <div class="grid-two-meta__comment">
                                            <i class="fa-solid fa-comment"></i>
                                            <span class="font-medium">{{$post->count}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-grid-content">
                                    <div class="mt-[30px] mb-[13px]">
                                        <div class="post-grid-content__btn category-box text-white w-[128px] h-[40px] rounded-[12px] bg-[#ff40631a] flex justify-center items-center text-[16px] font-medium">
                                            <a href="{{route('client.category_post', $post->categorySlug)}}"
                                               class="category-box">
                                                <i class="fa-solid fa-tag rotate-90"></i>
                                                {{$post->categoryName}}
                                            </a>
                                        </div>
                                    </div>
                                    <h3 class="post-grid-content__title">
{{--                                        href="{{route('client.detail_post',$post->slug)}}"--}}
                                        <button class="hover:no-underline hover:text-[#FF4063]" wire:click="getSlug({{ $post->slug}})">{{$post->title}}</button>
                                    </h3>
                                    <div class="post-excerpt-box">
                                        <p>{{$post->description}}</p>
                                    </div>
                                    <div class="post-author flex">
                                        <div class="post-author-img">
                                            @if(isset($post->avatarUser))
                                                <img src="{{asset('storage/avatarUser')}}/{{$post->avatarUser}}"
                                                     alt="" loading="lazy">
                                            @else
                                                <img src="{{asset('upload/default.jpg')}}" alt="">
                                            @endif
                                        </div>
                                        <div class="post-author-name">
                                            <h4 class="post-author-name__title">
                                                <a href=""
                                                   class="hover:no-underline hover:text-[#2B2B2B]">{{$post->authorName}}</a>
                                            </h4>
                                            <span class="post-author-name__date">{{now()->parse($post->created_at)->isoFormat('MMMM D, Y')}}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-4 post-popular-wapper">
                <div class="mb-[32px]">
                    <div class="leading-none font-extrabold text-[24px] mb-[15px] widget-title">New Posts</div>
                    @foreach($newPosts as $newPost)
                        <div class="post-popular ">
                            <div class="mr-[12px]">
                                <a href="{{route('client.detail_post',$newPost->slug)}}">
                                    <img class="post-popular__img"
                                         style="min-width: 75px; max-width: 72px; height: 72px"
                                         src="{{asset('storage/imgPost')}}/{{$newPost->image}}" alt="">
                                </a>
                            </div>
                            <div>
                                <div class="post-popular__title">
                                    <a class="hover:no-underline hover:text-[#FF4063]"
                                       href="{{route('client.detail_post',$newPost->slug)}}">{{$newPost->title}}</a>
                                </div>
                                <div class="post-popular__date">
                                    <i class="fa-solid fa-clock text-[#FF4063] text-[13px]"></i>
                                    <span>{{now()->parse($newPost->created_at)->isoFormat('MMMM D, Y')}}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="leading-none font-extrabold text-[24px] mb-[15px] widget-title-2">Popular Posts</div>
                @foreach($popularPosts as $popularPost)
                    <div class="post-popular">
                        <div class="mr-[12px]">
                            <a href="{{route('client.detail_post',$popularPost->post->slug)}}">
                                <img class="post-popular__img" style="min-width: 75px; max-width: 72px; height: 72px"
                                     src="{{asset('storage/imgPost')}}/{{$popularPost->post->image}}" alt="">
                            </a>
                        </div>
                        <div>
                            <div class="post-popular__title">
                                <a class="hover:no-underline hover:text-[#FF4063]"
                                   href="{{route('client.detail_post',$popularPost->post->slug)}}">{{$popularPost->post->title}}</a>
                            </div>
                            <div class="post-popular__date">
                                <i class="fa-solid fa-clock text-[#FF4063] text-[13px]"></i>
                                <span>{{now()->parse($popularPost->post->created_at)->isoFormat('MMMM D, Y')}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
</section>





