@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Inspections')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-fluid">

        </div>
        <div class="container-fluid">
            <div class="mt-3">
                <div class="d-flex mb-3">
                    <button type="button" class="btn btn-sm me-3 add-section" data-bs-toggle="modal"
                        data-bs-target="#kt_modal_add_user">
                        Schedule Email of this Report
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover datatable datatable-Role cell-border"
                        data-ordering="false">
                        <thead>
                            <tr style="text-wrap: nowrap;">
                                <th></th>
                                <th></th>
                                <th>Date Created</th>
                                <th>Job No</th>
                                <th>Client Name</th>
                                <th>Client Site Name</th>
                                <th>ID Marketing</th>
                                <th>Certificate No</th>
                                <th>Equipment Description</th>
                                <th>Inspection Template</th>
                                <th>Equipment Type</th>
                                <th>Branch</th>
                                <th>Worker Fullname</th>
                                <th>Passed</th>
                                <th>Failed</th>
                                <th>Inspection Status</th>
                                <th>Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="rgRow">
                                <td><a class="btn btn-sm save-btn" href="javascript:void(0)">View Job</a></td>
                                <td><a class="btn btn-sm save-btn" href="javascript:void(0)">View Equipment</a></td>
                                <td>28/08/2024</td>
                                <td>221</td>
                                <td>MC2 CIVIL, INC.</td>
                                <td>HOU</td>
                                <td>112047-1-1</td>
                                <td>AA1520</td>
                                <td>LIFTGEAR 1-1/2" x 8 FT 1- LEG WIRE ROPE SLING 21 TONS @ VERTICAL 6x36 BRIGHT
                                </td>
                                <td>WIRE ROPE ASSEMBLY ASME B.30</td>
                                <td>WIRE ROPE SLING</td>
                                <td>Head Office</td>
                                <td>Jorge Guevara</td>
                                <td>YES</td>
                                <td>No</td>
                                <td>PASSED</td>
                                <td>This is Comment</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_user_header">
                    <h2 class="fw-bolder">Schedule Email</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="">
                        <label for="roles">All users in a role</label>
                        <select name="roles" class="form-control" id="roles">
                            <option value="">All Roles</option>
                            <option value="">Admin</option>
                            <option value="">Worker</option>
                        </select>
                        <label for="individualUser">Individual users</label>
                        <select name="individual_user" class="form-control" id="individualUser">
                            <option value="">All Roles</option>
                            <option value="">Admin</option>
                            <option value="">Worker</option>
                        </select>
                        <label for="individualUser">Email Text</label>
                        <textarea name="email_text" class="form-control" id="emailText" cols="30" rows="5"></textarea>
                        <label for="roles">How often should we send this email?</label>
                        <select name="roles" class="form-control" id="roles">
                            <option value="">Weekly</option>
                            <option value="">Monthly</option>
                        </select>
                        <label for="roles">Send on a</label>
                        <select name="roles" class="form-control" id="roles">
                            <option value="">Monday</option>
                            <option value="">Tuesday</option>
                            <option value="">Wednesday</option>
                            <option value="">Thursday</option>
                            <option value="">Friday</option>
                            <option value="">Saturday</option>
                            <option value="">Sunday</option>
                        </select>

                        <button type="button" class="btn btn-sm me-3 mt-3 save-btn">
                        <i class="far fa-save icon"></i>Save
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
                autoWidth: false, // Allow table columns to auto adjust
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 10,
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

            $('#inspectionInterval').select2();
        });
    </script>
@endsection
@endsection
