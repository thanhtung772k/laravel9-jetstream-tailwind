<div class="p-6  bg-white border-b border-gray-200">
    <div class="flex justify-between">

        <div class="form-group w-[72px] ">
            <select class="form-control text-sm" id="exampleFormControlSelect1">
                <option>10</option>
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>
        <div class="relative">
            <div class="col-sm- mt-[24px] float-right flex">
                <form action="{{route('check_in')}}" method="post" class="pr-1.5">
                    @csrf
{{--                    {{now('Asia/Ho_Chi_Minh')->format('H:i:s')}}--}}
                    <input name="checkin_date" type="hidden" value="{{now('Asia/Ho_Chi_Minh')->format('Y-m-d')}}">
                    <input name="checkin_hour" type="hidden" value="06:00:00">
                    <button type="submit" class="btn btn-primary cus-btn-style bg-[#c2f2ff]" id="js-btn-checkin">@lang('lang.checkin')</button>
                </form>
                <form action="{{route('check_out')}}" method="post">
                    @csrf
                        <input name="checkout_date" type="text" value="{{now('Asia/Ho_Chi_Minh')->format('Y-m-d')}}">
                        <input name="checkout_hour" type="text" value="07:00:00">
                    <button type="submit" class="btn btn-secondary cus-btn-style bg-[#c5c8cc]">@lang('lang.checkout')</button>
                </form>
            </div>
            <span class="text-sm text-right absolute right-2.5">Hiển thị 1 đến 10 của 25 bản ghi</span>
        </div>



    </div>
    <div class="mt-2 text-sm text-gray-500">
        <div class="row">
            <div class="card  mx-auto" style="border-right: none; border-left: none">
                <div>

                </div>
                <table class="table" wire:loading.remove>
                    <thead>
                    <tr class="text-center items-center">
                        <th scope="col">#</th>
                        <th scope="col">@lang('lang.date')</th>
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
                        <tr class="text-center">
                            <th scope="row">{{$index+1}}</th>
                            <td class="whitespace-nowrap">{{$value->date}}</td>
                            <td class="whitespace-nowrap">{{now()->parse($value->date)->format('l')}}</td>
                            @if($value->check_in != null)
                                <td>{{ $value->check_in }}</td>
                            @else
                                <td>-</td>
                            @endif
                            @if($value->check_out != null)
                                <td>{{ $value->check_out }}</td>
                            @else
                                <td>-</td>
                            @endif
                            @if($value->check_out != null && $value->check_in != null)
                                @php
                                    $in = explode(":", $value->check_in );
                                    $sumIn = $in[0] * 3600 + $in[1] * 60 + $in[2];
                                    if((8*3600 - $sumIn) > 0)
                                        $sumIn= 8*3600;
                                    if(12*3600 <= $sumIn && $sumIn <= (13 * 3600 + 30 * 60))
                                        $sumIn= 13 * 3600 + 30 * 60;
                                    $sumIn=gmdate('H:i:s',$sumIn);
                                @endphp
                                <td>{{$sumIn}}</td>
                            @else
                                <td>-</td>
                            @endif
                            @if($value->check_out != null && $value->check_in != null)
                                <td>08:00</td>
                            @else
                                <td>-</td>
                            @endif
                            @if(isset($value->check_out) && isset($value->check_in) && now()->parse($value->check_out)->diffInHours(now()->parse($value->check_in)) > 4)
                                <td>01:30</td>
                            @else
                                <td>-</td>
                            @endif
                            @if($value->actual_working_time != null )
                                <td>{{$value->actual_working_time}}</td>
                            @else
                                <td>-</td>
                            @endif
                            @if($value->paid_working_time != null )
                                <td>{{$value->paid_working_time}}</td>
                            @else
                                <td>-</td>
                            @endif
                            <td>{{$value->note}}</td>
                            <td>
                                <button type="button" class="btn btn-outline-primary text-xs">@lang('lang.timekeeping')</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        @if(count($data) > 0 )
            <div class="flex justify-center">
                {{ $data->links("pagination::bootstrap-4")}}
            </div>
        @else
            <div class="flex justify-center">
                Không tìm thấy dữ liệu
            </div>
        @endif
    </div>
</div>
