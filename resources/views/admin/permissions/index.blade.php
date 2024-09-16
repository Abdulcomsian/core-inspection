@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Permissions')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-fluid">

        </div>
        <div class="container-fluid">
            <button type="button" class="btn btn-sm add-section" data-toggle="modal" data-target="#addPermissionModal">
                <i class="fas fa-plus icon"></i>
                Add Permission
            </button>
            <div class="mt-3">
                <div class="table-responsive">
                    <table class=" table table-bordered table-striped table-hover datatable datatable-Role cell-border">
                        <thead>
                            <tr>
                                <th>
                                    {{ trans('cruds.permission.fields.id') }}
                                </th>
                                <th>
                                    {{ trans('cruds.permission.fields.title') }}
                                </th>
                                <th>
                                    &nbsp;
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $key => $permission)
                                <tr data-entry-id="{{ $permission->id }}">
                                    <td>
                                        {{ $permission->id ?? '' }}
                                    </td>
                                    <td>
                                        {{ $permission->title ?? '' }}
                                    </td>
                                    <td>
                                        {{-- @can('permission_show')
                                            <a class="btn btn-xs btn-primary" href="{{ route('permissions.show', $permission->id) }}">
                                                {{ trans('global.view') }}
                                            </a>
                                        @endcan --}}

                                        @can('permission_edit')
                                            <a class="btn btn-sm save-btn"
                                                href="{{ route('permissions.edit', $permission->id) }}">
                                                {{ trans('global.edit') }}
                                            </a>
                                        @endcan

                                        @can('permission_delete')
                                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST"
                                                onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                                style="display: inline-block;">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                <input type="submit" class="btn btn-sm delete-btn"
                                                    value="{{ trans('global.delete') }}">
                                            </form>
                                        @endcan
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

            $('#geographicZoneSelect').select2();
            $('#salesPersonSelect').select2();
        });
    </script>
@endsection
@endsection
