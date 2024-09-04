@extends('admin.layouts.master')
@section('title')
    @lang('translation.widgets')
@endsection
@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            All Transactions
        @endslot
    @endcomponent

    <style>
        .a-auto a{
            width: auto !important;
        }
    </style>
<div class="row">
    <div class="col">
        <div class="h-100">
            <div class="row">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1"></h4>
                            </div>
                            <div class="mt-3 mt-lg-0">
                                <form action="javascript:void(0);">
                                    <div class="row g-3 mb-0 align-items-center">
                                        <div class="col-sm-auto">
                                            <b>Search By Date:</b>
                                            <div class="input-group mt-2">
                                                <input type="text" class="form-control border-0 dash-filter-picker shadow" data-provider="flatpickr" data-range-date="true" data-date-format="d M, Y" data-deafult-date="01 Jan 2022 to 31 Jan 2022">
                                                <div class="input-group-text bg-primary border-primary text-white">
                                                    <i class="ri-calendar-2-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end row-->
                                </form>
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">All Transactions</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-centered align-middle table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Tansaction ID</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Role</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>2541</td>
                                            <td>Nouman</td>
                                            <td>150$</td>
                                            <td>Service Provider</td>
                                            <td>20/1/2024</td>
                                            <td>Successfull</td>
                                        </tr>
                                        <tr>
                                            <td>2</td>
                                            <td>2541</td>
                                            <td>Nouman</td>
                                            <td>150$</td>
                                            <td>Service Provider</td>
                                            <td>20/1/2024</td>
                                            <td>Successfull</td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>2541</td>
                                            <td>Nouman</td>
                                            <td>150$</td>
                                            <td>Service Provider</td>
                                            <td>20/1/2024</td>
                                            <td>Successfull</td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>2541</td>
                                            <td>Nouman</td>
                                            <td>150$</td>
                                            <td>Service Provider</td>
                                            <td>20/1/2024</td>
                                            <td>Successfull</td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>2541</td>
                                            <td>Nouman</td>
                                            <td>150$</td>
                                            <td>Service Provider</td>
                                            <td>20/1/2024</td>
                                            <td>Successfull</td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>2541</td>
                                            <td>Nouman</td>
                                            <td>150$</td>
                                            <td>Service Provider</td>
                                            <td>20/1/2024</td>
                                            <td>Successfull</td>
                                        </tr>
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>
                        </div>
                    </div> <!-- .card-->
                </div> <!-- .col-->
            </div> <!-- end row-->

        </div> <!-- end .h-100-->

    </div> <!-- end col -->
</div>

@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/us-merc-en.js') }}"></script>
    <!-- Swiper Js -->
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/form-input-spin.init.js') }}"></script>

    <script src="{{ URL::asset('build/libs/card/card.js') }}"></script>

    <!-- Widget init -->
    <script src="{{ URL::asset('build/js/pages/widgets.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
