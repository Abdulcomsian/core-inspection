@extends('admin.layouts.master')
@section('title')
    Commissions
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Booked Services Commission
        @endslot
    @endcomponent

    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row">

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">APPOINTMENTS COMMISSION</h4>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">Support Service</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Time</th>
                                                <th scope="col">Location</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Service Provider</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Commision</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($allAppointments)
                                                @foreach ($allAppointments as $index => $appointment)
                                                    <tr>
                                                        <td>{{ $appointment->serviceDetails->serviceCategory->name ?? '' }}</td>
                                                        <td>{{ date('d/m/Y', strtotime($appointment->start_date)) }}-{{ date('d/m/Y', strtotime($appointment->end_date)) }}
                                                        </td>
                                                        <td>{{ date('h:i A', strtotime($appointment->start_time)) ?? '' }}-{{ date('h:i A', strtotime($appointment->end_time)) ?? '' }}
                                                        </td>
                                                        <td>{{ $appointment->location ?? '' }}</td>
                                                        <td>{{ $appointment->user->first_name ?? '' }}
                                                            {{ $appointment->user->last_name ?? '' }}</td>
                                                        <td>{{ $appointment->serviceProvider->first_name ?? '' }}
                                                            {{ $appointment->serviceProvider->last_name ?? '' }}</td>
                                                        @if (isset($appointment->disbursementDetails))
                                                            @if ($appointment->disbursementDetails->status == 2)
                                                                <td><span class="badge bg-success">Completed</span></td>
                                                            @endif
                                                        @elseif(isset($appointment->collectionDetails))
                                                            <td><span class="badge bg-warning">Processing</span></td>
                                                        @else
                                                            <td><span class="badge bg-warning">Pending</span></td>
                                                        @endif
                                                        <td>${{ $appointment->serviceDetails->serviceCategory->price }}</td>
                                                        @if ($appointment->disbursementDetails)
                                                            <td>${{ $appointment->disbursementDetails->commission_amount ?? '' }}
                                                            </td>
                                                        @else
                                                            <td>NULL</td>
                                                        @endif
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

@endsection
@section('script')
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
