@extends('admin.layouts.master')
@section('title')
    Service Details
@endsection
@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
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
    {{-- @component('components.breadcrumb')
        @slot('title')
        Service Provider
        @endslot
    @endcomponent --}}

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
            <!--end col-->
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ $providerDetails->first_name }} {{ $providerDetails->last_name }}</h3>
                    <p class="text-white text-opacity-75">Service Provider</p>
                    <div class="hstack text-white-50 gap-1">
                        <div class="me-2">
                            <i class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>
                            @empty($companyAddress->town)
                                N/A
                            @else
                                {{ $companyAddress->town->name }}
                            @endempty

                            @empty($companyAddress->city)
                                N/A
                            @else
                                {{ $companyAddress->city->name }},
                            @endempty

                            @empty($companyAddress->country)
                                N/A
                            @else
                                {{ $companyAddress->country->country_name }}
                            @endempty
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-auto order-last order-lg-0">
                <div class="row text text-white-50 text-center">
                    @if ($providerDetails->profile_approved_status == '1')
                        <a href="javascript:void(0);" class="btn btn-primary"><i class="fas fa-check"></i> Account
                            Approved</a>
                    @elseif($providerDetails->profile_approved_status == '2')
                        <a href="javascript:void(0);" class="btn btn-danger"><i class="fas fa-times"></i> Rejected</a>
                        {{-- @else
                        <a href="javascript:void(0);" class="btn btn-success make-appointment-button" data-bs-toggle="modal"
                            data-bs-target=".bs-modal-make-appointment"><i class="ri-checkbox-circle-line align-bottom"></i>
                            Approve Account</a> --}}
                    @endif
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
                                                        <td class="text-muted">
                                                            @if ($providerDetails)
                                                                {{ $providerDetails->first_name }}
                                                                {{ $providerDetails->last_name }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">E-mail:</th>
                                                        <td class="text-muted">
                                                            @if ($providerDetails)
                                                                {{ $providerDetails->email }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Phone:</th>
                                                        <td class="text-muted">
                                                            @if ($providerDetails)
                                                                {{ $providerDetails->phone }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Location:</th>
                                                        <td class="text-muted">
                                                            @if ($companyAddress)
                                                                {{ $companyAddress->town->name ?? 'N/A' }}
                                                                {{ $companyAddress->city->name ?? 'N/A' }},
                                                                {{ $companyAddress->country->country_name ?? 'N/A' }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
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
                                                        <th scope="row">Identifier ID:</th>
                                                        <td class="text-muted">
                                                            @if ($providerDetails)
                                                                {{ $providerDetails->identifier }}
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Gender:</th>
                                                        <td class="text-muted">
                                                            @if (isset($providerDetails->gender))
                                                                @if ($providerDetails->gender == 0)
                                                                    Male
                                                                @elseif ($providerDetails->gender == 1)
                                                                    Female
                                                                @elseif ($providerDetails->gender == 2)
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
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">SERVICES</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="live-preview" style="max-height: 300px; overflow-y: auto;">
                                            <ul class="list-group">
                                                @if (isset($services) && $services->isNotEmpty())
                                                    @foreach ($services as $category)
                                                        <li class="list-group-item">
                                                            <i
                                                                class="ri-bookmark-line align-middle me-2"></i>{{ $category->serviceCategory->name ?? '' }}
                                                        </li>
                                                    @endforeach
                                                @else
                                                    <li class="list-group-item">No services/Not approved yet</li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div class="d-none code-view">
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-9">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Biography</h5>
                                        <div class="row">
                                            <div class="col-12 d-flex my-2">
                                                <span><strong>Experience: </strong></span>
                                                <span class="ms-3">{{ $biography->years_of_experience ?? 'N/A' }}
                                                    years</span>
                                            </div>
                                            <div class="col-12 my-2">
                                                <span>{!! $biography->detail_bio ?? '' !!}</span>
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

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Address</h5>
                                        <div class="row">
                                            <div class="col-12 d-flex my-2">
                                                <span><strong>Country: </strong></span>
                                                <span
                                                    class="ms-3">{{ $companyAddress->country->country_name ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-12 d-flex my-2">
                                                <span><strong>City: </strong></span>
                                                <span class="ms-3">{{ $companyAddress->city->name ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-12 d-flex my-2">
                                                <span><strong>Street: </strong></span>
                                                <span class="ms-3">{{ $companyAddress->town->name ?? 'N/A' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title">Appointment Schedule</h5>
                                        <div class="row">
                                            <div class="col-12 d-flex my-2">
                                                <span><strong>Days: </strong></span>
                                                <span class="ms-3">{{ $appointmentSchedule?->days ?? 'N/A' }}</span>
                                            </div>
                                            <div class="col-12 d-flex my-2">
                                                <span><strong>From Time: </strong></span>
                                                <span class="ms-3 text-dark">
                                                    @if ($appointmentSchedule)
                                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $appointmentSchedule?->from)->format('h:i A') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="col-12 d-flex my-2">
                                                <span><strong>To Time: </strong></span>
                                                <span class="ms-3 text-dark">
                                                    @if ($appointmentSchedule)
                                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $appointmentSchedule?->to)->format('h:i A') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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
                                                                            <div class="card mb-3 w-100">
                                                                                <div class="card-body">
                                                                                    <ul class="list-unstyled d-flex mb-0">
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
    <div class="modal fade bs-modal-make-appointment" tabindex="-1" aria-labelledby="mySmallModalLabel1"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel1">Approval Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class = "col-xxl-12 text-center mb-3" style = "font-size:15px;">Are are sure to approve this
                        account ?</div>
                    <div class="d-flex justify-content-center">
                        <button type="button" data-approve-status="1" data-provider-id="{{ $providerDetails->id }}"
                            class="btn btn-success approval-status">Approve</button>
                        <button type="button" data-approve-status="2" data-provider-id="{{ $providerDetails->id }}"
                            class="btn btn-danger approval-status mx-2">Reject</button>
                    </div>
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
                                                            class="ri-phone-line me-2 align-middle text-muted fs-16"></i>+(256)
                                                        245451 441</li>
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
                        <!-- end tab pane -->

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
        < </div>
        @endsection

        @section('script')
            <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

            <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
            <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
            <script src="{{ URL::asset('build/libs/jsvectormap/maps/us-merc-en.js') }}"></script>
            <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
            <script src="{{ URL::asset('build/js/pages/form-input-spin.init.js') }}"></script>
            <script src="{{ URL::asset('build/libs/card/card.js') }}"></script>
            <script src="{{ URL::asset('build/js/pages/widgets.init.js') }}"></script>
            <script src="{{ URL::asset('build/js/app.js') }}"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
                integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
                crossorigin="anonymous" referrerpolicy="no-referrer"></script>
            <script>
                $(document).on("click", ".approval-status", function(e) {
                    e.preventDefault();
                    let approvalStatus = this.dataset.approveStatus;
                    let providerId = this.dataset.providerId;
                    $.ajax({
                        type: 'POST',
                        url: '{{ route('admin.updateApprovalStatus') }}',
                        data: {
                            providerId: providerId,
                            approvalStatus: approvalStatus,
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(res) {
                            if (res.status) {
                                $(".modal").modal('hide');
                                window.location.reload();
                            } else {
                                toastr.error(res.error);
                            }
                        }
                    })
                })
            </script>
        @endsection
