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
                        <li class="nav-item">
                            <a class="nav-link" id="attachment-tab" data-toggle="tab" href="#attachment" role="tab"
                                aria-controls="attachment" aria-selected="false">Attachements</a>
                        </li>
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
                                        <label for="jobInforTypeSelect">Type</label>
                                        <select id="jobInforTypeSelect" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="EquipmentId">ID#</label>
                                        <input class="form-control" type="text" name="equipment_id" id="EquipmentId">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="EquDescription">Description</label>
                                        <textarea name="equipment_description" class="form-control" id="EquDescription" rows="3"></textarea>
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Optional Equipment Information -->
                            <h5 class="mb-4">Optional Equipment Information</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="clientRef">Client Ref</label>
                                        <input class="form-control" type="text" name="client_ref" id="clientRef">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="locationNote">Location Notes</label>
                                        <select id="locationNote" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="barcode">Barcode</label>
                                        <select id="barcode" class="form-control">
                                            <option value="1">Head Office</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="warrentlyStart">Warrently Start</label>
                                        <input class="form-control" type="date" name="warrently_start"
                                            id="warrentlyStart">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="warrentlyEnd">End</label>
                                        <input class="form-control" type="date" name="warrently_end"
                                            id="warrentlyEnd">
                                    </div>
                                </div>
                            </div>

                            <hr>

                            <!-- Current Equipment Status -->
                            <h5 class="mb-4">Current Equipment Status</h5>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="salesOrderNo">Last Result</label>
                                        <div class="d-flex flex-wrap gap-3 mt-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="statusPassed" value="Passed">
                                                <label class="form-check-label" for="statusPassed">
                                                    Passed
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="statusFailed" value="Failed">
                                                <label class="form-check-label" for="statusFailed">
                                                    Failed
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="statusMissed" value="Not Seen">
                                                <label class="form-check-label" for="statusMissed">
                                                    Not Seen
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status"
                                                    id="statusNoValue" value="No Value" checked>
                                                <label class="form-check-label" for="statusNoValue">
                                                    No Value
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="lastStatus">Last Status</label>
                                        <select id="lastStatus" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="salesOrderNo">Last Inspected</label>
                                        <input class="form-control" type="date" name="sale_order_no"
                                            id="salesOrderNo">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="overallComment">Overall Comment</label>
                                        <textarea name="overall_comment" id="overallComment" class="form-control" cols="30" rows="5"></textarea>
                                    </div>
                                </div>

                            </div>

                            <hr>
                            {{-- ANCHOR POINT / SAFETY LINE (PERMANENT) --}}
                            <h5 class="mb-4">ANCHOR POINT / SAFETY LINE (PERMANENT)</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="scheduleDate">Serial Number</label>
                                        <input class="form-control" type="text" name="schedule_date"
                                            id="scheduleDate">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="scheduleTime">Rating</label>
                                        <input class="form-control" type="text" name="schedule_time"
                                            id="scheduleTime">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="scheduleDuration">Manufacturer</label>
                                        <input class="form-control" type="text" name="schedule_duration"
                                            id="scheduleDuration">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="scheduleDuration">Manufacturer-other</label>
                                        <input class="form-control" type="text" name="schedule_duration"
                                            id="scheduleDuration">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label for="status">Type</label>
                                        <div class="form-group mt-3">
                                            <button type="button" class="btn btn-sm"
                                                style="background-color: #7F8C8D">Anchor
                                                Point</button>
                                            <button type="button" class="btn btn-sm"
                                                style="background-color: #E67E22">Permanent
                                                Safety Line</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-3">
                                        <label for="overallComment">Additional Information</label>
                                        <textarea name="overall_comment" id="overallComment" class="form-control" cols="30" rows="5"></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <!-- Inspection Tab Content -->
                        <div class="tab-pane fade" id="inspection" role="tabpanel" aria-labelledby="inspection">
                            <div class="mt-3">
                                <div class="table-responsive">
                                    <table id="mytable"
                                        class="table table-bordered table-striped table-hover datatable datatable-Role cell-border"
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
                            </div>
                        </div>
                        <!-- Attachments Tab Content -->
                        <div class="tab-pane fade" id="attachment" role="tabpanel" aria-labelledby="attachment">
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
                            </div>
                        </div>
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
    </script>
@endsection
@endsection
