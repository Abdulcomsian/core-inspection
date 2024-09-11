@extends('layouts.admin')
@section('title', 'Software')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
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
                    <li class="breadcrumb-item text-muted">Jobs</li>
                </ul>
            </div>
        </div>

        <div class="container-fluid">
            <div class="card bgg-light-primary">
                <div class="card-title">
                </div>
                <div class="card-body pt-0">
                    <div class="form-section">
                        <div class="row">
                            <div class="col-md-4 col-12 mb-3">
                                <div class="custom-grid-layout">
                                    <label for="client" style="font-weight: bold;">Client</label>
                                    <select id="client" class="form-control mb-3">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-12">
                                <div class="custom-grid-layout">
                                    <label for="clientSite" style="font-weight: bold;">Client Site</label>
                                    <select id="clientSite" class="form-control">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4 col-12">
                                <div class="d-flex flex-column flex-md-row gap-2 mb-3">
                                    <input type="text" class="form-control" name="" id="">
                                    <button class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card mt-5">
            <div class="container-fluid">
                <!-- Tab Contents -->
                <div class="tab-content mt-3">
                    <div class="tab-pane fade show active" id="activeJob" role="tabpanel" aria-labelledby="active-tab">
                        <div class="d-flex flex-wrap gap-2 mb-3">
                            <a href="{{ route('equipment.create') }}">
                            <button type="button" class="btn btn-success btn-sm flex-fill">
                                <i class="fas fa-plus-circle"></i> Add New Equipment
                            </button>
                        </a>

                            <button type="button" class="btn btn-info btn-sm flex-fill">
                                <i class="fas fa-plus-square"></i> Add Multiple New Equipment
                            </button>

                            <button type="button" class="btn btn-warning btn-sm flex-fill">
                                <i class="fas fa-file-import"></i> Import
                            </button>

                            <button type="button" class="btn btn-secondary btn-sm flex-fill">
                                <i class="fas fa-exchange-alt"></i> Change Client Site
                            </button>

                            <button type="button" class="btn btn-dark btn-sm flex-fill">
                                <i class="fas fa-chart-bar"></i> Reports
                            </button>

                            <button type="button" class="btn btn-danger btn-sm flex-fill">
                                <i class="fas fa-map-marker-alt"></i> Change Asset Location
                            </button>

                            {{-- <button type="button" class="btn btn-primary btn-sm flex-fill">
                                    <i class="fas fa-archive"></i> Archive Selected Equipment
                                </button> --}}
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
                                    <tr class="rgRow">
                                        <td><a class="btn btn-success btn-sm" href="javascript:void(0)">Open</a></td>
                                        <td>01 Aug 2024</td>
                                        <td>195</td>
                                        <td>LIEBHERR - AMERICA, INC.</td>
                                        <td>Subject</td>
                                        <td>HOU - 1</td>
                                        <td>WALK IN</td>
                                        <td>Jorge Guevara</td>
                                        <td>112056</td>
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

            $('#client').select2();
            $('#clientSite').select2();
        });
    </script>
@endsection
@endsection
