@extends('layouts.main')
@section('breadcrumb')
    <div class="hidden sm:-my-px sm:ml-10 sm:flex">
        {{ Breadcrumbs::render('user-create') }}
    </div>
@endsection
@section('content')

    <div class="nav__sub-header absolute w-full" style="background-color: #fffafa;">
        <!-- Page Heading -->
        <header class=" shadow pt-[120px] p-8">
            <div class="row pt-[50px] pl-6">
                <div class="col-2">
                    <span class="cursor-pointer text-[#4f5d73] cus-font-style"
                          id="js-list-staff">Danh sach nhan su</span>
                </div>
                <div class="col text-[#4f5d73]">
                    <span class="cursor-pointer" id="js-chart-user">Bieu do nhan su</span>
                </div>
            </div>
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8 m-auto hidden" id="chart-user">
                <div class="w-full max-w-[400px]">
                    <canvas id="myChart"></canvas>
                </div>
            </div>
            <div class="max-w-7xl py-6 px-4 sm:px-6 lg:px-8 m-auto" id="list-user">
                123123
            </div>
        </header>
        <main>
            <div>
                Copyright © 2022 Fabbi JSC. All rights reserved.
                <input type="hidden" value="{{$title}}" id="titleChart">
                <input type="hidden" value="{{$dataUser}}" id="dataUserChart">
            </div>
        </main>
    </div>
    <script src="{{ asset('js/timesheet/project.js') }}"></script>
@stop
