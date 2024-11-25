<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="mdi mdi-view-dashboard menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <!-- Menu Teks Bacaan untuk Teacher -->
        @if (auth()->user()->role === 'teacher')
        <li class="nav-item {{ request()->is('teks-bacaan') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('teks-bacaan.index') }}">
                <i class="mdi mdi-book-open-variant menu-icon"></i>
                <span class="menu-title">Teks Bacaan</span>
            </a>
        </li>
        @endif

        <!-- Menu Pembelajaran untuk Student -->
        @if (auth()->user()->role === 'student')
        <li class="nav-item {{ request()->is('pembelajaran') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('pembelajaran.index') }}">
                <i class="mdi mdi-school menu-icon"></i>
                <span class="menu-title">Pembelajaran</span>
            </a>
        </li>
        @endif
    </ul>
</nav>
