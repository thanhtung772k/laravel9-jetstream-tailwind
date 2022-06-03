@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('add_timesheet-waiting_list') }}
    </div>
@endsection
<script>
    function approvalAddtimesheet(id) {
        $.get('/additional-timesheet-approval/' + id, function (addtimsheet) {
            $('#id').val(addtimsheet.id);
            $('#timesheetID').val(addtimsheet.timesheet_id);
            $('#checkInReq').val(addtimsheet.check_int_request);
            $('#checkOutReq').val(addtimsheet.check_out_request);
            $('#status').val(addtimsheet.status);
            $('#modalComment').modal('toggle');
        })

        $('#addTimesheetApprovalForm').submit(function (e) {
            e.preventDefault();
            let id = $('#id').val();
            let timesheetID = $('#timesheetID').val();
            let checkInReq = $('#checkInReq').val();
            let checkOutReq = $('#checkOutReq').val();
            let note = $('#note').val();
            $.ajax({
                url: '/additional-timesheet-approval/' + id + '/' + {{config('constant.status_agree')}},
                type: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    timesheetID: timesheetID,
                    checkInReq: checkInReq,
                    checkOutReq: checkOutReq,
                    note: note
                },
                success: function (response) {
                    console.log(id, '#abc_' + id)
                    console.log(response);
                    $('#addTimesheetApprovalForm').modal('hide');
                    // if(response.status){
                    //     $('#abc_'+id).text('Approved')
                    // }
                    window.location.reload();
                }, error: function (error) {
                    console.log(error);
                }
            })
        })
    }

    function rejectAddtimesheet(id) {
        $.get('/additional-timesheet-approval/' + id, function (addtimsheet) {
            $('#id').val(addtimsheet.id);
            $('#timesheetID').val(addtimsheet.timesheet_id);
            $('#checkInReq').val(addtimsheet.check_int_request);
            $('#checkOutReq').val(addtimsheet.check_out_request);
            $('#modalComment').modal('toggle');
        })

        $('#addTimesheetApprovalForm').submit(function (e) {
            e.preventDefault();
            let id = $('#id').val();
            let timesheetID = $('#timesheetID').val();
            let checkInReq = $('#checkInReq').val();
            let checkOutReq = $('#checkOutReq').val();
            let note = $('#note').val();
            $.ajax({
                url: '/additional-timesheet-approval/' + id + '/' + {{config('constant.status_reject')}},
                type: "PUT",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    timesheetID: timesheetID,
                    checkInReq: checkInReq,
                    checkOutReq: checkOutReq,
                    note: note
                },
                success: function (response) {
                    console.log(id, '#abc_' + id)
                    console.log(response);
                    $('#addTimesheetApprovalForm').modal('hide');
                    // if(response.status){
                    //     $('#abc_'+id).text('Approved')
                    // }
                    window.location.reload();
                }, error: function (error) {
                    console.log(error);
                }
            })
        })
    }

    function approvalAll() {
        var allVals = [];
        $('.checkboxItem:checked').each(function () {
            allVals.push($(this).val());
        });
        $('#addTimesheetApprovalForm').submit(function (e) {
            e.preventDefault();
            let note = $('#note').val();
            $.ajax({
                url: "{{route('updateAll',config('constant.status_agree'))}}",
                method: 'PUT',
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    addTimeId: allVals,
                    note: note
                },
                success: function (data) {
                    console.log(data);
                    location.reload();
                },
                error: function () {
                    console.log("Có lỗi xảy ra, vui lòng thử lại.");
                }
            });
        })
    }

    function rejectedAll() {
        var allVals = [];
        $('.checkboxItem:checked').each(function () {
            allVals.push($(this).val());
        });
        $('#addTimesheetApprovalForm').submit(function (e) {
            e.preventDefault();
            let note = $('#note').val();
            $.ajax({
                url: "{{route('updateAll',config('constant.status_reject'))}}",
                method: 'PUT',
                cache: false,
                data: {
                    _token: "{{ csrf_token() }}",
                    addTimeId: allVals,
                    note: note
                },
                success: function (data) {
                    console.log(data);
                    location.reload();
                },
                error: function () {
                    console.log("Có lỗi xảy ra, vui lòng thử lại.");
                }
            });
        })
    }
