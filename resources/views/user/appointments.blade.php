@extends('user.layouts.master')
@section('title')
    Booked Services
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/aos/aos.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        .filter-container {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
        }

        .filter-container .form-group {
            margin-right: 10px;
        }
    </style>
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Booked Services
        @endslot
    @endcomponent

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive table-card">
                        <table class="table table-centered align-middle table-nowrap mb-0" id="appointments-table">
                            <thead class="text-muted table-light">
                                <tr>
                                    <th scope="col">Service Provider</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Service Category</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Appointment Status</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- DataTables will automatically populate this section -->
                            </tbody>
                        </table>
                    </div>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#appointments-table').DataTable({
                processing: true,
                serverSide: true,
                lengthChange: true,
                searching: true,
                ajax: {
                    url: '{{ route('user.Appointments') }}',
                    data: function(d) {
                        d.service_category = $('#service-category').val();
                        d.service_type = $('#service-type').val();
                        d.search_input = $('#global-search-input').val();
                    }
                },
                columns: [{
                        data: 'serviceProvider',
                        name: 'serviceProvider'
                    },
                    {
                        data: 'date',
                        name: 'date',
                    },
                    {
                        data: 'time',
                        name: 'time'
                    },
                    {
                        data: 'location',
                        name: 'location'
                    },
                    {
                        data: 'serviceCategory',
                        name: 'serviceCategory'
                    },
                    {
                        data: 'status',
                        name: 'status',
                        orderable: false
                    },
                    {
                        data: 'appointmentStatus',
                        name: 'appointmentStatus',
                        orderable: false
                    },
                    {
                        data: 'amount',
                        name: 'amount'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });
            $('#appointments-table_filter').hide();
            // $('#appointments-table_filter').css({
            //     'width': '33.33%',
            //     'float': 'left'
            // });

            $('#appointments-table_filter').after(`
            <div class="form-group" style="display: inline-block; margin-right: 10px; margin-top: 10px!important;">
            <input type="text" id="global-search-input" class="form-control" placeholder="Search...">
        </div>
        <div class="form-group" style="display: inline-block; margin-right: 10px; margin-top: 10px!important;">
            <select id="service-category" class="form-control">
                <option value="">Select Service Category</option>
                @foreach ($serviceCategories as $serviceCategory)
                    <option value="{{ $serviceCategory->id }}">
                        {{ $serviceCategory->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group" style="display: inline-block; margin-right: 10px; margin-top: 10px!important;">
            <select id="service-type" class="form-control">
                <option value="">Select Service Type</option>
                <option value="0">pending</option>
                <option value="1">Approved</option>
            </select>
        </div>
    `);

            $('#service-category, #service-type, #global-search-input').on('change keyup', function() {
                table.draw();
            });
        });
    </script>
@endsection
