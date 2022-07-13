@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('timesheet-list') }}
    </div>
@endsection

<div class="p-6  bg-white border-b border-gray-200">
    <div class="flex justify-between">
        <div class="form-group w-[72px] ">
            <select class="form-control text-sm" id="FormControlSelect" name="paginate" onchange="this.form.submit()">
                @foreach($paginate as $key => $value)
                    @if(app('request')->input('paginate') == $value)
                        @php
                            $select = 'selected';
                        @endphp
                    @else
                        {{$select = ''}}
                    @endif
                    <option value="{{$value}}" {{$select}}>{{$value}}</option>
                @endforeach
            </select>
        </div>
        </form>
        <div class="relative">
            <div class="col-sm- mt-[24px] float-right flex">
                <form action="{{route('check_in')}}" method="post" class="pr-1.5" onsubmit="return handleSubmit(event)">
                    @csrf
                    @if(isset($disabledCheckin->check_in) || isset($disabledCheckin->check_out))
                        @php
                            $disabled = 'disabled';
                        @endphp
                    @else
                        {{$disabled = ''}}
                    @endif
                    <input name="checkin_date" type="hidden" value="{{now()->format('Y-m-d')}}">
                    <button type="submit" class="btn btn-primary cus-btn-style bg-[#c2f2ff]"
                            id="js-btn-checkin" {{$disabled }}>@lang('lang.checkin')</button>
                </form>
                <form action="{{route('check_out')}}" method="post">
                    @csrf
                    <input name="checkout_date" type="hidden" value="{{now()->format('Y-m-d')}}">
                    <button type="submit"
                            class="btn btn-secondary cus-btn-style  bg-[#c5c8cc]">@lang('lang.checkout')</button>
                </form>
            </div>
            <span class="text-sm text-right absolute right-2.5">@lang('lang.showing') {{$data->firstItem()}} @lang('lang.to') {{$data->lastItem()}} @lang('lang.of') {{$dataCount}} @lang('lang.entries')</span>
        </div>

    </div>
    <div class="mt-2 text-sm text-gray-500">
        <div class="row">
            <div class="card mx-auto w-full" style="border-right: none; border-left: none">
                <div>

                </div>
                <table class="table" wire:loading.remove>
                    <thead>
                    <tr class="text-center items-center whitespace-nowrap text-xs">
                        <th scope="col">#</th>
                        <th scope="col">
                            @lang('lang.date')
                            <i class="fa-solid fa-caret-down"></i>
                        </th>
                        <th scope="col">@lang('lang.dayofweek')</th>
                        <th scope="col">@lang('lang.checkin')</th>
                        <th scope="col">@lang('lang.checkout')</th>
                        <th scope="col">@lang('lang.checkin_pay')</th>
                        <th scope="col">@lang('lang.checkout_pay')</th>
                        <th scope="col">@lang('lang.lunch_break_time')</th>
                        <th scope="col">@lang('lang.actual_working_time')</th>
                        <th scope="col">@lang('lang.paid_working_time')</th>
                        <th scope="col">@lang('lang.note')</th>
                        <th scope="col">@lang('lang.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $index => $value)
                        <tr class="text-center @php if($value->created_at->isWeekend()) echo'bg-weekend' @endphp" >
                            <th scope="row">{{$index+1}}</th>
                            <td class="whitespace-nowrap">{{$value->date}}</td>
                            <td class="whitespace-nowrap">{{now()->parse($value->date)->format('l')}}</td>

                            @if($value->check_in !== null)
                                <td>{{ $value->check_in }}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if($value->check_out !== null)
                                <td>{{ $value->check_out }}</td>
                            @else
                                <td>-</td>
                            @endif
                            <td>{{ $value->checkin_pay ? gmdate('H:i',$value->checkin_pay) : '-'}}</td>

                            <td>{{ $value->checkout_pay ? gmdate('H:i',$value->checkout_pay): '-' }}</td>

                            <td>{{ $value->lunch_break_time ? gmdate('H:i',$value->lunch_break_time): '-' }}</td>

                            @if($value->actual_working_time !== null )
                                <td>{{$value->actual_working_time}}</td>
                            @else
                                <td>-</td>
                            @endif

                            @if($value->paid_working_time !== null )
                                <td>{{$value->paid_working_time}}</td>
                            @else
                                <td>-</td>
                            @endif

                            <td>{{ $value->note_check ? $value->note_check : '-' }}</td>

                            <td>
                                <a href="{{ route('get_addtimesheet', $value->id) }}" class="btn btn-outline-primary text-xs">@lang('lang.timekeeping')</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        @if(count($data) > 0 )
            <div class="flex justify-center">
                @php
                    $fromDate ? $fromDate : '';
                    $toDate ? $toDate : '';
                @endphp
                {{ $data->appends([ 'fromDate' => $fromDate,'toDate' => $toDate,'paginate' => app('request')->input('paginate') ])->links("pagination::bootstrap-4") }}
            </div>
        @else
            <div class="flex justify-center">
                Không tìm thấy dữ liệu
            </div>
        @endif
    </div>
</div>
