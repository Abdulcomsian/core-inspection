@extends('user.layouts.master')
@section('title')
    Dashboard
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/aos/aos.css') }}" rel="stylesheet">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Dashboard
        @endslot
    @endcomponent

    <style>
        .avatar-title {
            margin-top: -18px;
        }
    </style>
    <div class="row">
        <div class="col">

            <div class="h-100">
                {{--
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-16 mb-1">Welcome Back, John Doe!</h4>
                            <p class="text-muted mb-0">Here's what's happening in your Services Portal today.</p>
                        </div>
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>
            --}}
                <!--end row-->

                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Appointments</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">{{ $countAppointment }}
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success rounded fs-3">
                                            <i class="mdi mdi-calendar-month"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Service Providers</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">{{ $countServiceProviders }}
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success rounded fs-3">
                                            <i class="mdi mdi-view-dashboard"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Service Categories</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">{{ $countServiceCategories }}</h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info rounded fs-3">
                                            <i class="mdi mdi-chart-bar"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Wallet</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">${{ getUserWalletBalance() }}
                                        </h4>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-danger rounded fs-3">
                                            <i class="mdi mdi-wallet"></i>
                                        </span>
                                    </div>
                                </div>

                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                </div> <!-- end row-->


                <div class="row">

                    <div class="col-xl-8">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">APPOINTMENTS</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">Appointment Request</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Start</th>
                                                <th scope="col">End</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Appointment Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($allAppointments)
                                                @if ($allAppointments->isEmpty())
                                                    <tr>
                                                        <td>No result found</td>
                                                    </tr>
                                                @else
                                                    @foreach ($allAppointments as $index => $appointment)
                                                        <tr>
                                                            <td>{{ $appointment->user->first_name ?? '' }}
                                                                {{ $appointment->user->last_name ?? '' }}</td>
                                                            <td>{{ date('d/m/Y', strtotime($appointment->start_date)) }}-{{ date('d/m/Y', strtotime($appointment->end_date)) }}
                                                            </td>
                                                            <td>{{ date('h:i A', strtotime($appointment->start_time)) ?? '' }}
                                                            </td>
                                                            <td>{{ date('h:i A', strtotime($appointment->end_time)) ?? '' }}
                                                            </td>
                                                            @if (isset($appointment->disbursementDetails))
                                                                @if ($appointment->disbursementDetails->status == 2)
                                                                    <td><span class="badge bg-success">Admin Approved &
                                                                            Withdrawn</span></td>
                                                                @elseif($appointment->disbursementDetails->status == 1)
                                                                    <td><span class="badge bg-success">User Approved</span></td>
                                                                @else
                                                                    <td><span class="badge bg-success">Provider Requested</span>
                                                                    </td>
                                                                @endif
                                                                {{-- @elseif(isset($appointment->collectionDetails)) --}}
                                                            @elseif($appointment->status == '0')
                                                                <td><span class="badge bg-success">Payment Initiated</span></td>
                                                            @else
                                                                <td>
                                                                    <span class="badge bg-warning">Pending</span>
                                                                </td>
                                                            @endif
                                                            <td>
                                                                @if ($appointment->appointment_status == 1)
                                                                    <span class="badge bg-success">Approved</span>
                                                                @elseif ($appointment->appointment_status == 2)
                                                                    <span class="badge bg-danger">Rejected</span>
                                                                @else
                                                                    <span class="badge bg-info">Pending</span>
                                                                @endif
                                                            </td>
                                                            <td>

                                                                <div class="hstack gap-3 flex-wrap">
                                                                    <a href="{{ route('user.appointmentDetails', ['id' => $appointment->id, 'vendor_id' => $appointment->serviceProvider->id]) }}"
                                                                        class="link-success fs-23 Edit-Button"
                                                                        title = "Service Reviews"><i class="las la-eye"></i></a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            @endisset
                                            {{--
                                        <tr>
                                            <td>Personal assistants</td>
                                            <td>10 Feb 2024</td>
                                            <td></td>
                                            <td></td>
                                            <td>Pending</td>
                                            <td>
                                                <div class="hstack gap-3 flex-wrap">
                                                    <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target=".bs-modal-edit-service" class="link-success fs-23"><i class="las la-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Personal assistants</td>
                                            <td>10 Feb 2024</td>
                                            <td></td>
                                            <td></td>
                                            <td>Pending</td>
                                            <td>
                                                <div class="hstack gap-3 flex-wrap">
                                                    <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target=".bs-modal-edit-service" class="link-success fs-23"><i class="las la-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Personal assistants</td>
                                            <td>10 Feb 2024</td>
                                            <td></td>
                                            <td></td>
                                            <td>Pending</td>
                                            <td>
                                                <div class="hstack gap-3 flex-wrap">
                                                    <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target=".bs-modal-edit-service" class="link-success fs-23"><i class="las la-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Personal assistants</td>
                                            <td>10 Feb 2024</td>
                                            <td></td>
                                            <td></td>
                                            <td>Pending</td>
                                            <td>
                                                <div class="hstack gap-3 flex-wrap">
                                                    <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target=".bs-modal-edit-service" class="link-success fs-23"><i class="las la-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        --}}
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div>
                            </div>
                        </div> <!-- .card-->
                    </div> <!-- .col-->
                    <div class="col-xxl-4 col-xl-6">
                        <div class="card" style="height:94%;">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Activities</h4>
                            </div><!-- end card header -->
                            <div class="card-body">
                                <div class="live-preview">
                                    <ul class="list-group">
                                        @isset($allAppointments)
                                            @if ($allAppointments->isEmpty())
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    No result found
                                                </li>
                                            @else
                                                @foreach ($allAppointments as $index => $appointment)
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center">
                                                        {{ $appointment->serviceDetails->serviceCategory->name ?? '' }}
                                                        @if (isset($appointment->disbursementDetails))
                                                            @if ($appointment->disbursementDetails->status == 2)
                                                                <span class="badge bg-success">Admin Approved & Withdrawn</span>
                                                            @elseif($appointment->disbursementDetails->status == 1)
                                                                <span class="badge bg-success">User Approved</span>
                                                            @else
                                                                <span class="badge bg-success">Provider Requested</span>
                                                            @endif
                                                        @elseif(isset($appointment->collectionDetails))
                                                            <span class="badge bg-success">Payment Initiated</span>
                                                        @else
                                                            <span class="badge bg-warning">Pending</span>
                                                        @endif
                                                    </li>
                                                @endforeach
                                            @endif
                                        @endisset
                                    </ul>
                                </div>
                                <div class="d-none code-view">
                                </div>
                            </div><!-- end card-body -->
                        </div><!-- end card -->
                    </div>

                </div> <!-- end row-->
                {{--
            <div class="row">
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">WALLET</h4>
                            <h5 class="text-muted fs-14 mb-0">
                               <i class="ri-wallet-2-line fs-21"></i>
                            </h5>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="card-radio">
                                <label class="form-check-label" for="listGroupRadioGrid1">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1">Ballance</h6>
                                            <b class="pay-amount">$8,500</b>
                                        </div>
                                        <div class="hstack gap-2 mt-3 justify-content-center a-auto">
                                            <button class="btn btn-outline-primary btn-border">Deposit Funds</button>
                                            <button class="btn btn-outline-success btn-border">Withdraw Funds</button>
                                        </div>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div> <!-- .card-->
                </div> <!-- .col-->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">RECOMMENDATIONS</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-centered align-middle table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Recomended</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>12 Feb 2024</td>
                                            <td>John Doe</td>
                                        </tr>
                                        <tr>
                                            <td>12 Feb 2024</td>
                                            <td>John Doe</td>
                                        </tr>
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>
                        </div>
                    </div> <!-- .card-->
                </div> <!-- .col-->
                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Completed Appointments</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-centered align-middle table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Appointment</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>12 Feb 2024</td>
                                            <td>John Doe</td>
                                            <td class="text-success"><b>Completed</b></td>
                                        </tr>
                                        <tr>
                                            <td>12 Feb 2024</td>
                                            <td>John Doe</td>
                                            <td class="text-success"><b>Completed</b></td>
                                        </tr>
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>
                        </div>
                    </div> <!-- .card-->
                </div> <!-- .col-->
            </div>
                    --}}
                <!-- end row-->

            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>

    <div class="modal fade bs-modal-edit-service" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Booking Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-0">
                        <div class="col-lg-12">
                            <a href="javascript:void(0);" class="list-group-item list-group-item-action">
                                <div class="float-end">
                                    <b class="text-success">$100</b>
                                </div>
                                <div class="d-flex mb-2 align-items-center">
                                    <div class="flex-shrink-0">
                                        <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt=""
                                            class="avatar-sm rounded-circle">
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h5 class="list-title fs-15 mb-1">Angela Bernier</h5>
                                        <p class="list-text mb-0 fs-12">+123 456 7890</p>
                                    </div>
                                </div>
                                <p class="list-text mb-0">Just like in the image where we talked about using multiple
                                    fonts, you can see that the background in this graphic design is blurred. Whenever you
                                    put text on top of an image, it’s important that your viewers can understand the text,
                                    and sometimes that means applying a gaussian readable.</p>
                                <div class="hstack gap-2 mt-3 justify-content-center a-auto">
                                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Close</button>
                                    <a href="javascript:void(0);" class="btn btn-danger">Cancel Appointment</a>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/aos/aos.js') }}"></script>
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/animation-aos.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
