@extends('vendor-user.layouts.master')
@section('title')
    @lang('translation.animation')
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
    .avatar-title{
        margin-top: -18px;
    }
</style>
<div class="row">
    <div class="col">

        <div class="h-100">
            <div class="row">

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Tasks</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-centered align-middle table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                        <tr>
                                            <th scope="col">Support Service</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Location</th>
                                            <th scope="col">Telephone</th>
                                            <th scope="col">Service Provider</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Need Personal assistants</td>
                                            <td>10 Feb 2024</td>
                                            <td>10:30 PM</td>
                                            <td>Calafonia, Us</td>
                                            <td>+12 345 67890</td>
                                            <td>John Doe</td>
                                            <td>
                                                <span class="badge bg-success-subtle text-success fs-11"><i class="ri-time-line align-bottom"></i>
                                                    Completed
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Need Personal assistants</td>
                                            <td>10 Feb 2024</td>
                                            <td>10:30 PM</td>
                                            <td>Calafonia, Us</td>
                                            <td>+12 345 67890</td>
                                            <td>John Doe</td>
                                            <td>
                                                <span class="badge bg-warning-subtle text-warning fs-11"><i class="ri-time-line align-bottom"></i>
                                                    pending
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Need Personal assistants</td>
                                            <td>10 Feb 2024</td>
                                            <td>10:30 PM</td>
                                            <td>Calafonia, Us</td>
                                            <td>+12 345 67890</td>
                                            <td>John Doe</td>
                                            <td>
                                                <span class="badge bg-success-subtle text-success fs-11"><i class="ri-time-line align-bottom"></i>
                                                    Completed
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Need Personal assistants</td>
                                            <td>10 Feb 2024</td>
                                            <td>10:30 PM</td>
                                            <td>Calafonia, Us</td>
                                            <td>+12 345 67890</td>
                                            <td>John Doe</td>
                                            <td>
                                                <span class="badge bg-warning-subtle text-warning fs-11"><i class="ri-time-line align-bottom"></i>
                                                    pending
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Need Personal assistants</td>
                                            <td>10 Feb 2024</td>
                                            <td>10:30 PM</td>
                                            <td>Calafonia, Us</td>
                                            <td>+12 345 67890</td>
                                            <td>John Doe</td>
                                            <td>
                                                <span class="badge bg-success-subtle text-success fs-11"><i class="ri-time-line align-bottom"></i>
                                                    Completed
                                                </span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Need Personal assistants</td>
                                            <td>10 Feb 2024</td>
                                            <td>10:30 PM</td>
                                            <td>Calafonia, Us</td>
                                            <td>+12 345 67890</td>
                                            <td>John Doe</td>
                                            <td>
                                                <span class="badge bg-warning-subtle text-warning fs-11"><i class="ri-time-line align-bottom"></i>
                                                    pending
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody><!-- end tbody -->
                                </table><!-- end table -->
                            </div>
                        </div>
                    </div> <!-- .card-->
                </div> <!-- .col-->
            </div> <!-- end row-->

        </div> <!-- end .h-100-->

    </div> <!-- end col -->
</div>

<div class="modal fade bs-modal-edit-service" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
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
                                    <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt="" class="avatar-sm rounded-circle">
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="list-title fs-15 mb-1">Angela Bernier</h5>
                                    <p class="list-text mb-0 fs-12">+123 456 7890</p>
                                </div>
                            </div>
                            <div class="hstack gap-3 flex-wrap mb-2 mt-2">
                                <div><i class="ri-calendar-2-line align-bottom me-1"></i> Themesbrand</div>
                                <div class="vr"></div>
                                <div class="d-flex align-items-center"><i class="las la-clock align-bottom me-1"></i> Zuweihir, UAE</div>
                                <div class="vr"></div>
                                <div class="d-flex align-items-center"><i class="las la-phone align-bottom me-1"></i> +12 345 67890</div>
                                <div class="vr"></div>
                            </div>
                            <p class="list-text mb-0">Just like in the image where we talked about using multiple fonts, you can see that the background in this graphic design is blurred. Whenever you put text on top of an image, it’s important that your viewers can understand the text, and sometimes that means applying a gaussian readable.</p>
                            <div class="hstack gap-2 mt-3 justify-content-center a-auto">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Accept</button>
                                <a href="javascript:void(0);" class="btn btn-danger">Reject</a>
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
