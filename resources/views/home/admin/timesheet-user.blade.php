@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('timesheet-detail') }}
    </div>
@endsection

<script>
    function approvalAddtimesheet(date,id) {
        $.get('/home-management-history/' + id +'/' + date, function (history) {
            $('#totalTimesheet').html(_.size(history))
            $('#tableBody').empty();
            for (const key in history) {
                var row = '<tr class="tableContent text-center">' +
                                '<th scope="row">'+ key +'</th>' +
                                '<td class="whitespace-nowrap">'+ history[key].date_time +'</td>' +
                            '</tr>'
                $('#tableBody').append(row);
            }
        })
    }
</script>
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
            <div class="col-sm float-right flex" style="font-size: 24px;">
                Total working days: <span style="color: #ef398a;">&nbsp;{{number_format($total,2)}}</span>   
            </div>
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
                            @sortablelink('date', __('lang.date'))
                        </th>
                        <th scope="col">@lang('lang.checkin')</th>
                        <th scope="col">@lang('lang.checkout')</th>
                        <th scope="col">@lang('lang.checkin_pay')</th>
                        <th scope="col">@lang('lang.checkout_pay')</th>
                        <th scope="col">@lang('lang.actual_working_time')</th>
                        <th scope="col">@lang('lang.paid_working_time')</th>
                        <th scope="col">@lang('lang.note')</th>
                        <th scope="col">Paid working day</th>
                        <th scope="col">@lang('lang.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($data as $index => $value)
                        <tr class="text-center @php if(now()->parse($value->date)->isWeekend()) echo'bg-weekend' @endphp">

                            <th scope="row">{{$index+1}}</th>

                            <td class="whitespace-nowrap">{{$value->date}}</td>

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
                            @if (!isset($value->paid_work_day))
                                <td class="whitespace-nowrap">-</td>
                            @elseif ($value->paid_work_day == 0)
                                <td class="whitespace-nowrap" style="color: red">{{number_format($value->paid_work_day, 2)}}</td>
                            @else
                                <td class="whitespace-nowrap">{{number_format($value->paid_work_day, 2)}}</td>
                            @endif
                            <td class="min-w-[200px]">
                                <a href="#" class=" text-xs btn btn-outline-info mx-[4px]"
                                    onclick="approvalAddtimesheet('{{$value->date}}',{{$value->user_id}})" data-toggle="modal"
                                    data-target="#modalComment">History</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        <div class="modal fade text-left" id="modalComment" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document" style="padding: 0 125px 0 148px;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Total: <span style="color: #ef398a;">&nbsp;<span id="totalTimesheet"></span></span> 
                        </h4>
                    </div>
                    <div class="modal-body">
                    <table class="table" wire:loading.remove>
                        <thead>
                        <tr class="text-center items-center whitespace-nowrap text-xs">
                            <th scope="col">#</th>
                            <th scope="col">
                                Date Time
                            </th>
                        </tr>
                        </thead>
                        <tbody id='tableBody'>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
        @if(count($data) > 0 )
            <div class="flex justify-center pt-3.5">
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

