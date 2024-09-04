@extends('user.layouts.master')
@section('title')
    Transaction History
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/aos/aos.css') }}" rel="stylesheet">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Transaction History
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
                <div class="row">

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex justify-content-between">
                                <h4 class="card-title mb-0">Loaded Balance</h4>
                                <h5 class="text-muted">Remaining Balance: {{ $remainingBalance }}</h5>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">MTN Number</th>
                                                <th scope="col">Amount (USD)</th>
                                                <th scope="col">Type</th>
                                                <th scope="col">Transaction Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($otherTransactions)
                                                @foreach ($otherTransactions as $index => $transaction)
                                                    <tr>
                                                        <td>{{ $transaction->mtn_number ?? '' }} </td>
                                                        <td>{{ $transaction->amount ?? '' }}</td>
                                                        <td><span
                                                                class="badge bg-success">{{ $transaction->transaction_type ?? '' }}</span>
                                                        </td>
                                                        <td>{{ $transaction->transaction_status ?? '' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0">Booked Services</h4>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">Service Category</th>
                                                <th scope="col">Amount(USD)</th>
                                        </thead>
                                        <tbody>
                                            @isset($userAppointments)
                                                @foreach ($userAppointments as $index => $appointment)
                                                    <tr>
                                                        <td>{{ date('d-m-Y', strtotime($appointment->start_date)) }} -
                                                            {{ date('d-m-Y', strtotime($appointment->end_date)) }}
                                                        </td>
                                                        <td>{{ date('h:i A', strtotime($appointment->start_time)) ?? '' }} -
                                                            {{ date('h:i A', strtotime($appointment->end_time)) ?? '' }}</td>
                                                        <td>{{ $appointment->serviceDetails->serviceCategory->name ?? '' }}
                                                        </td>
                                                        <td>-{{ $appointment->purchase_amount ?? '' }}</td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-modal-edit-appointment" tabindex="-1" aria-labelledby="mySmallModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Edit Admin</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0);" id = "edit-user-form">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <input type="text" name="first_name" class="form-control" id="ServiceName"
                                        placeholder="Title">
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <div>
                                    <input type="date" name="last_name" class="form-control" id="ServiceName"
                                        placeholder="Date">
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <div>
                                    <input type="time" name="email" class="form-control" id="UserName"
                                        placeholder="Time">
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <div>
                                    <input type="text" name="email" class="form-control" id="UserName"
                                        placeholder="Location">
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <div>
                                    <input type="number" name="phone_number" class="form-control" id="UserName"
                                        placeholder="Phone Number">
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <select class="form-select" aria-label=".form-select-sm example">
                                    <option selected="">Change Category</option>
                                    <option value="1">One</option>
                                    <option value="2">Two</option>
                                    <option value="3">Three</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Appointment</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-modal-delete-appointment" tabindex="-1" aria-labelledby="mySmallModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Cancel Appointment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-5">
                    <img class="" alt="200x200" width="100"
                        src="{{ URL::asset('build/images/warning.gif') }}" data-holder-rendered="true">
                    <div class="mt-4">
                        <h4 class="mb-3">Cancel this Appointment</h4>
                        <p class="text-muted mb-4"> Are you sure tou want to Cancel this Appointment, YOu wnt be able to
                            restore it.</p>
                        <div class="hstack gap-2 justify-content-center">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <a href="javascript:void(0);" class="btn btn-danger">Cancel Appointment</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/aos/aos.js') }}"></script>
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/animation-aos.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
