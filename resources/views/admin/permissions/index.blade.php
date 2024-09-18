@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Permissions')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="container-fluid">

        </div>
        <div class="container-fluid">
            <a href="#" data-bs-toggle="modal" data-bs-target="#permissionModal">
                <button type="button" class="btn btn-sm add-section">
                    <i class="fas fa-plus icon"></i>
                    Add Permission
                </button>
            </a>
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
                                <tr>
                                        <td>{{ $key + 1 }}</td>
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
                                            <a class="btn btn-sm save-btn" href="javascript:void(0)"
                                                onclick="openEditModal({{ $permission->id }})">
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

    <!-- Modal -->
    <div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="permissionModalLabel">Create Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('permissions.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="title"
                                class="form-label required">{{ trans('cruds.permission.fields.title') }}</label>
                            <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text"
                                name="title" id="title" value="{{ old('title', '') }}" required>
                            @if ($errors->has('title'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                            <small class="form-text text-muted">{{ trans('cruds.permission.fields.title_helper') }}</small>
                        </div>
                        <button type="submit" class="btn save-btn btn-sm">
                            <i class="far fa-save icon"></i> Save
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Permission Modal -->
    <div class="modal fade" id="editPermissionModal" tabindex="-1" aria-labelledby="editPermissionModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPermissionModalLabel">{{ trans('global.edit') }} Permission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Edit Form -->
                    <form method="POST" action="" id="editPermissionForm">
                        @method('PUT')
                        @csrf
                        <div class="mb-3">
                            <label class="required" for="edit_title">{{ trans('cruds.permission.fields.title') }}</label>
                            <input class="form-control" type="text" name="title" id="edit_title" required>
                            <span class="help-block">{{ trans('cruds.permission.fields.title_helper') }}</span>
                        </div>
                        <div class="mb-3 text-end">
                            <button class="btn btn-sm save-btn" type="submit">
                                <i class="far fa-save icon"></i>{{ trans('global.save') }}
                            </button>
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

        function openEditModal(permissionId) {
            // Fetch the permission data using AJAX
            $.ajax({
                url: `/permissions/${permissionId}/edit`, // Adjust to your route
                type: 'GET',
                success: function(data) {
                    // Populate the modal form fields with the fetched data
                    $('#edit_title').val(data.title);

                    // Update the form action URL
                    $('#editPermissionForm').attr('action', `/permissions/${permissionId}`);

                    // Open the modal
                    $('#editPermissionModal').modal('show');
                },
                error: function(error) {
                    console.log("Error fetching permission data:", error);
                }
            });
        }
    </script>
@endsection
@endsection
