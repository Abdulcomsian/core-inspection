@extends('user.layouts.master')
@section('title')
    Edit Profile
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/aos/aos.css') }}" rel="stylesheet">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Edit Profile
        @endslot
    @endcomponent

    <style>
        .avatar-title {
            margin-top: -18px;
        }
    </style>

    @php
        // Get the user's avatar
$avatar = Auth::user()->avatar;

// Define the base URL based on the environment
$baseUrl = config('app.url') . '/storage/users-avatar/';

// Check if the avatar contains the full URL and remove the unwanted prefix if necessary
if (strpos($avatar, $baseUrl) === 0) {
    $avatar = str_replace($baseUrl, '', $avatar);
}

// Construct the final URL
$avatarUrl = $avatar ? URL::asset('images/' . $avatar) : URL::asset('build/images/users/avatar-1.jpg');
    @endphp

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('user.update.profile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name"
                                        value="{{ $user->first_name }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name"
                                        value="{{ $user->last_name }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ $user->email }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ $user->phone }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="gender">Gender</label>
                                    <select class="form-control" id="gender" name="gender" required>
                                        <option value="0" {{ $user->gender == '0' ? 'selected' : '' }}>Male</option>
                                        <option value="1" {{ $user->gender == '1' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label for="avatar">Avatar</label>
                                            <input type="file" class="form-control" id="avatar" name="avatar">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-3">
                                        <div class="form-group">
                                            <img src="{{ $avatarUrl }}" alt="User Avatar" class="img-thumbnail"
                                                width="70">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="password">Change Password</label>
                                    <input type="password" class="form-control" id="password" name="password">
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-3 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
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
