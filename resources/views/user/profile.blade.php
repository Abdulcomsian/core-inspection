@extends('user.layouts.master')
@section('title')
    Disable Platform | Service Provider
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        .testimonial-card .card-up {
            height: 120px;
            overflow: hidden;
            border-top-left-radius: 0.25rem;
            border-top-right-radius: 0.25rem;
        }

        .testimonial-card .avatar {
            width: 110px;
            margin-top: -60px;
            overflow: hidden;
            border: 3px solid #fff;
            border-radius: 50%;
        }

        body {
            background: #dcdcdc;
        }

        .total-like-user-main a {
            display: inline-block;
            margin: 0 -17px 0 0;
        }

        .total-like {
            border: 1px solid;
            border-radius: 50px;
            display: inline-block;
            font-weight: 500;
            height: 34px;
            line-height: 33px;
            padding: 0 13px;
            vertical-align: top;
        }

        .restaurant-detailed-ratings-and-reviews hr {
            margin: 0 -24px;
        }

        .graph-star-rating-header .star-rating {
            font-size: 17px;
        }

        .progress {
            background: #f2f4f8 none repeat scroll 0 0;
            border-radius: 0;
            height: 30px;
        }

        .rating-list {
            display: inline-flex;
            margin-bottom: 15px;
            width: 100%;
        }

        .rating-list-left {
            height: 16px;
            line-height: 29px;
            width: 10%;
        }

        .rating-list-center {
            width: 80%;
        }

        .rating-list-right {
            line-height: 29px;
            text-align: right;
            width: 10%;
        }

        .restaurant-slider-pics {
            bottom: 0;
            font-size: 12px;
            left: 0;
            z-index: 999;
            padding: 0 10px;
        }

        .restaurant-slider-view-all {
            bottom: 15px;
            right: 15px;
            z-index: 999;
        }

        .offer-dedicated-nav .nav-link.active,
        .offer-dedicated-nav .nav-link:hover,
        .offer-dedicated-nav .nav-link:focus {
            border-color: #3868fb;
            color: #3868fb;
        }

        .offer-dedicated-nav .nav-link {
            border-bottom: 2px solid #fff;
            color: #000000;
            padding: 16px 0;
            font-weight: 600;
        }

        .offer-dedicated-nav .nav-item {
            margin: 0 37px 0 0;
        }

        .restaurant-detailed-action-btn {
            margin-top: 12px;
        }

        .restaurant-detailed-header-right .btn-success {
            border-radius: 3px;
            height: 45px;
            margin: -18px 0 18px;
            min-width: 130px;
            padding: 7px;
        }

        .text-black {
            color: #000000;
        }

        .icon-overlap {
            bottom: -23px;
            font-size: 74px;
            opacity: 0.23;
            position: absolute;
            right: -32px;
        }

        .menu-list img {
            width: 41px;
            height: 41px;
            object-fit: cover;
        }

        .restaurant-detailed-header-left img {
            width: 88px;
            height: 88px;
            border-radius: 3px;
            object-fit: cover;
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
        }

        .reviews-members .media .mr-3 {
            width: 56px;
            height: 56px;
            object-fit: cover;
        }

        .rounded-pill {
            border-radius: 50rem !important;
        }

        .total-like-user {
            border: 2px solid #fff;
            height: 34px;
            box-shadow: 0 .125rem .25rem rgba(0, 0, 0, .075) !important;
            width: 34px;
        }

        .total-like-user-main a {
            display: inline-block;
            margin: 0 -17px 0 0;
        }

        .total-like {
            border: 1px solid;
            border-radius: 50px;
            display: inline-block;
            font-weight: 500;
            height: 34px;
            line-height: 33px;
            padding: 0 13px;
            vertical-align: top;
        }

        .restaurant-detailed-ratings-and-reviews hr {
            margin: 0 -24px;
        }

        .graph-star-rating-header .star-rating {
            font-size: 17px;
        }

        .progress {
            background: #f2f4f8 none repeat scroll 0 0;
            border-radius: 0;
            height: 30px;
        }

        .rating-list {
            display: inline-flex;
            margin-bottom: 15px;
            width: 100%;
        }

        .rating-list-left {
            height: 16px;
            line-height: 29px;
            width: 10%;
        }

        .rating-list-center {
            width: 80%;
        }

        .rating-list-right {
            line-height: 29px;
            text-align: right;
            width: 10%;
        }

        .restaurant-slider-pics {
            bottom: 0;
            font-size: 12px;
            left: 0;
            z-index: 999;
            padding: 0 10px;
        }

        .restaurant-slider-view-all {
            bottom: 15px;
            right: 15px;
            z-index: 999;
        }

        .progress {
            background: #f2f4f8 none repeat scroll 0 0;
            border-radius: 0;
            height: 30px;
        }

        .circular {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            position: relative;
            overflow: hidden;
        }

        .circular img {
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Dashboard
        @endslot
    @endcomponent

    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="{{ URL::asset('build/images/profile-bg.jpg') }}" alt="" class="profile-wid-img" />
        </div>
    </div>
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
        <div class="row g-4">
            <div class="col-auto">
                <div class="avatar-lg">
                    <div class="circular">
                        <img src="@if ($providerDetails->avatar != '') {{ URL::asset('images/' . $providerDetails->avatar) }}@else{{ URL::asset('build/images/users/avatar-1.jpg') }} @endif"
                            alt="user-img" class="img-thumbnail rounded-circle" />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ $providerDetails->first_name }} {{ $providerDetails->last_name }}</h3>
                    <p class="text-white text-opacity-75">Service Provider</p>
                    <div class="hstack text-white-50 gap-1">
                        <div class="me-2"><i
                                class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{ $companyAddress->town->name ?? 'N/A' }}
                            {{ $companyAddress->city->name ?? 'N/A' }},
                            {{ $companyAddress->country->country_name ?? 'N/A' }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-auto order-last order-lg-0">
                <div class="row text text-white-50 text-center">
                    <a href="javascript:void(0);" class="btn btn-success make-appointment-button" data-bs-toggle="modal"
                        data-bs-target=".bs-modal-make-appointment"><i class="ri-calendar-line align-bottom"></i> Book a
                        Service</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Info</h5>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Name:</th>
                                                        <td class="text-muted">{{ $providerDetails->first_name }}
                                                            {{ $providerDetails->last_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Phone:</th>
                                                        <td class="text-muted">
                                                            {{ $providerDetails->phone ?? 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">E-mail:</th>
                                                        <td class="text-muted">{{ $providerDetails->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Location:</th>
                                                        <td class="text-muted">{{ $companyAddress->town->name ?? 'N/A' }}
                                                            {{ $companyAddress->city->name ?? 'N/A' }},
                                                            {{ $companyAddress->country->country_name ?? 'N/A' }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Languages:</th>
                                                        <td class="text-muted">
                                                            @if (isset($biography->languages) && $biography->languages !== null)
                                                                @php
                                                                    $languages = json_decode($biography->languages);
                                                                    if (is_array($languages)) {
                                                                        echo implode(', ', $languages);
                                                                    } else {
                                                                        echo 'N/A';
                                                                    }
                                                                @endphp
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Gender:</th>
                                                        <td class="text-muted">
                                                            @if (isset(auth()->user()->gender))
                                                                @if (auth()->user()->gender == 0)
                                                                    Male
                                                                @elseif (auth()->user()->gender == 1)
                                                                    Female
                                                                @elseif (auth()->user()->gender == 2)
                                                                    Prefer not to say
                                                                @else
                                                                    N/A
                                                                @endif
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Service Type:</th>
                                                        <td class="text-muted">
                                                            @if (isset($biography->service_type))
                                                                @if ($biography->service_type == 0)
                                                                    Physical
                                                                @elseif ($biography->service_type == 1)
                                                                    Virtual
                                                                @elseif ($biography->service_type == 2)
                                                                    Physical and Virtual
                                                                @else
                                                                    N/A
                                                                @endif
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Services</h5>
                                        @isset($serviceCategories)
                                            @forelse ($serviceCategories as $serviceCategory)
                                                <div class="d-flex align-items-center" style="justify-content: space-between;">
                                                    <a href="javascript:void(0);"
                                                        class="badge bg-light-subtle text-dark py-3 mb-2 fs-12 text-start d-block">
                                                        {{ $serviceCategory->name }}
                                                    </a>
                                                    <a href="javascript:void(0);" data-bs-toggle="modal"
                                                        data-bs-target=".bs-modal-view-service"
                                                        class="link-success fs-23 service-details"
                                                        id="{{ $serviceCategory->id }}">
                                                        <i class="las la-eye"></i>
                                                    </a>
                                                </div>
                                            @empty
                                                <p>No Services Found!</p>
                                            @endforelse
                                        @endisset
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0  me-2">Biography</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content text-muted">
                                                    <div class="tab-pane active" id="today" role="tabpanel">
                                                        <div class="profile-timeline">
                                                            <div class="accordion accordion-flush" id="todayExample">

                                                                <div class="accordion-item border-0 mb-3">
                                                                    <div class="accordion-header" id="headingTwo">
                                                                        <a class="accordion-button p-2 shadow-none">
                                                                            <div class="d-flex">
                                                                                <div class="flex-shrink-0 avatar-xs">
                                                                                    <div
                                                                                        class="avatar-title bg-light text-success rounded-circle shadow">
                                                                                        1
                                                                                    </div>
                                                                                </div>
                                                                                <div class="flex-grow-1 ms-3">
                                                                                    <span class="text-dark"><strong>Experience:
                                                                                        </strong></span>
                                                                                    <small class="text-dark">
                                                                                        {{ $biography->years_of_experience ?? 'N/A' }}
                                                                                        years</small>

                                                                                    <p class="text-dark mt-2">
                                                                                        {!! $biography->detail_bio ?? 'N/A' !!}
                                                                                    </p>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0  me-2">Qualifications</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content text-muted">
                                                    <div class="tab-pane active" id="today" role="tabpanel">
                                                        <div class="profile-timeline">
                                                            <div class="accordion accordion-flush" id="todayExample">
                                                                @forelse ($qualifications as $index => $qualification)
                                                                    <div class="accordion-item border-0 mb-3">
                                                                        <div class="accordion-header" id="headingTwo">
                                                                            <a class="accordion-button p-2 shadow-none">
                                                                                <div class="d-flex">
                                                                                    <div class="flex-shrink-0 avatar-xs">
                                                                                        <div
                                                                                            class="avatar-title bg-light text-success rounded-circle shadow">
                                                                                            {{ $index + 1 }}
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="flex-grow-1 ms-3">
                                                                                        <h6 class="fs-14 mb-1">
                                                                                            {{ $qualification->degree }}
                                                                                        </h6>
                                                                                        <small>{{ date('M, y', strtotime($qualification->from)) }}
                                                                                            -
                                                                                            {{ date('M, y', strtotime($qualification->to)) }}</small>
                                                                                    </div>
                                                                                </div>
                                                                            </a>
                                                                        </div>
                                                                        <div id="collapseTwo"
                                                                            class="accordion-collapse collapse show"
                                                                            aria-labelledby="headingTwo"
                                                                            data-bs-parent="#accordionExample">
                                                                            <div
                                                                                class="accordion-body ms-2 ps-5 pt-0 pb-0">
                                                                                <div class="row g-2">
                                                                                    <div class="col-auto">
                                                                                        @if ($qualification->image)
                                                                                            @if (pathinfo($qualification->image, PATHINFO_EXTENSION) === 'pdf')
                                                                                                <div
                                                                                                    class="d-flex border border-dashed p-2 rounded position-relative shadow">
                                                                                                    <a href="{{ asset('uploads/' . $qualification->image) }}"
                                                                                                        target="_blank"
                                                                                                        class="qualification-pdf link-primary"
                                                                                                        style="display: block; margin-top: 5px;">
                                                                                                        View PDF
                                                                                                    </a>
                                                                                                </div>
                                                                                            @else
                                                                                                <a href="{{ asset('uploads/' . $qualification->image) }}"
                                                                                                    target="_blank">
                                                                                                    <img src="{{ asset('uploads/' . $qualification->image) }}"
                                                                                                        alt=""
                                                                                                        width="50"
                                                                                                        height="50"
                                                                                                        class="qualification-image"
                                                                                                        style="margin-right: -66px; margin-bottom: -5px; width: 70px; height: 50px;" />
                                                                                                </a>
                                                                                            @endif
                                                                                        @else
                                                                                            <img src=""
                                                                                                alt=""
                                                                                                width="50"
                                                                                                height="50"
                                                                                                class="qualification-image d-none"
                                                                                                style="margin-right: -66px; margin-bottom: -5px; width: 70px; height: 50px;" />
                                                                                        @endif
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                    <div class="accordion-item border-0 mb-3">
                                                                        <div class="accordion-header" id="headingTwo">
                                                                            <a
                                                                                class="accordion-button p-2 shadow-none text-dark">
                                                                                No qualifications found
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                @endforelse
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 me-2">Appointment Schedule</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content text-muted">
                                                    <div class="tab-pane active" id="today" role="tabpanel">
                                                        <div class="profile-timeline">
                                                            <div class="accordion accordion-flush" id="todayExample">
                                                                <div class="accordion-item border-0 mb-3">
                                                                    <div class="accordion-header" id="headingTwo">
                                                                        <a class="accordion-button p-2 shadow-none">
                                                                            <div class="ms-3">
                                                                                <div class="col-12 my-2">
                                                                                    <span
                                                                                        class="fw-bold text-dark">Days:</span>
                                                                                    <span
                                                                                        class="ms-3 text-dark">{{ $appointmentSchedule?->days ?? 'N/A' }}</span>
                                                                                </div>
                                                                                <div class="col-12 my-2">
                                                                                    <span class="fw-bold text-dark">From
                                                                                        Time:</span>
                                                                                    <span class="ms-3 text-dark">
                                                                                        @if ($appointmentSchedule)
                                                                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $appointmentSchedule?->from)->format('h:i A') }}
                                                                                        @else
                                                                                            N/A
                                                                                        @endif
                                                                                    </span>
                                                                                </div>
                                                                                <div class="col-12 my-2">
                                                                                    <span class="fw-bold text-dark">To
                                                                                        Time:</span>
                                                                                    <span class="ms-3 text-dark">
                                                                                        @if ($appointmentSchedule)
                                                                                            {{ \Carbon\Carbon::createFromFormat('H:i:s', $appointmentSchedule?->to)->format('h:i A') }}
                                                                                        @else
                                                                                            N/A
                                                                                        @endif
                                                                                    </span>
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0 me-2">Ratings and Reviews</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="tab-content text-muted">
                                                    <div class="tab-pane active" id="today" role="tabpanel">
                                                        <div class="profile-timeline">
                                                            <div class="accordion accordion-flush" id="todayExample">
                                                                <div class="accordion-item border-0 mb-3">
                                                                    <div class="accordion-header" id="headingTwo">
                                                                        <a class="shadow-none">
                                                                            @if ($allReviews->isEmpty())
                                                                                <h3 class="text-center text-dark">No
                                                                                    reviews
                                                                                    found.</h3>
                                                                            @else
                                                                                @foreach ($allReviews as $review)
                                                                                    <div class="card mb-3">
                                                                                        <div class="card-body">
                                                                                            <ul
                                                                                                class="list-unstyled d-flex mb-0">
                                                                                                @for ($i = 0; $i < $review->ratings; $i++)
                                                                                                    <li><i
                                                                                                            class="fas fa-star fa-sm text-warning"></i>
                                                                                                    </li>
                                                                                                @endfor
                                                                                                @if ($review->ratings < 5)
                                                                                                    @for ($i = 0; $i < 5 - $review->ratings; $i++)
                                                                                                        <li><i
                                                                                                                class="far fa-star fa-sm text-warning"></i>
                                                                                                        </li>
                                                                                                    @endfor
                                                                                                @endif
                                                                                            </ul>
                                                                                            <h6 class="card-title mb-1">
                                                                                                <a class="text-black"
                                                                                                    href="#">
                                                                                                    {{ $review->userDetails->name }}
                                                                                                </a>
                                                                                            </h6>
                                                                                            <p class="card-text text-gray">
                                                                                                {{ $review->created_at->format('M d, Y') }}
                                                                                            </p>
                                                                                            <p class="card-text">
                                                                                                <i
                                                                                                    class="fas fa-quote-left pe-2"></i>{{ $review->description }}
                                                                                            </p>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                                <!-- Pagination links -->
                                                                                <div class="d-flex justify-content-end">
                                                                                    {{ $allReviews->links() }}
                                                                                </div>
                                                                            @endif
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-modal-make-appointment" tabindex="-1" aria-labelledby="mySmallModalLabel1"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel1">Book a Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="appointment-validation" novalidate id = "make-appointment-form"
                        action = "{{ route('user.makeAppointment') }}" method = "post">
                        @csrf
                        <input type = "hidden" name= "vendor_id" value = "{{ $providerDetails->id }}">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <label for="basiInput" class="form-label">Select Services</label>
                                <select class="form-select" aria-label=".form-select-sm example"
                                    name = "service_category" required>
                                    <option value="" selected>Change Service Category</option>
                                    @isset($serviceCategories)
                                        @foreach ($serviceCategories as $serviceCategory)
                                            <option value="{{ $serviceCategory->id }}">{{ $serviceCategory->name }} |
                                                ${{ $serviceCategory->price }}</option>
                                        @endforeach
                                    @endisset
                                </select>
                            </div>
                            <div class="col-xxl-6">
                                <div>
                                    <label for="basiInput" class="form-label">Location</label>
                                    <input type="text" name="location" class="form-control" id="UserName"
                                        placeholder="Location" required>
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <div>
                                    <label for="basiInput" class="form-label">Start Date</label>
                                    <input type="date" name = "start_date" class="form-control" id="basiInput"
                                        required>
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <div>
                                    <label for="basiInput" class="form-label">End Date</label>
                                    <input type="date" name = "end_date" class="form-control" id="UserName"
                                        placeholder="Time" required>
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <div>
                                    <label for="basiInput" class="form-label">From Time</label>
                                    <input type="time" name = "start_time" class="form-control" id="UserName"
                                        placeholder="From Time" required>
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <div>
                                    <label for="basiInput" class="form-label">End Time</label>
                                    <input type="time" name = "end_time" class="form-control" id="UserName"
                                        placeholder="To Time" required>
                                </div>
                            </div>
                            <div class="col-xxl-12">
                                <div>
                                    <label for="basiInput" class="form-label">Message</label>
                                    <textarea name = "message" class="form-control" id="exampleFormControlTextarea5" rows="3" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary make-appointment">Book Service</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-modal-review-and-pay" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="mySmallModalLabel2" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel2">Review Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        onclick = "closeReviewModal()"></button>
                </div>
                <div class="modal-body">
                    <div class="text-center pt-3 pb-4 mb-1 d-flex justify-content-center">
                        <img src="{{ URL::asset('build/images/logo-dark.png') }}" class="card-logo card-logo-dark"
                            alt="logo dark" height="17">
                        <img src="{{ URL::asset('build/images/logo-light.png') }}" class="card-logo card-logo-light"
                            alt="logo light" height="17">
                    </div>
                    <div class="step-arrow-nav mb-4">

                        <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="steparrow-gen-info-tab" data-bs-toggle="pill"
                                    data-bs-target="#steparrow-gen-info" type="button" role="tab"
                                    aria-controls="steparrow-gen-info" aria-selected="true">Appointment Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="steparrow-description-info-tab" data-bs-toggle="pill"
                                    data-bs-target="#steparrow-description-info" type="button" role="tab"
                                    aria-controls="steparrow-description-info" aria-selected="false">Payment</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-experience" type="button" role="tab"
                                    aria-controls="pills-experience" aria-selected="false">Complete</button>
                            </li>
                        </ul>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="steparrow-gen-info" role="tabpanel"
                            aria-labelledby="steparrow-gen-info-tab">
                            <div>
                                <div class="row">
                                    <div class="col-xl-6">
                                        <div class="card" style="box-shadow: 1px 1px 11px 3px #38414a1a;">
                                            <div class="card-header">
                                                <div class="d-flex">
                                                    <h5 class="card-title flex-grow-1 mb-0">Vendor Details</h5>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <ul class="list-unstyled mb-0 vstack gap-3">
                                                    <li>
                                                        <div class="d-flex align-items-center">
                                                            <div class="flex-shrink-0">
                                                                <img src="{{ URL::asset('build/images/profile-bg.jpg') }}"
                                                                    alt="" class="avatar-sm rounded shadow">
                                                            </div>
                                                            <div class="flex-grow-1 ms-3">
                                                                <h6 class="fs-14 mb-1">{{ $providerDetails->first_name }}
                                                                    {{ $providerDetails->last_name }}</h6>
                                                                <p class="text-muted mb-0">Customer</p>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li><i
                                                            class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ $providerDetails->email }}
                                                    </li>
                                                    <li><i
                                                            class="ri-phone-line me-2 align-middle text-muted fs-16"></i>{{ $providerDetails->phone ?? 'N/A' }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-6">

                                        <div class="card" style="box-shadow: 1px 1px 11px 3px #38414a1a;">
                                            <div class="card-header">
                                                <div class="d-flex">
                                                    <h5 class="card-title flex-grow-1 mb-0">Service Details</h5>
                                                    <div class="flex-shrink-0">
                                                        <a href="javascript:void(0);" class="link-secondary">Edit
                                                            Details</a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="card-body">
                                                <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                                                    <li class="fw-medium fs-14"><b>Service Category:</b> <span
                                                            class = "service-category"></span></li>
                                                    <li><b>Appointment Start Date:</b><span
                                                            class = "service-start-date"></span></li>
                                                    <li><b>Appointment Date:</b>
                                                    <li><b>Appointment Start Date:</b><span
                                                            class = "service-end-date"></span></li>
                                                    </li>
                                                    <li><b>Time: <span class = "service-start-time"></span> - <span
                                                                class = "service-end-time"></span></b></li>
                                                    <li><b>Numbers of Days: Number of Days</b></li>
                                                    <li><b class = "service-location">Location: Calefonia</b></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-12 mt-3">
                                        <div class="table-responsive table-card">
                                            <table class="table table-centered align-middle table-nowrap mb-0">
                                                <tbody>
                                                    <tr>
                                                        <td><b>Appointment Start Date</b></td>
                                                        <td>15/02/2024</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>End Date</b></td>
                                                        <td>15/02/2024</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Service Number</b></td>
                                                        <td>2041</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Email Address</b></td>
                                                        <td>johndoe@gmail.com</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Gender</b></td>
                                                        <td>Male</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Request Created On</b></td>
                                                        <td>02/2024</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3 mt-4">
                                <button type="button" id = "proceed-to-payment-button"
                                    class="btn btn-success btn-label right ms-auto nexttab"><i
                                        class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Proceed To
                                    Payment
                                    info</button>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="steparrow-description-info" role="tabpanel"
                            aria-labelledby="steparrow-description-info-tab">
                            <div class = "mt-1" id ="service-payment-error"></div>
                            <div>
                                <h5>Payment</h5>
                                <p class="text-muted">Fill all information below</p>
                            </div>
                            <form action="javascript:void(0);" class="form-steps payment-form-validation"
                                autocomplete="off" novalidate id =  "payment-form">
                                <div>
                                    <div class="my-3">
                                        <div class="form-check form-check-inline">
                                            <input id="mtn-momo" name="paymentMethod" type="radio"
                                                class="form-check-input" checked>
                                            <label class="form-check-label" for="mtn-momo">MTN MOMO</label>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="row gy-3 card-details">

                                    <div class="col-md-6">
                                        <label for="mtn-number" class="form-label">Mobile Number</label>
                                        <input type="number" name="mtn_number" class="form-control" id="mtn-number"
                                            placeholder="Enter your MOMO Mobile Number" required>
                                        <div class="invalid-feedback">
                                            Credit card number is required
                                        </div>
                                    </div>

                                </div>
                        </div> -->
                    </div>
                    <div class="d-flex align-items-start gap-3 mt-4">
                        <button type="button" class="btn btn-light btn-label previestab"
                            data-previous="steparrow-gen-info-tab"><i
                                class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                            General</button>
                        <button type="submit"
                            class="btn btn-success btn-label right ms-auto nexttab nexttab payment-submission-form"
                            data-nexttab="pills-experience-tab"><i
                                class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                    </div>
                    </form>

                </div>

                <div class="tab-pane fade" id="pills-experience" role="tabpanel">
                    <div class="text-center">

                        <div class="avatar-md mt-5 mb-4 mx-auto">
                            <div class="avatar-title bg-light text-success display-4 rounded-circle">
                                <i class="ri-checkbox-circle-fill"></i>
                            </div>
                        </div>
                        <h5>Well Done !</h5>
                        <p class="text-muted">Payment Successfull</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <div class="modal fade bs-modal-view-service" tabindex="-1" aria-labelledby="mySmallModalLabel4"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Service Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-0">
                        <div class="col-lg-12">
                            <a href="javascript:void(0);" class="list-group-item list-group-item-action cursor-default">
                                <div class="d-flex justify-content-between">
                                    <p class="list-text mb-0 service-details-category fw-bold"></p>
                                    <b class="price-tag">$<span class="service-details-price"></span></b>
                                </div>
                                <p class="mb-0 service-details-description text-muted"></p>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('page-script')
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/profile.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script>
        document.querySelectorAll('.service-details').forEach(function(element) {
            element.addEventListener('click', function(e) {
                let ServiceId = this.id;
                let detailsUrl =
                    "{{ route('user.vendor_service_details', ['vendor_id' => $providerDetails->id, 'id' => ':ID']) }}";
                detailsUrl = detailsUrl.replace(":ID", ServiceId);
                fetch(detailsUrl, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        if (data.serviceDetails) {
                            document.querySelector(".service-details-category").textContent = data
                                .serviceDetails.service_category.name;
                            document.querySelector(".service-details-price").textContent = data
                                .serviceDetails.service_category.price;
                            // document.querySelector(".service-details-description").textContent = data
                            //     .serviceDetails.service_category.description;
                            if (data.serviceDetails.upload_media) {
                                document.querySelector(".service-details-image").src =
                                    "{{ asset('') }}" + data.serviceDetails.upload_media;
                                document.querySelector(".service-details-image").style.display =
                                    "block";
                            } else {
                                document.querySelector(".service-details-image").style.display = "none";
                            }
                        } else {
                            console.log('2');
                        }
                    })
                    .catch(error => {
                        console.log(error);
                    })
            });

        });
        document.querySelector('.make-appointment-button').addEventListener('click', function() {
            document.getElementById('make-appointment-form').reset();
            document.getElementById('make-appointment-form').classList.remove('was-validated');
        });
        let appointmentData = '';
        (function() {
            'use strict';
            document.querySelector(".make-appointment").addEventListener('click', function() {
                var forms = document.getElementsByClassName('appointment-validation');
                var formId = forms.id;
                let req = 0;
                if (forms)
                    var validation = Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            } else {
                                var selectElement = document.querySelector(
                                    'select[name=service_category]');

                                var selectedIndex = selectElement.selectedIndex;

                                var selectedOptionText = selectElement.options[selectedIndex]
                                    .text;
                                appointmentData = {
                                    service_category: document.querySelector(
                                        "select[name=service_category]").value,
                                    category_text: selectedOptionText,
                                    location: document.querySelector("input[name=location]")
                                        .value,
                                    start_date: document.querySelector(
                                        "input[name=start_date]").value,
                                    end_date: document.querySelector("input[name=end_date]")
                                        .value,
                                    start_time: document.querySelector(
                                        "input[name=start_time]").value,
                                    end_time: document.querySelector("input[name=end_time]")
                                        .value,
                                    message: document.querySelector(
                                        "textarea[name=message]").value,
                                    vendor_id: document.querySelector(
                                        'input[name=vendor_id]').value
                                };
                                document.querySelector('.service-category').innerText =
                                    appointmentData.category_text;
                                document.querySelector('.service-start-date').innerText =
                                    formatDate(appointmentData.start_date);
                                document.querySelector('.service-end-date').innerText =
                                    formatDate(appointmentData.end_date);
                                document.querySelector('.service-start-time').innerText =
                                    timeFormat(appointmentData.start_time);
                                document.querySelector('.service-end-time').innerText =
                                    timeFormat(appointmentData.end_time);
                                document.querySelector('.service-location').innerText =
                                    appointmentData.location;
                                console.log(appointmentData);
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
            }, false);
            document.querySelector(".payment-submission-form").addEventListener('click', function() {
                var validateMobileNumber = document.querySelector('input[name=mtn_number]');
                var paymentforms = document.getElementsByClassName('payment-form-validation');

                if (paymentforms)
                    var validation = Array.prototype.filter.call(paymentforms, function(form, index) {
                        console.log(index);
                        form.addEventListener('submit', function(event) {
                            console.log(form.checkValidity());

                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');

                        }, false);
                    });

            }, false);
        })();
        (function() {
            'use strict';

        })()
        let modal_backdrop = '';
        let apppointmentModal = document.getElementsByClassName('bs-modal-make-appointment')[0];
        let paymentModal = document.getElementsByClassName('bs-modal-review-and-pay')[0];

        function openAnotherModal() {
            modal_backdrop = document.getElementsByClassName('modal-backdrop')[
                0];
            apppointmentModal.classList.remove('show');
            modal_backdrop.classList.remove('show');
            apppointmentModal.style.display = 'none';
            apppointmentModal.setAttribute('aria-hidden', true);
            if (paymentModal) {
                paymentModal.style.display = 'block';
                paymentModal.classList.add('show');
                modal_backdrop.classList.add('show');

            } else {
                console.error('Modal element not found.');
            }
        }

        function closeReviewModal() {
            paymentModal.classList.remove('show');
            paymentModal.setAttribute('aria-hidden', true);
            paymentModal.style.display = 'none';
            modal_backdrop.remove();
        }

        function formatDate(date) {
            let dateParts = date.split('-');
            let formattedDate = dateParts[2] + '/' + dateParts[1] + '/' + dateParts[0];
            return formattedDate;
        }

        function timeFormat(time) {
            let timeParts = time.split(':');
            let hours = parseInt(timeParts[0]);
            let minutes = parseInt(timeParts[1]);
            let period = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12 || 12;
            let formattedTime = hours + ':' + (minutes < 10 ? '0' : '') + minutes + ' ' + period;
            return formattedTime;
        }

        document.getElementById('proceed-to-payment-button').addEventListener('click', function(event) {
            document.getElementById('steparrow-gen-info-tab').classList.remove('active');
            document.getElementById('steparrow-gen-info').classList.remove('show');
            document.getElementById('steparrow-gen-info').classList.remove('active');
            document.getElementById('steparrow-description-info-tab').classList.add('active');
            document.getElementById('steparrow-description-info').classList.add('active');
            document.getElementById('steparrow-description-info').classList.add('show');
        });

        document.getElementById('payment-form').addEventListener('submit', function(event) {
            event.preventDefault();
            var mobile_number = document.getElementById('mtn-number').value;
            if (mobile_number != '') {
                let paymentUrl = "{{ route('user.submit_payment') }}";
                let requestOptions = {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify({
                        _token: "{{ csrf_token() }}",
                        appointment: appointmentData,
                        mobile_number: mobile_number
                    })
                };

                fetch(paymentUrl, requestOptions)
                    .then(response => {
                        return response.json();
                    })
                    .then(data => {
                        if (data.status === true) {
                            document.getElementById('steparrow-description-info-tab').classList.remove(
                                'active');
                            document.getElementById('steparrow-description-info').classList.remove('active');
                            document.getElementById('steparrow-description-info').classList.remove('show');
                            document.getElementById('pills-experience-tab').classList.add('active');
                            document.getElementById('pills-experience').classList.add('show');
                            document.getElementById('pills-experience').classList.add('active');
                            document.querySelector('.payment-submission-form').disabled = true;
                        } else {
                            document.getElementById('service-payment-error').innerHTML =
                                '';
                            for (const key in data.errors) {
                                if (data.errors.hasOwnProperty(key)) {
                                    const val = data.errors[key];
                                    document.getElementById('service-payment-error').innerHTML +=
                                        "<div class='alert alert-danger'>" + val + "</div>";
                                }
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }
        });
    </script>
@endpush
