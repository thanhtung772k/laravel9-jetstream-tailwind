@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('add_timesheet-waiting_list') }}
    </div>
@endsection

<div class="p-6  bg-white border-b border-gray-200">
    <div class="flex justify-between">
        <div class="form-group w-[72px] ">
            <select class="form-control text-sm" id="FormControlSelect" name="paginate" onchange="this.form.submit()">
                {{--                @foreach($paginate as $key => $value)--}}
                {{--                    @if(app('request')->input('paginate') == $value)--}}
                {{--                        @php--}}
                {{--                            $select = 'selected';--}}
                {{--                        @endphp--}}
                {{--                    @else--}}
                {{--                        {{$select = ''}}--}}
                {{--                    @endif--}}
                {{--                    <option value="{{$value}}" {{$select}}>{{$value}}</option>--}}
                {{--                @endforeach--}}
            </select>
        </div>
        <div class="relative">
            <div class="col-sm- mt-[24px] float-right flex whitespace-nowrap">
                <span class="text-sm text-right absolute right-2.5">@lang('lang.showing') 1 @lang('lang.to') 10 @lang('lang.of') 25 @lang('lang.entries')</span>
            </div>
        </div>


    </div>
    <div class="mt-2 text-sm text-gray-500">
        <div class="row">
            <div class="card mx-auto w-full" style="border-right: none; border-left: none">
                <table class="table" wire:loading.remove>
                    <thead>
                    <tr class="text-center items-center whitespace-nowrap text-xs">
                        <td class="col-sm-1 text-center float-left">
                            <input type="checkbox" class="rounded" id="checkall" name="item[]">
                        </td>
                        <th scope="col">@lang('lang.id')</th>
                        <th scope="col">@lang('lang.name')</th>
                        <th scope="col">@lang('lang.timekeeping')</th>
                        <th scope="col">@lang('lang.checkin')</th>
                        <th scope="col">@lang('lang.checkout')</th>
                        <th scope="col">@lang('lang.reason')</th>
                        <th scope="col">@lang('lang.confirm_info')</th>
                        <th scope="col">@lang('lang.status')</th>
                        <th scope="col">@lang('lang.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($isAdmin->is_admin == 1 )
                            @foreach($dataTimesheetApproval as $value)
                                <tr class="text-center">
                                    <td class="col-sm-1 text-center float-left">
                                        <input type="checkbox" class="rounded" id="checkall" name="item[]">
                                    </td>

                                    <td>{{ $value->user_id }}</td>

                                    @foreach($user as $userName)
                                        @if($userName->id == $value->user_id)
                                            <td> {{ $userName->name }} </td>
                                        @endif
                                    @endforeach
                                    <td class="whitespace-nowrap">{{$value->date}}</td>

                                    <td>{{$value->check_int_request}}</td>

                                    <td>{{$value->check_out_request}}</td>

                                    <td class="max-w-[140px]">{{$value->description}}</td>

                                    <td class="max-w-[240px]">- {{$value->name}}: {{$value->confirmInfo}}</td>

                                    <td class="whitespace-nowrap">
                                        @if($value->status == config('constant.status_wait'))
                                            <span class="text-xs px-1 bg-wait rounded">@lang('lang.not_approved')</span>
                                        @elseif($value->status == config('constant.status_agree'))
                                            <span class="text-xs px-1 bg-accept text-white rounded">@lang('lang.approved')</span>
                                        @else
                                            <span class="text-xs px-1 bg-cancel text-white rounded">@lang('lang.rejected')</span>
                                        @endif
                                    </td>

                                    <td class="min-w-[200px]">
                                        @if($value->status == 0)
                                            <a href="#" class=" text-xs btn btn-outline-info mx-[4px]" data-toggle="modal" data-target="#modalComment({{$value->id}})">@lang('lang.approved')</a>
                                            <a href="{{route('delete_addtimesheet', $value->id)}}" class="text-xs btn btn-outline-danger ">@lang('lang.rejected')</a>
                                        @else
                                            <a href="{{route('detail_addtimesheet', $value->id)}}" class="text-xs btn btn-outline-primary ">@lang('lang.detail')</a>
                                        @endif
                                    </td>
                                </tr>
                                 {{-- Comment admin --}}
                                <form action="" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal fade text-left" id="modalComment({{$value->id}})" tabindex="-1" role="dialog" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">@lang('lang.note')</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <div class="form-group">
                                                            <p><strong>@lang('lang.comment'):</strong></p>
                                                            <textarea class="form-control" name="" rows="3"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="float-right">
                                                        <button type="submit"
                                                                class="btn btn-primary cus-btn-style bg-[#c2f2ff]">
                                                            @lang('lang.save_info')
                                                        </button>
                                                        <button class="btn cus-btn-style bg-[##f8f9fa] cus-border-btn" data-dismiss="modal" aria-label="Close">
                                                            @lang('lang.cancel')
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        @else
                            <div class="flex justify-center">
                                @lang('lang.not_found')
                            </div>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        @if(count($dataTimesheetApproval) > 0 )
            <div class="flex justify-center">
            </div>
        @else
            <div class="flex justify-center">
                @lang('lang.not_found')
            </div>
        @endif
    </div>
</div>
