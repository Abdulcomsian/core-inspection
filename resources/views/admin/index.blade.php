@extends('admin.layouts.master')
@section('title')
    Dashboard
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="row">
        <div class="col">

            <div class="h-100">
                {{--
            <div class="row mb-3 pb-1">
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            <h4 class="fs-16 mb-1">Welcome Back, Admin!</h4>
                            <p class="text-muted mb-0">Here's what's happening in your Services Portal today.</p>
                        </div>
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>
                   --}}
                <!--end row-->

                <div class="row">
                    <div class="col-xl-4 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Total Commission</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            +16.24 %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value"
                                                data-target="{{ $sumServiceBookedPrice }}">0</span>
                                        </h4>
                                        <a href="{{ route('admin.appointmentCommision') }}"
                                            class="text-decoration-underline">View net
                                            commission</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success rounded fs-3">
                                            <i class="bx bx-dollar-circle"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-4 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Services Booked</p>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="{{ $serviceBooked }}">0</span></h4>
                                        <a href="{{ route('admin.Appointments') }}" class="text-decoration-underline">View
                                            all Bookings</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-info rounded fs-3">
                                            <i class="bx bx-shopping-bag"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-4 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            Service Providers</p>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <h5 class="text-success fs-14 mb-0">
                                            <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                            +29.08 %
                                        </h5>
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value"
                                                data-target="{{ $countServiceProviders }}">0</span>
                                        </h4>
                                        <a href="{{ route('admin.ServiceProvider') }}"
                                            class="text-decoration-underline">View All Service Providers</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning rounded fs-3">
                                            <i class="bx bx-user-circle"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    {{--
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Total Wallet Balance</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-muted fs-14 mb-0">
                                        +0.00 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="0">0</span>k
                                    </h4>
                                    <a href="" class="text-decoration-underline">Withdraw money</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-danger rounded fs-3">
                                        <i class="bx bx-wallet"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>
                --}}
                    <!-- end col -->
                </div> <!-- end row-->


                <div class="row">

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Categories</h4>
                                <div class="flex-shrink-0">
                                    <button type="button"
                                        class="btn btn-soft-info btn-sm shadow-none bg-primary text-white"
                                        data-bs-toggle="modal" data-bs-target=".bs-modal-add-service">
                                        <i class="ri-file-list-3-line align-middle"></i> Add New Category
                                    </button>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Category Name</th>
                                                <th scope="col">Category Amount</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($serviceCategories)
                                                @foreach ($serviceCategories as $index => $serviceCategory)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $serviceCategory->name }}</td>
                                                        <td>{{ $serviceCategory->price }}</td>
                                                        <td>
                                                            <div class="hstack gap-3 flex-wrap">
                                                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                                                    data-bs-target=".bs-modal-edit-service"
                                                                    class="link-success fs-15 Edit-Service-Category-Button"
                                                                    id = "{{ $serviceCategory->id }}"><i
                                                                        class="ri-edit-2-line"></i></a>
                                                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                                                    data-bs-target=".bs-modal-delete-service"
                                                                    class="link-danger fs-15 Delete-Service-Category-Button"
                                                                    id = "{{ $serviceCategory->id }}"><i
                                                                        class="ri-delete-bin-line"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                            {{--
                                        <tr>
                                            <td>2</td>
                                            <td>Live & Closed Captioning	</td>
                                            <td>
                                                <div class="hstack gap-3 flex-wrap">
                                                    <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target=".bs-modal-edit-service" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                                    <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target=".bs-modal-delete-service" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>3</td>
                                            <td>Mobility guides	</td>
                                            <td>
                                                <div class="hstack gap-3 flex-wrap">
                                                    <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target=".bs-modal-edit-service" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                                    <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target=".bs-modal-delete-service" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>4</td>
                                            <td>Personal assistants	</td>
                                            <td>
                                                <div class="hstack gap-3 flex-wrap">
                                                    <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target=".bs-modal-edit-service" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                                    <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target=".bs-modal-delete-service" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>5</td>
                                            <td>Tactile sign language</td>
                                            <td>
                                                <div class="hstack gap-3 flex-wrap">
                                                    <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target=".bs-modal-edit-service" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                                    <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target=".bs-modal-delete-service" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>6</td>
                                            <td>Ugandan Sign language</td>
                                            <td>
                                                <div class="hstack gap-3 flex-wrap">
                                                    <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target=".bs-modal-edit-service" class="link-success fs-15"><i class="ri-edit-2-line"></i></a>
                                                    <a href="javascript:void(0);"  data-bs-toggle="modal" data-bs-target=".bs-modal-delete-service" class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
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
                </div> <!-- end row-->

            </div> <!-- end .h-100-->

        </div> <!-- end col -->
    </div>
    <div class="modal fade bs-modal-add-service" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add-service-category-form" method="POST"
                        action="{{ route('admin.service-categories.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <input type="text" name="category_name" class="form-control" id="categoryName"
                                        placeholder="Enter Name">
                                </div>
                            </div>
                            {{-- <div class="col-xxl-12">
                                <div>
                                    <textarea name="description" class="form-control" id="description" cols="10" rows="5"
                                        placeholder="Enter Description"></textarea>
                                </div>
                            </div> --}}
                            <div class="col-xxl-12">
                                <div>
                                    <input type="number" name="category_amount" class="form-control"
                                        id="categoryAmount" placeholder="Enter Amount">
                                </div>
                            </div>
                            {{-- <div class="col-xxl-12">
                                <div>
                                    <input type="file" name="image" class="form-control" id="categoryImage">
                                </div>
                            </div> --}}
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary bg-primary border-primary">Add
                                        Category</button>
                                </div>
                            </div>
                        </div>
                    </form>
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
                    <form id="edit-service-category-form" action="" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            <div class="col-xxl-12">
                                <div>
                                    <input type="text" name="category_name" class="form-control" id="categoryName"
                                        placeholder="Enter Name">
                                </div>
                            </div>
                            {{-- <div class="col-xxl-12">
                                <div>
                                    <textarea name="description" class="form-control" id="description" cols="10" rows="5"
                                        placeholder="Enter Description"></textarea>
                                </div>
                            </div> --}}
                            <div class="col-xxl-12">
                                <div>
                                    <input type="text" name="category_amount" class="form-control" id="categoryId"
                                        placeholder="Enter Amount">
                                </div>
                            </div>
                            {{-- <div class="col-xxl-12">
                                <div>
                                    <input type="file" name="image" class="form-control" id="categoryImage">
                                </div>
                            </div>
                            <div class="col-xxl-12">
                                <div>
                                    <img id="categoryImagePreview" src="" alt="Category Image"
                                        class="img-thumbnail d-none" />
                                </div>
                            </div> --}}
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary bg-primary border-primary">Update
                                        Service</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-modal-delete-service" tabindex="-1" aria-labelledby="mySmallModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Delete Service Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action = "" id = "delete-service-category-form" method = "post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-body text-center p-5">
                        <img class="" alt="200x200" width="100"
                            src="{{ URL::asset('build/images/warning.gif') }}" data-holder-rendered="true">
                        <div class="mt-4">
                            <h4 class="mb-3">Delete this Service</h4>
                            <p class="text-muted mb-4"> Are you sure tou want to delete this service, YOu wnt be able to
                                restore it.</p>
                            <div class="hstack gap-2 justify-content-center">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-danger">Delete Service</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('page-script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <!-- dashboard init -->
    <script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.Edit-Service-Category-Button', function() {
            let serviceId = $(this).attr('id');
            let formId = $("#edit-service-category-form");
            let apiUrl = '{{ url('admin/service-categories') }}' + '/' + serviceId;
            $(formId).attr('action', apiUrl)
            fetch(apiUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.categoryDetails) {
                        $(formId).find("input[name='category_name']").val(data.categoryDetails.name);
                        // $(formId).find("textarea[name='description']").val(data.categoryDetails.description);
                        $(formId).find("input[name='category_amount']").val(data.categoryDetails.price);
                        // if (data.categoryDetails.image) {
                        //     $("#categoryImagePreview").attr('src', '{{ asset('storage/') }}/' + data
                        //         .categoryDetails.image).removeClass('d-none');
                        // } else {
                        //     $("#categoryImagePreview").addClass('d-none');
                        // }
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });

        $(document).on('click', '.Delete-Service-Category-Button', function() {
            let deleteServiceCategoryId = $(this).attr('id');
            let deleteApiUrl = '{{ url('admin/service-categories') }}' + '/' + deleteServiceCategoryId;
            let deleteForm = $("#delete-service-category-form");
            $(deleteForm).attr('action', deleteApiUrl);

        });
    </script>
@endpush
