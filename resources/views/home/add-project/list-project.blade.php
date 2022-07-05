@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('add_project') }}
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
                        <th scope="col">@lang('lang.project_name')</th>
                        <th scope="col">@lang('lang.customer')</th>
                        <th scope="col">@lang('lang.project_type')</th>
                        <th scope="col">@lang('lang.value_contract') (mm)</th>
                        <th scope="col">@lang('lang.status')</th>
                        <th scope="col">@lang('lang.total') @lang('lang.staff')</th>
                        <th scope="col">@lang('lang.total') @lang('lang.effort')</th>
                        <th scope="col">@lang('lang.department')</th>
                        <th scope="col">@lang('lang.time')</th>
                        <th scope="col">@lang('lang.time') @lang('lang.update')</th>
                        <th scope="col">@lang('lang.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($getProject as $index => $value)
                            <tr class="text-center" >
                                <th scope="row">{{$index+1}}</th>

                                <td class="whitespace-nowrap">{{$value->name}}</td>

                                <td class="whitespace-nowrap">{{$value->customer}}</td>

                                <td class="">{{$value->projectType->name}}</td>

                                <td>{{ $value->vale_contract}}</td>

                                <td class="whitespace-nowrap">
                                    @if($value->status == config('constant.status_undeveloped'))
                                        <span>@lang('lang.undeveloped')</span>
                                    @elseif($value->status == config('constant.status_doing'))
                                        <span>@lang('lang.developing')</span>
                                    @else
                                        <span>@lang('lang.done')</span>
                                    @endif
                                </td>

                                <td class="whitespace-nowrap">{{$value->effort}}</td>

                                <td>{{ $value->effort}}</td>

                                <td>{{ $value->nameDept}} </td>

                                <td class="whitespace-nowrap">{{ $value->start_date}}~{{ $value->end_date }}</td>

                                <td class="whitespace-nowrap">{{ $value->updated_at}}</td>

                                <td class="whitespace-nowrap">
                                    <a href="" class="text-xs btn btn-outline-primary ">@lang('lang.detail')</a>
                                    <a href="{{route('edit_project', $value->id)}}" class=" text-xs btn btn-outline-info mx-[4px]">@lang('lang.edit')</a>
                                    <a href="{{route('delete_project', $value->id)}}" class="text-xs btn btn-outline-danger ">@lang('lang.delete')</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @if(count($getProject) > config('constant.default_number') )
                    <div class="flex justify-center">
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
