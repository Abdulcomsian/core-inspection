@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Update User')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-fluid">
            <!-- Card Toolbar -->
            <div class="mt-5">
                <!-- Form Section -->
                <div class="card">
                    <div class="form-header d-flex justify-content-between align-items-center">
                        <a href="{{ route('users.index') }}">
                            <button type="button" class="btn btn-sm add-section">
                                <i class="fas fa-eye icon"></i>View Users
                            </button>
                        </a>
                    </div>
                    <div class="card-body">
                        <form class="form" method="POST" action="{{ route('users.update', $user->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group row">
                                <div class="col-lg-6">
                                    <label>Full Name:</label>
                                    <input type="text" class="form-control" placeholder="Enter full name"
                                        name="name" value="{{ old('name', $user->name) }}" required />
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span class="form-text text-muted">Please enter your full name</span>
                                </div>
                                <div class="col-lg-6">
                                    <label>UserName:</label>
                                    <input type="text" class="form-control" placeholder="Enter username"
                                        name="username" value="{{ old('username', $user->username) }}" required />
                                    @error('username')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span class="form-text text-muted">Please enter your username</span>
                                </div>
                                <div class="col-lg-6">
                                    <label>Password:</label>
                                    <input type="password" class="form-control" placeholder="Enter password"
                                        name="password" />
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span class="form-text text-muted">Leave blank if you don't want to change the
                                        password</span>
                                </div>
                                <div class="col-lg-6">
                                    <label>Role:</label>
                                    <select class="form-control" name="role" required>
                                        <option value="">Select Role</option>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}"
                                                {{ $userRole == $role ? 'selected' : '' }}>{{ $role }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    <span class="form-text text-muted">Please select the user role</span>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-sm save-btn mr-2"><i class="far fa-save icon"></i>Save</button>
                                        <button type="reset" class="btn btn-sm delete-btn"><i class="fa fa-ban icon"></i>Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@section('scripts')
    @parent
    <script>
        $(document).ready(function() {
            $('.select-all').click(function() {
                $('#permissions option').prop('selected', true);
                $('#permissions').trigger('change');
            });

            $('.deselect-all').click(function() {
                $('#permissions option').prop('selected', false);
                $('#permissions').trigger('change');
            });
        });
    </script>
@endsection
@endsection
