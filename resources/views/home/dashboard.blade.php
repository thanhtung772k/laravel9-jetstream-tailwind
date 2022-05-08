<x-app-layout>
    <x-slot name="header">
        <form action="" method="POST">
            <div class="w[110%]">
                <div class="row">
                    @csrf
                    <div class="col-sm-3">
                        <div class="header-search__text-date">
                            <span class="text-sm">Ngày bắt đầu</span>
                        </div>
                        <div class="header-search__date" >
                            <section>
                                    <div class="input-group date" id="datepicker">
                                        <input class="form-control" id="fromDate" name="fromDate">
                                        <span class="input-group-append">
                                        <span class="input-group-text bg-white">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                    </div>
                            </section>

                            <script type="text/javascript">
                                $(function() {
                                    $('#datepicker').datepicker({
                                        format: 'yyyy-mm-dd'
                                    });
                                    $('#datepicker-end').datepicker({
                                        format: 'yyyy-mm-dd'
                                    });
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
                                    <div class="input-group date" id="datepicker-end">
                                        <input class="form-control" id="toDate" name="toDate">
                                        <span class="input-group-append">
                                        <span class="input-group-text bg-white">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                    </span>
                                    </div>
                            </section>

                            <script type="text/javascript">
                                $(function() {
                                    $("#datepicker-end").datepicker({
                                        format: 'yyyy-mm-dd'
                                    });
                                });
                            </script>
                        </div>
                    </div>
                    <div class="col-sm-3 mt-[24px]">
                        <button type="submit" class="btn btn-primary cus-btn-style bg-[#c2f2ff]" name="search">@lang('lang.search')</button>
                        <button type="reset" class="btn btn-secondary cus-btn-style  bg-[#c5c8cc]">@lang('lang.reset')</button>
                    </div>

                </div>
            </div>
        </form>
    </x-slot>
    <div class="py-8">
        <div class="max-w-[100%] px-[12px]">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                @include('livewire.user.user-index')
            </div>
        </div>

</x-app-layout>
