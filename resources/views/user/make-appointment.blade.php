@extends('user.layouts.master')
@section('title')
Disable Platform | Make Appointment
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}">

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
                <img src="@if (Auth::user()->avatar != '') {{ URL::asset('images/' . Auth::user()->avatar) }}@else{{ URL::asset('build/images/users/avatar-1.jpg') }} @endif" alt="user-img" class="img-thumbnail rounded-circle" />
            </div>
        </div>
        <!--end col-->
        <div class="col">
            <div class="p-2">
                <h3 class="text-white mb-1">{{$providerDetails->first_name}} {{$providerDetails->last_name}}</h3>
                <p class="text-white text-opacity-75">Owner & Founder</p>
                <div class="hstack text-white-50 gap-1">
                    <div class="me-2"><i
                            class="ri-map-pin-user-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>California,
                        United States</div>
                    <div><i class="ri-building-line me-1 text-white text-opacity-75 fs-16 align-middle"></i>Themesbrand
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
        <div class="col-12 col-lg-auto order-last order-lg-0">
            <div class="row text text-white-50 text-center">
            <!-- <a href="javascript:void(0);" class="btn btn-success"  data-bs-toggle="modal" data-bs-target=".bs-modal-make-appointment"><i
                            class="ri-edit-box-line align-bottom"></i> Make Appointment</a> -->
            </div>
        </div>
        <!--end col-->

    </div>
    <!--end row-->
</div>

