@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Equipment Details')
@section('content')
    <div class="row mt-5">
        <div class="col-md-12 mt-5">
            <div class="card mt-5">
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab"
                                aria-controls="detail" aria-selected="true">Details</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="inspection-tab" data-toggle="tab" href="#inspection" role="tab"
                                aria-controls="inspection" aria-selected="false">Inspections</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" id="attachment-tab" data-toggle="tab" href="#attachment" role="tab"
                                aria-controls="attachment" aria-selected="false">Attachements</a>
                        </li> --}}
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                            <!-- Equipment Type Description Section -->
                            <h5 class="mb-4">Mandatory Job Information</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="JobInfoClientSelect">Client</label>
                                        <select id="JobInfoClientSelect" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="jobInforclientSiteSelect">Client Site</label>
                                        <select id="jobInforclientSiteSelect" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="mainPhone">Main Phone</label>
                                        <input class="form-control" type="number" name="main_phone" id="mainPhone">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="customerOrderNumber">Customer Ref/ Order Number</label>
                                        <input class="form-control" type="text" name="customer_order_number"
                                            id="customerOrderNumber">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter description"></textarea>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Scheduling Information Section -->
                            <h5 class="mb-4">Scheduling Information</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="scheduleDate">Schedule For</label>
                                        <input class="form-control" type="date" name="schedule_date" id="scheduleDate">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="scheduleTime">Time</label>
                                        <input class="form-control" type="time" name="schedule_time" id="scheduleTime">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="scheduleDuration">Duration</label>
                                        <input class="form-control" type="number" name="schedule_duration"
                                            id="scheduleDuration">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="status">Status</label>
                                        <div class="row">
                                            <div class="form-group col-md-6 mt-3">
                                                <button type="button" class="btn btn-sm"
                                                    style="background-color: #7F8C8D;color: #fff;">Pending
                                                    Job</button>
                                                <button type="button" class="btn btn-sm"
                                                    style="background-color: #E67E22;color: #fff;">Active
                                                    Job</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="branchSelect">Branch</label>
                                        <select id="branchSelect" class="form-control">
                                            <option value="1">Head Office</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="competenciesRequiredSelect">Competencies Required</label>
                                        <select id="competenciesRequiredSelect" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="schedulingWorkersSelect">Workers</label>
                                        <select id="schedulingWorkersSelect" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Reference Documents Section -->
                            <h5 class="mb-4">Job Location Details</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="jobLocPhone">Contact</label>
                                        <input class="form-control" type="number" name="job_loc_phone"
                                            id="jobLocPhone">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="jobLocMobile">Mobile</label>
                                        <input class="form-control" type="number" name="job_loc_mobile"
                                            id="jobLocMobile">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="jobLocEmail">Email</label>
                                        <input class="form-control" type="email" name="job_loc_email"
                                            id="jobLocEmail">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="jobLocAddress">Address</label>
                                        <input class="form-control" type="text" name="job_loc_address"
                                            id="jobLocAddress">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="jobLocAddress">Address</label>
                                        <input class="form-control" type="text" name="job_loc_address2"
                                            id="jobLocAddress2">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="jobLocCity">City</label>
                                        <input class="form-control" type="text" name="job_loc_city" id="jobLocCity">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="jobLocRegion">Region</label>
                                        <input class="form-control" type="text" name="schedule_region"
                                            id="jobLocRegion" placeholder="Region">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="jobLocPostCode">Post Code</label>
                                        <input class="form-control" type="number" name="schedule_region"
                                            id="jobLocPostCode" placeholder="Post Code">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <h5 class="mb-4">Notes / Customer Requirements</h5>
                            <div class="form-group mb-3">
                                <textarea class="form-control" name="description" id="description" rows="5"></textarea>
                            </div>

                            <hr>

                            <h5 class="mb-4">Extra Fields</h5>
                            <div class="form-group mb-3">
                                <label for="jobLocRegion">Certificate Number</label>
                                <input class="form-control" type="text" name="schedule_region" id="jobLocRegion">
                            </div>

                            <!-- Save and Cancel Buttons -->
                            <div class="form-group mt-4">
                                <button type="button" class="btn btn-sm save-btn">
                                    <i class="far fa-save icon"></i> Save
                                </button>
                                <button type="button" class="btn btn-sm save-btn">
                                    <i class="far fa-save icon"></i> Save & Continue
                                </button>
                                <button type="button" class="btn btn-sm delete-btn">
                                    <i class="fa fa-ban icon"></i> Cancel
                                </button>
                            </div>

                        </div>

                        <!-- Inspection Tab Content -->
                        <div class="tab-pane fade" id="inspection" role="tabpanel" aria-labelledby="inspection">
                            <div class="mt-3">
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <div class="d-flex mb-3">
                                        <button type="button" class="btn btn-sm me-3 add-section" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_add_user"><i class="fas fa-plus circle icon"></i>
                                            Add new Inspection
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
                                                <th></th>
                                                <th></th>
                                                <th>Date of Inspection</th>
                                                <th>ID No</th>
                                                <th>Description</th>
                                                <th>Equipment Type</th>
                                                <th>Location</th>
                                                <th>Inspection Report</th>
                                                <th>Performed By</th>
                                                <th>Result</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="rgRow">
                                                <td class="text-center"><a class="btn save-btn btn-sm"
                                                        href="javascript:void(0)">Open</a></td>
                                                <td class="text-center"><a class="btn delete-btn btn-sm"
                                                        href="{{ route('job.inspection.edit') }}">Edit Inspection</a></td>
                                                <td class="text-center"><a class="btn btn-dark btn-sm"
                                                        href="{{ route('equipment.show') }}">Edit Equipment</a></td>
                                                <td>01 Aug 2024</td>
                                                <td>195</td>
                                                <td>LIEBHERR - AMERICA, INC.</td>
                                                <td>Subject</td>
                                                <td>HOU - 1</td>
                                                <td>WALK IN</td>
                                                <td>Jorge Guevara</td>
                                                <td>112056</td>
                                                <td class="text-center"><button
                                                        class="btn delete-btn btn-sm">Delete</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- Attachments Tab Content -->
                        {{-- <div class="tab-pane fade" id="attachment" role="tabpanel" aria-labelledby="attachment">
                            <div class="mt-3">
                                <button type="button" class="btn add-section btn-sm"><i
                                        class="fas fa-plus-circle icon"></i>Add
                                    Attachement</button>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-hover datatable datatable-Role"
                                        data-ordering="false">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Schedule</th>
                                                <th>Job Number</th>
                                                <th>Client</th>
                                                <th>Client Site</th>
                                                <th>Subject</th>
                                                <th>Customer Ref</th>
                                                <th>Workers</th>
                                                <th>Extra Fields</th>
                                                <th>Job Repeats</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Your rows here -->
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    <button type="button" class="btn btn-sm save-btn">
                                        <i class="far fa-save icon"></i> Save
                                    </button>
                                    <button type="button" class="btn btn-sm save-btn">
                                        <i class="far fa-save icon"></i> Save & Continue
                                    </button>
                                    <button type="button" class="btn btn-sm delete-btn">
                                        <i class="fa fa-ban icon"></i> Cancel
                                    </button>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_user_header">
                    <h5 class="fw-bolder">Add Inspection</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="mb-3">
                            <label for="inspectionSelect">Select Equipment to inspect</label>
                            <select name="inspection" class="form-control mt-2" id="inspectionSelect">
                                <option value="">Inspection 1</option>
                                <option value="">Inspection 2</option>
                                <option value="">Inspection 3</option>
                                <option value="">Inspection 4</option>
                                <option value="">Inspection 5</option>
                            </select>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('job.inspection.create') }}">
                            <button type="button" class="btn btn-sm save-btn">
                                <i class="far fa-save icon"></i>Next
                            </button>
                        </a>
                            <button type="button" class="btn btn-sm delete-btn">
                                <i class="fa fa-ban icon"></i> Cancel
                            </button>
                        </div>
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
                            }).done(function() {
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

            $('a[data-toggle="tab"]').on('shown.bs.tab click', function() {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });

            $('#client').select2();
            $('#geographicZoneSelect').select2();
            $('#salesPersonSelect').select2();
        });

        $('#JobInfoClientSelect').select2();
        $('#jobInforclientSiteSelect').select2();
        $('#jobInforTypeSelect').select2();
        $('#locationNote').select2();
        $('#lastStatus').select2();
        $('#competenciesRequiredSelect').select2();
        $('#schedulingWorkersSelect').select2();

        $("#inspectionInterval").select2({
            width: '100%',
            height: '100%',
        });

        $('#inspectionSelect').select2({
            dropdownParent: $('#kt_modal_add_user'),
            width: '100%'
        });
    </script>
@endsection
@endsection
