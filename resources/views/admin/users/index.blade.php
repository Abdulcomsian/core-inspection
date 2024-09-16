@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Users')
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
                                <th>#</th>
                                <th>User</th>
                                <th>Role</th>
                                <th>Joined Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="d-flex align-items-center">
                                        <div class="d-flex flex-column">
                                            <a href="#"
                                                class="text-gray-800 text-hover-primary mb-1">{{ $user->name }}</a>
                                            <span>{{ $user->email }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @foreach ($user->roles as $key => $item)
                                            <span class="badge add-section">{{ $item->title }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        {{ $user->created_at ? $user->created_at->format('d M Y, h:i a') : 'N/A' }}
                                    </td>

                                    <td class="text-end">
                                        <a class="btn btn-sm me-2 save-btn" href="{{ route('users.edit', $user->id) }}">
                                            {{ trans('global.edit') }}
                                        </a>

                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                            onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline;">
                                            @method('DELETE')
                                            @csrf
                                            <input type="submit" class="btn btn-sm delete-btn"
                                                value="{{ trans('global.delete') }}">
                                        </form>
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
