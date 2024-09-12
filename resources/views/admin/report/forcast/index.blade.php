@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Job Forecast')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="container-fluid">
            <div class="card bgg-light-primary">
                <div class="card-title">
                    <!-- Optional: Add a title here if needed -->
                </div>
                <div class="card-body pt-0">
                    <div class="form-section">
                        <div class="row">
                            <div class="col-md-4 col-12 mb-3">
                                <label for="dateInput">Date</label>
                                <input type="date" id="dateInput" class="form-control">
                            </div>
                            <div class="col-md-8 col-12">
                                <div class="custom-grid-layout">
                                    <label for="branchSelect">Branch</label>
                                    <div class="d-flex flex-column flex-md-row gap-2 mb-3">
                                        <select id="branchSelect" class="form-control mb-2 mb-md-0">
                                            <option value="1">Head Office</option>
                                        </select>
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                    <label for="geographicZoneSelect">Geographic Zone</label>
                                    <select id="geographicZoneSelect" class="form-control mb-3">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                    <label for="salesPersonSelect">Sales Person</label>
                                    <select id="salesPersonSelect" class="form-control">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="card mt-5">
                <div class="container-fluid">
                    <div class="mt-3">
                        <div class="d-flex mb-3">
                            <a href="{{ route('report.forcast.create') }}">
                            <button type="button" class="btn btn-primary me-3">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <rect fill="#000000" x="4" y="11" width="16" height="2" rx="1" />
                                        <rect fill="#000000" opacity="0.5"
                                            transform="translate(12.000000, 12.000000) rotate(-270.000000) translate(-12.000000, -12.000000)"
                                            x="4" y="11" width="16" height="2" rx="1" />
                                    </svg>
                                </span>
                                Add New
                            </button>
                        </a>
                            <button type="button" class="btn btn-light-primary" data-bs-toggle="modal"
                                data-bs-target="#kt_modal_export_users">
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24" />
                                            <path
                                                d="M17,8 C16.4477153,8 16,7.55228475 16,7 C16,6.44771525 16.4477153,6 17,6 L18,6 C20.209139,6 22,7.790861 22,10 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,9.99305689 C2,7.7839179 3.790861,5.99305689 6,5.99305689 L7.00000482,5.99305689 C7.55228957,5.99305689 8.00000482,6.44077214 8.00000482,6.99305689 C8.00000482,7.54534164 7.55228957,7.99305689 7.00000482,7.99305689 L6,7.99305689 C4.8954305,7.99305689 4,8.88848739 4,9.99305689 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,10 C20,8.8954305 19.1045695,8 18,8 L17,8 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                            <rect fill="#000000" opacity="0.3"
                                                transform="translate(12.000000, 8.000000) scale(1, -1) rotate(-180.000000) translate(-12.000000, -8.000000)"
                                                x="11" y="2" width="2" height="12" rx="1" />
                                            <path
                                                d="M12,2.58578644 L14.2928932,0.292893219 C14.6834175,-0.0976310729 15.3165825,-0.0976310729 15.7071068,0.292893219 C16.0976311,0.683417511 16.0976311,1.31658249 15.7071068,1.70710678 L12.7071068,4.70710678 C12.3165825,5.09763107 11.6834175,5.09763107 11.2928932,4.70710678 L8.29289322,1.70710678 C7.90236893,1.31658249 7.90236893,0.683417511 8.29289322,0.292893219 C8.68341751,-0.0976310729 9.31658249,-0.0976310729 9.70710678,0.292893219 L12,2.58578644 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                transform="translate(12.000000, 2.500000) scale(1, -1) translate(-12.000000, -2.500000)" />
                                        </g>
                                    </svg>
                                </span>
                                Export
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table id="mytable"
                                class="table table-bordered table-striped table-hover datatable datatable-Role"
                                data-ordering="false">
                                <thead>
                                    <tr style="text-wrap: nowrap;">
                                        <th></th>
                                        <th>Schedule</th>
                                        <th>Job Number</th>
                                        <th>Client</th>
                                        <th>Site Name</th>
                                        <th>Customer Ref</th>
                                        <th>Status</th>
                                        <th>Repeats</th>
                                        <th>Repeats</th>
                                        <th>Repeats</th>
                                        <th>Repeats</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="rgRow">
                                        <td><a class="btn btn-success btn-sm" href="javascript:void(0)">Open</a></td>
                                        <td>01 Aug 2024</td>
                                        <td>195</td>
                                        <td>SABRE INDUSTRIES</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>Active</td>
                                        <td>Active</td>
                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                    <tr class="rgRow">
                                        <td><a class="btn btn-success btn-sm" href="javascript:void(0)">Open</a></td>
                                        <td>01 Aug 2024</td>
                                        <td>195</td>
                                        <td>SABRE INDUSTRIES</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>Active</td>
                                        <td>Active</td>
                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                    <tr class="rgRow">
                                        <td><a class="btn btn-success btn-sm" href="javascript:void(0)">Open</a></td>
                                        <td>01 Aug 2024</td>
                                        <td>195</td>
                                        <td>SABRE INDUSTRIES</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>Active</td>
                                        <td>Active</td>
                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                    <tr class="rgRow">
                                        <td><a class="btn btn-success btn-sm" href="javascript:void(0)">Open</a></td>
                                        <td>01 Aug 2024</td>
                                        <td>195</td>
                                        <td>SABRE INDUSTRIES</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>Active</td>
                                        <td>Active</td>
                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                    <tr class="rgRow">
                                        <td><a class="btn btn-success btn-sm" href="javascript:void(0)">Open</a></td>
                                        <td>01 Aug 2024</td>
                                        <td>195</td>
                                        <td>SABRE INDUSTRIES</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>Active</td>
                                        <td>Active</td>
                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                    <tr class="rgRow">
                                        <td><a class="btn btn-success btn-sm" href="javascript:void(0)">Open</a></td>
                                        <td>01 Aug 2024</td>
                                        <td>195</td>
                                        <td>SABRE INDUSTRIES</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>Active</td>
                                        <td>Active</td>
                                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                                    </tr>
                                </tbody>
                            </table>
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
