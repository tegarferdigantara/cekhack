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
            {{-- <li class="nav-item{{ Request::is('pemasukan') ? 'active' : ' ' }}">
                <a class="nav-link" href="{{ route('pemasukan') }}">
                    <i class="icon-head menu-icon"></i>
                    <span class="menu-title">Pemasukan</span>
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#transaksi" aria-expanded="false"
                    aria-controls="transaksi">
                    <i class="icon-columns menu-icon"></i>
                    <span class="menu-title">Transaksi</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="transaksi">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="{{ route('pemasukan') }}">Tambah</a>
                        </li>
                        <li class="nav-item"><a class="nav-link"
                                href="{{ route('riwayat-transaksi', ['id' => auth()->user()->id ?? '']) }}">Riwayat</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('goal', ['id' => auth()->user()->id ?? '']) }}">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title">Tujuan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reminder', ['id' => auth()->user()->id ?? '']) }}">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title">Pengingat</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('laporan', ['id' => auth()->user()->id ?? '']) }}">
                    <i class="icon-paper menu-icon"></i>
                    <span class="menu-title">Laporan</span>
                </a>
            </li>

        @endguest
    </ul>
</nav>
