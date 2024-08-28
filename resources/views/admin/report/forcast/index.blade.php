@extends('layouts.admin')

<style>
    .card.bgg-light-primary {
        background-color: #4f8edc !important;
    }

    .card.bgg-light-primary .card-body {
        color: #fff; /* Ensure text color contrasts with background */
    }

    .custom-grid-layout {
        display: grid;
        grid-template-columns: 100px 1fr;
        row-gap: 1rem;
        column-gap: 1rem; /* Add column gap for better spacing */
        align-items: center; /* Align items vertically */
    }

    .form-section {
        margin-bottom: 1.5rem; /* Add some space between form sections */
    }
</style>

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-fluid" id="kt_toolbar_container">
            <div class="toolbar d-flex flex-stack">
                <div class="page-title d-flex align-items-center me-3 flex-wrap mb-5 mb-lg-0 lh-1">
                    <span class="h-20px border-gray-200 border-start mx-4"></span>
                    <ul class="breadcrumb breadcrumb-separatorless fw-bold fs-7 my-1">
                        <li class="breadcrumb-item text-muted">
                            <a href="index.html" class="text-muted text-hover-primary">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">
                            <span class="bullet bg-gray-200 w-5px h-2px"></span>
                        </li>
                        <li class="breadcrumb-item text-muted">Job Forecast</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="card bgg-light-primary">
                <div class="card-title">
                </div>
                <div class="card-body pt-0">
                    <div class="form-section">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="dateInput">Date</label>
                                <input type="date" id="dateInput" class="form-control">
                            </div>
                            <div class="col-md-8">
                                <div class="custom-grid-layout">
                                    <label for="branchSelect">Branch</label>
                                    <div class="d-flex gap-2">
                                        <select id="branchSelect" class="form-control">
                                            <option value="1">Head Office</option>
                                        </select>
                                        <button class="btn btn-primary">Search</button>
                                    </div>
                                    <label for="geographicZoneSelect">Geographic Zone</label>
                                    <select id="geographicZoneSelect" class="form-control">
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

            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-title">
                    </div>
                    <div class="card-body pt-0">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_add_user">
                            <span class="svg-icon svg-icon-2">
                                <!-- SVG Icon -->
                            </span>
                            Add New
                        </button>
                        <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_export_users">
                            <span class="svg-icon svg-icon-2">
                                <!-- SVG Icon -->
                            </span>
                            Export
                        </button>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover datatable datatable-Role" style="width: 100%;">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;"></th>
                                        <th style="width: 120px;">Schedule</th>
                                        <th style="width: 120px;">Job Number</th>
                                        <th style="width: 180px;">Client</th>
                                        <th style="width: 150px;">Site Name</th>
                                        <th style="width: 130px;">Customer Ref</th>
                                        <th style="width: 100px;">Status</th>
                                        <th style="width: 100px;">Repeats</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="rgRow">
                                        <td>
                                            <a class="btn btn-success btn-sm" href="javascript:void(0)">Open</a>
                                        </td>
                                        <td>01 Aug 2024</td>
                                        <td>195</td>
                                        <td>SABRE INDUSTRIES</td>
                                        <td>TX1</td>
                                        <td>TX1</td>
                                        <td>Active</td>
                                        <td>
                                            <button class="btn btn-danger btn-sm">Delete</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons);
            @can('role_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}';
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.roles.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({ selected: true }).nodes(), function(entry) {
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
                order: [[1, 'desc']],
                pageLength: 100,
            });
            let table = $('.datatable-Role:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            });
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });
        });

        $(document).ready(function() {
            $('#geographicZoneSelect').select2();
            $('#salesPersonSelect').select2();
        });
    </script>
@endsection
