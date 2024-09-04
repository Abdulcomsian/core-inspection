@extends('admin.layouts.master')
@section('title')
    @lang('translation.widgets')
@endsection
@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

    <style>
        #toast-container>.toast-success {
            background-color: #28a745 !important;
            color: #fff !important;
        }

        #toast-container>.toast-error {
            background-color: #dc3545 !important;
            color: #fff !important;
        }

        #toast-container>.toast-top-right {
            top: 12px;
            right: 12px;
        }

        #toast-container>.toast-message {
            font-size: 12px;
            font-weight: bold;
        }
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Location
        @endslot
    @endcomponent

    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Update Country</h4>
                            </div>
                            <div class="card-body my-3 ms-2">
                                <div class="row">
                                    <div class="col-12">
                                        <select name="country-list" id="" class="form-select w-25">
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="d-flex col-12 my-2">
                                        <input type="text" name="add-country" class="form-control me-2"
                                            placeholder="Add Country" />
                                        <input type="number" name="add-phone-code" class="form-control mx-2"
                                            placeholder="Add phone code" />
                                        <input type="text" name="add-country-code" class="form-control mx-2"
                                            placeholder="Add country code" />
                                        <button type="button" class="btn btn-primary add-country-btn mx-2">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Update City</h4>
                            </div>
                            <div class="card-body my-3 ms-2">
                                <div class="row">
                                    <div class="col-3">
                                        <select name="city-country-list" id="" class="form-select">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}">{{ $country->country_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select name="city-list" id="" class="form-select">
                                            <option value="">Select Country</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="d-flex col-3 my-2">
                                    <input type="text" name="add-city" class="form-control" placeholder="Add City" />
                                    <button type="button" class="btn btn-primary add-city-btn mx-2">Add</button>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Update Town</h4>
                            </div>
                            <div class="card-body my-3 ms-2">
                                <div class="row">
                                    <div class="col-3">
                                        <div>
                                            <select name="town-country-list" id="" class="form-select">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->country_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <select name="town-cities-list" id="" class="form-select">
                                            <option value="">Select country</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <select name="town-list" id="" class="form-select">
                                            <option value="">Select city</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="d-flex col-3 my-2">
                                        <input type="text"name="add-town" class="form-control" placeholder="Add Town" />
                                        <button type="button" class="btn btn-primary add-town-btn mx-2">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end row-->

            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @include('script.common-script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": true,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        $(document).on("click", ".add-country-btn", function(e) {
            let country = document.querySelector('input[name="add-country"]').value;
            let phoneCode = document.querySelector('input[name="add-phone-code"]').value;
            let countryCode = document.querySelector('input[name="add-country-code"]').value;
            $.ajax({
                type: "POST",
                url: "{{ route('admin.addCountry') }}",
                data: {
                    country: country,
                    phone_code: phoneCode,
                    country_code: countryCode,
                    _token: "{{ csrf_token() }}",
                },
                success: function(res) {
                    if (res.status) {
                        document.querySelector('select[name="country-list"]').innerHTML = res.html;
                        document.querySelector('select[name="city-country-list"]').innerHTML = res.html;
                        document.querySelector('select[name="town-country-list"]').innerHTML = res.html;
                        toastr.success('Country added successfully');
                    } else {
                        toastr.error('Something went Wrong!');
                    }
                }
            })
        })

        $(document).on("click", ".add-city-btn", function(e) {
            let countryId = document.querySelector('select[name="city-country-list"]').value;
            let city = document.querySelector('input[name="add-city"]').value;
            $.ajax({
                type: "POST",
                url: "{{ route('admin.addCity') }}",
                data: {
                    countryId: countryId,
                    city: city,
                    _token: "{{ csrf_token() }}",
                },
                success: function(res) {
                    if (res.status) {
                        toastr.success(res.msg);
                    } else {
                        toastr.error(res.error);
                    }
                }
            })
        })


        $(document).on("click", ".add-town-btn", function(e) {
            let cityId = document.querySelector('select[name="town-cities-list"]').value;
            let town = document.querySelector('input[name="add-town"]').value;
            $.ajax({
                type: "POST",
                url: "{{ route('admin.addTown') }}",
                data: {
                    cityId: cityId,
                    town: town,
                    _token: "{{ csrf_token() }}",
                },
                success: function(res) {
                    if (res.status) {
                        toastr.success(res.msg);
                    } else {
                        toastr.error(res.error);
                    }
                }
            })
        })

        $(document).on("change", 'select[name="city-country-list"]', function(e) {
            let countryId = this.value;
            let html = document.querySelector('select[name="city-list"]');
            let url = "{{ route('getCountryCities') }}";
            let type = 2;
            let form = new FormData();
            form.append('countryId', countryId);
            updateInformation(url, form, type, null, html, null, null)
        })

        ////////////////////////////////////

        $(document).on("change", 'select[name="town-country-list"]', function(e) {
            let countryId = this.value;
            let html = document.querySelector('select[name="town-cities-list"]');
            let url = "{{ route('getCountryCities') }}";
            let type = 2;
            let form = new FormData();
            form.append('countryId', countryId);
            updateInformation(url, form, type, null, html, null, null)
        })

        $(document).on("change", 'select[name="town-cities-list"]', function(e) {
            let cityId = this.value;
            let html = document.querySelector('select[name="town-list"]');
            let url = "{{ route('getCityTowns') }}";
            let type = 2;
            let form = new FormData();
            form.append('cityId', cityId);
            updateInformation(url, form, type, null, html, null, null)
        })
    </script>
@endsection
