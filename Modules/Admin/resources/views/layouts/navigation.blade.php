<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Menu</li>
            <li>
                <a href="{{ route('admin.dashboard') }}" aria-expanded="false">
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/categories/*') ? 'active' : '' }}">
                <a href="{{ route('admin.categories.index') }}" aria-expanded="false" class="{{ request()->is('admin/categories/*') ? 'active' : '' }}">
                    <i class="icon-layers menu-icon"></i><span class="nav-text">Categories Management</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/users/*') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}" aria-expanded="false" class="{{ request()->is('admin/users/*') ? 'active' : '' }}">
                    <i class="icon-user menu-icon"></i><span class="nav-text">Users Management</span>
                </a>
            </li>
            <li class="{{ request()->is('admin/address/*') ? 'active' : '' }}">
                <a href="{{ route('admin.address.index') }}" aria-expanded="false" class="{{ request()->is('admin/address/*') ? 'active' : '' }}">
                    <i class="icon-location-pin menu-icon"></i><span class="nav-text">Address Management</span>
                </a>
            </li>
        </ul>
    </div>
</div>
