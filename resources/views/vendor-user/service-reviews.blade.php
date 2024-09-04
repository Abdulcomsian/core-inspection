@extends('vendor-user.layouts.master')
@section('title')
    Booked Services
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/aos/aos.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
        Booked Services
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
                            <h4 class="card-title mb-0 flex-grow-1">Booked Services</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                           @foreach($serviceReviews as $review)
                           <div class = "row">
                                <div class = "col-md-6 justify-content-start">
                                    <img src="@if ($review->userDetails->avatar != '') {{ URL::asset('images/' . $review->userDetails->avatar) }}@else{{ asset('assets/images/human-avatar.png') }} @endif" alt="user-img" class="img-thumbnail rounded-circle" style = "width:50px;height:50px;body-fit:cover;margin-right:5px;">
                                    <span >{{$review->userDetails->first_name ?? ''}} {{$review->userDetails->last_name}}</span>
                                </div>
                                <div class = "col-md-6 " >
                                    <div class=" d-flex justify-content-end">
                                        <ul class="list-unstyled d-flex justify-content-start text-warning mb-0">
                                            @for($i=1;$i < 6; $i++)
                                                <li><i class="{{$review->ratings >= $i ? 'fas' : 'far'}} fa-star fa-sm"></i></li>
                                            @endfor	
                                        </ul>
                                    </div>
                                </div>
                           </div>
                           <p class = "px-3 py-3">{{$review->description}}</p>
                        @endforeach

                        </div>
                    </div> <!-- .card-->
                </div> 
            </div> <!-- end row-->

        </div> <!-- end .h-100-->

    </div> <!-- end col -->
</div>

<div class="modal fade bs-modal-delete-appointment" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Cancel Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center p-5">
                <img class="" alt="200x200" width="100" src="{{ URL::asset('build/images/warning.gif') }}" data-holder-rendered="true">
                <div class="mt-4">
                    <h4 class="mb-3">Cancel this Appointment</h4>
                    <p class="text-muted mb-4"> Are you sure tou want to Cancel this Appointment, YOu wnt be able to restore it.</p>
                    <div class="hstack gap-2 justify-content-center">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <a href="javascript:void(0);" class="btn btn-danger">Cancel Appointment</a>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@endsection
@section('script')
@endsection
