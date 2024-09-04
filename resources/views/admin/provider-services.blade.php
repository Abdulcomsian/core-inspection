@extends('admin.layouts.master')
@section('title')
    Services
@endsection
@section('css')
    <!-- plugin css -->
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" />
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
        Services
        @endslot
    @endcomponent

<div class="row">
    <div class="col">
        <div class="h-100">
            <div class="row">

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Services</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table table-centered align-middle table-nowrap mb-0">
                                    <thead class="text-muted table-light">
                                        <tr>
                                            {{-- <th scope="col">Name</th> --}}
                                            <th scope="col">Category</th>
                                            <th scope="col">Service Provider</th>
                                            <th scope="col">Price</th>
                                            {{-- <th scope="col">Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @isset($allServices)
                                        @foreach($allServices as $index=>$service)
                                        <tr>
                                            {{-- <td>{{$service->title ?? ''}}</td> --}}
                                            <td>{{$service->serviceCategory->name ?? ''}}</td>
                                            <td>{{$service->providerDetails->first_name ?? ''}} {{$service->providerDetails->last_name ?? ''}}</td>
                                            <td>${{$service->serviceCategory->price ?? ''}}</td> 
                                            {{-- <td>
                                                <button type="button" class="btn bg-primary border-primary py-1 mx-1 text-white Set-Price-Button" data-bs-toggle="modal"  data-bs-target=".bs-modal-edit-service"  id ="{{$service->id}}">Set Price</button>
                                            </td>                                   --}}
                                        </tr>
                                            @endforeach
                                            @endisset
                                    {{--
                                        <tr>
                                            <td>Sign Language</td>
                                            <td>13/05/2024</td>
                                            <td>10:30 PM</td>
                                            <td>Alabama, United State</td>
                                            <td>+123 456 7890</td>
                                            <td>John Doe</td>
                                            <td class="text-success"><b>Schedule</b></td>
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

<div class="modal fade bs-modal-edit-service" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Set Price</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id = "set-price-form" action =  "{{route('admin.setPrice')}}" method = "post">
                    @csrf
                    <input type = "hidden" name = "service_id">
                    <div class="row g-3">
                        <div class="col-xxl-12">
                            <div>
                                <input type="number" name  = "service_price" class="form-control" id="ServiceName" placeholder="Enter Service Price">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary bg-primary border-primary">Update Price</button>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@push('page-script')
    <!-- apexcharts -->
    

    <script src="{{ URL::asset('assets/js/jquery.min.js') }}"></script>

    <script>
        $(document).on('click','.Set-Price-Button',function(){
        let serviceId = $(this).attr('id');
        $("input[name=service_id]").val(serviceId);
        let apiUrl = '{{ url("admin/get-service") }}'+ '/' + serviceId;
        var formId  = $("#set-price-form");
        fetch(apiUrl,{
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
        })
        .then(response => {
            return response.json();
        })
        .then(data => {
            if (data.serviceDetaills) {
                console.log(data.serviceDetaills);
                $(formId).find("input[name='service_price']").val(data.serviceDetaills.price);
            }
        })
        .catch(error => {
            console.error(error);
        });
    });
    </script>
@endpush
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
@endsection

