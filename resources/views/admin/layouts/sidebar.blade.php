<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('build/images/logo-sm.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('build/images/logo-dark.png') }}" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
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
                    <a class="nav-link menu-link {{ request()->is('admin/dashboard') || request()->is('admin/dashboard/*') ? 'active' : '' }}"
                        href="{{ route('admin.dashboard') }}">
                        <i class="mdi mdi-view-dashboard-outline"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/user-accounts') || request()->is('admin/user-accounts/*') ? 'active' : '' }}"
                        href="{{ route('admin.UserAccounts') }}">
                        <i class="las la-users"></i> <span>User Accounts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/admin-accounts') || request()->is('admin/admin-accounts/*') ? 'active' : '' }}"
                        href="{{ route('admin.AdminAccounts') }}">
                        <i class="las la-user-tie"></i> <span>Admin Accounts</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/service-providers') || request()->is('admin/service-providers/*') || request()->is('admin/service-provider-detail/*') ? 'active' : '' }}"
                        href="{{ route('admin.ServiceProvider') }}">
                        <i class="las la-handshake"></i> <span>Service Providers</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/services') || request()->is('admin/services/*') ? 'active' : '' }}"
                        href="{{ route('admin.providerServices') }}">
                        <i class="las la-concierge-bell"></i> <span>Services</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ (request()->is('admin/booked-services') || request()->is('admin/booked-services/*') ? 'active' : '' || request()->is('admin/service-details/*')) ? 'active' : '' }}"
                        href="{{ route('admin.Appointments') }}">
                        <i class="las la-calendar-check"></i> <span>Appointments</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/services-commision') || request()->is('admin/services-commision/*') ? 'active' : '' }}"
                        href="{{ route('admin.appointmentCommision') }}">
                        <i class="las la-coins"></i> <span>Commissions</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/onboarding-approvals') || request()->is('admin/onboarding-approvals/*') ? 'active' : '' }}"
                        href="{{ route('admin.onBoardingApprovals') }}">
                        <i class="las la-check-circle"></i> <span>Onboarding Approvals</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/service-approvals') || request()->is('admin/service-approvals/*') ? 'active' : '' }}"
                        href="{{ route('admin.serviceApprovals') }}">
                        <i class="las la-check-circle"></i> <span>Service Approvals</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/locations') || request()->is('admin/locations/*') ? 'active' : '' }}"
                        href="{{ route('admin.Locations') }}">
                        <i class="las la-map-marked-alt"></i> <span>Locations</span>
                    </a>
                </li>
            </ul>

        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
