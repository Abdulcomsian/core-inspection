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
            Wallet
        @endslot
    @endcomponent

    <div class="row justify-content-center">
        <div class="col-xl-5">
            <div class="text-center mb-4">
                <h4>Your current wallet</h4>
                {{-- <p class="text-muted fs-13">WalletConnect is a convenient open source tool that enables a mobile wallet to
                    easily connect to decentralized web applications, and interact with them from your phone.</p> --}}
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-4">
        <div class="col-lg-8">
            <div class="card text-center">
                <div class="card-body py-5 px-4">
                    <h5>WALLET</h5>
                    <div class="row mt-4">
                        <div class="col-lg-4 col-sm-6">
                            <div class="p-2 border border-dashed rounded text-center">
                                <div>
                                    <p class="text-muted fw-medium mb-1">Total Amount Paid</p>
                                    <h5 class="fs-17 mb-0">${{ number_format($totalBalance, 2) }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="p-2 border border-dashed rounded text-center">
                                <div>
                                    <p class="text-muted fw-medium mb-1">On Hold</p>
                                    <h5 class="fs-17 mb-0">${{ number_format($onHold, 2) }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="p-2 border border-dashed rounded text-center">
                                <div>
                                    <p class="text-muted fw-medium mb-1">Total Amount Received</p>
                                    <h5 class="fs-17 mb-0">${{ number_format($amountReceived, 2) }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mb-4">
            <div class="col-lg-12">
                <div class="card text-center">
                    <div class="card-body py-5 px-4">
                        <h5>WALLET</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Service Name</th>
                                    <th>Amount Paid</th>
                                    <th>Commission (7%)</th>
                                    <th>Amount Received</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($appointments as $appointment)
                                    <tr>
                                        <td>{{ $appointment->serviceDetails->serviceCategory->name }}</td>
                                        <td>${{ number_format($appointment->purchase_amount, 2) }}</td>
                                        <td>${{ number_format($appointment->purchase_amount * 0.05, 2) }}</td>
                                        <td>${{ number_format($appointment->balance_after_commission, 2) }}</td>
                                        <td>{{ $appointment->disbursementDetails ? 'Payment Received' : 'Pending' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/aos/aos.js') }}"></script>
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/animation-aos.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
