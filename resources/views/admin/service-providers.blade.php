@extends('admin.layouts.master')
@section('title')
    Service Providers
@endsection
@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Service Providers
        @endslot
    @endcomponent

    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row">

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Service Provider</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">First Name</th>
                                                <th scope="col">Last Name</th>
                                                <th scope="col">Gender</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Phone</th>
                                                <th scope="col">Role</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($approvedVendors)
                                                @foreach ($approvedVendors as $index => $approvedVendor)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $approvedVendor->first_name }}</td>
                                                        <td>{{ $approvedVendor->last_name }}</td>
                                                        <td>
                                                            {{ $approvedVendor->gender == 0 ? 'Male' : ($approvedVendor->gender == 1 ? 'Female' : 'Prefer Not to say') }}
                                                        </td>
                                                        <td>{{ $approvedVendor->email }}</td>
                                                        <td>{{ $approvedVendor->phone ?? 'N/A' }}</td>
                                                        <td id = "{{ $approvedVendor->roles[0]['id'] }}">Service Provider</td>
                                                        <td id = "{{ $approvedVendor->profile_approved_status }}">
                                                            <span
                                                                class="badge {{ $approvedVendor->profile_approved_status == '1' ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} fs-11">
                                                                {{ $approvedVendor->profile_approved_status == '1' ? 'Active' : 'Inactive' }}
                                                            </span>
                                                        </td>
                                                        <td>
                                                            <div class="hstack gap-3 flex-wrap">
                                                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                                                    data-bs-target=".bs-modal-edit-service-provider"
                                                                    class="link-success fs-15 Edit-Button"
                                                                    id = "{{ $approvedVendor->id }}"><i
                                                                        class="ri-edit-2-line"></i></a>
                                                                <a href="javascript:void(0);" data-bs-toggle="modal"
                                                                    data-bs-target=".bs-modal-delete-admin"
                                                                    class="link-danger fs-15 Delete-Button"
                                                                    id = "{{ $approvedVendor->id }}"><i
                                                                        class="ri-delete-bin-line"></i></a>
                                                                <a href="{{ route('admin.serviceProviderDetail', $approvedVendor->id) }}"
                                                                    class="link-success fs-23" title = "Service Reviews"><i
                                                                        class="las la-eye"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset

                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end" style="margin-right: 20px;margin-top: 20px;">
                                        {{ $approvedVendors->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-modal-edit-service-provider" tabindex="-1" aria-labelledby="mySmallModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Edit Service Provider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id = "edit-user-form" method = "post" action  = "{{ route('update_user') }}">
                        @csrf
                        <input type = "hidden" name = "user_id">
                        <div class="row g-3">
                            <div class="col-xxl-6">
                                <div>
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="ServiceName"
                                        placeholder="First Name">
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <div>
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control" id="ServiceName"
                                        placeholder="Last Name">
                                </div>
                            </div>
                            <div class="col-xxl-6">
                                <div>
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" id="UserName"
                                        placeholder="Email Address">
                                </div>
                            </div>
                            {{-- <div class="col-xxl-6">
                            <div>
                            <label>Phone Number</label>
                                <input type="number" name="phone_number" class="form-control" id="UserName" placeholder="Phone Number">
                            </div>
                        </div> --}}
                            <div class="col-xxl-6">
                                <label>Role</label>
                                <select class="form-select" aria-label=".form-select-sm example" name = "role">
                                    <option value = "vendor_user" selected disabled>Service Provider</option>
                                </select>
                            </div>
                            <div class="col-xxl-6">
                                <label>Status</label>
                                <select class="form-select" aria-label=".form-select-sm example" name = "is_approved">
                                    <option selected="">Change Status</option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="col-lg-12">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary bg-primary border-primary">Update
                                        Service Provider</button>
                                </div>
                            </div>
                        </div>
                        <!--end row-->
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    <div class="modal fade bs-modal-delete-admin" tabindex="-1" aria-labelledby="mySmallModalLabel"
        style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalgridLabel">Delete Service Provider</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-5">
                    <form method = "post" action = "{{ route('delete_user') }}" id = "delete-user-form">
                        @csrf
                        <input type = "hidden" name = "user_id">
                        <img class="" alt="200x200" width="100"
                            src="{{ URL::asset('build/images/delete-user.gif') }}" data-holder-rendered="true">
                        <div class="mt-4">
                            <h4 class="mb-3">Delete this Service Provider</h4>
                            <p class="text-muted mb-4"> Are you sure to want to delete this Service Provider, You wnt be
                                able to restore it.</p>
                            <div class="hstack gap-2 justify-content-center">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                <button type = "submit" class="btn btn-danger">Delete Service Provider</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- Vector map-->
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/us-merc-en.js') }}"></script>
    <!-- Swiper Js -->
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/form-input-spin.init.js') }}"></script>

    <script src="{{ URL::asset('build/libs/card/card.js') }}"></script>

    <!-- Widget init -->
    <script src="{{ URL::asset('build/js/pages/widgets.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('click', '.Edit-Button', function() {
                let id = $(this).attr('id');
                let formId = "#edit-user-form";
                let row = $(this).closest('tr');
                $(formId).find($("input[name=user_id]")).val(id);
                $(formId).find($("input[name=first_name]")).val(row.find('td:eq(1)').text())
                $(formId).find($("input[name=last_name]")).val(row.find('td:eq(2)').text())
                $(formId).find($("input[name=email]")).val(row.find('td:eq(3)').text())
                $(formId).find($("select[name='is_approved']")).trigger('reset').val(row.find('td:eq(5)')
                    .attr('id')).attr('selected');
            });

            $(document).on('click', '.Delete-Button', function() {
                let deleteUserId = $(this).attr('id');
                let deleteFormId = "#delete-user-form";
                $(deleteFormId).find($("input[name=user_id]")).val(deleteUserId);
            });
        })
    </script>
@endsection
