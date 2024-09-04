@extends('admin.layouts.master')
@section('title')
    Disable Platform | Service Provider
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}">

    <style>
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
                        <img src="@if ($appointmentDetails->serviceProvider->avatar != '') {{ URL::asset('images/' . $appointmentDetails->serviceProvider->avatar) }}@else{{ URL::asset('build/images/users/avatar-1.jpg') }} @endif"
                            alt="user-img" class="img-thumbnail rounded-circle" />
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ $appointmentDetails->serviceProvider->first_name }}
                        {{ $appointmentDetails->serviceProvider->last_name }}</h3>
                    <p class="text-white text-opacity-75">Service Provider</p>
                    <div class="hstack text-white-50 gap-1">
                        <div class="me-2"><i
                                class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>{{ $companyAddress->town->name ?? '' }}
                            {{ $companyAddress->city->name ?? '' }}
                            {{ isset($companyAddress->country->country_name) ? ', ' . $companyAddress->country->country_name : '' }}
                        </div>
                    </div>
                </div>
            </div>
            <!--end col-->
            <div class="col-12 col-lg-auto order-last order-lg-0">
                <div class="row text text-white-50 text-center">
                    @isset($appointmentDetails->disbursementDetails)
                        @if ($appointmentDetails->disbursementDetails->status == 2)
                            <a href="javascript:void(0);" class="btn btn-secondary make-appointment-button mb-2">
                                <i class="ri-wallet-line align-bottom"></i> Service Provider Payment Approved
                            </a>
                        @elseif($appointmentDetails->disbursementDetails->status == 1)
                            <a href="javascript:void(0);" class="btn btn-secondary make-appointment-button mb-2"
                                onclick="event.preventDefault(); document.getElementById('user-approve-vendor-payment-form-{{ $appointmentDetails->id }}').submit();">
                                <i class="ri-check-line align-bottom"></i> Approve Service Provider Payment Request
                            </a>
                            <form id = "user-approve-vendor-payment-form-{{ $appointmentDetails->id }}" method = "POST"
                                action = "{{ route('admin.adminApproveVendorPayment', $appointmentDetails->id) }}">
                                @csrf
                            </form>
                        @endif
                    @elseif($appointmentDetails->collectionDetails)
                        <a href="javascript:void(0);" class="btn btn-secondary make-appointment-button mb-2">
                            <i class="ri-bank-card-line align-bottom"></i> Payment Initiated
                        </a>
                    @endisset
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
                            <div class="col-xxl-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Service Provider Info</h5>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Name:</th>
                                                        <td class="text-muted">
                                                            {{ $appointmentDetails->serviceProvider->first_name }}
                                                            {{ $appointmentDetails->serviceProvider->last_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">E-mail:</th>
                                                        <td class="text-muted">
                                                            {{ $appointmentDetails->serviceProvider->email }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Phone No:</th>
                                                        <td class="text-muted">
                                                            {{ $appointmentDetails->serviceProvider->phone ?? 'N/A' }}
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Location:</th>
                                                        <td class="text-muted">{{ $companyAddress->town->name ?? '' }}
                                                            {{ $companyAddress->city->name ?? '' }}
                                                            {{ isset($companyAddress->country->country_name) ? ', ' . $companyAddress->country->country_name : '' }}
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
                                    </div><!-- end card body -->
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">User Info</h5>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Name:</th>
                                                        <td class="text-muted">
                                                            {{ $appointmentDetails->user->first_name }}
                                                            {{ $appointmentDetails->user->last_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">E-mail:</th>
                                                        <td class="text-muted">
                                                            {{ $appointmentDetails->user->email }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Phone No:</th>
                                                        <td class="text-muted">
                                                            {{ $appointmentDetails->user->phone ?? 'N/A' }}
                                                        </td>
                                                    </tr>

                                                    {{-- <tr>
                                                        <th scope="row">Location:</th>
                                                        <td class="text-muted">{{ $companyAddress->town->name ?? '' }}
                                                            {{ $companyAddress->city->name ?? '' }}
                                                            {{ isset($companyAddress->country->country_name) ? ', ' . $companyAddress->country->country_name : '' }}
                                                        </td>
                                                    </tr> --}}
                                                    {{-- <tr>
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
                                                            @if (isset($appointmentDetails->user->gender))
                                                                @if ($appointmentDetails->user->gender == 0)
                                                                    Male
                                                                @elseif ($appointmentDetails->user->gender == 1)
                                                                    Female
                                                                @elseif ($appointmentDetails->user->gender == 2)
                                                                    Prefer not to say
                                                                @else
                                                                    N/A
                                                                @endif
                                                            @else
                                                                N/A
                                                            @endif
                                                        </td>
                                                    </tr>

                                                    {{-- <tr>
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
                                                    </tr> --}}
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- end card body -->
                                </div>

                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Service Details</h5>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Name:</th>
                                                        <td class="text-muted">
                                                            {{ $appointmentDetails->serviceDetails->serviceCategory->name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Description:</th>
                                                        <td class="text-muted" style="max-width: 300px; overflow-y: auto;">
                                                            <div style="max-height: 200px; overflow-y: auto;">
                                                                @php
                                                                    $description = strip_tags(
                                                                        $appointmentDetails->serviceDetails
                                                                            ->serviceCategory->description,
                                                                    );
                                                                    $firstPart = Str::words($description, 10, '');
                                                                    $remainingPart = trim(
                                                                        str_replace($firstPart, '', $description),
                                                                    );
                                                                @endphp

                                                                <div id="descriptionContent">
                                                                    <span id="firstPart">{{ $firstPart }}</span>
                                                                    @if (!empty($remainingPart))
                                                                        <span id="dots">...</span>
                                                                        <span id="more"
                                                                            style="display: none;">{{ $remainingPart }}</span>
                                                                        <a href="javascript:void(0);"
                                                                            onclick="toggleDescription()"
                                                                            id="myBtn">Read More</a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Price:</th>
                                                        <td class="text-muted">
                                                            ${{ $appointmentDetails->serviceDetails->serviceCategory->price }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div><!-- end card body -->
                                </div><!-- end card -->
                            </div>
                            <!--end col-->
                            <div class="col-xxl-9">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0  me-2">Experience</h4>
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
                                                                                        <div
                                                                                            class="d-flex border border-dashed p-2 rounded position-relative shadow">
                                                                                            <div class="flex-shrink-0">
                                                                                                <i
                                                                                                    class="ri-image-2-line fs-17 text-danger"></i>
                                                                                            </div>
                                                                                            <div class="flex-grow-1 ms-2">
                                                                                                <h6 class="mb-0">
                                                                                                    <img src='{{ asset("uploads/$qualification->image") }}'
                                                                                                        alt=""
                                                                                                        width="50"
                                                                                                        height="50"
                                                                                                        class="qualification-image @if (!$qualification->image) d-none @endif" />
                                                                                                </h6>
                                                                                                <small>685
                                                                                                    KB</small>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                    <div class="accordion-item border-0 mb-3">
                                                                        <div class="accordion-header" id="headingTwo">
                                                                            <a class="accordion-button p-2 shadow-none">
                                                                                <div class="d-flex">
                                                                                    <div class="flex-shrink-0 avatar-xs">
                                                                                        <div class="avatar-title bg-light text-danger rounded-circle shadow"
                                                                                            style="margin-top: -9px";>
                                                                                            N/A
                                                                                        </div>
                                                                                    </div>
                                                                                    <div
                                                                                        class="flex-grow-1
                                                                                            ms-3">
                                                                                        <h6 class="fs-14 mb-1">
                                                                                            No qualifications found
                                                                                        </h6>
                                                                                    </div>
                                                                                </div>
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
                                                    class="ms-3">{{ $companyAddress->country->country_name ?? '' }}</span>
                                            </div>
                                            <div class="col-12 d-flex my-2">
                                                <span><strong>City: </strong></span>
                                                <span class="ms-3">{{ $companyAddress->city->name ?? '' }}</span>
                                            </div>
                                            <div class="col-12 d-flex my-2">
                                                <span><strong>Street: </strong></span>
                                                <span class="ms-3">{{ $companyAddress->town->name ?? '' }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end card body -->
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
                                                <span class="ms-3">
                                                    @if ($appointmentSchedule)
                                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $appointmentSchedule?->from)->format('H:i A') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="col-12 d-flex my-2">
                                                <span><strong>To Time: </strong></span>
                                                <span class="ms-3">
                                                    @if ($appointmentSchedule)
                                                        {{ \Carbon\Carbon::createFromFormat('H:i:s', $appointmentSchedule?->to)->format('H:i A') }}
                                                    @else
                                                        N/A
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </div>
                    <!--end tab-pane-->
                </div>
                <!--end tab-content-->
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
    <!-- appointment modal -->
    <div class="modal fade bs-modal-make-appointment" tabindex="-1" aria-labelledby="mySmallModalLabel1"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel1">Make Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="appointment-validation" novalidate id = "make-appointment-form"
                        action = "{{ route('user.makeCollectionPayment', $appointmentDetails->id) }}" method = "post">
                        @csrf
                        <input type = "hidden" name= "vendor_id"
                            value = "{{ $appointmentDetails->serviceProvider->id }}">
                        <input type = "hidden" name= "service_id"
                            value = "{{ $appointmentDetails->serviceDetails->id }}">
                        <input type = "hidden" name= "service_category_id"
                            value = "{{ $appointmentDetails->serviceDetails->service_category_id }}">
                        <input type = "hidden" name= "appointment_id" value = "{{ $appointmentDetails->id }}">
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <label for="basiInput" class="form-label">Enter your mtn mobile number</label>
                                    <input type="number" name = "mtn_number" class="form-control" id="UserName"
                                        placeholder="MTN Number" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary make-appointment">Make Payment</button>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@push('page-script')
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/profile.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

    <script>
        function toggleDescription() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read More";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Read Less";
                moreText.style.display = "inline";
            }
        }
    </script>
@endpush
