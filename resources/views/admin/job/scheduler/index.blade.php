@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Job - Scheduler Details')
@section('content')
    <style>
        #calendar a {
            color: #E67E22 !important;
        }
    </style>
    <div class="row mt-5">
        <div class="col-md-12 mt-5">
            <div class="card mt-5">
                <div class="card-body">
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
                                            data-bs-target="#kt_modal_add_user">
                                            <i class="fas fa-plus icon icon"></i>
                                            Add Internal Time
                                        </button>
                                    </div>
                                </div>
                                <div id='calendar'></div>

                                <div class="table-responsive">
                                    <table
                                        class="table table-bordered table-striped table-hover datatable datatable-Role cell-border"
                                        data-ordering="false">
                                        <thead>
                                            <tr style="text-wrap: nowrap;">
                                                <th class="text-center">Job#</th>
                                                <th class="text-center">Customer Location</th>
                                                <th class="text-center">Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="rgRow">
                                                <td class="text-center">Inspection Job</td>
                                                <td class="text-center">Canada</td>
                                                <td class="text-center">28/08/2024</td>
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

    <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_user_header">
                    <h5 class="fw-bolder">Add Internal time</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="mb-3">
                            <label for="date">Date</label>
                            <input type="datetime-local" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="typeSelect" class="ms-2">Type</label>
                            <select name="roles" class="form-control mt-2" id="typeSelect">
                                <option value="">Type 1</option>
                                <option value="">Type 2</option>
                                <option value="">Type 3</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="emailText">Hours</label>
                            <input type="number" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="emailText">Description</label>
                            <textarea name="email_text" class="form-control" id="emailText" cols="30" rows="5"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="branchSelect" class="ms-2">Branch</label>
                            <select name="individual_user" class="form-control mt-2" id="branchSelect">
                                <option value="">Branch 1</option>
                                <option value="">Branch 2</option>
                                <option value="">Branch 3</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="workerSelect">Worker</label>
                            <select name="weekly_schedule" class="form-control" id="workerSelect">
                                <option value="">Weekly</option>
                                <option value="">Monthly</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="timeSheet">Add on timesheet</label>
                            <input type="checkbox" name="timesheet" id="timeSheet">
                        </div>
                        <button type="button" class="btn btn-sm mt-3 save-btn">
                            <i class="far fa-save icon"></i>Add Time
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
                pageLength: 10,
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

            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });

            $('#roles').select2({
                dropdownParent: $('#kt_modal_add_user'),
                width: '100%'
            });

            $('#individualUser').select2({
                dropdownParent: $('#kt_modal_add_user'),
                width: '100%'
            });

            $('#weeklySchedule').select2({
                dropdownParent: $('#kt_modal_add_user'),
                width: '100%'
            });
            $('#dailySchedule').select2({
                dropdownParent: $('#kt_modal_add_user'),
                width: '100%'
            });
        });

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                contentHeight: 300,
                aspectRatio: 1.5,
            });
            calendar.render();
        });

        $('#typeSelect').select2({
            dropdownParent: $('#kt_modal_add_user'),
            width: '100%'
        });

        $('#branchSelect').select2({
            dropdownParent: $('#kt_modal_add_user'),
            width: '100%'
        });

        $('#workerSelect').select2({
            dropdownParent: $('#kt_modal_add_user'),
            width: '100%'
        }); 

        $('#geographicZoneSelect').select2();
    </script>
@endsection
@endsection
