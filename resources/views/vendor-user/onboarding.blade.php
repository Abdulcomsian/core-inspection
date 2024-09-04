@extends('vendor-user.layouts.master')
@section('title')
    onBoarding
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/summernote/summernote.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .delete-row {
            cursor: pointer;
        }

        .qualification-image {
            position: absolute;
            right: 20%;
            bottom: 2px;
        }

        .cnic-image {
            position: absolute;
            right: 20%;
            bottom: 2px;
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

        .text-danger {
            color: #dc3545;
            /* Bootstrap's text-danger color */
        }
    </style>
@endsection
@section('content')
    {{-- @component('components.breadcrumb')
        @slot('title')
            Profile
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
                    @if (Auth::user()->hasRole('admin'))
                        <p class="text-white text-opacity-75">Admin</p>
                    @elseif(Auth::user()->hasRole('vendor_user'))
                        <p class="text-white text-opacity-75">Service
                            Provider</p>
                    @else
                        <p class="text-white text-opacity-75">System User</p>
                    @endif
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
                    @if (auth()->user()->profile_approved_status == '0')
                        <a href="{{ route('vendor.profileSubmit') }}" class="btn btn-primary"><i
                                class="fas fa-hourglass-start"></i> Submitted</a>
                    @elseif(auth()->user()->profile_approved_status == '1')
                        <a href="#" class="btn btn-success"><i class="fas fa-check-circle"></i> Approved</a>
                    @elseif(auth()->user()->profile_approved_status == '2')
                        <a href="#" class="btn btn-danger"><i class="fas fa-times-circle"></i> Rejected</a>
                        {{-- @else --}}
                        {{-- @if ($completionPercentage < 100)
                            <a href="javascript:void(0)" class="btn btn-info" data-bs-toggle="modal"
                                data-bs-target="#completeProfileModal">
                                <i class="fas fa-paper-plane"></i> Submit
                            </a>
                        @else
                            <a href="{{ route('vendor.profileSubmit') }}" class="btn btn-info"><i
                                    class="fas fa-paper-plane"></i>
                                Submit</a>
                        @endif --}}
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="completeProfileModal" tabindex="-1" aria-labelledby="completeProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalLabel">Complete Your Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body bg-warning mt-3" style="height: 50px;padding-top:15px;">
                    <p class="mb-2">Please complete your profile before submitting.</p>
                </div>
                <div class="modal-footer mt-2">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div>
                <!-- Tab panes -->
                <div class="tab-content pt-4 text-muted">
                    <div class="tab-pane active" id="overview-tab" role="tabpanel">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-5">Complete Your Profile</h5>
                                        <div class="progress animated-progress custom-progress progress-label">
                                            <div class="progress-bar {{ $completionPercentage == 100 ? 'bg-success' : 'bg-danger' }}"
                                                role="progressbar" style="width: {{ $completionPercentage }}%"
                                                aria-valuenow="{{ $completionPercentage }}" aria-valuemin="0"
                                                aria-valuemax="100">
                                                <div class="label">{{ round($completionPercentage) }}%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title mb-3">Info</h5>
                                        <div class="table-responsive">
                                            <table class="table mb-0">
                                                <tbody>
                                                    <tr>
                                                        <th scope="row">Full Name:</th>
                                                        <td class="text-muted">{{ auth()->user()->first_name }}
                                                            {{ auth()->user()->last_name }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">E-mail:</th>
                                                        <td class="text-muted">{{ auth()->user()->email }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Phone No:</th>
                                                        <td class="text-muted">{{ auth()->user()->phone ?? 'N/A' }}</td>
                                                    </tr>

                                                    <tr>
                                                        <th scope="row">Gender:</th>
                                                        <td class="text-muted">
                                                            {{ auth()->user()->gender == 0 ? 'Male' : (auth()->user()->gender == 1 ? 'Female' : 'Prefer Not to say') ?? 'N/A' }}
                                                        </td>
                                                    </tr>

                                                    @if (auth()->user()->created_at)
                                                        <tr>
                                                            <th scope="row">Joining Date:</th>
                                                            <td class="text-muted">
                                                                {{ auth()->user()->created_at->format('d M Y') }}</td>
                                                        </tr>
                                                    @endif
                                                    <tr>
                                                        <th scope="row">Location:</th>
                                                        <td class="text-muted">{{ $companyAddress->town->name ?? 'N/A' }}
                                                            {{ $companyAddress->city->name ?? 'N/A' }},
                                                            {{ $companyAddress->country->country_name ?? 'N/A' }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header align-items-center d-flex">
                                        <h4 class="card-title mb-0 flex-grow-1">SERVICES I PROVIDE</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="live-preview" style="max-height: 300px; overflow-y: auto;">
                                            <ul class="list-group">
                                                @if (isset($serviceCategories) && $serviceCategories->isNotEmpty())
                                                    @foreach ($serviceCategories as $category)
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
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0  me-2">Qualification</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="qualification-list">
                                                    @if ($qualifications->isEmpty())
                                                        @include('components.qualification-row')
                                                    @else
                                                        @include('components.qualification')
                                                    @endif
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 mt-3">
                                                        <button type="button" class="btn btn-primary"
                                                            id="update-qualification">Update</button>
                                                        <button type="button" class="btn btn-primary"
                                                            id="add-qualification-row">Add</button>
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
                                                <h4 class="card-title mb-0  me-2">Biography</h4>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('vendor.addBiography') }}" id="biography-form"
                                                    method="post">
                                                    <div class="row">
                                                        {{-- <div class="col-3">
                                                            <div class="form-group">
                                                                <label>Job Title/Position</label>
                                                                <input type="text" class="form-control" name="job"
                                                                    value="{{ $biography->job_title ?? '' }}"
                                                                    aria-describedby="emailHelp" placeholder="Enter job">
                                                            </div>
                                                        </div>
                                                        <div class="col-3">
                                                            <div class="form-group">
                                                                <label>Company Organization</label>
                                                                <input type="text" class="form-control" name="company"
                                                                    value="{{ $biography->organization ?? '' }}"
                                                                    aria-describedby="emailHelp" placeholder="Enter company">
                                                            </div>
                                                        </div> --}}
                                                        {{-- <div class="col-4">
                                                            <div class="form-group">
                                                                <label>NIN Number</label>
                                                                <input type="text" class="form-control"
                                                                    name="nin_number"
                                                                    value="{{ $biography->nin_number ?? '' }}"
                                                                    aria-describedby="ninHelp"
                                                                    placeholder="Enter NIN number">
                                                            </div>
                                                            </div> --}}
                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Years of experience <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control" name="yoe"
                                                                    value="{{ Carbon\Carbon::now()->diffInYears(auth()->user()->created_at) }}"
                                                                    aria-describedby="emailHelp"
                                                                    placeholder="Enter experience" readonly>
                                                            </div>
                                                        </div>

                                                        <div class="col-6">
                                                            <div class="form-group">
                                                                <label>Languages <span class="text-danger">*</span></label>
                                                                <select
                                                                    class="form-select mb-3 js-example-placeholder-single js-states form-control"
                                                                    aria-label="Default select example"
                                                                    id="search-service-category" name="languages[]"
                                                                    multiple required>
                                                                    <option value=""></option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <div class="form-group">
                                                                <label>Detail Biography <span
                                                                        class="text-danger">*</span></label>
                                                                <textarea id="summernote" name="detail_biography" required>{{ $biography->detail_bio ?? '' }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0  me-2">Vetting Options <span
                                                        class="text-danger">*</span></h4>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('vendor.addServiceType') }}" id="servicetype-form"
                                                    method="post">
                                                    <div class="row mt-3">
                                                        <div class="form-group">
                                                            <div class="checkbox-container">
                                                                <label>
                                                                    <input class="form-check-input" type="radio"
                                                                        name="service_type" value="0"
                                                                        {{ isset($biography->service_type) && $biography->service_type == '0' ? 'checked' : '' }}>
                                                                    Physical
                                                                </label>
                                                                <label>
                                                                    <input class="form-check-input" type="radio"
                                                                        name="service_type" value="1"
                                                                        {{ isset($biography->service_type) && $biography->service_type == '1' ? 'checked' : '' }}>
                                                                    Virtual
                                                                </label>
                                                                <label>
                                                                    <input class="form-check-input" type="radio"
                                                                        name="service_type" value="2"
                                                                        {{ isset($biography->service_type) && $biography->service_type == '2' ? 'checked' : '' }}>
                                                                    Both
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0  me-2">Information</h4>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('vendor.updateInfo') }}" id="updateinfo-form"
                                                    method="post">
                                                    <div class="row mt-3">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label>First Name <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    name="first_name"
                                                                    value="{{ auth()->user()->first_name ?? '' }}"
                                                                    aria-describedby="ninHelp"
                                                                    placeholder="Enter Your First Name">

                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label>Last Name <span class="text-danger">*</span></label>
                                                                <input type="text" class="form-control"
                                                                    name="last_name"
                                                                    value="{{ auth()->user()->last_name ?? '' }}"
                                                                    aria-describedby="ninHelp"
                                                                    placeholder="Enter Your Last Name">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label>Password</label>
                                                                <input type="password" class="form-control"
                                                                    name="password" value=""
                                                                    aria-describedby="ninHelp"
                                                                    placeholder="Enter Your Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label>Confirm Password</label>
                                                                <input type="password" class="form-control"
                                                                    name="confirm_password" value=""
                                                                    aria-describedby="ninHelp"
                                                                    placeholder="Enter Confirm Password">
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0  me-2">Identity</h4>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('vendor.addCompanyContactDetails') }}"
                                                    id="company-contact-form" method="post">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-4">
                                                            <div class="form-group mb-3">
                                                                <label for="phoneNo">Phone No <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="phone_no"
                                                                    class="form-control" id="phoneNo"
                                                                    placeholder="Enter Phone No"
                                                                    value="{{ auth()->user()->phone ?? '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group mb-3">
                                                                <label for="national_id_number">NIN Number <span
                                                                        class="text-danger">*</span></label>
                                                                <input type="number" name="national_id_number"
                                                                    class="form-control" id="national_id_number"
                                                                    placeholder="Enter National ID"
                                                                    value="{{ $identity ? $identity->national_id_number : '' }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="form-group mb-3">
                                                                <label for="national_id_image">National ID Image <span
                                                                        class="text-danger">*</span></label>
                                                                <div class="d-flex align-items-center">
                                                                    <input type="file" class="form-control w-75"
                                                                        id="national_id_image" name="national_id_image">
                                                                    @if (!empty($identity->national_id_image))
                                                                        <a href="{{ $identity ? asset('storage/' . $identity->national_id_image) : '#' }}"
                                                                            target="_blank">
                                                                            <img src="{{ $identity ? asset('storage/' . $identity->national_id_image) : '' }}"
                                                                                alt="CNIC Preview" width="70"
                                                                                height="50" class="cnic-image ml-2"
                                                                                style="
                                                                            margin-right: -57px;
                                                                            margin-bottom: 10px;
                                                                            width: 70px;
                                                                            height: 50px;
                                                                        ">
                                                                        </a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <form action="{{ route('vendor.addAppointmentSchedule') }}" method="post"
                                            id="appointment-schedule-form">
                                            <div class="card">
                                                <div class="card-header align-items-center d-flex">
                                                    <h4 class="card-title mb-0  me-2">Availability</h4>
                                                </div>
                                                <div class="card-body">
                                                    <form action="{{ route('vendor.addCompanyLocation') }}"
                                                        id="company-form" method="post">

                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label>Days <span class="text-danger">*</span></label>
                                                                    <select name="days" id=""
                                                                        class="form-select" multiple>
                                                                        <option value="Monday"
                                                                            @if (str_contains($appointmentSchedule?->days, 'Monday')) selected @endif>
                                                                            Monday</option>
                                                                        <option value="Tuesday"
                                                                            @if (str_contains($appointmentSchedule?->days, 'Tuesday')) selected @endif>
                                                                            Tuesday</option>
                                                                        <option value="Wednesday"
                                                                            @if (str_contains($appointmentSchedule?->days, 'Wednesday')) selected @endif>
                                                                            Wednesday</option>
                                                                        <option value="Thursday"
                                                                            @if (str_contains($appointmentSchedule?->days, 'Thursday')) selected @endif>
                                                                            Thursday</option>
                                                                        <option value="Friday"
                                                                            @if (str_contains($appointmentSchedule?->days, 'Friday')) selected @endif>
                                                                            Friday</option>
                                                                        <option value="Saturday"
                                                                            @if (str_contains($appointmentSchedule?->days, 'Saturday')) selected @endif>
                                                                            Saturday</option>
                                                                        <option value="Sunday"
                                                                            @if (str_contains($appointmentSchedule?->days, 'Monday')) Sunday @endif>
                                                                            Sunday</option>
                                                                    </select>
                                                                    <!-- <input type="text" class="form-control" name="country"  value="{{ $companyAddress->country ?? '' }}" aria-describedby="countryHelp" placeholder="Enter country"> -->
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label>From Time <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="time" name="from"
                                                                        class="form-control"
                                                                        value="{{ $appointmentSchedule?->from }}">

                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label>To Time <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="time" name="to"
                                                                        class="form-control"
                                                                        value="{{ $appointmentSchedule?->to }}">

                                                                </div>
                                                            </div>
                                                            <div class="col-12 mt-3">
                                                                <button type="submit"
                                                                    class="btn btn-primary">Update</button>
                                                            </div>
                                                        </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-header align-items-center d-flex">
                                                <h4 class="card-title mb-0  me-2">Location</h4>
                                            </div>
                                            <div class="card-body">
                                                <form action="{{ route('vendor.addCompanyLocation') }}" id="company-form"
                                                    method="post">
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label>Country <span class="text-danger">*</span></label>
                                                                <select name="country" id=""
                                                                    class="form-select">
                                                                    <option value="">Select Country</option>
                                                                    <option value="{{ $country->id }}" selected>
                                                                        {{ $country->country_name }}</option>
                                                                </select>
                                                                <!-- <input type="text" class="form-control" name="country"  value="{{ $companyAddress->country ?? '' }}" aria-describedby="countryHelp" placeholder="Enter country"> -->
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <select name="city" id=""
                                                                    class="form-select">
                                                                    <option value="">Select City <span
                                                                            class="text-danger">*</span></option>
                                                                    @isset($cities)
                                                                        @foreach ($cities as $city)
                                                                            <option value="{{ $city->id }}"
                                                                                @if ($companyAddress !== null && $companyAddress->city->id == $city->id) selected @endif>
                                                                                {{ $city->name }}</option>
                                                                        @endforeach
                                                                    @endisset
                                                                </select>
                                                                {{-- <input type="text" class="form-control" name="city"  value="{{$companyAddress->city->name ?? ''}}"  aria-describedby="cityHelp" placeholder="Enter city"> --}}
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label>Town <span class="text-danger">*</span></label>
                                                                <select name="town" id=""
                                                                    class="form-select">
                                                                    @if (!empty($towns))
                                                                        @foreach ($towns as $town)
                                                                            <option value="{{ $town->id }}"
                                                                                @if ($companyAddress->town->id == $town->id) selected @endif>
                                                                                {{ $town->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                                {{-- <input type="text" class="form-control" name="street"  value="{{$companyAddress->town->name ?? ''}}"   aria-describedby="streetHelp" placeholder="Enter street"> --}}
                                                            </div>
                                                        </div>
                                                        <div class="col-12 mt-3">
                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (auth()->user()->profile_approved_status !== '1')
                                    <div class="row">
                                        <div class="col d-flex justify-content-end mb-3">
                                            @if ($completionPercentage < 100)
                                                <a href="javascript:void(0)" class="btn btn-info" data-bs-toggle="modal"
                                                    data-bs-target="#completeProfileModal">
                                                    <i class="fas fa-paper-plane"></i> Submit
                                                </a>
                                            @else
                                                <a href="{{ route('vendor.profileSubmit') }}" class="btn btn-info">
                                                    <i class="fas fa-paper-plane"></i> Submit
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bs-modal-delete-qualification" tabindex="-1" aria-labelledby="mySmallModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <img class="" alt="200x200" width="100"
                        src="{{ URL::asset('build/images/warning.gif') }}" data-holder-rendered="true">
                    <div class="mt-4">
                        <input type="hidden" id="qualification_id" value="">
                        <h4 class="mb-3">Delete this Qualification</h4>
                        <p class="text-muted mb-4"> Are you sure tou want to delete this qualification, You won`t be able
                            to restore it.</p>
                        <div class="hstack gap-2 justify-content-center">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                            <button type="button" id="delete_qualification" class="btn btn-danger">Delete
                                Qualification</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @include('script.common-script')
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/profile.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="{{ asset('packages/summernote/summernote.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'clear']],
                    ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']],
                    ['insert', ['link']],
                    ['view', ['fullscreen', 'codeview', 'help']]
                ]
            });

            $('select[name="days"]').select2();

            var savedLanguages = @json($biography ? json_decode($biography->languages) : []);

            $.ajax({
                url: 'https://restcountries.com/v3.1/all',
                method: 'GET',
                success: function(data) {
                    var languages = new Set();
                    data.forEach(function(country) {
                        if (country.languages) {
                            Object.values(country.languages).forEach(function(language) {
                                languages.add(language);
                            });
                        }
                    });

                    var $select = $('#search-service-category');

                    savedLanguages.forEach(function(language) {
                        languages.add(language);
                    });

                    languages.forEach(function(language) {
                        var $option = $('<option>', {
                            value: language,
                            text: language
                        });

                        if (savedLanguages && savedLanguages.includes(language)) {
                            $option.prop('selected', true);
                        }

                        $select.append($option);
                    });

                    $("#search-service-category").select2({
                        placeholder: "Select Languages",
                        allowClear: true,
                        tags: true,
                        createTag: function(params) {
                            return {
                                id: params.term,
                                text: params.term,
                                newOption: true
                            };
                        },
                        templateResult: formatServiceOption,
                        templateSelection: formatServiceOption
                    });

                    function formatServiceOption(option) {
                        if (!option.id) {
                            return option.text;
                        }

                        var $option = $(
                            '<span>' +
                            option.text + (option.newOption ? ' <em>(new)</em>' : '') +
                            '</span>'
                        );

                        return $option;
                    }
                },
                error: function(error) {
                    console.log('Error fetching languages:', error);
                }
            });


        });

        $(document).on("submit", "#biography-form", function(e) {
            e.preventDefault();
            let form = new FormData(this);
            let url = this.getAttribute("action");
            let type = 1;
            updateBiography(url, form, type, reloadScreen);
        });

        $(document).on("submit", "#servicetype-form", function(e) {
            e.preventDefault();
            let form = new FormData(this);
            let url = this.getAttribute("action");
            let type = 1;
            updateServiceType(url, form, type, reloadScreen);
        });

        $(document).on("submit", "#updateinfo-form", function(e) {
            e.preventDefault();
            let form = new FormData(this);
            let url = this.getAttribute("action");
            let type = 1;
            updateInfoForm(url, form, type, reloadScreen);
        });

        $(document).on("click", "#add-qualification-row", function(e) {
            e.preventDefault();
            let form = new FormData();
            let url = "{{ route('vendor.getQualificationRow') }}";
            let type = 2;
            let html = document.querySelector(".qualification-list");
            let position = 'beforeend';
            updateQualificationInformation(url, form, type, position, html);
        });

        $(document).on("submit", "#company-form", function(e) {
            e.preventDefault();
            let form = new FormData(this);
            let url = this.getAttribute("action");
            let type = 1;
            updateCompanyLocation(url, form, type);
        });

        $(document).on("click", "#update-qualification", function(e) {
            e.preventDefault();
            let qualificationRow = document.querySelectorAll(".qualification-row");
            let qualificationList = [];
            let haveError = false;

            Array.from(qualificationRow).every((row, index) => {
                let qualificationId = row.getAttribute('data-qualification-id') ? row.dataset
                    .qualificationId : null;
                let degreeName = row.querySelector("input[name='degree']").value;
                let fromDate = row.querySelector("input[name='from_date']").value;
                let toDate = row.querySelector("input[name='to_date']").value;
                let fileInput = row.querySelector("input[name='qualification_certificate']");
                let file = fileInput && fileInput.files.length > 0 ? fileInput.files[0] : null;

                let check = [undefined, "", null];

                if (check.includes(degreeName)) {
                    toastr.error("Please enter degree name");
                    haveError = true;
                    return false;
                }

                if (check.includes(fromDate)) {
                    toastr.error("Please enter from date");
                    haveError = true;
                    return false;
                }

                if (check.includes(toDate)) {
                    toastr.error("Please enter to date");
                    haveError = true;
                    return false;
                }

                qualificationList.push({
                    qualificationId: qualificationId,
                    degreeName: degreeName,
                    fromDate: fromDate,
                    toDate: toDate,
                    file: file
                });

                return true;
            });

            if (haveError) {
                return;
            }

            let url = "{{ route('vendor.updateQualification') }}";
            let type = 1;
            let form = new FormData();
            form.append('qualifications', JSON.stringify(qualificationList));

            qualificationRow.forEach((row, index) => {
                let fileInput = row.querySelector("input[name='qualification_certificate']");
                if (fileInput && fileInput.files.length > 0) {
                    form.append('qualification_certificate_' + index, fileInput.files[0]);
                }
            });

            updateInformation(url, form, type, null, null, null, reloadScreen);
        });


        function reloadScreen() {
            location.reload();
        }

        $(document).on("click", ".delete-row", function(e) {
            e.preventDefault();
            let qualification_id = $(this).closest('[data-qualification-id]').attr("data-qualification-id");
            if (qualification_id) {
                $("#qualification_id").val(qualification_id);
                $(".bs-modal-delete-qualification").modal("show");
            } else {
                this.closest(".qualification-row").remove();
            }
        });

        $(document).on("click", "#delete_qualification", function() {
            let qualification_id = $('#qualification_id').val();
            let url = "{{ route('vendor.delete.qualification') }}";
            let form = new FormData();
            form.append('qualification_id', qualification_id);
            let type = 3;
            deleteQualificationInformation(url, form, type);
        });

        $(document).on("submit", "#appointment-schedule-form", function(e) {
            e.preventDefault();
            let url = this.getAttribute('action');
            let form = new FormData();
            form.append('from', document.querySelector('input[name="from"]').value);
            form.append('to', document.querySelector('input[name="to"]').value);
            form.append('days', $('select[name="days"]').val());
            let type = 1;
            updateAppointmentSchedule(url, form, type);
        });

        $(document).on("submit", "#company-contact-form", function(e) {
            e.preventDefault();
            let url = this.getAttribute('action');
            let form = new FormData(this);
            let type = 1;
            updateCompanyContact(url, form, type);
        });

        $(document).on("change", "input[name='qualification_certificate']", function(e) {
            let file = e.target.files[0];
            let parent = this.closest(".certificate-image-section");
            let image = parent.querySelector(".qualification-image");
            const reader = new FileReader();

            reader.addEventListener("load", () => {
                image.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
                image.classList.remove("d-none");
            }
        });

        $(document).on("change", "input[name='cnic_image']", function(e) {
            let file = e.target.files[0];
            let parent = this.closest(".cnic-image-section");
            let image = parent.querySelector(".cnic-image");
            const reader = new FileReader();

            reader.addEventListener("load", () => {
                image.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
                image.classList.remove("d-none");
            }
        });

        $(document).on("change", "select[name='city']", function(e) {
            let cityId = this.value;
            let url = "{{ route('getCityTowns') }}";
            let form = new FormData();
            let type = 2;
            let townHtml = document.querySelector('select[name="town"]');
            form.append('cityId', cityId);
            updateInformation(url, form, type, null, townHtml, null, null);
        });

        $(document).on('change', 'input[name="from_date"]', function(e) {
            let fromDate = this.value;
            let qualificationRow = this.closest('.qualification-row');
            let toDate = qualificationRow.querySelector('input[name="to_date"]');
            toDate.setAttribute('min', fromDate);
        });

        $(document).on('change', 'input[name="to_date"]', function(e) {
            let toDate = this.value;
            let qualificationRow = this.closest('.qualification-row');
            let fromDate = qualificationRow.querySelector('input[name="from_date"]');
            fromDate.setAttribute('max', toDate);
        });

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

        document.addEventListener('DOMContentLoaded', function() {
            var completionPercentage = {{ $completionPercentage }};
            var submitBtn = document.getElementById('submitBtn');

            submitBtn.addEventListener('click', function(event) {
                if (completionPercentage < 100) {
                    event.preventDefault();
                    $('#completeProfileModal').modal('show');
                } else {
                    window.location.href = submitBtn.href;
                }
            });
        });
    </script>
@endsection