<div class="row">
    <div class="col-lg-12">
        <div>
            <!-- Tab panes -->
            <div class="tab-content pt-4 text-muted">
                <div class="tab-pane active" id="overview-tab" role="tabpanel">
                    <div class="row">
                        <div class="col-xxl-3">

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-3">Info</h5>
                                    <div class="table-responsive">
                                        <table class="table mb-0">
                                            <tbody>
                                                <tr>
                                                    <th scope="row">Name :</th>
                                                    <td class="text-muted">{{$providerDetails->first_name}} {{$providerDetails->last_name}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Mobile :</th>
                                                    <td class="text-muted">+(1) 987 6543</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">E-mail :</th>
                                                    <td class="text-muted">{{$providerDetails->email}}</td>
                                                </tr>
                                                <tr>
                                                    <th scope="row">Location :</th>
                                                    <td class="text-muted">California, United States
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title mb-4">Services</h5>
                                    @isset($serviceCategories)
                                         @foreach($serviceCategories as $serviceCategory)
                                    <div class="d-flex align-items-center" style="justify-content:space-between;">
                                    
                                          <a href="javascript:void(0);" class="badge bg-light-subtle text-dark py-3 mb-2 fs-12 text-start d-block">{{$serviceCategory->name}}</a>
                                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target=".bs-modal-view-service" class="link-success fs-23 service-details" id = "{{$serviceCategory->id}}"><i class="las la-eye"></i></a>

                                        
                                        <!-- <a href="javascript:void(0);" class="badge bg-light-subtle text-dark py-3 mb-2 fs-12 text-start d-block">Live & Closed Captioning</a>
                                        <a href="javascript:void(0);" class="badge bg-light-subtle text-dark py-3 mb-2 fs-12 text-start d-block">Mobility guides</a>
                                        <a href="javascript:void(0);" class="badge bg-light-subtle text-dark py-3 mb-2 fs-12 text-start d-block">Personal assistants</a>
                                        <a href="javascript:void(0);" class="badge bg-light-subtle text-dark py-3 mb-2 fs-12 text-start d-block">Tactile sign language</a> -->
                                    </div>
                                    @endforeach
                                        @endisset
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div>
                        <!--end col-->
                        <div class="col-xxl-9">
                            <div class="card">
                                <div class="card-body">
                                <form action="javascript:void(0);" class="appointment-validation" novalidate id = "make-appointment-form">
                    <div class="row g-3">
                    <div class="col-xxl-6">
                            <label for="basiInput" class="form-label">Select Services</label>
                            <select class="form-select" aria-label=".form-select-sm example" required>
                                <option selected="">Change Service Category</option>
                                @isset($serviceCategories)
                                @foreach($serviceCategories as $serviceCategory)
                                <option value="{{$serviceCategory->id}}">{{$serviceCategory->name}}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="basiInput" class="form-label">Location</label>
                                <input type="number" name="phone_number" class="form-control" id="UserName" placeholder="Phone Number" required>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="basiInput" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="basiInput" required>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="basiInput" class="form-label">End Date</label>
                                <input type="date" name="email" class="form-control" id="UserName" placeholder="Time" required>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="basiInput" class="form-label">From Time</label>
                                <input type="time" name="email" class="form-control" id="UserName" placeholder="From Time" required>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="basiInput" class="form-label">End Time</label>
                                <input type="time" name="phone_number" class="form-control" id="UserName" placeholder="To Time" required>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div>
                                <label for="basiInput" class="form-label">Message</label>
                                <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary make-appointment">Make Appointment</button>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </form>
                                </div>
                                <!--end card-body-->
                            </div><!-- end card -->

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
                                                                                <h6 class="fs-14 mb-1">
                                                                                    Job Title
                                                                                </h6>
                                                                                <small>Company Name</small>
                                                                                
                                                                                <p class="text-dark mb-0">
                                                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita nobis eum sit hic nam officiis dicta veniam? Iure itaque natus adipisci optio non doloribus vitae, sit temporibus, sed veniam aspernatur?
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div id="collapseTwo"
                                                                    class="accordion-collapse collapse show"
                                                                    aria-labelledby="headingTwo"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body ms-2 ps-5 pt-0 pb-0">
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
                                                                                            <a href="javascript:void(0);"
                                                                                                class="stretched-link"> Job Certificate</a>
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
                                                                                <h6 class="fs-14 mb-1">
                                                                                    Job Title
                                                                                </h6>
                                                                                <small>Company Name</small>
                                                                                
                                                                                <p class="text-dark mb-0">
                                                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita nobis eum sit hic nam officiis dicta veniam? Iure itaque natus adipisci optio non doloribus vitae, sit temporibus, sed veniam aspernatur?
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div id="collapseTwo"
                                                                    class="accordion-collapse collapse show"
                                                                    aria-labelledby="headingTwo"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body ms-2 ps-5 pt-0 pb-0">
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
                                                                                            <a href="javascript:void(0);"
                                                                                                class="stretched-link"> Job Certificate</a>
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
                                                                                <h6 class="fs-14 mb-1">
                                                                                    Job Title
                                                                                </h6>
                                                                                <small>Company Name</small>
                                                                                
                                                                                <p class="text-dark mb-0">
                                                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Expedita nobis eum sit hic nam officiis dicta veniam? Iure itaque natus adipisci optio non doloribus vitae, sit temporibus, sed veniam aspernatur?
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <div id="collapseTwo"
                                                                    class="accordion-collapse collapse show"
                                                                    aria-labelledby="headingTwo"
                                                                    data-bs-parent="#accordionExample">
                                                                    <div class="accordion-body ms-2 ps-5 pt-0 pb-0">
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
                                                                                            <a href="javascript:void(0);"
                                                                                                class="stretched-link"> Job Certificate</a>
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
                                                        </div>
                                                        <!--end accordion-->
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card body -->
                                    </div><!-- end card -->
                                </div><!-- end col -->
                            </div><!-- end row -->

                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Completed Services</h5>
                                    <!-- Swiper -->
                                    <div class="swiper project-swiper mt-n4">
                                        <div class="d-flex justify-content-end gap-2 mb-2">
                                            <div class="slider-button-prev">
                                                <div class="avatar-title fs-18 rounded px-1 shadow">
                                                    <i class="ri-arrow-left-s-line"></i>
                                                </div>
                                            </div>
                                            <div class="slider-button-next">
                                                <div class="avatar-title fs-18 rounded px-1 shadow">
                                                    <i class="ri-arrow-right-s-line"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="swiper-wrapper">
                                            <div class="swiper-slide">
                                            <div class="card profile-project-card profile-project-info mb-0">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1 text-muted overflow-hidden">
                                                                <h5 class="fs-14 text-truncate mb-1">
                                                                    <a href="#" class="text-body">International Sign Language</a>
                                                                </h5>
                                                                <p class="text-muted text-truncate mb-0">
                                                                    Last Update : <span class="fw-semibold text-body">2
                                                                        hr Ago</span></p>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <div class="badge bg-warning-subtle text-warning fs-10">
                                                                    Inprogress</div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <div>
                                                                        <h5 class="fs-12 text-muted mb-0">
                                                                            Members :</h5>
                                                                    </div>
                                                                    <div class="avatar-group">
                                                                        <div class="avatar-group-item shadow">
                                                                            <div class="avatar-xs">
                                                                                <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                                                                    alt=""
                                                                                    class="rounded-circle img-fluid" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->
                                                <!-- end card -->
                                            </div>
                                            <!-- end slide item -->
                                            <div class="swiper-slide">
                                                <div class="card profile-project-card profile-project-success mb-0">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1 text-muted overflow-hidden">
                                                                <h5 class="fs-14 text-truncate mb-1">
                                                                    <a href="#" class="text-body">Live & Closed Captioning</a>
                                                                </h5>
                                                                <p class="text-muted text-truncate mb-0">
                                                                    Completed : <span class="fw-semibold text-body">2
                                                                        Days Ago</span></p>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <div class="badge bg-success-subtle text-success fs-10">
                                                                    Completed</div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <div>
                                                                        <h5 class="fs-12 text-muted mb-0">
                                                                            Members :</h5>
                                                                    </div>
                                                                    <div class="avatar-group">
                                                                        <div class="avatar-group-item shadow">
                                                                            <div class="avatar-xs">
                                                                                <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                                                                    alt=""
                                                                                    class="rounded-circle img-fluid" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->
                                            </div><!-- end slide item -->
                                            <div class="swiper-slide">
                                                <div class="card profile-project-card profile-project-success mb-0">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1 text-muted overflow-hidden">
                                                                <h5 class="fs-14 text-truncate mb-1">
                                                                    <a href="#" class="text-body">Mobility guides</a>
                                                                </h5>
                                                                <p class="text-muted text-truncate mb-0">
                                                                    Completd : <span class="fw-semibold text-body">2
                                                                        days Ago</span></p>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <div class="badge bg-success-subtle text-success fs-10">
                                                                    Completed</div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <div>
                                                                        <h5 class="fs-12 text-muted mb-0">
                                                                            Members :</h5>
                                                                    </div>
                                                                    <div class="avatar-group">
                                                                        <div class="avatar-group-item shadow">
                                                                            <div class="avatar-xs">
                                                                                <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                                                                    alt=""
                                                                                    class="rounded-circle img-fluid" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->
                                            </div><!-- end slide item -->
                                            <div class="swiper-slide">
                                                <div class="card profile-project-card profile-project-success mb-0">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1 text-muted overflow-hidden">
                                                                <h5 class="fs-14 text-truncate mb-1">
                                                                    <a href="#" class="text-body">Personal assistants</a>
                                                                </h5>
                                                                <p class="text-muted text-truncate mb-0">
                                                                    Completed : <span class="fw-semibold text-body">6
                                                                        days Ago</span></p>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <div class="badge bg-success-subtle text-success fs-10">
                                                                    Completed</div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <div>
                                                                        <h5 class="fs-12 text-muted mb-0">
                                                                            Members :</h5>
                                                                    </div>
                                                                    <div class="avatar-group">
                                                                        <div class="avatar-group-item shadow">
                                                                            <div class="avatar-xs">
                                                                                <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                                                                    alt=""
                                                                                    class="rounded-circle img-fluid" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->
                                                <!-- end card -->
                                            </div>
                                            <!-- end slide item -->
                                            <div class="swiper-slide">
                                                <div class="card profile-project-card profile-project-danger mb-0">
                                                    <div class="card-body p-4">
                                                        <div class="d-flex">
                                                            <div class="flex-grow-1 text-muted overflow-hidden">
                                                                <h5 class="fs-14 text-truncate mb-1">
                                                                    <a href="#" class="text-body">Tactile sign language</a>
                                                                </h5>
                                                                <p class="text-muted text-truncate mb-0">
                                                                    Completed : <span class="fw-semibold text-body">2
                                                                        hr Ago</span></p>
                                                            </div>
                                                            <div class="flex-shrink-0 ms-2">
                                                                <div class="badge bg-danger-subtle text-danger fs-10">
                                                                    Failed</div>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex mt-4">
                                                            <div class="flex-grow-1">
                                                                <div class="d-flex align-items-center gap-2">
                                                                    <div>
                                                                        <h5 class="fs-12 text-muted mb-0">
                                                                            Members :</h5>
                                                                    </div>
                                                                    <div class="avatar-group">
                                                                        <div class="avatar-group-item shadow">
                                                                            <div class="avatar-xs">
                                                                                <img src="{{ URL::asset('build/images/users/avatar-5.jpg') }}"
                                                                                    alt=""
                                                                                    class="rounded-circle img-fluid" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- end card body -->
                                                </div><!-- end card -->
                                                <!-- end card -->
                                            </div>
                                            <!-- end slide item -->
                                        </div>

                                    </div>

                                </div>
                                <!-- end card body -->
                            </div><!-- end card -->

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
<div class="modal fade bs-modal-make-appointment" tabindex="-1" aria-labelledby="mySmallModalLabel1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mySmallModalLabel1">Make Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);" class="appointment-validation" novalidate id = "make-appointment-form">
                    <div class="row g-3">
                    <div class="col-xxl-6">
                            <label for="basiInput" class="form-label">Select Services</label>
                            <select class="form-select" aria-label=".form-select-sm example" required>
                                <option selected="">Change Service Category</option>
                                @isset($serviceCategories)
                                @foreach($serviceCategories as $serviceCategory)
                                <option value="{{$serviceCategory->id}}">{{$serviceCategory->name}}</option>
                                @endforeach
                                @endisset
                            </select>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="basiInput" class="form-label">Location</label>
                                <input type="number" name="phone_number" class="form-control" id="UserName" placeholder="Phone Number" required>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="basiInput" class="form-label">Start Date</label>
                                <input type="date" class="form-control" id="basiInput" required>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="basiInput" class="form-label">End Date</label>
                                <input type="date" name="email" class="form-control" id="UserName" placeholder="Time" required>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="basiInput" class="form-label">From Time</label>
                                <input type="time" name="email" class="form-control" id="UserName" placeholder="From Time" required>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="basiInput" class="form-label">End Time</label>
                                <input type="time" name="phone_number" class="form-control" id="UserName" placeholder="To Time" required>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div>
                                <label for="basiInput" class="form-label">Message</label>
                                <textarea class="form-control" id="exampleFormControlTextarea5" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary make-appointment">Make Appointment</button>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<div class="modal fade bs-modal-review-and-pay" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" aria-labelledby="mySmallModalLabel2" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mySmallModalLabel2">Review Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick = "closeReviewModal()"></button>
            </div>
            <div class="modal-body">
                <form action="#" class="form-steps" autocomplete="off">
                    <div class="text-center pt-3 pb-4 mb-1 d-flex justify-content-center">
                        <img src="{{ URL::asset('build/images/logo-dark.png') }}" class="card-logo card-logo-dark" alt="logo dark"
                            height="17">
                        <img src="{{ URL::asset('build/images/logo-light.png') }}" class="card-logo card-logo-light" alt="logo light"
                            height="17">
                    </div>
                    <div class="step-arrow-nav mb-4">

                        <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="steparrow-gen-info-tab" data-bs-toggle="pill"
                                    data-bs-target="#steparrow-gen-info" type="button" role="tab"
                                    aria-controls="steparrow-gen-info" aria-selected="true">Appointment Details</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="steparrow-description-info-tab"
                                    data-bs-toggle="pill" data-bs-target="#steparrow-description-info" type="button"
                                    role="tab" aria-controls="steparrow-description-info"
                                    aria-selected="false">Payment</button>
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
                                                            <img src="{{ URL::asset('build/images/profile-bg.jpg') }}" alt="" class="avatar-sm rounded shadow">
                                                        </div>
                                                        <div class="flex-grow-1 ms-3">
                                                            <h6 class="fs-14 mb-1">{{$providerDetails->first_name}} {{$providerDetails->last_name}}</h6>
                                                            <p class="text-muted mb-0">Customer</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li><i class="ri-mail-line me-2 align-middle text-muted fs-16"></i>{{$providerDetails->email}}</li>
                                                <li><i class="ri-phone-line me-2 align-middle text-muted fs-16"></i>+(256) 245451 441</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--end card-->
                                </div>
                                <div class="col-xl-6">
                                    
                                    <div class="card" style="box-shadow: 1px 1px 11px 3px #38414a1a;">
                                        <div class="card-header">
                                            <div class="d-flex">
                                                <h5 class="card-title flex-grow-1 mb-0">Service Details</h5>
                                                <div class="flex-shrink-0">
                                                    <a href="javascript:void(0);" class="link-secondary">Edit Details</a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-unstyled vstack gap-2 fs-13 mb-0">
                                                <li class="fw-medium fs-14"><b>Service Category:</b> International Sign Language</li>
                                                <li><b>Appointment Date:</b> 15/02/2024</li>
                                                <li><b>Time: 10:20 - 02:17</b></li>
                                                <li><b>Numbers of Days: Number of Days</b></li>
                                                <li><b>Location: Calefonia</b></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!--end card-->
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
                                            </tbody><!-- end tbody -->
                                        </table><!-- end table -->
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="d-flex align-items-start gap-3 mt-4">
                                <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                    data-nexttab="steparrow-description-info-tab"><i
                                        class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Go to more
                                    info</button>
                            </div>
                        </div>
                        <!-- end tab pane -->

                        <div class="tab-pane fade" id="steparrow-description-info" role="tabpanel"
                            aria-labelledby="steparrow-description-info-tab">
                            <div>
                                <h5>Payment</h5>
                                <p class="text-muted">Fill all information below</p>
                            </div>
                            <div>
                                <div class="my-3">
                                    <div class="form-check form-check-inline">
                                        <input id="mtn-momo" name="paymentMethod" type="radio" class="form-check-input" checked >
                                        <label class="form-check-label" for="mtn-momo">MTN MOMO</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input id="credit" name="paymentMethod" type="radio" class="form-check-input"  >
                                        <label class="form-check-label" for="credit">Credit card</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input id="debit" name="paymentMethod" type="radio" class="form-check-input" >
                                        <label class="form-check-label" for="debit">Debit card</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input id="paypal" name="paymentMethod" type="radio" class="form-check-input">
                                        <label class="form-check-label" for="paypal">PayPal</label>
                                    </div>
                                </div>

                                <div class="row gy-3 card-details">
                                    <div class="col-md-12">
                                        <label for="cc-name" class="form-label">Name on card</label>
                                        <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                                        <small class="text-muted">Full name as displayed on card</small>
                                        <div class="invalid-feedback">
                                            Name on card is required
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="cc-number" class="form-label">Credit card number</label>
                                        <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                                        <div class="invalid-feedback">
                                            Credit card number is required
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="cc-expiration" class="form-label">Expiration</label>
                                        <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                                        <div class="invalid-feedback">
                                            Expiration date required
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <label for="cc-cvv" class="form-label">CVV</label>
                                        <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                                        <div class="invalid-feedback">
                                            Security code required
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-start gap-3 mt-4">
                                <button type="button" class="btn btn-light btn-label previestab"
                                    data-previous="steparrow-gen-info-tab"><i
                                        class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                    General</button>
                                <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                    data-nexttab="pills-experience-tab"><i
                                        class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                            </div>
                        </div>
                        <!-- end tab pane -->

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
                        <!-- end tab pane -->
                    </div>
                    <!-- end tab content -->
                </form>
             

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<!-- service modal -->
<div class="modal fade bs-modal-view-service" tabindex="-1" aria-labelledby="mySmallModalLabel4" style="display: none;" aria-hidden="true">
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
                            <div class="float-end">
                               <b class="price-tag">$<span class = "service-details-price"></span></b>
                            </div>
                            <div class="d-block mb-2 align-items-center">
                                <div class="mb-3">
                                    <img src=""  class = "service-details-image" alt="" width="100" height="100" style="object-fit:cover;display:none;">
                                </div>
                                <div class="">
                                    <h5 class="list-title fs-15 mb-1 service-details-title"></h5>
                                </div>
                            </div>
                            <p class="list-text mb-0 service-details-description"></p>
                            <!-- <div class="hstack gap-2 mt-3 justify-content-center a-auto">
                                <button type="button" class="btn btn-secondary service-details-edit" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target=".bs-modal-edit-service">Edit</button>
                                <a href="javascript:void(0);" class="btn btn-danger service-details-delete"  data-bs-toggle="modal" data-bs-target=".bs-modal-delete-vendor-service">Delete</a>
                            </div> -->
                        </a>
                    </div>
                </div>
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
    document.querySelectorAll('.service-details').forEach(function(element) {
        element.addEventListener('click',function(e){
                console.log( this.id);
            let ServiceId = this.id;
            let detailsUrl = "{{ route('user.vendor_service_details', ['vendor_id' => $providerDetails->id, 'id' => ':ID']) }}";
            detailsUrl = detailsUrl.replace(":ID", ServiceId);
            fetch(detailsUrl,{
                headers:{
                    'X-Requested-With':'XMLHttpRequest'
                }
            })
            .then(response=>{
                return response.json();
            })
            .then(data=>{
                if (data.serviceDetails) {

                        document.querySelector(".service-details-title").textContent  = data.serviceDetails.title;
                        document.querySelector(".service-details-price").textContent  = data.serviceDetails.price;
                        document.querySelector(".service-details-description").innerHTML  = data.serviceDetails.description;
                        if(data.serviceDetails.upload_media)
                        {
                            document.querySelector(".service-details-image").src = "{{asset('')}}"+data.serviceDetails.upload_media;
                            document.querySelector(".service-details-image").style.display = "block";
                        }else{
                            document.querySelector(".service-details-image").style.display = "none";

                        }
                    
                    
                
                    
                }else{
                    console.log('2');
                }

            })
            .catch(error=>{
                console.log(error);
            })
        });
  
    });

    (function () {
        'use strict';
        document.querySelector(".make-appointment").addEventListener('click', function () {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('appointment-validation');
            var formId = forms.id;
            // Loop over them and prevent submission
            let req = 0;
            if (forms)
			var validation = Array.prototype.filter.call(forms, function (form) {
				form.addEventListener('submit', function (event) {
					if (form.checkValidity() === false) {
						event.preventDefault();
						event.stopPropagation();
					} else {
                        // If form is valid, open another modal
                        alert('shakir');
                        openAnotherModal(); // Call your function to open another modal here
                    }
					form.classList.add('was-validated');
				}, false);
			});
        }, false);
        // document.querySelector(".add-submit-button").addEventListener('click', function () {
        //     // Fetch all the forms we want to apply custom Bootstrap validation styles to
        //     var forms = document.getElementsByClassName('needs-validation');
        //     var formId = $(".needs-validation").attr('id');
        //     // Loop over them and prevent submission
        //     let req = 0;
        //     if (forms)
        //         Array.prototype.filter.call(forms, function (form) {
        //             form.addEventListener('submit', function (event) {
        //                 if (form.checkValidity() === false) {
        //                     event.preventDefault();
        //                     req++;
        //                     event.stopPropagation();
        //                 }
        //                 form.classList.add('was-validated');
        //             }, false);
        //         });
        // }, false);
          
    })();

    function openAnotherModal() {
        let paymentModal = document.getElementsByClassName('bs-modal-review-and-pay')[0]; // Assuming there's only one modal with this class
        let apppointmentModal = document.getElementsByClassName('bs-modal-make-appointment')[0]; // Assuming there's only one modal with this class
        let modal_backdrop = document.getElementsByClassName('modal-backdrop')[0]; // Assuming there's only one modal with this class
        //  apppointmentModal.classList.remove('show');
        //  modal_backdrop.classList.remove('show');
        //  apppointmentModal.setAttribute('role','');
         apppointmentModal.style.display = 'none';
        //  apppointmentModal.setAttribute('aria-hidden',true);

            // Check if the modal element is found
            if (paymentModal) {
                // Set the display property to 'block' to show the modal
                paymentModal.style.display = 'block';
                // paymentModal.setAttribute('aria-hidden',true);
                
                // Add the 'modal-open' class to the body to allow scrolling within the modal
                paymentModal.classList.add('show');
                modal_backdrop.classList.add('show');

            } else {
                console.error('Modal element not found.');
            }
        }
        function closeReviewModal()
        {
            let paymentModal = document.getElementsByClassName('bs-modal-review-and-pay')[0]; // Assuming there's only one modal with this class
            let modalBackdrop  = document.getElementsByClassName('modal-backdrop')[0]; // Assuming there's only one modal with this class
            paymentModal.classList.remove('show');
            modal_backdrop.remove();
        //  modal_backdrop.classList.remove('show');
        //  apppointmentModal.setAttribute('role','');
             paymentModal.style.display = 'none';
        }
</script>
    
@endpush
