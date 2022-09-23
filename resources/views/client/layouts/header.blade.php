<header class="pt-6">
    <div class="theme-header-area mb-5 mt-[20px]">
        <div class="container">
            <div class="row items-center">
                <div class="col-lg-3 flex justify-between">
                    <div class="logo theme-logo text-left">
                        <a href="{{route('client.index')}}" class="font-bold text-4xl hover:no-underline text-[#0056b3]">
                            <h1 class="text-logo flex items-center">
                                    <img src="https://inkythuatso.com/uploads/thumbnails/800/2021/12/logo-epu-inkythuatso-14-15-47-22.jpg" alt="" class="h-24">
                                    EPU
                            </h1>
                        </a>
                    </div>
                    <div class="reposive-header-icon-search text-[30px] hidden">
                        <a href="#" class="menu-item pr-6">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>
                    <div class="mobile-menu-btn text-[30px]">
                        <i class="fa-solid fa-bars"></i>
                    </div>
                </div>
                <div class="col-lg-6 nav-design-two">
                    <div class="nav-menu-wrapper-two">
                            <div class="mainmenu">
                                <div class="menu-main-menu-container m-0 p-0">
                                    <ul id="primary-menu" class="menu justify-between">
                                        <li class="menu-item relative" id="home">
                                            <span>
                                                Home
                                                <i class="fa-solid fa-angle-down text-xs"></i>
                                            </span>
                                        </li>
                                        <li class="menu-item relative">
                                            <span>
                                                Category
                                                <i class="fa-solid fa-angle-down text-xs"></i>
                                            </span>
                                            <ul class="sub-menu hidden">
                                                @foreach($categories as $category)
                                                    <li class=" pb-2.5"><a href="{{route('client.category_post', $category->slug)}}" aria-current="page">{{$category->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="menu-item relative">
                                            <span>
                                                Features
                                                <i class="fa-solid fa-angle-down text-xs"></i>
                                            </span>
                                            <ul class="sub-menu hidden">
                                                <li class=" pb-2.5"><a href="https://flawlessdigitalagency.com/elior/" aria-current="page">Home Blog Slider</a></li>
                                                <li class=" pb-2.5"><a href="https://flawlessdigitalagency.com/elior/home-two/">Home Blog Carousel</a></li>
                                                <li class=" pb-2.5"><a href="https://flawlessdigitalagency.com/elior/home-three/">Home Grid : 2 Columns</a></li>
                                                <li class=" pb-2.5"><a href="https://flawlessdigitalagency.com/elior/home-four/">Home Grid : 3 Columns</a></li>
                                                <li class=""><a href="https://flawlessdigitalagency.com/elior/home-five/">Home Grid : 4 Columns</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item relative">
                                            <span>Lifestyle</span>
                                        </li>
                                        <li class="menu-item relative">
                                            <span>
                                                Shop
                                                <i class="fa-solid fa-angle-down text-xs"></i>
                                            </span>
                                            <ul class="sub-menu hidden">
                                                <li class=" pb-2.5"><a href="https://flawlessdigitalagency.com/elior/" aria-current="page">Home Blog Slider</a></li>
                                                <li class=" pb-2.5"><a href="https://flawlessdigitalagency.com/elior/home-two/">Home Blog Carousel</a></li>
                                                <li class=" pb-2.5"><a href="https://flawlessdigitalagency.com/elior/home-three/">Home Grid : 2 Columns</a></li>
                                                <li class=" pb-2.5"><a href="https://flawlessdigitalagency.com/elior/home-four/">Home Grid : 3 Columns</a></li>
                                                <li class=""><a href="https://flawlessdigitalagency.com/elior/home-five/">Home Grid : 4 Columns</a></li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 flex justify-end items-center">
                    <div class="header-icon-search text-[19px]">
                        <a href="#" class="menu-item pr-6">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>

                    <div class="bg-[#FF4063] text-[17px] text-white w-[150px] h-[50px] rounded-[50px] header-login transition duration-300 flex justify-center items-center">
                        <a href="{{route('login')}}" class="transition duration-300">
                            <i class="fa-solid fa-right-to-bracket pr-1.5"></i>
                            <span>
                                 @lang('lang.login')
                            </span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>
