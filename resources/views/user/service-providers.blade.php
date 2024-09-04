@extends('user.layouts.master')
@section('title')
    Service Providers
@endsection
@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .break-world {
            word-break: break-all;
        }
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Service Providers
        @endslot
    @endcomponent

    <div class="row g-4 mb-3">
        <div class="col-sm-auto">
            <div></div>
        </div>
        <div class="col-sm">
            <div class="d-md-flex justify-content-sm-start gap-2">
                <div class="search-box ms-md-2  mb-3 mb-md-0">
                    <label>Service Category</label>
                    <select class="form-select mb-3" aria-label="Default select example" id="search-service-category"
                        multiple>

                        @php
                            $serviceCategoriesId = isset($_GET['service_category'])
                                ? explode(',', $_GET['service_category'])
                                : [];
                            $countryId = isset($_GET['country']) ? $_GET['country'] : '';
                            $cityId = isset($_GET['city']) ? $_GET['city'] : '';
                            $townId = isset($_GET['town']) ? $_GET['town'] : '';
                        @endphp

                        @isset($serviceCategories)
                            @foreach ($serviceCategories as $serviceCategory)
                                <option value="{{ $serviceCategory->id }}" @if (in_array($serviceCategory->id, $serviceCategoriesId)) selected @endif>
                                    {{ $serviceCategory->name }}
                                </option>
                            @endforeach
                        @endisset
                    </select>
                </div>
                <div class="search-box ms-md-2 flex-shrink-0 mb-3 mb-md-0">
                    <label>Country</label>
                    <select class="form-select mb-3" aria-label="Default select example" id="search-country">
                        <option value="" @if (empty($countryId)) selected @endif>Select Country</option>
                        <option value="{{ $country->id }}" @if ($country->id == $countryId) selected @endif>
                            {{ $country->country_name }}
                        </option>
                    </select>
                </div>
                <div class="search-box ms-md-2 flex-shrink-0 mb-3 mb-md-0">
                    <label>City</label>
                    <select class="form-select mb-3" aria-label="Default select example" id="search-city">
                        <option value="" selected>Select City</option>
                        @foreach ($cities as $city)
                            <option value="{{ $city->id }}" @if ($city->id == $cityId) selected @endif>
                                {{ $city->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="search-box ms-md-2 flex-shrink-0 mb-3 mb-md-0">
                    <label>Town</label>
                    <select class="form-select mb-3" aria-label="Default select example" id="search-town">
                        <option value="" selected>Select Town</option>
                        @if (isset($town))
                            <option value="{{ $town->id }}" @if ($town->id == $townId) selected @endif>
                                {{ $town->name }}
                        @endif
                    </select>
                </div>
                <div class="search-box ms-md-2 flex-shrink-0 mb-3 mb-md-0 pt-1">
                    <button type="button" class="btn btn-primary search-service mt-4"><span
                            class="mdi mdi-magnify search-widget-icon"></span></button>
                </div>
            </div>
        </div>
    </div>
    <div class="row job-list-row" id="candidate-list">
        @isset($serviceProviders)
            @forelse($serviceProviders as $serviceProvider)
                <div class="col-xxl-3 col-md-6">
                    <div class="card" style="cursor:pointer;"
                        onclick="getUrl('{{ route('user.Profile', $serviceProvider->id) }}')">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    @isset($serviceProvider->avatar)
                                        <div class="avatar-lg rounded"><img
                                                src="{{ URL::asset('images/' . $serviceProvider->avatar) }}" alt=""
                                                class="member-img h-100 img-fluid d-block rounded"></div>
                                    @else
                                        <div class="avatar-lg rounded"><img src="{{ URL::asset('build/images/job-profile2.png') }}"
                                                alt="" class="member-img h-100 img-fluid d-block rounded"></div>
                                    @endisset
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <a href="{{ route('user.Profile', $serviceProvider->id) }}" previewlistener="true">
                                        <h5 class="fs-16 mb-1">{{ $serviceProvider->first_name }}
                                            {{ $serviceProvider->last_name }}</h5>
                                    </a>
                                    <p class="text-muted mb-2 break-world">{{ $serviceProvider->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-xxl-12 col-md-12">
                    <div class="card ps-3 py-3">
                        <h3>No Service Provider Found!</h3>
                    </div>
                </div>
            @endforelse
        @endisset
    </div>
@endsection
@push('page-script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @include('script.common-script')
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/us-merc-en.js') }}"></script>
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/form-input-spin.init.js') }}"></script>

    <script src="{{ URL::asset('build/libs/card/card.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/widgets.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#search-service-category").select2();

            $("#search-country").change(function() {
                let countryId = $(this).val();
                let url = "{{ route('user.getCountryCities') }}";
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        country_id: countryId
                    },
                    success: function(response) {
                        let citySelect = $("#search-city");
                        citySelect.empty();
                        citySelect.append('<option value="" selected>Select City</option>');
                        response.cities.forEach(city => {
                            citySelect.append(
                                `<option value="${city.id}">${city.name}</option>`);
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });

        function getUrl(url) {
            window.location.href = url;
        }

        $(document).on("change", "#search-city", function(e) {
            let cityId = this.value;
            let url = "{{ route('getCityTowns') }}";
            let form = new FormData();
            let type = 2;
            let townHtml = document.querySelector('#search-town');
            form.append('cityId', cityId);
            updateInformation(url, form, type, null, townHtml, null, null);
        });

        $(document).on("click", ".search-service", function(e) {
            let serviceCategory = $("#search-service-category").val();
            let country = $("#search-country").val();
            let city = $("#search-city").val();
            let town = $("#search-town").val();
            let params = "?service_category=" + serviceCategory + "&country=" + country + "&city=" + city +
                "&town=" + town;
            let url = "{{ route('user.ServiceProviders') }}" + params;
            window.location.href = url;
        });
    </script>
@endpush
