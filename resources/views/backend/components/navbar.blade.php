<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard') }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>

        </li>
        @if (Auth::user()->role == 'Admin')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="icon-layout menu-icon"></i>
                    <span class="menu-title">Master</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('user') }}">User</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('dosen') }}">Dosen</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('tahun') }}">Tahun</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('kegiatan') }}">Kegiatan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('jadwal') }}">Jadwal</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#tahap1" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="bi bi-box-seam menu-icon"></i>
                    <span class="menu-title">Pengusulan</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="tahap1">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('usulan-judul') }}">Usulan Judul</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('usulan-proposal') }}">Usulan Proposal</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#tahap2" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="bi bi-box-seam menu-icon"></i>
                    <span class="menu-title">Pelaksanaan</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="tahap2">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('revisi-proposal') }}">Revisi Proposal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('kontrak') }}">Kontrak</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('seminar-antara') }}">Sem. Antara</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('luaran-penelitian') }}">Luaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('seminar-hasil') }}">Sem. Hasil</a>
                        </li>
                    </ul>
                </div>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#tahap3" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="bi bi-box-seam menu-icon"></i>
                    <span class="menu-title">Pengawasan</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="tahap3">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Monev</a>
                        </li>
                    </ul>
                </div>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#lain" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="bi bi-box-seam menu-icon"></i>
                    <span class="menu-title">Keb. Dosen</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="lain">
                    <ul class="nav flex-column sub-menu">
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">Publikasi</a>
                        </li> --}}
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('surat-izin-penelitian') }}">Izin Penelitian</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link" href="#">Pelatihan</a>
                        </li> --}}
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('notifikasi') }}">
                    <i class="bi bi-chat-left-text menu-icon"></i>
                    <span class="menu-title">Notifikasi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('library') }}">
                    <i class="bi bi-journals menu-icon"></i>
                    <span class="menu-title">Library</span>
                </a>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('haki') }}">
                    <i class="bi bi-journals menu-icon"></i>
                    <span class="menu-title">Dokumen HAKI</span>
                </a>

            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('pengumuman') }}">
                    <i class="bi bi-megaphone menu-icon"></i>
                    <span class="menu-title">Pengumuman</span>
                </a>

            </li>
        @elseif(Auth::user()->role == 'Reviewer')
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#tahap2" aria-expanded="false"
                    aria-controls="ui-basic">
                    <i class="bi bi-box-seam menu-icon"></i>
                    <span class="menu-title">Pelaksanaan</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="tahap2">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('penilaian-proposal') }}">Penilaian Proposal</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('revisi-proposal') }}">Revisi Proposal</a>
                        </li>
                    </ul>
                </div>
            </li>
        @endif

    </ul>
</nav>
