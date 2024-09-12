@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Inspections')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-fluid">
            <div class="card bgg-light-primary" style="height: 50px;">
            </div>

            <div class="card mt-5">
                <div class="container-fluid">
                    <div class="mt-3">
                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_add_user">
                                Schedule Email of this Report
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-striped table-hover datatable datatable-Role" data-ordering="false">
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
                                        <td><a class="btn btn-success btn-sm" href="javascript:void(0)">View Job</a></td>
                                        <td><a class="btn btn-success btn-sm" href="javascript:void(0)">View Equipment</a></td>
                                        <td>28/08/2024</td>
                                        <td>221</td>
                                        <td>MC2 CIVIL, INC.</td>
                                        <td>HOU</td>
                                        <td>112047-1-1</td>
                                        <td>AA1520</td>
                                        <td>LIFTGEAR 1-1/2" x 8 FT 1- LEG WIRE ROPE SLING 21 TONS @ VERTICAL 6x36 BRIGHT</td>
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
        </div>
    </div>

    <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_user_header">
                    <h2 class="fw-bolder">Add User</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Email address</label>
                          <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Example select</label>
                          <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlSelect2">Example multiple select</label>
                          <select multiple class="form-control" id="exampleFormControlSelect2">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">Example textarea</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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
                    }
                ]
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
