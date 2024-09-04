@extends('vendor-user.layouts.master')
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

        .toast-success {
            background-color: #51A351 !important;
        }

        .toast-error {
            background-color: #BD362F !important;
        }

        .toast-warning {
            background-color: #F89406 !important;
        }

        .cnic-image {
            position: absolute;
            right: 72%;
            bottom: -18px;
        }

        .profile-pic {
            color: transparent;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            transition: all .3s ease;

            input {
                display: none;
            }

            img {
                position: absolute;
                object-fit: cover;
                width: 110px;
                height: 110px;
                box-shadow: 0 0 10px 0 rgba(255, 255, 255, .35);
                border-radius: 100px;
                z-index: 0;
            }

            .-label {
                cursor: pointer;
                height: 110px;
                width: 110px;
            }

            &:hover {
                .-label {
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    background-color: rgba(0, 0, 0, .8);
                    z-index: 10000;
                    color: rgb(250, 250, 250);
                    transition: background-color .2s ease-in-out;
                    border-radius: 100px;
                    margin-bottom: 0;
                }
            }

            span {
                display: inline-flex;
                padding: .2em;
                height: 2em;
            }
        }

        a:hover {
            text-decoration: none;
        }
    </style>
@endsection
@section('content')

    <div class="profile-foreground position-relative mx-n4 mt-n4">
        <div class="profile-wid-bg">
            <img src="{{ URL::asset('build/images/profile-bg.jpg') }}" alt="" class="profile-wid-img" />
        </div>
    </div>
    <div class="pt-4 mb-4 mb-lg-3 pb-lg-4 profile-wrapper">
        <div class="row g-4">
            <div class="col-auto">
                <div class="profile-pic">
                    <label class="-label" for="avatar-input">
                        <span class="glyphicon glyphicon-camera"></span>
                        <span>Change Image</span>
                    </label>
                    <input id="avatar-input" type="file" accept="image/*" style="display: none;">
                    <img id="profile-picture"
                        src="@if (Auth::user()->avatar != '') {{ URL::asset('images/' . Auth::user()->avatar) }} @else {{ asset('assets/images/human-avatar.png') }} @endif"
                        alt="user-img" />
                </div>
            </div>
            <!--end col-->
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h3>
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
            {{-- <div class="col-12 col-lg-auto order-last order-lg-0">
                <div class="row text text-white-50 text-center">
                    <a href="{{ route('vendor.OnBoarding') }}" class="btn btn-success"><i class="fas fa-user"></i>
                        onBoarding</a>
                </div>
            </div>
            <br>
            <div class="col-12 col-lg-auto order-last order-lg-0">
                <div class="row text text-white-50 text-center">
                    <button type="button" class="btn btn-success btn-md shadow-none add-service-button"
                        data-bs-toggle="modal" data-bs-target=".bs-modal-add-service">
                        <i class="ri-file-add-line align-middle"></i> Add New Service
                    </button>
                </div>
            </div> --}}
            <div class="col-12 col-lg-auto order-last order-lg-0">
                <div class="row text text-white-50 text-center">
                    <a href="{{ route('vendor.OnBoarding') }}" class="btn btn-success"><i class="fas fa-edit"></i>
                        Edit Profile</a>
                    <button type="button" class="btn btn-info btn-md shadow-none add-service-button mt-2"
                        data-bs-toggle="modal" data-bs-target=".bs-modal-add-service">
                        <i class="ri-file-add-line align-middle"></i> Add New Service
                    </button>
                </div>
            </div>
        </div>
    </div>
    @if (auth()->user()->profile_approved_status == 1)
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
                                                                {{ auth()->user()->first_name ?? '' }}
                                                                {{ auth()->user()->last_name ?? '' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">E-mail:</th>
                                                            <td class="text-muted">
                                                                {{ auth()->user()->email ?? '' }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th scope="row">Phone:</th>
                                                            <td class="text-muted">
                                                                {{ auth()->user()->phone ?? '' }}
                                                            </td>
                                                        </tr>
                                                        {{-- <tr>
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
                                                    </tr> --}}

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
                                                            <th scope="row">Identifier ID:</th>
                                                            <td class="text-muted">
                                                                {{ auth()->user()->identifier ?? 'N/A' }}
                                                            </td>
                                                        </tr>
                                                        {{-- <tr>
                                                        <th scope="row">Vetting Options:</th>
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
                                                    </tr> --}}
                                                    </tbody>
                                                </table>
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
                                                <div class="col-12 d-flex my-2">
                                                    <span style="margin-right: 10px;"><strong>Languages: </strong></span>
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
                                                </div>
                                                <div class="col-12 d-flex my-2">
                                                    <span style="margin-right: 10px;"><strong>Vetting Options: </strong></span>
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
                                                                                        <div
                                                                                            class="flex-shrink-0 avatar-xs">
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
                                            <h5 class="card-title">Contact/Identity</h5>
                                            <div class="row">
                                                <div class="col-12 d-flex my-2">
                                                    <span><strong>Phone No: </strong></span>
                                                    <span class="ms-3">{{ auth()->user()->phone ?? 'N/A' }}</span>
                                                </div>
                                                <div class="col-12 d-flex my-2">
                                                    <span><strong>National ID: </strong></span>
                                                    <span
                                                        class="ms-3">{{ $identity->national_id_number ?? 'N/A' }}</span>
                                                </div>
                                                <div class="col-12 d-flex my-2">
                                                    <span><strong>National ID Image: </strong></span>
                                                    @if (!empty($identity->national_id_image))
                                                        <a href="{{ asset('storage/' . $identity->national_id_image) }}"
                                                            target="_blank">
                                                            <img src="{{ asset('storage/' . $identity->national_id_image) }}"
                                                                alt="CNIC Preview" width="70" height="50"
                                                                class="cnic-image">
                                                        </a>
                                                    @else
                                                        <span class="ms-3">N/A</span>
                                                    @endif
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
                                            <h5 class="card-title">Availability Schedule</h5>
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
                                        <div class="card-body">
                                            <h5 class="card-title">My Services</h5>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row row-cols-xxl-4 row-cols-lg-3 row-cols-1"
                                                        style="max-height: 600px; overflow-y: auto;">
                                                        @isset($services)
                                                            @if ($services->isNotEmpty())
                                                                @foreach ($services as $index => $service)
                                                                    <div class="col mb-4">
                                                                        <div class="card h-100">
                                                                            <div class="card-body d-flex flex-column">
                                                                                <div class="d-block mb-4 align-items-center">
                                                                                    <div class="flex-shrink-0 card-icons">
                                                                                        <div class="overlay-icons">
                                                                                            <a href="javascript:void(0)"
                                                                                                class="edit text-primary"
                                                                                                data-bs-toggle="modal"
                                                                                                data-bs-target=".bs-modal-edit-service"
                                                                                                onclick="serviceDetail({{ $service->id }},'edit-details')">
                                                                                                <i
                                                                                                    class="las la-pencil-alt"></i>
                                                                                                <span>Edit</span>
                                                                                            </a>
                                                                                            <a href="javascript:void(0)"
                                                                                                class="delete delete-service-button text-primary"
                                                                                                id="{{ $service->id }}"
                                                                                                data-bs-toggle="modal"
                                                                                                data-bs-target=".bs-modal-delete-vendor-service">
                                                                                                <i class="las la-trash"></i>
                                                                                                <span>Delete</span>
                                                                                            </a>
                                                                                        </div>
                                                                                        <div class="overlay-price">
                                                                                            <span>${{ $service->serviceCategory->price ?? '' }}</span>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <h6 class="mb-1 flex-grow-1">
                                                                                    <b>{{ $service->serviceCategory->name ?? 'No Name Available' }}</b>
                                                                                </h6>
                                                                                <a href="javascript:void(0)"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target=".bs-modal-view-service"
                                                                                    class="btn btn-primary btn-sm bg-primary border-primary mt-auto"
                                                                                    onclick="serviceDetail({{ $service->id }},'view-details')">View</a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @else
                                                                <div class="col-12">
                                                                    <p class="text-center">No services/Not approved yet</p>
                                                                </div>
                                                            @endif
                                                        @endisset
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
                                                                                    <h3 class="text-center text-dark">
                                                                                        No
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
                                                                                                <h6
                                                                                                    class="card-title mb-1">
                                                                                                    <a class="text-black"
                                                                                                        href="#">
                                                                                                        {{ $review->userDetails->name }}
                                                                                                    </a>
                                                                                                </h6>
                                                                                                <p
                                                                                                    class="card-text text-gray">
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
                                                                                    <div
                                                                                        class="d-flex justify-content-end">
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
    @endif

    <div class="modal fade bs-modal-add-service" tabindex="-1" aria-labelledby="mySmallModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Add Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action  = "{{ route('vendor.services.store') }}" class="needs-validation" novalidate
                        id = "add-service-form" method = "post" enctype = "multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <select class="form-select mb-3" aria-label="Default select example"
                                    id="service-category" name = "service_category_id" required>
                                    @isset($serviceCategories)
                                        @foreach ($serviceCategories as $index => $serviceCategory)
                                            <option value = "{{ $serviceCategory->id }}" {{ $index == 0 ? 'selected' : '' }}>
                                                {{ $serviceCategory->name }} | ${{ $serviceCategory->price }}</option>
                                        @endforeach
                                    @endisset
                                    <div class="invalid-feedback">
                                        Please select any service category
                                    </div>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit"
                                        class="btn btn-primary add-submit-button bg-primary border-primary">Add
                                        Service</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-modal-view-service" tabindex="-1" aria-labelledby="mySmallModalLabel"
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
                            <h5 class="list-title fs-15 mb-3 text-center service-details-title"></h5>
                            <div class="float-end">
                                <b class="price-tag">$<span class="service-details-price"></span></b>
                            </div>
                            <strong class="list-text mb-3 service-details-category"></strong>
                            <p class="list-text mb-0 service-details-description"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-modal-edit-service" tabindex="-1" aria-labelledby="mySmallModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Edit Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action  = "" id = "edit-service-form" class= "edit-needs-validation" novalidate
                        method = "post" enctype = "multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <select class="form-select mb-3" aria-label="Default select example"
                                    name = "service_category_id" id = "edit-service-category" required>
                                    @isset($serviceCategories)
                                        @foreach ($serviceCategories as $index => $serviceCategory)
                                            <option value = "{{ $serviceCategory->id }}" {{ $index == 0 ? 'selected' : '' }}>
                                                {{ $serviceCategory->name }} | ${{ $serviceCategory->price }}</option>
                                        @endforeach
                                    @endisset
                                    <div class="invalid-feedback">
                                        Please select any service category
                                    </div>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit"
                                        class="btn btn-primary edit-submit-button bg-primary border-primary">Update
                                        Service</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-modal-delete-vendor-service" tabindex="-1" aria-labelledby="mySmallModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Delete Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" id="delete-service-form" method = "post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body text-center p-5">
                        {{-- <img class="" alt="200x200" width="100"
                            src="{{ URL::asset('build/images/warning.gif') }}" data-holder-rendered="true"> --}}
                        <div class="mt-4">
                            <h4 class="mb-3">Delete this Service</h4>
                            <p class="text-muted mb-4"> Are you sure tou want to delete this service, You wnt be able to
                                restore it.</p>
                            <div class="hstack gap-2 justify-content-center">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type = "submit" class="btn btn-danger">Delete Service</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- <div class="tab-content">
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
                                                <img src="{{ URL::asset('build/images/profile-bg.jpg') }}" alt=""
                                                    class="avatar-sm rounded shadow">
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <h6 class="fs-14 mb-1">
                                                    {{ auth()->user()->first_name ?? '' }}
                                                    {{ auth()->user()->last_name ?? '' }}</h6>
                                                <p class="text-muted mb-0">Customer</p>
                                            </div>
                                        </div>
                                    </li>
                                    <li><i
                                            class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{ auth()->user()->email ?? '' }}
                                    </li>
                                    <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>+(256)
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
                                    <li><b>Appointment Start Date:</b><span class = "service-start-date"></span></li>
                                    <li><b>Appointment Date:</b>
                                    <li><b>Appointment Start Date:</b><span class = "service-end-date"></span></li>
                                    </li>
                                    <li><b>Time: <span class = "service-start-time"></span> - <span
                                                class = "service-end-time"></span></b></li>
                                    <li><b>Numbers of Days: Number of Days</b></li>
                                    <li><b class = "service-location">Location: Calefonia</b></li>
                                </ul>
                            </div>
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
            <form action="javascript:void(0);" class="form-steps payment-form-validation" autocomplete="off" novalidate
                id =  "payment-form">
                <div>
                    <div class="my-3">
                        <div class="form-check form-check-inline">
                            <input id="mtn-momo" name="paymentMethod" type="radio" class="form-check-input" checked>
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
    </div> --}}

    </div>
    </div>
    </div>
    </div>
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
                url: '{{ route('admin.updateonBoardingStatus') }}',
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
        });

        document.querySelector('.add-service-button').addEventListener('click', function() {
            isaddEditor = document.querySelector('#add-service-form .ck-editor');
            if (!isaddEditor) {
                ClassicEditor
                    .create(document.querySelector('#service-description'))
                    .then(editor => {})
                    .catch(error => {
                        console.error(error);
                    });
            }
        });

        function serviceDetail(serviceId, type) {
            let editServiceId = serviceId;
            let editApiUrl = "{{ url('service-provider/services') }}" + "/" + editServiceId;
            let editServiceForm = $("#edit-service-form");
            $(editServiceForm).trigger('reset');
            $(editServiceForm).attr('action', editApiUrl);
            fetch(editApiUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    if (data.serviceDetails) {
                        if (type === 'edit-details') {} else if (type == 'view-details') {
                            $(".service-details-title").text(data.serviceDetails.title);
                            $(".service-details-price").text(data.serviceDetails.service_category.price);
                            var description = data.serviceDetails.service_category.description;
                            $(".service-details-category").html(data.serviceDetails.service_category.name);
                            $(".service-details-delete").attr('id', serviceId);
                        }
                    } else {
                        console.log('Service details not found.');
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }

        const profilePicture = document.getElementById('profile-picture');
        const avatarInput = document.getElementById('avatar-input');

        profilePicture.addEventListener('click', () => {
            avatarInput.click();
        });

        avatarInput.addEventListener('change', (event) => {
            const selectedFile = event.target.files[0];
            if (selectedFile) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    profilePicture.src = e.target.result;

                    const formData = new FormData();
                    formData.append('avatar', selectedFile);

                    $.ajax({
                        url: '/service-provider/upload-avatar',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(data) {
                            toastr.success('Profile Image Updated successfully');
                            setTimeout(function() {
                                window.location.reload();
                            }, 2000);
                        },
                        error: function(error) {
                            console.error('Error uploading avatar:', error);
                        }
                    });
                };
                reader.readAsDataURL(selectedFile);
            }
        });
    </script>
@endsection
