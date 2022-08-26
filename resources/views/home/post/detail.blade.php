@extends('layouts.main')
@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('project-detail') }}
    </div>
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('css/client/detail.css') }}">
    <div class="nav__sub-header absolute w-full" style="background-color: #fffafa;">
        <!-- Page Heading -->
        <header class=" shadow pt-[120px] p-8">
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8 m-auto">
                <section>
                    <div class="row post-detail-wapper p-0">
                        <div class="col post-detail-wapper__column">
                            <div class="row">
                                <div class="post-detail">
                                    <div class="post-detail__img mb-[40px]">
                                        <img src="{{asset('storage/imgPost')}}/{{$post->image}}" alt="" class="">
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
                                            <img src="https://secure.gravatar.com/avatar/4baf8d27f33c75151b378befcd1ca61f?s=45&d=mm&r=g" alt="">
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
                                    <p>
                                        Struggling to sell one multi-million dollar home currently on the market won’t stop actress
                                        and singer Jennifer Lopez from expanding her property collection. Lopez has reportedly added
                                        to her real estate holdings an eight-plus acre estate in Bel-Air anchored by a multi-level
                                        mansion.
                                    </p>
                                    <p>
                                        The property, complete with a 30-seat screening room, a 100-seat amphitheater and a swimming
                                        pond with sandy beach and outdoor shower, was asking about $40 million, but J. Lo managed to
                                        make it hers for $28 million. As the Bronx native acquires a new home in California, she is
                                        trying to sell a gated compound.
                                    </p>
                                    <p>
                                        Black farmers in the US’s South— faced with continued failure their efforts to run
                                        successful farms their launched a lawsuit claiming that “white racism” is to blame for their
                                        inability to the produce crop yields and on equivalent to that switched seeds.
                                    </p>
                                    <h2>
                                        What Will Be The Next Step to Complete?
                                    </h2>
                                    <p>
                                        The “new ’20s” idea might not work—there were a lot more young people in the United States
                                        then than now; a reprise of the world-changing inventions and discoveries of the 1920s would
                                        be a big surprise to those economists who believe that we have been in an invention dry
                                        spell since the 1970s. In his Businessweek piece, Peter Coy largely agrees, writing, “In all
                                        probability … the U.S. will continue to wrestle with ‘secular
                                    </p>
                                    <div class="my-[30px] text-center">
                                        <div class="post-content__img px-[10px]">
                                            <img src="https://flawlessdigitalagency.com/elior/wp-content/uploads/2021/10/thumb_citydays.jpg"
                                                 alt="">
                                        </div>
                                        <div class="post-content__img px-[10px]">
                                            <img src="https://flawlessdigitalagency.com/elior/wp-content/uploads/2021/10/scene-pinks.jpg"
                                                 alt="">
                                        </div>
                                        <div class="post-content__img px-[10px]">
                                            <img src="https://flawlessdigitalagency.com/elior/wp-content/uploads/2021/10/frances-pic.jpg"
                                                 alt="">
                                        </div>
                                    </div>
                                    <p>
                                        These experts make strong cases, and they satisfy my natural instinct not to go there. But I
                                        remain very interested in the reasons the ’20s appeal to our imagination right now. Of
                                        course, it’s the booze, the sex, and the parties. But it’s also a decade with a very strong
                                        identity—and I think that helps. Writing in the journal American Speech in 1951, Mamie J.
                                        Meredith argued that the ’20s boasted.
                                    </p>
                                    <p>
                                        I’d argue that Meredith’s point about the decade’s exceptionality still holds: How many
                                        other 20th century decades have a nice little permanent descriptor like Roaring? It helps
                                        that most of these are good adjectives, evoking a time you’d probably like to live through
                                        again—but even the slightly dangerous-sounding ones conjure up something specific. That
                                        definiteness offers an appealing sense
                                    </p>
                                    <div class="my-[30px] text-center">
                                        <div class="post-content__img px-[10px]">
                                            <img src='https://flawlessdigitalagency.com/elior/wp-content/uploads/2021/10/winter-leaf.jpg'>
                                        </div>
                                    </div>
                                    <p>
                                        Anyway, let’s get to that fun. A very joyful book to read about the decade is Frederick
                                        Lewis Allen’s Only Yesterday: An Informal History of the 1920s, which Allen—a blueblood
                                        journalist and editor at Harper’s—published in 1931. The book chronicles all of the movement
                                        and motion that makes the decade sexy, and doesn’t seem to miss a fad.
                                    </p>
                                    <p>
                                        The property, complete with a 30-seat screening room, a 100-seat amphitheater and a swimming
                                        pond with sandy beach and outdoor shower, was asking about $40 million, but J. Lo managed to
                                        make it hers for $28 million. As the Bronx native acquires a new home in California, she is
                                        trying to sell a gated compound.
                                    </p>
                                    <blockquote>
                                        <i class="fa-solid fa-quote-left"></i>
                                        <p>
                                            A designer knows he has achieved perfection not when there is nothing left to add, but
                                            when there is nothing left to take away.
                                        </p>
                                    </blockquote>
                                    <p>
                                        Allen is also really good at describing parties—or, at least, the ones the middle class and
                                        upper class attended. The historian wrote about how women taking up smoking had “strewed the
                                        dinner table with their ashes, snatched a puff between the acts, invaded the masculine
                                        sanctity of the club car.
                                    </p>
                                    <h2>
                                        Popular In Human Interest:
                                    </h2>
                                    <ul class="list-disc pl-[19px]">
                                        <li>
                                            <p>
                                                Parents Are Fed Up With Their Kids’ Expensive Berry Habits
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                15 Mother’s Day Gifts for the Burned-Out Mom in Your Life
                                            </p>
                                        </li>
                                        <li>
                                            <p>
                                                Really Though, What Jeans Are in Style Now?
                                            </p>
                                        </li>
                                    </ul>
                                    <p>
                                        Perhaps by remembering the twenties merely as an enchanting series of novelties or the crude
                                        afterthought of a simpler past, we preserve the illusion of our own simple innocence,” mused
                                        historian Paula Fass in the introduction to her book The Damned and the Beautiful: American
                                        Youth in the 1920s.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
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

