@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Update Role')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-fluid">

        </div>
        <div class="container-fluid">
            <div class="mt-3">
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable datatable-Role cell-border">
                        <thead>
                            <tr>
                                <th>
                                    {{ trans('cruds.role.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.role.fields.title') }}
                                </th>
                                <th>
                                    {{ trans('cruds.role.fields.permissions') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $key => $role)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $role->title ?? '' }}</td>
                                    <td>
                                        @foreach ($role->permissions as $key => $item)
                                            <span class="badge add-section">{{ $item->title }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            {{-- @can('role_show')
                                                <a class="btn btn-sm btn-primary mr-2" href="{{ route('roles.show', $role->id) }}">
                                                    {{ trans('global.view') }}
                                                </a>
                                            @endcan --}}

                                            @can('role_edit')
                                                <a class="btn btn-sm me-2 save-btn" href="{{ route('roles.edit', $role->id) }}">
                                                    {{ trans('global.edit') }}
                                                </a>
                                            @endcan

                                            @can('role_delete')
                                                <form action="{{ route('roles.destroy', $role->id) }}" method="POST"
                                                    onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                    style="display: inline;">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="submit" class="btn btn-sm delete-btn"
                                                        value="{{ trans('global.delete') }}">
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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
                    [0, 'asc']
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

            $('#geographicZoneSelect').select2();
            $('#salesPersonSelect').select2();
        });
    </script>
@endsection
@endsection
