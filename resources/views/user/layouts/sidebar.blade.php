<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('user.Dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('user.Dashboard') }}" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo.png') }}" alt="" height="40">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('user/dashboard') || request()->is('user/dashboard/*') ? 'active' : '' }}"
                        href="{{ route('user.Dashboard') }}">
                        <i class="ri-dashboard-line"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('user/services') || request()->is('user/services/*') ? 'active' : '' }}"
                        href="{{ route('user.Services') }}">
                        <i class="ri-service-line"></i> <span>Request Services</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('user/booked-services') || request()->is('user/booked-services/*') || request()->is('user/service-detail/*') ? 'active' : '' }}"
                        href="{{ route('user.Appointments') }}">
                        <i class="ri-calendar-check-line"></i> <span>Booked Services</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('user/service-providers') || request()->is('user/service-providers/*') || request()->is('user/*/profile') ? 'active' : '' }}"
                        href="{{ route('user.ServiceProviders') }}">
                        <i class="ri-user-line"></i> <span>Service Providers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('user/transaction-history') || request()->is('user/transaction-history/*') ? 'active' : '' }}"
                        href="{{ route('user.transactionHistory') }}">
                        <i class="ri-file-list-3-line"></i> <span>Transaction History</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#" data-bs-toggle="modal"
                        data-bs-target=".bs-modal-add-balance">
                        <i class="ri-wallet-line"></i> <span>Add Funds</span>
                    </a>
                </li>

                <!-- <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('user/profile') || request()->is('user/profile/*') ? 'active' : '' }}" href="#">
                        <i class="las las la-user-tie"></i> <span>Profile
                        </span>
                    </a>
                </li> -->
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->is('user/wallet') || request()->is('user/wallet/*')) ? 'active' : '' }}" href="{{route('user.Wallet')}}">
                        <i class="las las la-wallet"></i> <span>Wallet
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->is('user/payments') || request()->is('user/payments/*')) ? 'active' : '' }}" href="{{route('user.Payments')}}">
                        <i class="las la-money-bill-wave-alt"></i> <span>Payments
                        </span>
                    </a>
                </li> --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
