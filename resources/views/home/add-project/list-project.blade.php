@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('project-list') }}
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
                        <th scope="col">@lang('lang.department')</th>
                        <th scope="col">@lang('lang.time')</th>
                        <th scope="col">@lang('lang.time') @lang('lang.update')</th>
                        <th scope="col">@lang('lang.action')</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($projects as $index => $project)
                        <tr class="text-center">
                            <th scope="row">{{$index+1}}</th>

                            <td class="whitespace-nowrap">{{$project->name}}</td>

                            <td class="whitespace-nowrap">{{$project->customer}}</td>

                            <td class="">{{$project->projectType->name}}</td>

                            <td>{{ $project->value_contract}}</td>

                            <td class="whitespace-nowrap">
                                @if($project->status == config('constant.status_undeveloped'))
                                    <span>@lang('lang.undeveloped')</span>
                                @elseif($project->status == config('constant.status_doing'))
                                    <span>@lang('lang.developing')</span>
                                @else
                                    <span>@lang('lang.done')</span>
                                @endif
                            </td>

                            <td>{{ $project->nameDept}} </td>

                            <td class="whitespace-nowrap">{{ $project->start_date}}~{{ $project->end_date }}</td>

                            <td class="whitespace-nowrap">{{ $project->updated_at}}</td>

                            <td class="whitespace-nowrap">
                                <a href="{{route('detail_project', $project->id)}}"
                                   class="text-xs btn btn-outline-primary ">@lang('lang.detail')</a>
                                <a href="{{route('edit_project', $project->id)}}"
                                   class=" text-xs btn btn-outline-info mx-[4px]">@lang('lang.edit')</a>
                                <a href="{{route('delete_project', $project->id)}}"
                                   class="text-xs btn btn-outline-danger ">@lang('lang.delete')</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                @if(count($projects) > config('constant.default_number') )
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
