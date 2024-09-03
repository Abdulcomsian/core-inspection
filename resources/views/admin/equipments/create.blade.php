@extends('layouts.admin')

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-fluid" id="kt_toolbar_container">
            <div class="toolbar d-flex flex-stack">
                <div class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="index.html" class="text-dark text-hover-primary">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Equipment Details</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="container">
                <div class="row justify-content-left">
                    <div class="col-md-6">
                        <div class="card bg-light-success">
                            <div class="card-title text-center">
                                <h3>Edit Image</h3>
                            </div>
                            <div class="card-body pt-0">
                                <div class="form-section">
                                    <div class="row">
                                        <div class="col-12 mb-3 text-center">
                                            <img src="{{ asset('assets/media/flags/curacao.svg') }}" alt="Image to edit"
                                                class="img-fluid mb-3" style="max-width: 20%; height: auto;">
                                            <div class="mt-3">
                                                <button type="button" class="btn btn-primary btn-sm">
                                                    <i class="fas fa-edit"></i> Edit Image
                                                </button>

                                                <button type="button" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash-alt"></i> Remove Image
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="detail-tab" data-toggle="tab" href="#detail" role="tab"
                        aria-controls="detail" aria-selected="true">Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="inspection-tab" data-toggle="tab" href="#inspection" role="tab"
                        aria-controls="inspection" aria-selected="false">Inspections</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="attachment-tab" data-toggle="tab" href="#attachment" role="tab"
                        aria-controls="attachment" aria-selected="false">Attachements</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="detail" role="tabpanel" aria-labelledby="detail-tab">
                    <div class="main-card card">
                        <div class="card-body">
                            <form action="#">
                                <div class="row">
                                    <div class="row">
                                        <!-- Mandatory Equipment Information -->
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-header">
                                                        <h3>Mandatory Equipment Information</h3>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="JobInfoClientSelect">Client</label>
                                                        <select id="JobInfoClientSelect" class="form-control">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="jobInforclientSiteSelect">Client Site</label>
                                                        <select id="jobInforclientSiteSelect" class="form-control">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="EquInforTypeSelect">Type</label>
                                                        <select id="EquInforTypeSelect" class="form-control">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3 d-flex justify-content-center">
                                                        <button type="button"
                                                            class="btn btn-success btn-sm">Load from Template</button>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="EquipmentId">ID#</label>
                                                        <input class="form-control" type="number" name="equipment_id"
                                                            id="EquipmentId">
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label for="EquDescription">Description</label>
                                                        <textarea name="equipment_description" class="form-control" id="EquDescription" rows="3"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Optional Equipment Information -->
                                        <div class="col-md-6 d-flex">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="form-header">
                                                        <h3>Optional Equipment Information</h3>
                                                    </div>
                                                    <div class="form-group mb-3 input-spacing">
                                                        <label for="clientRef">Client Ref</label>
                                                        <input class="form-control" type="text" name="client_ref"
                                                            id="clientRef">
                                                    </div>
                                                    <div class="form-group mb-3 input-spacing">
                                                        <label for="locationNote">Location Notes</label>
                                                        <select id="locationNote" class="form-control">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3 input-spacing">
                                                        <label for="barcode">Barcode</label>
                                                        <select id="barcode" class="form-control">
                                                            <option value="1">Head Office</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group mb-3 row input-spacing">
                                                        <div class="col-md-6">
                                                            <label for="warrentlyStart">Warrently Start</label>
                                                            <input class="form-control" type="date"
                                                                name="warrently_start" id="warrentlyStart">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="warrentlyEnd">End</label>
                                                            <input class="form-control" type="date"
                                                                name="warrently_end" id="warrentlyEnd">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-header">
                                                    <h3>Current Equipment Status</h3>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="salesOrderNo">Last Result</label>
                                                    <div class="d-flex flex-wrap gap-3">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status" id="statusPassed" value="Passed">
                                                            <label class="form-check-label" for="statusPassed">
                                                                Passed
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status" id="statusFailed" value="Failed">
                                                            <label class="form-check-label" for="statusFailed">
                                                                Failed
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status" id="statusMissed" value="Not Seen">
                                                            <label class="form-check-label" for="statusMissed">
                                                                Not Seen
                                                            </label>
                                                        </div>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="status" id="statusNoValue" value="No Value" checked>
                                                            <label class="form-check-label" for="statusNoValue">
                                                                No Value
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="lastStatus">Last Status</label>
                                                    <select id="lastStatus" class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="overallComment">Overall Comment</label>
                                                    <textarea name="overall_comment" id="overallComment" class="form-control" cols="30" rows="10"></textarea>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="salesOrderNo">Last Inspected</label>
                                                    <input class="form-control" type="date" name="sale_order_no" id="salesOrderNo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-header">
                                                    <h3>ANCHOR POINT / SAFETY LINE (PERMANENT)</h3>
                                                </div>
                                                <div class="form-group row input-spacing">
                                                    <div class="col-md-4">
                                                        <label for="scheduleDate">Schedule For</label>
                                                        <input class="form-control" type="date" name="schedule_date"
                                                            id="scheduleDate">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="scheduleTime">Time</label>
                                                        <input class="form-control" type="time" name="schedule_time"
                                                            id="scheduleTime">
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label for="scheduleDuration">Duration</label>
                                                        <input class="form-control" type="number"
                                                            name="schedule_duration" id="scheduleDuration">
                                                    </div>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="status">Status</label>
                                                    <div>
                                                        <button type="button" class="btn btn-outline-primary">Pending
                                                            Job</button>
                                                        <button type="button" class="btn btn-outline-success">Active
                                                            Job</button>
                                                    </div>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="branchSelect">Branch</label>
                                                    <select id="branchSelect" class="form-control">
                                                        <option value="1">Head Office</option>
                                                    </select>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="competenciesRequiredSelect">Competencies Required</label>
                                                    <select id="competenciesRequiredSelect" class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                                <div class="form-group input-spacing">
                                                    <label for="schedulingWorkersSelect">Workers</label>
                                                    <select id="schedulingWorkersSelect" class="form-control">
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <button type="button" class="btn btn-success btn-sm"><i
                                        class="fas fa-save"></i>Save</button>
                                <button type="button" class="btn btn-success btn-sm"><i class="far fa-save"></i>Save &
                                    Continue</button>
                                <button type="button" class="btn btn-danger btn-sm"><i
                                        class="fa fa-ban"></i>Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Inspection Tab Content -->
                <div class="tab-pane fade" id="inspection" role="tabpanel" aria-labelledby="inspection">
                    <div class="mt-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable datatable-Role" data-ordering="false">
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
                    </div>
                </div>
                <!-- Attachments Tab Content -->
                <div class="tab-pane fade" id="attachment" role="tabpanel" aria-labelledby="attachment">
                    <div class="mt-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable datatable-Role" data-ordering="false">
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
                            <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i>Add Attachement</button>
                        </div>
                        <div class="mt-3">
                            <button type="button" class="btn btn-success btn-sm"><i class="fas fa-save"></i>Save</button>
                            <button type="button" class="btn btn-success btn-sm"><i class="far fa-save"></i>Save & Inspect</button>
                            <button type="button" class="btn btn-danger btn-sm"><i class="fas fa-ban"></i>Cancel</button>
                        </div>
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
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
                responsive: true,
                scrollX: true,
                columnDefs: [{
                    orderable: false,
                    targets: '_all'
                }]
            });

            let table = $('.datatable-Role:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            });

            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });

            $('#geographicZoneSelect').select2();
            $('#salesPersonSelect').select2();
        });
    </script>
@endsection
@endsection
