@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('add_timesheet-list') }}
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
                        <th scope="col">#</th>
                        <th scope="col">@lang('lang.add_date')</th>
                        <th scope="col">@lang('lang.checkin_real')</th>
                        <th scope="col">@lang('lang.checkout_real')</th>
                        <th scope="col">@lang('lang.checkin_request')</th>
                        <th scope="col">@lang('lang.checkout_request')</th>
                        <th scope="col">@lang('lang.reason')</th>
                        <th scope="col">@lang('lang.confirm_info')</th>
                        <th scope="col">@lang('lang.status')</th>
                        <th scope="col">@lang('lang.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($dataAddTimesheet as $index => $value)
                        @if($value !== null)
                            <tr class="text-center">
                                <th scope="row">{{$index+1}}</th>

                                <td class="whitespace-nowrap">{{$value->date}}</td>

                                <td class="whitespace-nowrap">{{$value->check_in_real ? $value->check_in_real : '-'}}</td>

                                <td>{{$value->check_out_real ? $value->check_out_real : '-'}}</td>

                                <td>{{$value->check_int_request ? $value->check_int_request : '-'}}</td>

                                <td>{{$value->check_out_request ? $value->check_out_request : '-'}}</td>

                                <td class="max-w-[70px]">{{$value->description ? $value->description : '-'}}</td>

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

                                <td class="row min-w-[200px]">
                                    @if($value->status == 0)
                                        <a href="{{route('detail_addtimesheet', $value->id)}}" class="text-xs btn btn-outline-primary ">@lang('lang.detail')</a>
                                        <a href="{{route('edit_addtimesheet', $value->id)}}" class=" text-xs btn btn-outline-info mx-[4px]">@lang('lang.edit')</a>
                                        <a href="{{route('delete_addtimesheet', $value->id)}}" class="text-xs btn btn-outline-danger ">@lang('lang.delete')</a>
                                    @else
                                        <a href="{{route('detail_addtimesheet', $value->id)}}" class="text-xs btn btn-outline-primary">@lang('lang.detail')</a>
                                    @endif
                                </td>
                            </tr>
                        @endif
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
            @if(count($dataAddTimesheet) > 0 )
                <div class="flex justify-center">
                   </div>
            @else
            <div class="flex justify-center">
                @lang('lang.not_found')
            </div>
            @endif

    </div>
</div>
