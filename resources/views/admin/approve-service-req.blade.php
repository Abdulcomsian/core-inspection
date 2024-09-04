@extends('admin.layouts.master')
@section('title')
    Approvals
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Approvals
        @endslot
    @endcomponent

    <div class="row">
        <div class="col">
            <div class="h-100">
                <div class="row">

                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Approve Service Requests</h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-centered align-middle table-nowrap mb-0">
                                        <thead class="text-muted table-light">
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Service Provider</th>
                                                <th scope="col">Request Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @isset($unapprovedoServiceRequests)
                                                @foreach ($unapprovedoServiceRequests as $index => $unapprovedServiceRequest)
                                                    <tr>
                                                        <td>{{ $index + 1 }}</td>
                                                        <td>{{ $unapprovedServiceRequest->serviceCategory->name }}</td>
                                                        <td>{{ $unapprovedServiceRequest->serviceCategory->price }}</td>
                                                        <td>{{ $unapprovedServiceRequest->providerDetails->first_name }}
                                                            {{ $unapprovedServiceRequest->providerDetails->last_name }}</td>
                                                        @if ($unapprovedServiceRequest->status == 0)
                                                            <td><span class="badge bg-warning text-dark">Pending</span></td>
                                                        @elseif($unapprovedServiceRequest->status == 2)
                                                            <td><span class="badge bg-danger text-dark">Rejected</span></td>
                                                        @else
                                                            <td><span class="badge bg-success">Approved</span></td>
                                                        @endif
                                                        <td>
                                                            <div class="hstack gap-3 flex-wrap">
                                                                <a href="{{ url('admin/onboarding-vendor-profile', ['id' => $unapprovedServiceRequest->providerDetails->id, 'service_id' => $unapprovedServiceRequest->id]) }}"
                                                                    class="link-success fs-24 Approval-Modal-Button"><i
                                                                        class="las la-eye"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end mt-2"
                                        style="margin-right: 20px;margin-top: 20px;">
                                        {{ $unapprovedoServiceRequests->links() }}
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
                    <h5 class="modal-title" id="exampleModalgridLabel">Service Request</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method = "post" action = "{{ route('admin.UpdateVendor') }}">
                    @csrf
                    <input type= "hidden" name  = "user_id" value = "">
                    <div class="modal-body">
                        <div class="row g-0">
                            <div class="col-lg-12">
                                <a href="javascript:void(0);" class="list-group-item list-group-item-action">
                                    <div class="float-end">
                                        <b class="text-success">$100</b>
                                    </div>
                                    <div class="d-flex mb-2 align-items-center">
                                        <div class="flex-shrink-0">
                                            <img src="{{ URL::asset('build/images/users/avatar-1.jpg') }}" alt=""
                                                class="avatar-sm rounded-circle">
                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <h5 class="list-title fs-15 mb-1 name">Angela Bernier</h5>
                                            <p class="list-text mb-0 fs-12">Service Provider</p>
                                        </div>
                                    </div>
                                    <p class="list-text mb-0">Just like in the image where we talked about using multiple
                                        fonts, you can see that the background in this graphic design is blurred. Whenever
                                        you put text on top of an image, it’s important that your viewers can understand the
                                        text, and sometimes that means applying a gaussian readable.</p>
                                    <div class="hstack gap-2 mt-3 justify-content-center a-auto">
                                        <button type="submit" name= "submit_type" value = "accept" class="btn btn-success"
                                            data-bs-dismiss="modal">Accept</button>
                                        <button type = "submit" name= "submit_type" value = "reject"
                                            class="btn btn-danger">Reject</button>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('page-script')
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/us-merc-en.js') }}"></script>
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/form-input-spin.init.js') }}"></script>

    <script src="{{ URL::asset('build/libs/card/card.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/widgets.init.js') }}"></script>

    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '.Approval-Modal-Button', function() {
            let id = $(this).attr('id');
            console.log(id);
            const apiUrl = '{{ url('admin/get-Vendor-Details') }}' + '/' + id;
            fetch(apiUrl, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    return response.json();
                })
                .then(data => {
                    if (data.vendorDetails) {
                        console.log(data.vendorDetails);
                        $("input[name=user_id]").val(id)
                        $(".name").text(data.vendorDetails.name)
                        $(".email").text(data.vendorDetails.email)
                    }
                })
                .catch(error => {
                    console.error(error);
                });
        });
    </script>
@endpush
