@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Client - Client Details')
@section('content')

    <div class="row mt-5">
        <div class="col-md-12 mt-5">
            <div class="card mt-5">
                <div class="card-body">
                    <form action="#">
                        <h5 class="mb-4">Main Details</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group input-spacing">
                                    <label for="JobInfoClientSelect">Client</label>
                                    <input type="text" class="form-control custom-input" name="name" id="name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group input-spacing">
                                    <label for="jobInforclientSiteSelect">Client Site</label>
                                    <input type="text" class="form-control custom-input" name="code" id="code">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row input-spacing">
                            <div class="col-md-6">
                                <label for="phone">Phone</label>
                                <input class="form-control" type="text" name="phone" id="phone">
                            </div>
                            <div class="col-md-6">
                                <label for="fax">Fax</label>
                                <input class="form-control" type="text" name="fax" id="fax">
                            </div>
                        </div>
                        <div class="form-group input-spacing">
                            <label for="subject">Description</label>
                            <textarea name="description" class="form-control custom-textarea" id="description" cols="30" rows="5"></textarea>
                        </div>

                        <hr>

                        <h5 class="mb-4">Mailing Address</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group input-spacing">
                                    <label for="jobLocPhone">Contact</label>
                                    <input class="form-control" type="text" name="job_loc_phone" id="jobLocPhone">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group input-spacing">
                                    <label for="jobLocMobile">Mobile</label>
                                    <input class="form-control" type="text" name="job_loc_mobile" id="jobLocMobile">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group input-spacing">
                                    <label for="jobLocAddress">Address</label>
                                    <input class="form-control" type="text" name="job_loc_address" id="jobLocAddress">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="jobLocAddress">Address2</label>
                                <div class="form-group input-spacing">
                                    <input class="form-control" type="text" name="job_loc_address2" id="jobLocAddress2">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group input-spacing">
                                    <label for="jobLocEmail">Email</label>
                                    <input class="form-control" type="email" name="job_loc_email" id="jobLocEmail">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group input-spacing">
                                    <label for="country">Country</label>
                                    <input class="form-control" type="text" name="country" id="country">
                                </div>
                            </div>
                        </div>

                        <div class="form-group row input-spacing">
                            <div class="col-md-4">
                                <label for="jobLocCity">City</label>
                                <input class="form-control" type="text" name="job_loc_city" id="jobLocCity">
                            </div>
                            <div class="col-md-4">
                                <label for="jobLocRegion">Region</label>
                                <input class="form-control" type="text" name="schedule_region" id="jobLocRegion"
                                    placeholder="Region">
                            </div>
                            <div class="col-md-4">
                                <label for="jobLocPostCode">Post Code</label>
                                <input class="form-control" type="text" name="schedule_region" id="jobLocPostCode"
                                    placeholder="Post Code">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <button type="button" class="btn btn-sm save-btn"><i class="fas fa-save icon"></i>
                                    Save</button>
                                <button type="button" class="btn btn-sm delete-btn"><i class="fa fa-ban icon"></i>
                                    Cancel</button>
                            </div>
                        </div>
                    </form>

                    <hr>

                    <div class="row">
                        <div class="col-md-12 mt-5">
                            <div class="row mt-5 justify-content-center">
                                <div class="col-md-6">
                                    <label for="geographicZoneSelect" class="small-label">Filter by Zone</label>
                                    <select id="geographicZoneSelect" class="form-select">
                                        <option value="1">Zone 1</option>
                                        <option value="2">Zone 2</option>
                                        <option value="3">Zone 3</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button class="btn btn-sm delete-btn" style="margin-top: 29px;"><i
                                            class="fa fa-search"></i> Search</button>
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-sm me-3 add-section" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_add_client">
                                            <i class="fas fa-plus icon icon"></i>
                                            Add New
                                        </button>
                                    </div>
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
                                                <td><button class="btn btn-sm delete-btn">Delete</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_add_client" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_client_header">
                    <h5 class="fw-bolder">Client Site Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="mb-3">
                            <label for="clientName">Name</label>
                            <input type="text" class="form-control" name="name" id="clientName">
                        </div>
                        <div class="mb-3">
                            <label for="clientName">Code</label>
                            <input type="text" class="form-control" name="name" id="clientName">
                        </div>
                        <div class="mb-3">
                            <label for="clientName">Phone</label>
                            <input type="text" class="form-control" name="name" id="clientName">
                        </div>
                        <div class="mb-3">
                            <label for="clientName">Contact</label>
                            <input type="text" class="form-control" name="name" id="clientName">
                        </div>
                        <div class="mb-3">
                            <label for="clientName">Mobile</label>
                            <input type="text" class="form-control" name="name" id="clientName">
                        </div>
                        <div class="mb-3">
                            <label for="clientName">Reminder email</label>
                            <input type="text" class="form-control" name="name" id="clientName">
                        </div>
                        <div class="mb-3">
                            <label for="clientName">Address</label>
                            <input type="text" class="form-control" name="name" id="clientName">
                        </div>
                        <div class="mb-3">
                            <label for="clientName">Address 2</label>
                            <input type="text" class="form-control" name="name" id="clientName">
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="clientName">City</label>
                                    <input type="text" class="form-control" name="name" id="clientName">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="clientName">Region</label>
                                    <input type="text" class="form-control" name="name" id="clientName">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="clientName">Post Code</label>
                                    <input type="text" class="form-control" name="name" id="clientName">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="graphicalZone">Geographic Zone</label>
                            <select name="zone" class="form-control mt-2" id="graphicalZone">
                                <option value="">Zone 1</option>
                                <option value="">Zone 2</option>
                                <option value="">Zone 3</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="defaultBranch">Default Branch</label>
                            <select name="branch" class="form-control mt-2" id="defaultBranch">
                                <option value="">Branch 1</option>
                                <option value="">Branch 2</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="emailText">Notes / Customer Requirements</label>
                            <textarea name="email_text" class="form-control" id="emailText" cols="30" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="inspectionInterval">Inspection Interval</label>
                            <select name="interval" class="form-control" id="inspectionInterval">
                                <option value="">Weekly</option>
                                <option value="">Monthly</option>
                            </select>
                        </div>

                        <hr>

                        <!-- More Options Button -->
                        <div class="mb-3">
                            <button type="button" class="btn btn-sm text-primary" id="toggle-options">
                                <i class="fas fa-plus text-primary"></i>More Options
                            </button>
                        </div>

                        <!-- Fields to be toggled -->
                        <div id="extra-options" style="display: none;">
                            <div class="mb-3">
                                <label for="salesPerson">Sales Person</label>
                                <select name="sale_person" class="form-control mt-2" id="salesPerson">
                                    <option value="">Zone 1</option>
                                    <option value="">Zone 2</option>
                                    <option value="">Zone 3</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="inspector">Inspector</label>
                                <select name="inspector" class="form-control mt-2" id="inspector">
                                    <option value="">Branch 1</option>
                                    <option value="">Branch 2</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="travelTime">Travel Time (minutes)</label>
                                <input type="text" class="form-control" name="travel_time" id="travelTime">
                            </div>

                            <div class="mb-3">
                                <label for="duration">Duration (minutes)</label>
                                <input type="text" class="form-control" name="duration" id="duration">
                            </div>

                            <div class="mb-3">
                                <label for="competencies">Competencies</label>
                                <input type="text" class="form-control" name="competencies" id="competencies">
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm mt-3 save-btn">
                            <i class="far fa-save icon"></i>Save
                        </button>
                        <button type="button" class="btn btn-sm mt-3 delete-btn">
                            <i class="fa fa-ban icon"></i>Cancel
                        </button>
                    </form>
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
                autoWidth: false,
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
                responsive: true,
                scrollX: true,
                scrollY: 300,
                scrollCollapse: true,
                columnDefs: [{
                        width: '10%',
                        targets: 0
                    },
                    {
                        orderable: false,
                        targets: '_all'
                    }
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

        $('#graphicalZone').select2({
            dropdownParent: $('#kt_modal_add_client'),
            width: '100%'
        });

        $('#defaultBranch').select2({
            dropdownParent: $('#kt_modal_add_client'),
            width: '100%'
        });

        $('#inspectionInterval').select2({
            dropdownParent: $('#kt_modal_add_client'),
            width: '100%'
        });

        $('#salesPerson').select2({
            dropdownParent: $('#kt_modal_add_client'),
            width: '100%'
        });

        $('#inspector').select2({
            dropdownParent: $('#kt_modal_add_client'),
            width: '100%'
        });

        $(document).ready(function() {
            $('#toggle-options').click(function() {
                $('#extra-options').toggle();

                // Toggle between plus and minus icon
                const icon = $(this).find('i');
                if ($('#extra-options').is(':visible')) {
                    $(this).html('<i class="fas fa-minus text-primary"></i> Less Options');
                } else {
                    $(this).html('<i class="fas fa-plus text-primary"></i> More Options');
                }
            });
        });
    </script>
@endsection
@endsection
