@extends('vendor-user.layouts.master')
@section('title')
    Manage Services
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('build/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />

    <style>
        .modal-body {
            max-height: 400px;
            /* Adjust the max-height as needed */
            overflow-y: auto;
        }
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        <li class="breadcrumb-item"><a href="{{ route('vendor.Dashboard') }}">Dashboard</a></li>
        @slot('title')
            Manage Services
        @endslot
    @endcomponent


    <div class="row">
        <div class="col-12">
            <div class="justify-content-between d-flex align-items-center mt-3 mb-4">
                <h5 class="mb-0 pb-1 flex-grow-1 text-decoration-underline">My Services</h5>
                <div class="flex-shrink-0">
                    <button type="button" class="btn btn-success btn-md shadow-none add-service-button"
                        data-bs-toggle="modal" data-bs-target=".bs-modal-add-service">
                        <i class="ri-file-add-line align-middle"></i> Add New Service
                    </button>
                </div>
            </div>
            <div class="row row-cols-xxl-5 row-cols-lg-3 row-cols-1">
                @isset($services)
                    @foreach ($services as $index => $service)
                        <div class="col mb-4">
                            <div class="card h-100">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-block mb-4 align-items-center">
                                        <div class="flex-shrink-0 card-icons">
                                            <div class="overlay-icons">
                                                <a href="javascript:void(0)" class="edit text-primary" data-bs-toggle="modal"
                                                    data-bs-target=".bs-modal-edit-service"
                                                    onclick="serviceDetail({{ $service->id }},'edit-details')">
                                                    <i class="las la-pencil-alt"></i>
                                                    <span>Edit</span>
                                                </a>
                                                <a href="javascript:void(0)" class="delete delete-service-button text-primary"
                                                    id="{{ $service->id }}" data-bs-toggle="modal"
                                                    data-bs-target=".bs-modal-delete-vendor-service">
                                                    <i class="las la-trash"></i>
                                                    <span>Delete</span>
                                                </a>
                                            </div>
                                            <div class="overlay-price">
                                                <span>${{ $service->serviceCategory->price ?? '' }}</span>
                                            </div>
                                            {{-- <img src="{{ asset('storage/' . $service->serviceCategory->image) }}"
                                                alt="Category Image" class="w-100" height="200"
                                                style="object-fit: cover; min-height: 200px;"> --}}
                                        </div>
                                    </div>
                                    <h6 class="mb-1 flex-grow-1">
                                        <b>{{ $service->serviceCategory->name ?? 'No Name Available' }}</b>
                                    </h6>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target=".bs-modal-view-service"
                                        class="btn btn-primary btn-sm bg-primary border-primary mt-auto"
                                        onclick="serviceDetail({{ $service->id }},'view-details')">View</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>
        </div>
    </div>

    {{-- <div class="modal fade" id="descriptionModal" tabindex="-1" aria-labelledby="descriptionModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="descriptionModalLabel">Complete Description</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                    <p class="full-description"></p>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Modal for service details -->
    <div class="modal fade bs-modal-view-service" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Service Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-0">
                        <div class="col-lg-12">
                            <h5 class="list-title fs-15 mb-3 text-center service-details-title"></h5>
                            <div class="float-end">
                                <b class="price-tag">$<span class="service-details-price"></span></b>
                            </div>
                            <strong class="list-text mb-3 service-details-category"></strong>
                            <p class="list-text mb-0 service-details-description"></p>
                            {{-- <div class="text-center mb-4">
                                <img src="" class="service-details-image img-fluid" alt="Service Image"
                                    style="object-fit:cover; display:none;">
                            </div> --}}
                        </div>
                    </div>
                    {{-- <button type="button" class="btn btn-link view-all-description" data-bs-toggle="modal"
                        data-bs-target="#descriptionModal">View More</button> --}}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-modal-add-service" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Add Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action  = "{{ route('vendor.services.store') }}" class="needs-validation" novalidate
                        id = "add-service-form" method = "post" enctype = "multipart/form-data">
                        @csrf
                        <div class="row g-3">
                            {{-- <div class="col-xxl-12">
                            <div>
                                <input type="text" name  = "title" class="form-control" id="service-title" placeholder="Enter Service Name" required>
                                <div class="invalid-feedback">
                                    Please enter Title
                                </div>
                            </div>
                        </div>
                        <!-- <input type="hidden" name="description" id = "service-description" required> -->
                        <div class="col-xxl-12">
                          <textarea  name="description"  class="form-control ckeditor" id = "service-description" required></textarea>
                            <div class="invalid-feedback">
                                Please enter description
                            </div>
                        </div> --}}
                            {{-- <div class="col-xxl-6">
                            <div>
                                <input type="number" name="price" class="form-control" id="service-price" placeholder="Enter Price" required>
                                <div class="invalid-feedback">
                                    Please enter  service price
                                </div>
                            </div>
                        </div> --}}
                            <div class="col-xxl-12">
                                <select class="form-select mb-3" aria-label="Default select example" id="service-category"
                                    name = "service_category_id" required>
                                    <!-- <option selected="">Select Service Category </option> -->
                                    @isset($serviceCategories)
                                        @foreach ($serviceCategories as $index => $serviceCategory)
                                            <option value = "{{ $serviceCategory->id }}" {{ $index == 0 ? 'selected' : '' }}>
                                                {{ $serviceCategory->name }} | ${{ $serviceCategory->price }}</option>
                                        @endforeach
                                    @endisset
                                    <div class="invalid-feedback">
                                        Please select any service category
                                    </div>
                                </select>
                            </div>
                            {{-- <div class="col-xxl-6">
                            <input class="form-control" type="file" id="imageInput" name = "upload_media" accept=".png, .jpg, .jpeg" required>
                            <div class="invalid-feedback">
                                Please select any image
                            </div>
                            <img id="previewImage" style="max-width: 300px; max-height: 300px; margin-top: 10px; display: none;">
                        </div> --}}
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit"
                                        class="btn btn-primary add-submit-button bg-primary border-primary">Add
                                        Service</button>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade bs-modal-edit-service" tabindex="-1" aria-labelledby="mySmallModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Edit Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action  = "" id = "edit-service-form" class= "edit-needs-validation" novalidate
                        method = "post" enctype = "multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row g-3">
                            {{-- <div class="col-xxl-12">
                            <div>
                                <input type="text" class="form-control" name = "title" id="edit-service-title" placeholder="Enter Service Name" required>
                                <div class="invalid-feedback">
                                    Please enter service title
                                </div>
                            </div>
                        </div>
                        <!-- <input type="hidden" name="description" id="edit-service-description" required> -->
                        <div class="col-xxl-12">
                            <textarea name="description"  class="form-control ckeditor" id = "edit-service-description" required></textarea>
                            <div class="invalid-feedback">
                                Please enter description
                            </div>
                        </div> --}}
                            {{-- <div class="col-xxl-6">
                            <div>
                                <input type="number" class="form-control" id="edit-service-price" name = "price" placeholder="Enter Price" required>
                                <div class="invalid-feedback">
                                    Please enter service price
                                </div>
                            </div>
                        </div> --}}
                            <div class="col-xxl-12">
                                <select class="form-select mb-3" aria-label="Default select example"
                                    name = "service_category_id" id = "edit-service-category" required>
                                    @isset($serviceCategories)
                                        @foreach ($serviceCategories as $index => $serviceCategory)
                                            <option value = "{{ $serviceCategory->id }}" {{ $index == 0 ? 'selected' : '' }}>
                                                {{ $serviceCategory->name }} | ${{ $serviceCategory->price }}</option>
                                        @endforeach
                                    @endisset
                                    <div class="invalid-feedback">
                                        Please select any service category
                                    </div>
                                </select>
                            </div>
                            {{-- <div class="col-xxl-6">
                            <input class="form-control" type="file" id="formFile" name = "upload_media" >
                            <img class="previewImage" style="max-width: 300px; max-height: 300px; margin-top: 10px; display: none;">
                        </div> --}}
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit"
                                        class="btn btn-primary edit-submit-button bg-primary border-primary">Update
                                        Service</button>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

    <div class="modal fade bs-modal-delete-vendor-service" tabindex="-1" aria-labelledby="mySmallModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Delete Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action = "" id = "delete-service-form" method = "post">
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
                                <button type = "submit" class="btn btn-danger">Delete Service</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

@endsection
@push('page-script')
    <script src="{{ URL::asset('build/libs/aos/aos.js') }}"></script>
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/animation-aos.init.js') }}"></script>
    <!-- <script src="{{ URL::asset('build/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script> -->
    <script src="{{ URL::asset('build/libs/quill/quill.min.js') }}"></script>
    <!-- <script src="{{ URL::asset('build/js/pages/form-editor.init.js') }}"></script> -->
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>

    <script type="text/javascript">
        document.querySelector('.add-service-button').addEventListener('click', function() {
            isaddEditor = document.querySelector('#add-service-form .ck-editor');
            if (!isaddEditor) {
                ClassicEditor
                    .create(document.querySelector('#service-description'))
                    .then(editor => {
                        // Editor created successfully, you can perform any additional operations here if needed
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        });

        // ClassicEditor
        // .create( document.querySelector( '#edit-service-description') )
        // .catch( error => {
        //     console.error( error );
        // } );
        //     var quill = new Quill('.snow-editor', {
        //     theme: 'snow'
        // });
        // $(document).on('submit','#add-service-form', function(e){
        //     e.preventDefault();
        //     var editorContent = quill.root.innerHTML;
        //     // Set the content of the hidden textarea (Quill's way to store content in the form)
        //     document.querySelector('input[name="description"]').value = editorContent;

        //     // Submit the form
        //     document.getElementById('add-service-form').submit();
        // });
        // $(document).on('submit','#edit-service-form', function(e){
        //     e.preventDefault();
        //     var editorContent = quill.root.innerHTML;
        //     // Set the content of the hidden textarea (Quill's way to store content in the form)
        //     document.getElementById('edit-service-description').value = editorContent;

        //     // Submit the form
        //     document.getElementById('add-service-form').submit();
        // });

        function showFullDescription(description) {
            document.querySelector('#descriptionModal .full-description').innerHTML = description;
            var descriptionModal = new bootstrap.Modal(document.getElementById('descriptionModal'));
            descriptionModal.show();
        }

        document.getElementById('descriptionModal').addEventListener('hidden.bs.modal', function() {
            document.body.classList.remove('modal-open');
            document.querySelector('.modal-backdrop').remove();
        });

        function serviceDetail(serviceId, type) {
            let editServiceId = serviceId;
            let editApiUrl = "{{ url('service-provider/services') }}" + "/" + editServiceId;
            let editServiceForm = $("#edit-service-form");
            $(editServiceForm).trigger('reset');
            $(editServiceForm).attr('action', editApiUrl);
            fetch(editApiUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    if (data.serviceDetails) {
                        if (type === 'edit-details') {
                            // Logic for editing details...
                        } else if (type == 'view-details') {
                            $(".service-details-title").text(data.serviceDetails.title);
                            $(".service-details-price").text(data.serviceDetails.service_category.price);
                            var description = data.serviceDetails.service_category.description;
                            // var truncatedDescription = description.substring(0, 100) +
                            //     '...';
                            // $(".service-details-description").html(truncatedDescription);
                            $(".service-details-category").html(data.serviceDetails.service_category.name);
                            $(".service-details-delete").attr('id', serviceId);
                            // if (data.serviceDetails.service_category.image) {
                            //     $(".service-details-image").attr('src', "{{ asset('storage/') }}/" + data
                            //         .serviceDetails.service_category.image);
                            //     $(".service-details-image").css('display', 'block');
                            // } else {
                            //     $(".service-details-image").css('display', 'none');
                            // }
                            // $(".view-all-description").attr('onclick', 'showFullDescription("' + description +
                            //     '")'); // Set onclick event to show full description
                        }
                    } else {
                        console.log('Service details not found.');
                    }
                })
                .catch(error => {
                    console.log(error);
                });
        }

        $(document).on('click', '.delete-service-button, .service-details-delete', function() {
            let deleteServiceId = $(this).attr('id');
            let deleteForm = $("#delete-service-form");
            let deleteUrl = '{{ url('service-provider/services') }}' + '/' + deleteServiceId;
            $(deleteForm).attr('action', deleteUrl);

        });
        $(document).on('change', '#imageInput', function() {
            // Get the selected file
            var file = this.files[0];

            if (file) {
                // Read the file as a data URL
                var reader = new FileReader();

                reader.onload = function(e) {
                    // Set the source of the preview image
                    $('#previewImage').attr('src', e.target.result);
                    // Display the preview image
                    $('#previewImage').css('display', 'block');
                };

                // Read the file as a data URL
                reader.readAsDataURL(file);
            }
        });
        (function() {
            'use strict';
            document.querySelector(".edit-submit-button").addEventListener('click', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('edit-needs-validation');
                var formId = $(".edit-needs-validation").attr('id');
                // Loop over them and prevent submission
                let req = 0;
                if (forms)
                    Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                req++;
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
            }, false);
            document.querySelector(".add-submit-button").addEventListener('click', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                var formId = $(".needs-validation").attr('id');
                // Loop over them and prevent submission
                let req = 0;
                if (forms)
                    Array.prototype.filter.call(forms, function(form) {
                        form.addEventListener('submit', function(event) {
                            if (form.checkValidity() === false) {
                                event.preventDefault();
                                req++;
                                event.stopPropagation();
                            }
                            form.classList.add('was-validated');
                        }, false);
                    });
            }, false);
        })();
    </script>

    <!-- <script src="{{ URL::asset('build/js/pages/form-validation.init.js') }}"></script> -->
@endpush
