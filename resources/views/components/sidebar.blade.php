<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        @guest
            <li class="nav-item {{ Request::is('/') ? 'active' : ' ' }}">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login.view') }}">
                    <i class="icon-head menu-icon"></i>
                    <span class="menu-title">Login</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('about') ? 'active' : ' ' }}">
                <a class="nav-link" href="{{ route('about') }}">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title">Tentang</span>
                </a>
            </li>
        @else
            <li class="nav-item {{ Request::is('home') ? 'active' : ' ' }}">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="icon-grid menu-icon"></i>
                    <span class="menu-title">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('login.view') }}">
                    <i class="icon-head menu-icon"></i>
                    <span class="menu-title">Pemasukan</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('about') ? 'active' : ' ' }}">
                <a class="nav-link" href="{{ route('about') }}">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title">Pengeluaran</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('reminder') ? 'active' : ' ' }}">
                <a class="nav-link" href="{{ route('reminder', ['id' => auth()->user()->id ?? '']) }}">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title">Pengingat</span>
                </a>
            </li>
            <li class="nav-item {{ Request::is('about') ? 'active' : ' ' }}">
                <a class="nav-link" href="{{ route('about') }}">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title">Riwayat Transaksi</span>
                </a>
            </li>
        @endguest


    </ul>
</nav>
