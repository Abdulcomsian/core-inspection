@extends('user.layouts.master')
@section('title')
    Disable Platform | Service Provider
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('build/css/chat.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    <style>
        .rating-box {
            position: relative;
            background: #fff;
            padding: 25px 50px 35px;
            border-radius: 25px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.05);
        }

        .rating-box header {
            font-size: 22px;
            color: #dadada;
            font-weight: 500;
            margin-bottom: 20px;
            text-align: center;
        }

        .rating-box .stars {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .stars i {
            color: #e6e6e6;
            font-size: 35px;
            cursor: pointer;
            transition: color 0.2s ease;
        }

        .stars i.active {
            color: #ff9c1a !important;
        }

        @media screen and (min-width: 761px) {
            .adjust_height {
                height: 45px;
            }
        }

        .btn-paid {
            background-color: #28a745;
            /* Green */
            border-color: #28a745;
        }

        .btn-pending {
            background-color: #ffc107;
            /* Yellow */
            border-color: #ffc107;
        }

        .btn-approved {
            background-color: #28a745;
            /* Green */
            border-color: #28a745;
        }

        .btn-rejected {
            background-color: #dc3545;
            /* Red */
            border-color: #dc3545;
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

        .chat-scrollable {
            max-height: 600px;
            /* Adjust the height as needed */
            overflow-y: auto;
            padding: 10px;
            border: 1px solid #ccc;
            /* Optional: Add a border for better visualization */
        }

        /* Optional: Additional styling for the chat container */
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
                    <p class="text-white text-opacity-75">{{ $appointmentDetails->serviceProvider->type ?? '' }}</p>
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
                        @if ($appointmentDetails->disbursementDetails->status == 0)
                            <a href="javascript:void(0);" class="btn btn-secondary make-appointment-button mb-2"
                                onclick= "event.preventDefault();document.getElementById('user-approve-vendor-payment-form-{{ $appointmentDetails->id }}').submit();"><i
                                    class="ri-check-line align-bottom"></i> Approve Service Provider Payment Request</a>
                            <form id = "user-approve-vendor-payment-form-{{ $appointmentDetails->id }}" method = "POST"
                                action = "{{ route('user.userApproveVendorPayment', $appointmentDetails->id) }}">
                                @csrf
                            </form>
                        @elseif($appointmentDetails->disbursementDetails->status == 1)
                            <a href="javascript:void(0);" class="btn btn-secondary make-appointment-button mb-2"><i
                                    class="ri-wallet-line align-bottom"></i> Service Provider Payment Approved</a>
                        @elseif($appointmentDetails->disbursementDetails->status == 2)
                            <a href="javascript:void(0);" class="btn btn-secondary make-appointment-button mb-2"
                                data-bs-toggle="modal" data-bs-target=".bs-modal-review">
                                <i class="ri-star-line align-bottom"></i> Rate and Review Service
                            </a>
                        @endif
                    @endisset

                    {{-- @isset($appointmentDetails->collectionDetails)
                        <a class="btn btn-success make-appointment-button btn-paid"><i class="fa fa-thumbs-up"></i> Paid</a>
                    @else
                        @if ($appointmentDetails->appointment_status == '2')
                            <a class="btn btn-danger make-appointment-button"><i class="fas fa-times-circle"></i>
                                Rejected</a>
                        @elseif($appointmentDetails->appointment_status == '1')
                            <a href="javascript:void(0);" class="btn btn-success make-appointment-button" data-bs-toggle="modal"
                                data-bs-target=".bs-modal-make-appointment"><i class="fas fa-money-bill-wave"></i>
                                Make
                                Payment</a>
                        @else
                            <a class="btn btn-info make-appointment-button"><i class="fas fa-hourglass-half"></i>
                                Waiting for Acceptance</a>
                        @endif
                    @endisset --}}

                    @if (isset($appointmentDetails) && $appointmentDetails->status == '0')
                        <a class="btn btn-success make-appointment-button btn-paid"><i class="fa fa-thumbs-up"></i> Paid</a>
                    @else
                        @if ($appointmentDetails->appointment_status == '2')
                            <a class="btn btn-danger make-appointment-button"><i class="fas fa-times-circle"></i>
                                Rejected</a>
                        @elseif($appointmentDetails->appointment_status == '1')
                            <a href="javascript:void(0);" class="btn btn-success make-appointment-button"
                                data-bs-toggle="modal" data-bs-target=".bs-modal-make-appointment"><i
                                    class="fas fa-money-bill-wave"></i>
                                Make
                                Payment</a>
                        @else
                            <a class="btn btn-info make-appointment-button"><i class="fas fa-hourglass-half"></i>
                                Waiting for Acceptance</a>
                        @endif
                    @endisset
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
                                <div class="card mb-3">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Info</h5>
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Name:</th>
                                                        <td class="text-muted">
                                                            {{ $appointmentDetails->serviceProvider->first_name }}
                                                            {{ $appointmentDetails->serviceProvider->last_name }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Mobile:</th>
                                                        <td class="text-muted">
                                                            {{ $appointmentDetails->serviceProvider->phone ?? 'N/A' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">E-mail:</th>
                                                        <td class="text-muted">
                                                            {{ $appointmentDetails->serviceProvider->email }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Location:</th>
                                                        <td class="text-muted">
                                                            {{ $companyAddress->town->name ?? '' }}
                                                            {{ $companyAddress->city->name ?? '' }}
                                                            {{ isset($companyAddress->country->country_name) ? ', ' . $companyAddress->country->country_name : '' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Languages:</th>
                                                        <td class="text-muted">
                                                            @if (isset($appointmentDetails->serviceProvider->biography->languages) && $appointmentDetails->serviceProvider->biography->languages !== null)
                                                                @php
                                                                    $languages = json_decode($appointmentDetails->serviceProvider->biography->languages);
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
                                                            @if (isset($appointmentDetails->serviceProvider->gender))
                                                                @if ($appointmentDetails->serviceProvider->gender == 0)
                                                                    Male
                                                                @elseif ($appointmentDetails->serviceProvider->gender == 1)
                                                                    Female
                                                                @elseif ($appointmentDetails->serviceProvider->gender == 2)
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
                                                            {{ $appointmentDetails->serviceProvider->identifier ?? 'N/A' }}
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">Service Type:</th>
                                                        <td class="text-muted">
                                                            @if (isset($appointmentDetails->serviceProvider->biography->service_type))
                                                                @if ($appointmentDetails->serviceProvider->biography->service_type == 0)
                                                                    Physical
                                                                @elseif ($appointmentDetails->serviceProvider->biography->service_type == 1)
                                                                    Virtual
                                                                @elseif ($appointmentDetails->serviceProvider->biography->service_type == 2)
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
                                        <h5 class="card-title mb-4">Service Details</h5>
                                        <div class="table-responsive">
                                            <table class="table table-striped mb-0">
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
                                        <a href="javascript:void(0);" class="btn btn-primary mb-3"
                                            onclick="loadChatModule('{{ route('user', $appointmentDetails->serviceProvider->id) }}')">
                                            Chat with Service Provider
                                        </a>
                                        <div id="chatModuleContainer" style="display: none;">
                                            <iframe id="chatModuleIframe" src=""
                                                style="width: 100%; height: 500px; border: none;"></iframe>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- End Chat Module --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Existing Make Payment Modal -->
    <div class="modal fade bs-modal-make-appointment" tabindex="-1" aria-labelledby="mySmallModalLabel1"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel1">Make Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="appointment-validation" novalidate id="make-appointment-form"
                        action="{{ route('user.makeCollectionPayment', $appointmentDetails->id) }}" method="post">
                        @csrf
                        <input type="hidden" name="vendor_id"
                            value="{{ $appointmentDetails->serviceProvider->id }}">
                        <input type="hidden" name="service_id"
                            value="{{ $appointmentDetails->serviceDetails->id }}">
                        <input type="hidden" name="service_category_id"
                            value="{{ $appointmentDetails->serviceDetails->service_category_id }}">
                        <input type="hidden" name="appointment_id" value="{{ $appointmentDetails->id }}">
                        <div class="row g-3">
                            <div class="col-xxl-12"></div>
                            <div class="col-lg-12">
                                <div class="alert alert-warning" style="padding: 10px; height: auto;">
                                    <p style="margin: 0;">Are you sure you want to make the payment?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light"
                                        data-bs-dismiss="modal">Cancel</button>
                                    <button type="button" class="btn btn-primary" id="confirmMakePayment">Yes,
                                        Make
                                        Payment</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-modal-review" tabindex="-1" aria-labelledby="mySmallModalLabel12"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mySmallModalLabel12">Rate and Review Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="appointment-validation" action = "{{ route('user.submitReview') }}"
                        method = "post">
                        @csrf
                        <div class="row g-3">
                            <div class = "col-xxl-6">
                                <div class=" d-flex justify-content-center">
                                    <div class="stars">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                                <input type="text" name="rating" hidden value=0></input>
                            </div>
                            <div class="col-xxl-12">
                                <div>
                                    <label for="basiInput" class="form-label">Description</label>
                                    <input type ="hidden" name = "appointment_id"
                                        value = "{{ $appointmentDetails->id }}">
                                    <input type ="hidden" name = "service_id"
                                        value = "{{ $appointmentDetails->service_id }}">
                                    <textarea type="number" name = "description" class="form-control" rows="5" id="UserName" required></textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary make-appointment">Submit</button>
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

    <script>
        let appointmentId = "{{ $appointmentDetails->id }}";
        $(document).on('submit', '#send-text-to-vendor-form', function(e) {
            e.preventDefault();
            var formData = new FormData();
            formData.append("_token", "{{ csrf_token() }}");
            formData.append("appointment_id", $("#send-text-to-vendor-form").find("input[name=appointment_id]")
                .val());
            var filesInput = $('#chatFiles')[0];
            if (filesInput && filesInput.files && filesInput.files.length > 0) {
                var files = filesInput.files;
                for (var i = 0; i < files.length; i++) {
                    var licenseFile = files[i];
                    formData.append('chat_files[]', licenseFile);
                }
            } else {
                console.log("No files selected.");
            }
            formData.append("message", $("#send-text-to-vendor-form").find("textarea[name=message]").val());
            var apiUrl = '{{ route('user.sendTextToVendor') }}';
            $.ajax({
                type: "POST",
                url: apiUrl,
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: function(data) {

                    if (data.status) {
                        console.log(appointmentId);
                        $(".appointment-message").append(data.html);
                        $("#send-text-to-vendor-form").find("textarea[name=message]").val('');
                        $(".compose-new-email-container").find(".compose-body textarea").focus();
                        $(".email-body").scrollTop($(".email-body")[0].scrollHeight);
                    } else {
                        $.each(data.errors, function(key, val) {
                            $("#errors-list").append("<div class='alert alert-danger'>" + val +
                                "</div>");
                        });
                    }

                }
            });
        });

        function downloadFile(url, fileName) {
            var link = document.createElement("a");
            link.href = url;
            link.download = fileName;
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        document.getElementById('confirmMakePayment').addEventListener('click', function() {
            document.getElementById('make-appointment-form').submit();
        });
    </script>

    <script>
        const stars = document.querySelectorAll(".stars i");
        stars.forEach((star, index1) => {
            star.addEventListener("click", () => {
                stars.forEach((star, index2) => {
                    index1 >= index2 ? star.classList.add("active") : star.classList.remove(
                        "active");
                });
                const rating = document.querySelectorAll(".stars i.active").length;
                const hiddenInput = modal.querySelector('input[name="rating"]');
                hiddenInput.value = rating;
            });
        });
        const modal = document.querySelector('.bs-modal-review');
        modal.addEventListener('hidden.bs.modal', function() {
            const textareaElement = modal.querySelector('textarea');
            textareaElement.value = '';

            const hiddenInput = modal.querySelector('input[name="rating"]');
            hiddenInput.value = 0;

            const stars = modal.querySelectorAll('.stars i');
            stars.forEach(star => star.classList.remove('active'));
        });

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

        function loadChatModule(url) {
            document.getElementById('chatModuleContainer').style.display = 'block';
            document.getElementById('chatModuleIframe').src = url;
        }
    </script>
@endpush
