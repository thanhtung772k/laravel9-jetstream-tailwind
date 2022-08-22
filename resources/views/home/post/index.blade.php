@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('user-list') }}
    </div>
@endsection

<div class="p-6  bg-white border-b border-gray-200">
    <div class="mt-2 text-sm text-gray-500">
        <div class="row">
            <div class="card mx-auto w-full" style="border-right: none; border-left: none">
                <table class="table" wire:loading.remove>
                    <thead>
                    <tr class="text-center items-center whitespace-nowrap text-xs">
                        <th scope="col">#</th>
                        <th scope="col">@lang('client/lang.title')</th>
                        <th scope="col">@lang('client/lang.img')</th>
                        <th scope="col">@lang('client/lang.category')</th>
                        <th scope="col">@lang('client/lang.author')</th>
                        <th scope="col">@lang('client/lang.start_date')</th>
                        <th scope="col">@lang('client/lang.status')</th>
                        <th scope="col">@lang('client/lang.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $index => $post)
                            <tr class="text-center" >
                                <th scope="row">{{$index+1}}</th>

                                <td class=" max-w-[150px]">{{$post->title}}</td>

                                <td class="whitespace-nowrap w-[150px] max-w-[160px]">
                                    <img src="{{asset('storage/imgPost')}}/{{$post->image}}">
                                </td>

                                <td class="whitespace-nowrap">{{$post->categoryName}}</td>

                                <td class="whitespace-nowrap">{{$post->authorName}}</td>

                                <td class="whitespace-nowrap">{{now()->parse($post->created_at)->format('Y-m-d')}}</td>

                                <td class="whitespace-nowrap">
                                    @if($post->status == 0)
                                        Draff
                                    @else
                                        Public
                                    @endif
                                </td>

                                <td class="whitespace-nowrap">
                                    <a href="" class="text-xs btn btn-outline-primary ">@lang('client/lang.detail')</a>
                                    <a href="" class=" text-xs btn btn-outline-info mx-[4px]">@lang('client/lang.update')</a>
                                    <a href="" class="text-xs btn btn-outline-danger ">@lang('client/lang.delete')</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
