<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('admin.index') }}" class="nav-link {{ request()->routeIs('admin.index') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Inicio
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('offices.index') }}" class="nav-link {{ request()->routeIs('offices.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Oficina
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('staffs.index') }}" class="nav-link {{ request()->routeIs('staffs.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Personal
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('networks.index') }}" class="nav-link {{ request()->routeIs('networks.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Red
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('devices.index') }}" class="nav-link {{ request()->routeIs('devices.*') ? 'active' : '' }}">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                    Equipo
                </p>
            </a>
        </li>
    </ul>
</nav>