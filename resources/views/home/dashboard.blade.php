<x-app-layout>
    <x-slot name="header">

        <div class="w[110%]">
            <div class="row">
                <div class="col-sm-3">
                    <div class="header-search__text-date">
                        <span class="text-sm">Ngày bắt đầu</span>
                    </div>
                    <div class="header-search__date" >
                        <section>
                            <form>
                                <div class="input-group date" id="datepicker">
                                    <input class="form-control">
                                    <span class="input-group-append">
                                    <span class="input-group-text bg-white">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </span>
                                </div>
                            </form>
                        </section>

                        <script type="text/javascript">
                            $(function() {
                                $('#datepicker').datepicker();
                            });
                        </script>
                    </div>

                </div>
                <div class="col-sm-3">
                    <div class="header-search__text-date">
                        <span class="text-sm">Ngày kết thúc</span>
                    </div>
                    <div class="header-search__text-date" >
                        <section>
                            <form>
                                <div class="input-group date" id="datepicker-end">
                                    <input class="form-control">
                                    <span class="input-group-append">
                                    <span class="input-group-text bg-white">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </span>
                                </div>
                            </form>
                        </section>

                        <script type="text/javascript">
                            $(function() {
                                $('#datepicker-end').datepicker();
                            });
                        </script>
                    </div>
                </div>
                <div class="col-sm-3 mt-[24px]">
                    <button type="button" class="btn btn-primary cus-btn-style bg-[#c2f2ff]" >@lang('lang.search')</button>
                    <button type="button" class="btn btn-secondary cus-btn-style  bg-[#c5c8cc]">@lang('lang.reset')</button>
                </div>
                <div class="col-sm- mt-[24px] float-right">
                    <button type="button" class="btn btn-primary cus-btn-style bg-[#c2f2ff]" >@lang('lang.checkin')</button>
                    <button type="button" class="btn btn-secondary cus-btn-style  bg-[#c5c8cc]" >@lang('lang.checkout')</button>
                </div>
            </div>
        </div>
    </x-slot>
    <div class="py-8">
        <div class="max-w-[100%] px-[12px]">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @include('livewire.user.user-index')
            </div>
        </div>

</x-app-layout>
