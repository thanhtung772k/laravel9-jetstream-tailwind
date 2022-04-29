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
        <span class="text-sm">Hiển thị 1 đến 10 của 25 bản ghi</span>

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
                        <th scope="col">Ngày</th>
                        <th scope="col">Thứ</th>
                        <th scope="col">Thời gian bắt đầu</th>
                        <th scope="col">Thời gian kết thúc</th>
                        <th scope="col">Giờ bắt đầu tính công</th>
                        <th scope="col">Giờ kết thúc tính công</th>
                        <th scope="col">Thời gian nghỉ trưa</th>
                        <th scope="col">Giờ công thực tế</th>
                        <th scope="col">Giờ công tính lương</th>
                        <th scope="col">Chi tiết</th>
                        <th scope="col">Hoạt động</th>
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
                                <td>17:30</td>
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
                            <td>{{$value->actual_working_time}}</td>
                            <td>{{$value->paid_working_time}}</td>
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
