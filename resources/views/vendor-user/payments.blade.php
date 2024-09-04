@extends('vendor-user.layouts.master')
@section('title')
    @lang('translation.animation')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/aos/aos.css') }}" rel="stylesheet">

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
           Payments
        @endslot
    @endcomponent


<div class="row">
    <div class="col">

        <div class="h-100">
            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Pending Payments</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-14 mb-0">
                                        <i class="ri-arrow-right-up-line fs-13 align-middle"></i>
                                        0 %
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="0">0</span>k
                                    </h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success rounded fs-3">
                                        <i class="bx bx-dollar-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-4 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Services Booked</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="0">0</span></h4>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-info rounded fs-3">
                                        <i class="bx bx-shopping-bag"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-4 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Wallet Balance</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-muted fs-14 mb-0">
                                        +0.00 %
                                    </h5>
                                    
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-1">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="0">0</span>k
                                    </h4>
                                    <a href="" class="text-decoration-underline" previewlistener="true">Withdraw</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-danger rounded fs-3">
                                        <i class="bx bx-wallet"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->


            <div class="row">

                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-header align-items-center d-flex">
                            <h4 class="card-title mb-0 flex-grow-1">Recent Activity</h4>
                        </div><!-- end card header -->

                        <div class="card-body">
                            <div class="table-responsive table-card">
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light text-muted">
                                        <tr>
                                            <th class="sort" data-sort="name" scope="col" style="width: 60px;"></th>
                                            <th class="sort" data-sort="date" scope="col">Timestamp</th>
                                            <th class="sort" data-sort="to_name" scope="col">To Account</th>
                                            <th class="sort" data-sort="transaction_id" scope="col">Transaction ID</th>
                                            <th class="sort" data-sort="type" scope="col">Type</th>
                                            <th class="sort" data-sort="amount" scope="col">Amount</th>
                                            <th class="sort" data-sort="status" scope="col">Status</th>
                                        </tr>
                                        <!--end tr-->
                                    </thead>
                                    <tbody class="list form-check-all">
                                        <tr>
                                            <td class="id" style="display:none;"><a href="javascript:void(0);"
                                                    class="fw-medium link-primary">#VZ001</a></td>
                                            <td>
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-danger-subtle text-danger rounded-circle fs-16">
                                                        <i class="ri-arrow-right-up-fill"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="date">24 Dec, 2021 <small class="text-muted">08:58AM</small></td>
                                            <td class="to_name">Thomas Taylor</td>
                                            <td class="transaction_id">16b1d9234b61e8778d9e3588f20</td>
                                            <td class="type">Withdraw</td>
                                            <td>
                                                <h6 class="text-danger mb-1 amount">-142.35 $</h6>
                                                <p class="text-muted mb-0">$697.88k</p>
                                            </td>
                                            <td class="status">
                                                <span class="badge bg-warning-subtle text-warning fs-11"><i class="ri-time-line align-bottom"></i>
                                                    Processing</span>
                                            </td>
                                        </tr>
                                        <!--end tr-->
                                        <tr>
                                            <td class="id" style="display:none;"><a href="javascript:void(0);"
                                                    class="fw-medium link-primary">#VZ002</a></td>
                                            <td>
                                                <div class="avatar-xs">
                                                    <div class="avatar-title bg-success-subtle text-success rounded-circle fs-16">
                                                        <i class="ri-arrow-left-down-fill"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="date">16 Dec, 2021 <small class="text-muted">10:32PM</small></td>
                                            <td class="to_name">Wallet</td>
                                            <td class="transaction_id">0a4b5e0e15d70ce79809eabbe</td>
                                            <td class="type">Deposit</td>
                                            <td>
                                                <h6 class="text-success mb-1 amount">+342.35 $</h6>
                                                <p class="text-muted mb-0">$14565.35</p>
                                            </td>
                                            <td class="status">
                                                <span class="badge bg-success-subtle text-success fs-11"><i
                                                        class="ri-checkbox-circle-line align-bottom"></i> Success</span>
                                            </td>
                                        </tr>
                                        <!--end tr-->
                                    </tbody>
                                </table>
                                <!--end table-->
                                <div class="noresult" style="display: none">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                            colors="primary:#405189,secondary:#0ab39c" style="width:75px;height:75px">
                                        </lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted mb-0">We've searched more than 150+ transactions We did not find any
                                            transactions for you search.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <div class="pagination-wrap hstack gap-2">
                                    <a class="page-item pagination-prev disabled" href="#">
                                        Previous
                                    </a>
                                    <ul class="pagination listjs-pagination mb-0">
                                        <li class="active"><a class="page" href="#" data-i="1" data-page="8">1</a></li>
                                        <li><a class="page" href="#" data-i="1" data-page="8">2</a></li>
                                    </ul>
                                    <a class="page-item pagination-next" href="#">
                                        Next
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- .card-->
                </div> <!-- .col-->
            </div> <!-- end row-->

        </div> <!-- end .h-100-->

    </div> <!-- end col -->
</div>

<div class="modal fade bs-modal-edit-service" tabindex="-1" aria-labelledby="mySmallModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Transaction Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="card-radio">   
                    <label class="form-check-label" for="listGroupRadioGrid1">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-xs">
                                    <div class="avatar-title bg-success-subtle text-success fs-18 rounded">
                                        <i class="ri-visa-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">1234 5678 9102 ****</h6>
                                <b class="pay-amount">$8,500</b>
                            </div>
                        </div>
                        <div class="alert alert-success shadow mb-0 mt-2" role="alert">
                            Payment <strong>Successfully</strong> Transfered on <strong>20/1/2024 10:30 PM</strong>
                        </div>
                    </label>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/aos/aos.js') }}"></script>
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/animation-aos.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
