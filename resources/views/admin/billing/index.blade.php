@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Billings')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="container-fluid">

        </div>
        <div class="container-fluid fluid">
            <div>
                <div class="d-flex mb-3">
                    <a href="{{ route('billing.create') }}">
                        <button type="button" class="btn btn-sm me-3 add-section"><i class="fas fa-plus icon"></i>
                            Add New Billing
                        </button>
                    </a>
                </div>
                <div class="table-responsive">
                    <table id="mytable"
                        class="table table-bordered table-striped table-hover datatable datatable-Role cell-border"
                        data-ordering="false">
                        <thead>
                            <tr style="text-wrap: nowrap;">
                                <th></th>
                                <th class="text-center">Client</th>
                                <th class="text-center">#Job</th>
                                <th class="text-center">Equipment</th>
                                <th class="text-center">Inspection</th>
                                <th class="text-center">Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="no-records">
                                <td class="text-center"><a class="btn btn-sm save-btn"
                                        href="{{ route('billing.show') }}">Open</a>
                                </td>
                                <td class="text-center">Joe Root</td>
                                <td class="text-center">Inspection Job</td>
                                <td class="text-center">Stairs Equipment</td>
                                <td class="text-center">Stairs Inspection</td>
                                <td class="text-center">$50</td>
                                <td class="text-left">
                                    <button class="btn btn-sm save-btn">Copy</button>
                                    <button class="btn btn-sm delete-btn">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
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
    </script>
@endsection
@endsection
