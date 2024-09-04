@extends('vendor-user.layouts.master')
@section('title')
    Disable Platform | Service Provider
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('build/css/chat.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

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

        .chat-scrollable {
            max-height: 600px;
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .chat-scrollable::-webkit-scrollbar {
            width: 6px;
        }

        .chat-scrollable::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 3px;
        }

        .chat-scrollable::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

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

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table th {
            width: 30%;
        }
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Appointment Details
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
                        <img src="@if ($appointmentDetails->user->avatar != '') {{ URL::asset('images/' . $appointmentDetails->user->avatar) }}@else{{ URL::asset('build/images/users/avatar-1.jpg') }} @endif"
                            alt="user-img" class="img-thumbnail rounded-circle" />
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="p-2">
                    <h3 class="text-white mb-1">{{ $appointmentDetails->user->first_name }}
                        {{ $appointmentDetails->user->last_name }}</h3>
                    <p class="text-white text-opacity-75">System User</p>
                </div>
            </div>
            <!--end col-->
            <div class="col-12 col-lg-auto order-last order-lg-0">
                <div class="row text text-white-50 text-center">
                    @if ($appointmentDetails->appointment_status == '')
                        <button class="btn btn-success approve-btn" data-id="{{ $appointmentDetails->id }}" title="Approve">
                            <i class="fas fa-check"></i> Accept Request
                        </button>
                        <button class="btn btn-danger reject-btn mt-2" data-id="{{ $appointmentDetails->id }}"
                            title="Reject">
                            <i class="fas fa-times"></i> Reject Request
                        </button>
                    @endif
                    @isset($appointmentDetails->disbursementDetails)
                        @if ($appointmentDetails->disbursementDetails->status == 0)
                            <a href="javascript:void(0);" class="btn btn-success make-appointment-button">
                                <i class="ri-user-follow-line align-bottom"></i> Waiting for User Approval
                            </a>
                        @elseif($appointmentDetails->disbursementDetails->status == 1)
                            <a href="javascript:void(0);" class="btn btn-success make-appointment-button">
                                <i class="ri-time-line align-bottom"></i> Waiting for Admin Approval
                            </a>
                        @elseif($appointmentDetails->disbursementDetails->status == 2)
                            <a href="javascript:void(0);" class="btn btn-success make-appointment-button">
                                <i class="ri-checkbox-circle-line align-bottom"></i> Payment Approved
                            </a>
                        @endif
                        {{-- @elseif($appointmentDetails->collectionDetails) --}}
                    @elseif($appointmentDetails->status == '0')
                        <a href="javascript:void(0);" class="btn btn-success make-appointment-button" data-bs-toggle="modal"
                            data-bs-target=".bs-modal-make-appointment">
                            <i class="ri-money-dollar-circle-line align-bottom"></i> Request Payment</a>
                    @endisset

                    {{-- @if ($appointment->appointment_status == '')
                        <div>
                            <button class="btn btn-success btn-sm approve-btn" data-id="{{ $appointment->id }}"
                                title="Approve">
                                <i class="fas fa-check"></i>
                            </button>
                            <button class="btn btn-danger btn-sm reject-btn" data-id="{{ $appointment->id }}"
                                title="Reject">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif --}}
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
                                        <h5 class="card-title mb-3">User Info</h5>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Name :</th>
                                                        <td class="text-muted">
                                                            {{ $appointmentDetails->user->first_name }}
                                                            {{ $appointmentDetails->user->last_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">E-mail :</th>
                                                        <td class="text-muted">
                                                            {{ $appointmentDetails->user->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Phone:</th>
                                                        <td class="text-muted">
                                                            {{ $appointmentDetails->user->phone ?? 'N/A' }}</td>
                                                    </tr>
                                                    @if ($appointmentDetails->user->created_at)
                                                        <tr>
                                                            <th scope="row">Joining Date</th>
                                                            <td class="text-muted">
                                                                {{ $appointmentDetails->user->created_at->format('d M Y') }}
                                                            </td>
                                                        </tr>
                                                    @endif
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
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
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
                                                        <th scope="row">Price:</th>
                                                        <td class="text-muted">
                                                            ${{ $appointmentDetails->serviceDetails->serviceCategory->price }}
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xxl-9">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-4">Actions</h5>
                                        <a href="javascript:void(0);" class="btn btn-primary mb-3"
                                            onclick="loadChatModule('{{ route('user', $appointmentDetails->user->id) }}')">
                                            Chat with User
                                        </a>
                                        <div id="chatModuleContainer" style="display: none;">
                                            <iframe id="chatModuleIframe" src=""
                                                style="width: 100%; height: 500px; border: none;"></iframe>
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
                    <h5 class="modal-title" id="mySmallModalLabel1">Request Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="appointment-validation" novalidate id = "make-appointment-form"
                        action = "{{ route('vendor.WithDrawFund') }}" method = "post">
                        @csrf
                        <input type = "hidden" name= "appointment_id" value = "{{ $appointmentDetails->id }}">
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                @php
                                    $serviceCharges = ($appointmentDetails->serviceDetails->price * 5) / 100;
                                    $remainingAmount = $appointmentDetails->serviceDetails->price - $serviceCharges;
                                @endphp
                                <div>Total price of your service is
                                    ${{ $appointmentDetails->serviceDetails->serviceCategory->price }}.service charges
                                    is
                                    5%. you will
                                    receive ${{ $remainingAmount }}</div>
                                <div>
                                    <label for="basiInput" class="form-label">Enter your mtn mobile number</label>
                                    <input type="number" name = "mtn_number" class="form-control" id="UserName"
                                        placeholder="MTN Number" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary make-appointment">Request
                                        Payment</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page-script')
    <script src="{{ asset('js/chatify/font.awesome.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/profile.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

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

        $(document).ready(function() {
            $('.approve-btn').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ url('/service-provider/appointments/approve') }}/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.success) {
                            toastr.success(response.message);
                            location.reload();
                        }
                    }
                });
            });

            $('.reject-btn').click(function() {
                var id = $(this).data('id');
                $.ajax({
                    url: '{{ url('/service-provider/appointments/reject') }}/' + id,
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            toastr.success(response.message);
                            location.reload();
                        }
                    }
                });
            });
        });

        function loadChatModule(url) {
            document.getElementById('chatModuleContainer').style.display = 'block';
            document.getElementById('chatModuleIframe').src = url;
        }
    </script>
@endpush
