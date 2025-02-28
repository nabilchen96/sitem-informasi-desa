<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>

        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ url('user') }}">
                <i class="bi bi-people menu-icon"></i>
                <span class="menu-title">User</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('desa') }}">
                <i class="bi bi-map menu-icon"></i>
                <span class="menu-title">Data Desa</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('penduduk') }}">
                <i class="bi bi-people menu-icon"></i>
                <span class="menu-title">Data Penduduk</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('berita') }}">
                <i class="bi bi-newspaper menu-icon"></i>
                <span class="menu-title">Berita</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('laporan') }}">
                <i class="bi bi-chat-right-dots menu-icon"></i>
                <span class="menu-title">Laporan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('pengajuan-surat') }}">
                <i class="bi bi-envelope menu-icon"></i>
                <span class="menu-title">Pengajuan Surat</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ url('program') }}">
                <i class="bi bi-calendar menu-icon"></i>
                <span class="menu-title">Program & Agenda</span>
            </a>
        </li>
        <!-- @if (Auth::user()->role == 'Admin' || Auth::user()->role == 'SKPD')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Master</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('user') }}">User</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif -->
    </ul>
</nav>