</script>
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
    <div class="row ml-[-24px]">
        <div class="mb-3 ml-4">
            <button class="text-xs btn btn-success btn-complete" onclick="approvalAll()"
                    data-toggle="modal" data-target="#modalComment"
                    disabled>@lang('lang.approval_All')</button>
        </div>
        <div class="mb-3 ml-2">
            <button class="text-xs btn btn-danger btn-delete" onclick="rejectedAll()"
                    data-toggle="modal" data-target="#modalComment"
                    disabled>@lang('lang.rejected_All')</button>
        </div>
    </div>
    <div class="mt-2 text-sm text-gray-500">
        <div class="row">
            <div class="card mx-auto w-full" style="border-right: none; border-left: none">
                <table class="table" wire:loading.remove>
                    <thead>
                    <tr class="text-center items-center whitespace-nowrap text-xs">
                        <td class="col-sm-1 text-center float-left">
                            <input type="checkbox" class="rounded" id="checkboxAll" name="item[]">
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
                    @if($getInfUser->is_admin == config('constant.is_admin') )
                        @if($dataTimesheetApproval->count() > 0)
                            @foreach($dataTimesheetApproval as $value)
                                <tr class="text-center">
                                    <td class="col-sm-1 text-center float-left">
                                        <input type="checkbox" class="checkboxItem rounded" name="item[]"
                                               value="{{$value->id}}">
                                    </td>

                                    <td>{{ $value->user_id }}</td>

                                    <td>{{$value->user->name}}</td>

                                    <td class="whitespace-nowrap">{{$value->date}}</td>

                                    <td>{{$value->check_int_request}}</td>

                                    <td>{{$value->check_out_request}}</td>

                                    <td class="max-w-[140px]">{{$value->description}}</td>

                                    <td class="max-w-[240px]">- {{$value->name}}: {{$value->confirmInfo}}</td>

                                    <td class="whitespace-nowrap" id="abc_{{$value->id}}">
                                        @if($value->status == config('constant.status_wait'))
                                            <span class="text-xs px-1 bg-wait rounded">@lang('lang.not_approved')</span>
                                        @elseif($value->status == config('constant.status_agree'))
                                            <span
                                                class="text-xs px-1 bg-accept text-white rounded">@lang('lang.approved')</span>
                                        @else
                                            <span
                                                class="text-xs px-1 bg-cancel text-white rounded">@lang('lang.rejected')</span>
                                        @endif
                                    </td>

                                    <td class="min-w-[200px]">
                                        @if($value->status == config('constant.status_wait'))
                                            <a href="#" class=" text-xs btn btn-outline-info mx-[4px]"
                                               onclick="approvalAddtimesheet({{$value->id}})" data-toggle="modal"
                                               data-target="#modalComment">@lang('lang.approved')</a>
                                            <a href="#" onclick="rejectAddtimesheet({{$value->id}})" data-toggle="modal"
                                               data-target="#modalComment"
                                               class="text-xs btn btn-outline-danger ">@lang('lang.rejected')</a>
                                        @else
                                            <a href="{{route('detail_addtimesheet', $value->id)}}"
                                               class="text-xs btn btn-outline-primary ">@lang('lang.detail')</a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    @else
                        <div class="flex justify-center">
                            @lang('lang.not_found')
                        </div>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{-- Comment admin --}}
        <form action="" id="addTimesheetApprovalForm">
            @csrf
            <div class="modal fade text-left" id="modalComment" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">@lang('lang.note')</h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <p><strong>@lang('lang.comment'):</strong></p>
                                    <input type="hidden" id="id" name="id">
                                    <input type="hidden" id="timesheetID" name="timesheetID">
                                    <input type="hidden" id="checkInReq" name="checkInReq">
                                    <input type="hidden" id="checkOutReq" name="checkOutReq">
                                    <input type="hidden" id="status" name="status">
                                    <textarea class="form-control" name="note" id="note"></textarea>
                                </div>
                            </div>

                            <div class="float-right">
                                <button type="submit" class="btn btn-primary cus-btn-style bg-[#c2f2ff]">
                                    @lang('lang.save_info')
                                </button>
                                <button class="btn cus-btn-style bg-[##f8f9fa] cus-border-btn" data-dismiss="modal"
                                        aria-label="Close">
                                    @lang('lang.cancel')
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @if(count($dataTimesheetApproval) > config('constant.default_number') )
            <div class="flex justify-center">
            </div>
        @else
            <div class="flex justify-center">
                @lang('lang.not_found')
            </div>
        @endif
    </div>
</div>
