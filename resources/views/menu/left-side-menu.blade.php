<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa-regular fa-gem" style="color: #ffffff;"></i>
        </div>
        <div class="sidebar-brand-text mx-3">DIAMEND</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Admin Items -->
    <!-- Dashboard -->
    <li class="nav-item {{ Nav::isRoute('home') }}">
        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>{{ __('general.dashboard') }}</span></a>
    </li>

    <!-- Products -->
    <li class="nav-item {{ Nav::isRoute('products*') }}">
        <a class="nav-link {{ request()->routeIs('products*') ? 'active' : '' }}" href="{{ route('products.index') }}">
            <i class="fa-solid fa-diamond"></i>
            <span>{{ __('general.products') }}</span></a>
    </li>

    <!-- Customers -->
    <li class="nav-item {{ Nav::isRoute('customers*') }}">
        <a class="nav-link {{ request()->routeIs('customers*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
            <i class="fa-solid fa-users"></i>
            <span>{{ __('general.customers') }}</span></a>
    </li>

    <!-- Expenses -->
    <li class="nav-item {{ Nav::isRoute('expenses*') }}">
        <a class="nav-link {{ request()->routeIs('expenses*') ? 'active' : '' }}" href="{{ route('expenses.index') }}">
            <i class="fa-solid fa-turkish-lira-sign"></i>
            <span>{{ __('general.expenses') }}</span></a>
    </li>

    <!-- End of Admin Items -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        {{ __('general.settings') }}
    </div>

    <!-- Nav Item - Profile -->
    <li class="nav-item {{ Nav::isRoute('profile') }}">
        <a class="nav-link {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}">
            <i class="fas fa-fw fa-user"></i>
            <span>{{ __('general.profile') }}</span>
        </a>
    </li>

    <!-- Nav Item - About -->
    <li class="nav-item {{ Nav::isRoute('about') }}">
        <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
            <i class="fa-solid fa-circle-info"></i>
            <span>{{ __('general.about') }}</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
