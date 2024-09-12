@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Create User')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container">
                <div class="card">
                    <div class="card-header border-0 pt-6">
                        <div class="card-title">
                            <div class="d-flex align-items-center position-relative my-1">
                            </div>
                        </div>
                        <div class="card-toolbar">
                            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                                <a href="{{ route('users.index') }}">
                                <button type="button" class="btn btn-primary">
                                    <span class="svg-icon svg-icon-2">
                                    </span>
                                    View Users</button>
                                </a>
                            </div>
                            <div class="d-flex justify-content-end align-items-center d-none"
                                data-kt-user-table-toolbar="selected">
                                <div class="fw-bolder me-5">
                                    <span class="me-2" data-kt-user-table-select="selected_count"></span>Selected
                                </div>
                                <button type="button" class="btn btn-danger"
                                    data-kt-user-table-select="delete_selected">Delete Selected</button>
                            </div>
                        </div>
                    </div>

                    <div class="container">
                        <form class="form" method="POST" action="{{ route('users.store') }}">
                            @csrf
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Full Name:</label>
                                        <input type="text" class="form-control" placeholder="Enter full name" name="name" required />
                                        <span class="form-text text-muted">Please enter your full name</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>UserName:</label>
                                        <input type="text" class="form-control" placeholder="Enter username" name="username" required />
                                        <span class="form-text text-muted">Please enter your username</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Email:</label>
                                        <input type="email" class="form-control" placeholder="Enter email address" name="email" required />
                                        <span class="form-text text-muted">Please enter your email address</span>
                                    </div>
                                    <div class="col-lg-6">
                                        <label>Password:</label>
                                        <input type="password" class="form-control" placeholder="Enter password" name="password" required />
                                        <span class="form-text text-muted">Please enter your password</span>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Role:</label>
                                        <select class="form-control" name="role" required>
                                            <option value="">Select Role</option>
                                            <option value="user">User</option>
                                            <option value="admin">Admin</option>
                                        </select>
                                        <span class="form-text text-muted">Please select the user role</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-primary mr-2">Save</button>
                                        <button type="reset" class="btn btn-secondary">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
