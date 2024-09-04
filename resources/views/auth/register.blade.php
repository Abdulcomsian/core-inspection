@extends('admin.layouts.master-without-nav')
@section('title')
    @lang('translation.signup')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .select2-container .select2-search--inline {
            float: left;
            margin: 0;
        }
    </style>
@endsection
@section('content')
    <div class="auth-page-wrapper pt-5">
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <a href="index" class="d-inline-block auth-logo">
                                    <img src="{{ URL::asset('build/images/logo.png') }}" alt="" height="40">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Create New Account</h5>
                                    <p class="text-muted">Get your free Dasuns account now</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form class="needs-validation" novalidate method="POST"
                                        action="{{ route('register') }}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3 d-flex">
                                            <div>
                                                <label for="firstname" class="form-label">First Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('first_name') is-invalid @enderror"
                                                    name="first_name" value="{{ old('first_name') }}" id="first-name"
                                                    placeholder="Enter Your First Name" required>
                                                @error('first_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback">
                                                    Please enter your first name
                                                </div>
                                            </div>
                                            <div class = "ms-1">
                                                <label for="lastname" class="form-label">Last Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control @error('last_name') is-invalid @enderror"
                                                    name="last_name" value="{{ old('last_name') }}" id="last-name"
                                                    placeholder="Enter Your Last Name" required>
                                                @error('last_name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                                <div class="invalid-feedback">
                                                    Please enter your last name
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="useremail" class="form-label">Email <span
                                                    class="text-danger">*</span></label>
                                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                                name="email" value="{{ old('email') }}" id="useremail"
                                                placeholder="Enter email address" required>
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback">
                                                Please enter email
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="role" class="form-label">Role <span
                                                    class="text-danger">*</span></label>
                                            <select placeholder="Name" name="role" id="role"
                                                class="form-control @error('role') is-invalid @enderror" required>
                                                <option value="">Select</option>
                                                <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User
                                                </option>
                                                <option value="vendor" {{ old('role') == 'vendor' ? 'selected' : '' }}>
                                                    Service Provider</option>
                                            </select>
                                            @error('role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback">
                                                Please Select Role
                                            </div>
                                        </div>

                                        <div class="mb-3 search-box" id="service-selection" style="display: none;">
                                            <label for="search-service-category" class="form-label">Select Services<span
                                                    class="text-danger">*</span></label>
                                            <select
                                                class="form-select mb-3 js-example-placeholder-single js-states form-control"
                                                aria-label="Default select example" id="search-service-category"
                                                name="services[]" multiple>

                                                @php
                                                    $serviceCategories = \App\Models\ServiceCategory::all();
                                                @endphp

                                                @isset($serviceCategories)
                                                    @foreach ($serviceCategories as $serviceCategory)
                                                        <option value="{{ $serviceCategory->id }}">
                                                            {{ $serviceCategory->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @error('services')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback">
                                                Please Select Service
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="gender" class="form-label">Gender<span
                                                    class="text-danger">*</span></label>
                                            <select placeholder="Name" name="gender" id="gender"
                                                class="form-control @error('gender') is-invalid @enderror" required>
                                                <option value="">Select</option>
                                                <option value="0">
                                                    Male
                                                </option>
                                                <option value="1">
                                                    Female</option>
                                                <option value="2">
                                                    Prefer not to say</option>
                                            </select>
                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback">
                                                Please Select Role
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="phoneNo" class="form-label">Phone No <span
                                                    class="text-danger">*</span></label>
                                            <input type="number"
                                                class="form-control @error('phone') is-invalid @enderror" name="phone"
                                                id="phoneNo" placeholder="Enter Phone No" required>
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback">
                                                Please enter Phone No
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="userpassword" class="form-label">Password <span
                                                    class="text-danger">*</span></label>
                                            <input type="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                name="password" id="userpassword" placeholder="Enter password" required>
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="invalid-feedback">
                                                Please enter password
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input-password">Confirm Password <span
                                                    class="text-danger">*</span></label>
                                            <input type="password"
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                name="password_confirmation" id="input-password"
                                                placeholder="Enter Confirm Password" required>

                                            <div class="form-floating-icon">
                                                <i data-feather="lock"></i>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="input-avatar">Avatar <span class="text-danger"></span></label>
                                            <input type="file"
                                                class="form-control @error('avatar') is-invalid @enderror" name="avatar"
                                                id="input-avatar">
                                            @error('avatar')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="">
                                                <i data-feather="file"></i>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <p class="mb-0 fs-12 text-muted fst-italic">By registering you agree to the
                                                Velzon <a href="#"
                                                    class="text-primary text-decoration-underline fst-normal fw-medium">Terms
                                                    of Use</a></p>
                                        </div>

                                        <div class="mt-3">
                                            <button class="btn btn-success w-100" type="submit">Sign Up</button>
                                        </div>

                                        {{-- <div class="mt-3 text-center">
                                                <div class="signin-other-title">
                                                    <h5 class="fs-13 mb-4 title text-muted">Create account with</h5>
                                                </div>

                                                <div>
                                                    <button type="button"
                                                        class="btn btn-primary btn-icon waves-effect waves-light"><i
                                                            class="ri-facebook-fill fs-16"></i></button>
                                                    <button type="button"
                                                        class="btn btn-danger btn-icon waves-effect waves-light"><i
                                                            class="ri-google-fill fs-16"></i></button>
                                                    <button type="button"
                                                        class="btn btn-dark btn-icon waves-effect waves-light"><i
                                                            class="ri-github-fill fs-16"></i></button>
                                                    <button type="button"
                                                        class="btn btn-info btn-icon waves-effect waves-light"><i
                                                            class="ri-twitter-fill fs-16"></i></button>
                                                </div>

                                            </div> --}}
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 text-center">
                            <p class="mb-0">Already have an account ? <a href="{{ route('login') }}"
                                    class="fw-semibold text-primary text-decoration-underline"> Signin </a> </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> Copyright @ Diversity Ability Support Network System. Crafted with <i
                                class="mdi mdi-heart text-danger"></i> by Maven Cloud Limited</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/particles.js/particles.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/particles.app.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/form-validation.init.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    @include('script.common-script')
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/us-merc-en.js') }}"></script>
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/form-input-spin.init.js') }}"></script>

    <script src="{{ URL::asset('build/libs/card/card.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/widgets.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#search-service-category").select2({
                placeholder: "Select Services",
                allowClear: true
            });

            function toggleServiceSelection() {
                var selectedRole = $('#role').val();
                if (selectedRole === 'vendor') {
                    $('#service-selection').show();
                } else {
                    $('#service-selection').hide();
                }
            }

            toggleServiceSelection();

            $('#role').on('change', function() {
                toggleServiceSelection();
            });
        });
    </script>
@endsection
