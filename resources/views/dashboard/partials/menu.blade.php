@php
    $meta = App\Models\SystemInfo::pluck('meta_value', 'meta_field')->toArray();
@endphp
<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="{{ route('admin.index') }}" class="app-brand-link">
            @if (!empty($meta['logo']))
                <img src="{{ Storage::url($meta['logo']) }}" alt="logo" width="55px">
            @else
                <img src="{{ asset('assets/img/logo.png') }}" alt="logo" width="55px">
            @endif
            <span class="app-brand-text demo menu-text fw-bolder ms-2">{{ $meta['short_name'] ?? 'CLeoow' }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('admin') ? 'active' : '' }}">
            <a href="{{ route('admin.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Menu</span></li>
        <li class="menu-item {{ request()->is('admin/products*') ? 'active' : '' }}">
            <a href="{{ route('admin.products.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-package"></i>
                <div data-i18n="Basic">Product List</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/inventories*') ? 'active' : '' }}">
            <a href="{{ route('admin.inventories.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-list-ul"></i>
                <div data-i18n="Basic">Inventory List</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/order-list*') ? 'active' : '' }}">
            <a href="{{ route('admin.order-list.index') }}" class="menu-link">
                <i class='menu-icon bx bx-calendar-check'></i>
                <div data-i18n="Basic">Order List</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Maintenance</span>
        </li>
        <li class="menu-item {{ request()->is('admin/categories*') ? 'active' : '' }}">
            <a href="{{ route('admin.categories.index') }}" class="menu-link">
                <i class='menu-icon bx bx-category'></i>
                <div data-i18n="Basic">Category List</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/sub-categories*') ? 'active' : '' }}">
            <a href="{{ route('admin.sub-categories.index') }}" class="menu-link">
                <i class='menu-icon bx bx-category-alt'></i>
                <div data-i18n="Basic">Sub Category List</div>
            </a>
        </li>
        <li class="menu-item {{ request()->is('admin/settings*') ? 'active' : '' }}">
            <a href="{{ route('admin.settings.index') }}" class="menu-link">
                <i class='menu-icon bx bx-cog'></i>
                <div data-i18n="Basic">Settings</div>
            </a>
        </li>
    </ul>
</aside>
