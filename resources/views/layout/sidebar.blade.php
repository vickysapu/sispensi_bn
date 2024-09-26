<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('template/') }}/dist/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('absensi.index') }}" class="nav-link">
                    <i class="fa fa-calendar nav-icon"></i>
                    <p>
                        Absensi
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('datasiswa.index') }}" class="nav-link">
                    <i class="fa fa-users nav-icon"></i>
                    <p>Data Siswa</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('datapiket.index') }}" class="nav-link">
                    <i class="fa fa-table nav-icon"></i>
                    <p>Data Piket</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('walikelas.index') }}" class="nav-link">
                    <i class="fa fa-user nav-icon"></i>
                    <p>Data Wali Kelas</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('sekolah.index') }}" class="nav-link">
                    <i class="fa fa-school nav-icon"></i>
                    <p>Data Sekolah</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('tahunpelajaran.index') }}" class="nav-link">
                    <i class="far fa-calendar nav-icon"></i>
                    <p>Data Tahun Pelajaran</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('jurusan.index') }}" class="nav-link">
                    <i class="fa fa-bars nav-icon"></i>
                    <p>Data Jurusan</p>
                </a>
            </li>
        </ul>
    </nav>
    </div>
</aside>
