@extends('user.layouts.master')
@section('title')
    @lang('translation.animation')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/aos/aos.css') }}" rel="stylesheet">

@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('title')
            Dashboard
        @endslot
    @endcomponent

    <div class="row justify-content-center">
    <div class="col-xl-5">
        <div class="text-center mb-4">
            <h4>Your current wallet</h4>
            <p class="text-muted fs-13">WalletConnect is a convenient open source tool that enables a mobile wallet to easily connect to decentralized web applications, and interact with them from your phone.</p>
        </div>
    </div>
</div>

<div class="row justify-content-center mb-4">
    <div class="col-lg-8">
        <div class="card text-center">
            <div class="card-body py-5 px-4">
                <h5>WALLET</h5>
                <div class="row mt-4">
                    <div class="col-lg-3 col-sm-6">
                        <div class="p-2 border border-dashed rounded text-center">
                            <div>
                                <p class="text-muted fw-medium mb-1">Service No :</p>
                                <h5 class="fs-17 text-secondary mb-0">00034P</h5>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="p-2 border border-dashed rounded text-center">
                            <div>
                                <p class="text-muted fw-medium mb-1">Total Balance</p>
                                <h5 class="fs-17 mb-0">$300</h5>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="p-2 border border-dashed rounded text-center">
                            <div>
                                <p class="text-muted fw-medium mb-1">On Hold</p>
                                <h5 class="fs-17 mb-0">$100</h5>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-lg-3 col-sm-6">
                        <div class="p-2 border border-dashed rounded text-center">
                            <div>
                                <p class="text-muted fw-medium mb-1">To Withdraw</p>
                                <h5 class="fs-17 mb-0">$200</h5>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <p class="text-muted pb-1 mt-3">MetaMask is a software cryptocurrency wallet used to interact with the Ethereum blockchain.</p>
                <div class="hstack gap-2 mt-3 justify-content-center a-auto">
                    <button class="btn btn-outline-primary btn-border">Deposit Funds</button>
                    <button class="btn btn-outline-success btn-border">Withdraw Funds</button>
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
