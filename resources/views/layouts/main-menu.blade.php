<div class="nav-menu fixed">
    <div class="w-[256px] bg-[#303c54] flex items-center py-1">
        <a href="" class="text-center w-full left-16">
            <img src="https://ecs.fabbi.io/img/fabbi_logo.031027dd.jpeg" alt="" width="118px" height="50px"
                 class="text-center custom-center">
        </a>
    </div>
    <div class="nav-menu__background">
        <ul class="text-sm">
            <li class="nav-menu__item">
                <span>
                    <i class="nav-menu__icon fa-solid fa-gauge-high pr-3 "></i>
                    <a href="{{url('home')}}" class="nav-menu__item">@lang('lang.dashboard')</a>
                </span>
            </li>
            <li class="nav-menu__item-head">
                <span class="menu-items__title">MANAGEMENT</span>
            </li>

            <li class="nav-menu__item">
                <span>
                    <i class="nav-menu__icon fa-solid fa-gauge-high  pr-3"></i>
                    <span>@lang('lang.timesheets')</span>
                </span>
                <i class="nav-menu__dropToggle fa-solid fa-angle-left text-xs pr-3 float-right relative top-3.5"></i>
                <ul class="nav-menu__sub-item" style="display: none;">
                    <li class="text-center w-full">
                        <a href="{{url('home')}}" class="nav-menu__sub-item--list">@lang('lang.list_timesheets')</a>
                    </li>
                </ul>
            </li>

            <li class="nav-menu__item">
                <span>
                    <i class="nav-menu__icon fa-solid fa-clock pr-3"></i>
                    <span>@lang('lang.overtime')</span>
                </span>
                <i class="nav-menu__dropToggle fa-solid fa-angle-left text-xs pr-3 float-right relative top-3.5"></i>
                <ul class="nav-menu__sub-item" style="display: none;">
                    <li class="nav-menu__sub-item--list text-center w-full">
                        @lang('lang.overtime_requests_list')
                    </li>
                    <li class="nav-menu__sub-item--list text-center w-full">
                        @lang('lang.overtime_requests_approval')
                    </li>
                    <li class="nav-menu__sub-item--list text-center w-full">
                        @lang('lang.overtime_requests_create')
                    </li>
                </ul>
            </li>
            <li class="nav-menu__item">
                <span>
                    <i class="nav-menu__icon fa-solid fa-clock  pr-3"></i>
                    <span>@lang('lang.add_timesheet')</span>
                </span>
                <i class="nav-menu__dropToggle fa-solid fa-angle-left text-xs pr-3 float-right relative top-3.5"></i>
                <ul class="nav-menu__sub-item" style="display: none;">
                    <li class="text-center w-full">
                        <a href="{{url('additional-timesheet')}}" class="nav-menu__sub-item--list">@lang('lang.add_timesheet_list')</a>
                    </li>
                    <li class="text-center w-full">
                        <a href="{{route('addtimesheet_approval')}}" class="nav-menu__sub-item--list">@lang('lang.add_timesheet_approval')</a>
                    </li>
                    <li class="text-center w-full">
                        <a href="{{ route('get_addtimesheet') }}" class="nav-menu__sub-item--list">@lang('lang.add_timesheet_create')</a>
                    </li>
                </ul>
            </li>
            <li class="nav-menu__item">
                <span>
                    <i class="nav-menu__icon fa-solid fa-clock  pr-3"></i>
                    <span>@lang('lang.sab_leave')</span>
                </span>
                <i class="nav-menu__dropToggle fa-solid fa-angle-left text-xs pr-3 float-right relative top-3.5"></i>
                <ul class="nav-menu__sub-item" style="display: none;">
                    <li class="nav-menu__sub-item--list text-center w-full">
                        @lang('lang.list_timesheets')
                    </li>
                    <li class="nav-menu__sub-item--list text-center w-full">
                        @lang('lang.list_timesheets')
                    </li>
                    <li class="nav-menu__sub-item--list text-center w-full">
                        @lang('lang.list_timesheets')
                    </li>
                </ul>
            </li>

            <li class="nav-menu__item">
                <span>
                    <i class="nav-menu__icon fa-solid fa-file pr-3"></i>
                    <span>@lang('lang.instruction')</span>
                </span>
            </li>
        </ul>
    </div>
    <div class="menu-items__footer h-[56px] bg-[#303c54] pr-4">
        <i class="fa-solid fa-angle-left text-xl opacity-50"></i>
    </div>
</div>
