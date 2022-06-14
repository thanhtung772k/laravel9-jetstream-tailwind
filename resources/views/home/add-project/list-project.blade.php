@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('add_project') }}
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
