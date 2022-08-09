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
                        <th scope="col">@sortablelink('employee_code',  __('lang.employee_code'))</th>
                        <th scope="col">@sortablelink('name', __('lang.name'))</th>
                        <th scope="col">@sortablelink('email', __('lang.email'))</th>
                        <th scope="col">@lang('lang.phone')</th>
                        <th scope="col">@lang('lang.department')</th>
                        <th scope="col">@lang('lang.position')</th>
                        <th scope="col">@lang('lang.location')</th>
                        <th scope="col">@sortablelink('time_start', __('lang.start_date'))</th>
                        <th scope="col">@lang('lang.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $index => $value)
                        <tr class="text-center" >
                            <th scope="row">{{$index+1}}</th>

                            <td class="max-w-[100px]">{{$value->employee_code}}</td>

                            <td class="max-w-[140px]">{{$value->name}}</td>

                            <td class="">{{$value->email}}</td>

                            <td>{{ $value->phone}}</td>

                            <td>{{ $value->depart->name}} </td>

                            <td>{{ $value->position->name}} </td>

                            <td>{{ $value->role->name}} </td>

                            <td class="whitespace-nowrap">{{ $value->time_start}}</td>

                            <td class="whitespace-nowrap">
                                <a href="{{route('detail_user',$value->id)}}" class="text-xs btn btn-outline-primary ">@lang('lang.detail')</a>
                                <a href="{{route('edit_user', $value->userDetailId)}}" class=" text-xs btn btn-outline-info mx-[4px]">@lang('lang.edit')</a>
                                <a href="{{route('delete_user', $value->id)}}" class="text-xs btn btn-outline-danger ">@lang('lang.delete')</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if(count($users) > config('constant.default_number') )
                    <div class="row justify-content-center mb-3">
                        {{ $users->links("pagination::bootstrap-4") }}
                    </div>
                @else
                    <div class="flex justify-center">
                        @lang('lang.not_found')
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
