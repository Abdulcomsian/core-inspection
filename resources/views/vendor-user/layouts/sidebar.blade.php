<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('vendor.Dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('vendor.Dashboard') }}" class="logo logo-light">
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
                @if (auth()->user()->profile_approved_status == '1')
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('service-provider/dashboard') || request()->is('service-provider/dashboard/*') ? 'active' : '' }}"
                            href="{{ route('vendor.Dashboard') }}">
                            <i class="ri-dashboard-line"></i> <span>Dashboard
                            </span>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('service-provider/profile') || request()->is('service-provider/profile/*') ? 'active' : '' }}"
                        href="{{ route('vendor.Profile') }}">
                        <i class="las la-user"></i> <span>Profile
                        </span>
                    </a>
                </li>
                @if (auth()->user()->profile_approved_status != '1')
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('service-provider/onBoarding') || request()->is('service-provider/onBoarding/*') ? 'active' : '' }}"
                            href="{{ route('vendor.OnBoarding') }}">
                            <i class="las la-user"></i> <span>OnBoarding
                            </span>
                        </a>
                    </li>
                @endif

                @if (auth()->user()->profile_approved_status)
                    {{-- <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('service-provider/manage-services') || request()->is('service-provider/manage-services/*') ? 'active' : '' }}"
                            href="{{ route('vendor.ManageServices') }}">
                            <i class="las la-list-alt"></i> <span>Manage Services
                            </span>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a class="nav-link menu-link {{ request()->is('service-provider/appointments') || request()->is('service-provider/appointments/*') || request()->is('service-provider/appointment-details/*') ? 'active' : '' }}"
                            href="{{ route('vendor.Appointments') }}">
                            <i class="ri-calendar-check-line"></i> <span>Appointments
                            </span>
                        </a>
                    </li>
                @endif

                {{-- <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->is('service-provider/bookings') || request()->is('service-provider/bookings/*')) ? 'active' : '' }}" href="{{route('vendor.Bookings')}}">
                        <i class="mdi mdi-book-account-outline"></i> <span>Bookings
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->is('service-provider/tasks') || request()->is('service-provider/tasks/*')) ? 'active' : '' }}" href="{{route('vendor.Tasks')}}">
                        <i class="mdi mdi-clipboard-list-outline"></i> <span>Tasks
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->is('service-provider/profile') || request()->is('service-provider/profile/*')) ? 'active' : '' }}" href="{{route('vendor.Profile')}}">
                        <i class="las la-user"></i> <span>Profile</span>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('service-provider/wallet') || request()->is('service-provider/wallet/*') ? 'active' : '' }}"
                        href="{{ route('vendor.Wallet') }}">
                        <i class="las las la-wallet"></i> <span>Wallet
                        </span>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->is('service-provider/payments') || request()->is('service-provider/payments/*')) ? 'active' : '' }}" href="{{route('vendor.Payments')}}">
                        <i class="las la-money-bill-wave-alt"></i> <span>Payments
                        </span>
                    </a>
                </li> --}}
            </ul>
        </div>
    </div>
    <div class="sidebar-background"></div>
</div>
<div class="vertical-overlay"></div>
