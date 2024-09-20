@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Clients')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
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
                            <button class="btn btn-sm delete-btn" style="margin-top: 27px;"><i class="fa fa-search"></i>
                                Search</button>
                        </div>
                    </div>

                    <div class="mt-3">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('client.create') }}">
                                    <button type="button" class="btn btn-sm me-3 add-section">
                                        <i class="fas fa-plus icon"></i>
                                        Add New
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="mytable"
                                class="table table-bordered table-striped table-hover datatable datatable-Role cell-border"
                                data-ordering="false">
                                <thead>
                                    <tr style="text-wrap: nowrap;">
                                        <th></th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Contact</th>
                                        <th>Mobile</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>City</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center"><a class="btn btn-sm save-btn"
                                                href="javascript:void(0)">Open</a></td>
                                        <td>Alex</td>
                                        <td>195</td>
                                        <td>2434</td>
                                        <td>24334</td>
                                        <td>test@gmail.com</td>
                                        <td>Test Address</td>
                                        <td>Islamabad</td>
                                        <td><button class="btn btn-sm delete-btn">Delete</button></td>
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
            $('#geographicZoneSelect').select2();
            $('#salesPersonSelect').select2();
        });

        $('.dropdown').click(function() {

            $('.dropdown-menu').toggleClass('show');

        });
    </script>
@endsection
@endsection
