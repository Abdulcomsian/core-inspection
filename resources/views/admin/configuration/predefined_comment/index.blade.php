@extends('layouts.admin')
@section('title', 'Software')
@section('header', 'Predefined Comments')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">

        <div class="container-fluid">
            <div class="card bgg-light-primary">
                <div class="card-title">
                </div>
                <div class="card-body pt-0">
                    <div class="form-section">
                        <div class="row">
                            <div class="col-md-8 col-8">
                                <div class="custom-grid-layout">
                                    <label for="branchSelect1" class="small-label">Search</label>
                                    <div class="d-flex flex-column flex-md-row gap-2 mb-3">
                                        <select id="geographicZoneSelect" class="form-select mb-3">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-4">
                                    <button class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card mt-5">
                <div class="container-fluid">
                    <div class="mt-3">
                        <div class="d-flex mb-3">
                            <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal"
                            data-bs-target="#kt_modal_add_user"><i class="fas fa-plus"></i>
                                Add New
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table id="mytable" class="table table-bordered table-striped table-hover datatable datatable-Role" data-ordering="false">
                                <thead>
                                    <tr style="text-wrap: nowrap;">
                                        <th></th>
                                        <th>Description</th>
                                        <th>#Address</th>
                                        <th>#Equipment</th>
                                        <th>#Last Modified</th>
                                        <th>#Modified By</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="no-records">
                                        <td><a class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_add_user" href="javascript:void(0)">Open</a></td>
                                        <td class="text-center">ANCHOR POINT / SAFETY LINE (PERMANENT)</td>
                                        <td class="text-center">6</td>
                                        <td class="text-center">2</td>
                                        <td class="text-center">14 Mar 2022</td>
                                        <td class="text-center">Core Admin</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-success btn-sm me-2">Copy</button>
                                                <button class="btn btn-danger btn-sm">Delete</button>
                                            </div>
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

    <div class="modal fade" id="kt_modal_add_user" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content">
                <div class="modal-header" id="kt_modal_add_user_header">
                    <h2 class="fw-bolder">Add User</h2>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body scroll-y mx-5 mx-xl-15 my-7">
                    <form>
                        <div class="form-group">
                          <label for="exampleFormControlInput1">Email address</label>
                          <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlSelect1">Example select</label>
                          <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlSelect2">Example multiple select</label>
                          <select multiple class="form-control" id="exampleFormControlSelect2">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="exampleFormControlTextarea1">Example textarea</label>
                          <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
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
            $('#geographicZoneSelect').select2();
            $('#salesPersonSelect').select2();
        });

        $('.dropdown').click(function() {

            $('.dropdown-menu').toggleClass('show');

        });
    </script>
@endsection
@endsection
