<!-- Sidebar -->

{{-- applicant role --}}
@if(auth()->user()->hasAnyPermission(['submission']))
    <li class="nav-item active">
      <a class="nav-link" style="color:#00e6ac" >
        <i class="fas fa-fw fa-fa fa-briefcase"></i>
        <span>Pegawai</span>
      </a>
    </li>
    <li class="nav-item dropdown active">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{-- <i class="fas fa-fw fa-folder"></i> --}}
        <span>Pengajuan</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <h6 class="dropdown-header">Skema:</h6>
        <a class="dropdown-item" href="{{ route('terampil_create') }}">Terampil</a>
        <a class="dropdown-item" href="{{ route('ahli_create') }}">Ahli</a>
        {{-- <div class="dropdown-divider"></div>
        <h6 class="dropdown-header">Other Pages:</h6>
        <a class="dropdown-item" href="404.html">404 Page</a>
        <a class="dropdown-item" href="blank.html">Blank Page</a> --}}
      </div>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="{{ route('about') }}">
        {{-- <i class="fas fa-fw fa-user"></i> --}}
        <span>Profil</span></a>
    </li>
    {{-- <li class="nav-item">
      <a class="nav-link" href="tables.html">
        <i class="fas fa-fw fa-table"></i>
        <span>Tables</span></a>
    </li> --}}
@endif





{{-- verificator role --}}
@if(auth()->user()->hasAnyPermission(['accept applicant', 'reject applicant', 'sees applicant']))
<li class="nav-item active">
  <a class="nav-link" style="color:#00e6ac">
    <i class="fas fa-fw fa-address-book"></i>
    <span>Verificator</span>
  </a>
</li>
<li class="nav-item active">
  <a class="nav-link" href="{{ route('newapplicant') }}">
    {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
    <span>Pemohon baru</span>
  </a>
</li>
@endif


{{-- biro umum role --}}
@if(auth()->user()->hasAnyPermission(['record submission bu']))

    <li class="nav-item active">
      <a class="nav-link" style="color:#00e6ac">
        <i class="fas fa-fw fa fa-building"></i>
        <span>Biro Umum</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Berkas Baru</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Rekap Berkas diteruskan</span>
      </a>
    </li>
@endif


{{-- tu kepegawaian role --}}
@if(auth()->user()->hasAnyPermission(['administration check','record submission tu','accept submission tu','reject submission tu','create disposition','notif applicant']))

    <li class="nav-item active">
      <a class="nav-link" style="color:#00e6ac">
        <i class="fas fa-fw fa fa-sitemap"></i>
        <span>TU Kepegawaian</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Verifikasi Administrasi</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Rekap Verifikasi</span>
      </a>
    </li>
@endif


{{-- asesmen role --}}
@if(auth()->user()->hasAnyPermission(['record submission as']))

    <li class="nav-item active">
      <a class="nav-link" style="color:#00e6ac">
        <i class="fas fa-fw fa fa-signal"></i>
        <span>Asesmen</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Berkas Baru</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Rekap Berkas diteruskan</span>
      </a>
    </li>
@endif


{{-- JFT role --}}
@if(auth()->user()->hasAnyPermission(['record submission jf']))

    <li class="nav-item active">
      <a class="nav-link" style="color:#00e6ac">
        <i class="fas fa-fw fa fa-street-view"></i>
        <span>JFT</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Berkas Baru</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Rekap Berkas diteruskan</span>
      </a>
    </li>
@endif


{{-- Konseptor Prakom role --}}
@if(auth()->user()->hasAnyPermission(['record submission ko','create supeng ko','create sk']))

    <li class="nav-item active">
      <a class="nav-link" style="color:#00e6ac">
        <i class="fas fa-fw fa fa-street-view"></i>
        <span>Konseptor</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Berkas Baru</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Rekap Berkas diteruskan</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Buat Sk</span>
      </a>
    </li>
@endif


{{-- kesekretariatan role --}}
@if(auth()->user()->hasAnyPermission(['record submission se','file check','accept submission se','reject submission se','create supeng se','create pak']))
    <li class="nav-item active">
      <a class="nav-link" style="color:#00e6ac" >
        <i class="fas fa-fw fa fa-tasks"></i>
        <span>Kesekretariatan</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Verifikasi Berkas</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Rekap Verifikasi Berkas</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Rincian PAK masuk</span>
      </a>
    </li>
@endif


{{-- Ketua Tim role --}}
@if(auth()->user()->hasAnyPermission(['create team','apply team']))

    <li class="nav-item active">
      <a class="nav-link" style="color:#00e6ac">
        <i class="fas fa-fw fa fa-users"></i>
        <span>Ketua TIM</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Buat Tim</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Tentukan tim penilai</span>
      </a>
    </li>
@endif


{{--  Tim Penilai role --}}
@if(auth()->user()->hasAnyPermission(['apply individual score', 'apply score','create pak detail']))

    <li class="nav-item active">
      <a class="nav-link" style="color:#00e6ac">
        <i class="fas fa-fw fa fa-trademark"></i>
        <span>TIM Penilai</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Berkas Penilaian</span>
      </a>
    </li>
    <li class="nav-item active">
      <a class="nav-link" href="#">
        {{-- <i class="fas fa-fw fa-user-plus"></i> --}}
        <span>Penilaian (Optional)</span>
      </a>
    </li>
@endif


{{-- admin role --}}
@if(auth()->user()->hasRole('admin'))
  <li class="nav-item active">
    <a class="nav-link" style="color:#00e6ac">
      <i class="fas fa-fw fa-university"></i>
      <span>Admin</span>
    </a>
  </li>
  <li class="nav-item active">
    <a class="nav-link" href="{{ route('manageusers') }}">
      {{-- <i class="fas fa-fw fa-users"></i> --}}
      <span>Kelola pengguna</span>
    </a>
  </li>
@endif





