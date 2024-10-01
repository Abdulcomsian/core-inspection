@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Clients')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="row mt-5">
                        <div class="col-md-3">
                            <label for="geographicClientSelect" class="small-label">Client</label>
                            <select id="geographicClientSelect" class="form-select">
                                <option value="1">Client 1</option>
                                <option value="2">Client 2</option>
                                <option value="3">Client 3</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="geographicClientSiteSelect" class="small-label">Client Site</label>
                            <select id="geographicClientSiteSelect" class="form-select">
                                <option value="1">Client Site 1</option>
                                <option value="2">Client Site 2</option>
                                <option value="3">Client Site 3</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="geographicDueSelect" class="small-label">Due</label>
                            <select id="geographicDueSelect" class="form-select">
                                <option value="1">Octuber 2024</option>
                                <option value="2">November 2024</option>
                                <option value="3">December 2024</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-sm delete-btn" style="margin-top: 27px;"><i class="fa fa-search"></i>
                                Search</button>
                        </div>
                    </div>

                    <div class="tab-content mt-5">
                        <div class="tab-pane fade show active" id="activeJob" role="tabpanel" aria-labelledby="active-tab">
                            <div class="d-flex flex-wrap gap-2 mb-3">
                                <a href="{{ route('equipment.create') }}">
                                <button type="button" class="btn btn-sm add-section flex-fill">
                                    <i class="fas fa-plus-circle icon"></i> Add New Equipment
                                </button>
                            </a>
    
                                <button type="button" class="btn btn-sm save-btn flex-fill">
                                    <i class="fas fa-plus-square icon"></i> Add Multiple New Equipment
                                </button>
    
                                <button type="button" class="btn btn-light btn-sm flex-fill">
                                    <i class="fas fa-file-import icon"></i> Import
                                </button>
    
                                <button type="button" class="btn btn-secondary btn-sm flex-fill">
                                    <i class="fas fa-exchange-alt"></i> Change Client Site
                                </button>
    
                                <button type="button" class="btn btn-dark btn-sm flex-fill">
                                    <i class="fas fa-chart-bar"></i> Reports
                                </button>
    
                                <button type="button" class="btn btn-sm delete-btn flex-fill">
                                    <i class="fas fa-map-marker-alt icon"></i> Change Asset Location
                                </button>
    
                                {{-- <button type="button" class="btn btn-primary btn-sm flex-fill">
                                        <i class="fas fa-archive"></i> Archive Selected Equipment
                                    </button> --}}
                            </div>
                            <div class="table-responsive">
                                <table id="mytable"
                                    class="table table-bordered table-striped table-hover datatable datatable-Role cell-border"
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
                                            <td class="text-center"><a class="btn save-btn btn-sm" href="{{ route('equipment.show') }}">Open</a></td>
                                            <td>01 Aug 2024</td>
                                            <td>195</td>
                                            <td>LIEBHERR - AMERICA, INC.</td>
                                            <td>Subject</td>
                                            <td>HOU - 1</td>
                                            <td>WALK IN</td>
                                            <td>Jorge Guevara</td>
                                            <td>112056</td>
                                            <td>Active</td>
                                            <td><button class="btn delete-btn btn-sm">Delete</button></td>
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

            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable().columns.adjust();
            });

            $('#client').select2();
            $('#geographicClientSelect').select2();
            $('#geographicClientSiteSelect').select2();
            $('#geographicDueSelect').select2();
        });

        $('.dropdown').click(function() {
            $('.dropdown-menu').toggleClass('show');
        });
    </script>
@endsection
@endsection
