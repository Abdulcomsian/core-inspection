@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Client - Client Details')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-fluid">
            <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                <div class="main-card card">
                    <div class="card-body">
                        <form action="#">
                            <div class="row">
                                <div class="col-md-6 d-flex">
                                    <div class="inner-card card flex-fill">
                                        <div class="form-header">
                                            <h3>Main Details</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group input-spacing">
                                                <label for="JobInfoClientSelect">Client</label>
                                                <input type="text" class="form-control custom-input" name="name"
                                                    id="name">
                                            </div>
                                            <div class="form-group input-spacing">
                                                <label for="jobInforclientSiteSelect">Client Site</label>
                                                <input type="text" class="form-control custom-input" name="code"
                                                    id="code">
                                            </div>
                                            <div class="form-group row input-spacing">
                                                <div class="col-md-6">
                                                    <label for="phone">Phone</label>
                                                    <input class="form-control" type="text" name="phone"
                                                        id="phone">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="fax">Fax</label>
                                                    <input class="form-control" type="text" name="fax"
                                                        id="fax">
                                                </div>
                                            </div>
                                            <div class="form-group input-spacing">
                                                <label for="subject">Description</label>
                                                <textarea name="description" class="form-control custom-textarea" id="description" cols="30" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 d-flex">
                                    <div class="inner-card card flex-fill">
                                        <div class="form-header">
                                            <h3>Mailing Address</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group input-spacing">
                                                <label for="jobLocPhone">Contact</label>
                                                <input class="form-control" type="number" name="job_loc_phone"
                                                    id="jobLocPhone">
                                            </div>
                                            <div class="form-group input-spacing">
                                                <label for="jobLocMobile">Mobile</label>
                                                <input class="form-control" type="number" name="job_loc_mobile"
                                                    id="jobLocMobile">
                                            </div>
                                            <div class="form-group input-spacing">
                                                <label for="jobLocEmail">Email</label>
                                                <input class="form-control" type="email" name="job_loc_email"
                                                    id="jobLocEmail">
                                            </div>
                                            <div class="form-group input-spacing">
                                                <label for="jobLocAddress">Address</label>
                                                <input class="form-control" type="text" name="job_loc_address"
                                                    id="jobLocAddress">
                                            </div>
                                            <div class="form-group input-spacing">
                                                <input class="form-control" type="text" name="job_loc_address2"
                                                    id="jobLocAddress2">
                                            </div>
                                            <div class="form-group row input-spacing">
                                                <div class="col-md-4">
                                                    <label for="jobLocCity">City</label>
                                                    <input class="form-control" type="text" name="job_loc_city"
                                                        id="jobLocCity">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="jobLocRegion">Region</label>
                                                    <input class="form-control" type="text" name="schedule_region"
                                                        id="jobLocRegion" placeholder="Region">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="jobLocPostCode">Post Code</label>
                                                    <input class="form-control" type="number" name="schedule_region"
                                                        id="jobLocPostCode" placeholder="Post Code">
                                                </div>
                                            </div>
                                            <div class="form-group input-spacing">
                                                <label for="country">Country</label>
                                                <input class="form-control" type="text" name="country"
                                                    id="country">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <button type="button" class="btn btn-sm save-btn"><i
                                            class="fas fa-save icon"></i>Save</button>
                                    <button type="button" class="btn btn-sm delete-btn"><i
                                            class="fa fa-ban icon"></i>Cancel</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mt-5">
                                    <div class="card bgg-light-orange">
                                        <div class="card-body pt-0">
                                            <div class="form-section">
                                                <div class="row mt-5">
                                                    <div class="col-md-8 col-8">
                                                        <div class="custom-grid-layout">
                                                            <label for="branchSelect1"
                                                                class="small-label color-white">Search</label>
                                                            <div class="d-flex flex-column flex-md-row gap-2 mb-3">
                                                                <select id="geographicZoneSelect"
                                                                    class="form-select mb-3">
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-4">
                                                        <button class="btn btn-sm delete-btn"><i class="fa fa-search"></i>
                                                            Search</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <div class="d-flex mb-3">
                                            <button type="button" class="btn btn-sm me-3 add-section">
                                                <i class="fas fa-plus icon icon"></i>
                                                Add New
                                            </button>
                                        </div>
                                        <div class="table-responsive">
                                            <table id="mytable"
                                                class="table table-bordered table-striped table-hover datatable datatable-Role cell-border"
                                                data-ordering="false">
                                                <thead>
                                                    <tr style="text-wrap: nowrap;">
                                                        <th></th>
                                                        <th>Name</th>
                                                        <th>Phone</th>
                                                        <th>Contact</th>
                                                        <th>Mobile</th>
                                                        <th>Email</th>
                                                        <th>Address</th>
                                                        <th>City</th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center"><a class="btn btn-sm save-btn"
                                                                href="javascript:void(0)">Open</a></td>
                                                        <td>Alex</td>
                                                        <td>195</td>
                                                        <td>2434</td>
                                                        <td>24334</td>
                                                        <td>test@gmail.com</td>
                                                        <td>Test Address</td>
                                                        <td>Islamabad</td>
                                                        <td><button class="btn btn-sm delete-btn">Delete</button>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
            @can('role_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('roles.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id');
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}');
                            return;
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload();
                                });
                        }
                    }
                };
                dtButtons.push(deleteButton);
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                autoWidth: false, // Allow table columns to auto adjust
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
                responsive: true,
                scrollX: true, // Enable horizontal scroll
                scrollY: 300, // Enable vertical scroll
                scrollCollapse: true,
                columnDefs: [{
                        width: '10%',
                        targets: 0
                    }, // Set width for the first column
                    {
                        orderable: false,
                        targets: '_all'
                    } // Disable ordering for all columns
                ],
                fixedColumns: {
                    leftColumns: 1,
                    rightColumns: 1
                }
            });

            let table = $('.datatable-Role:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });

            $('#client').select2();
            $('#geographicZoneSelect').select2();
            $('#salesPersonSelect').select2();
        });

        $('.dropdown').click(function() {

            $('.dropdown-menu').toggleClass('show');

        });
    </script>
@endsection
@endsection
