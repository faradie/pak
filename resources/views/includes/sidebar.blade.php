<!-- Sidebar -->

@if(auth()->user()->hasRole('admin'))
  <li class="nav-item active">
    <a class="nav-link" >
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



{{-- @if(auth()->user()->hasRole('verificator'))

@endif --}}
@if(auth()->user()->hasAnyPermission(['accept applicant', 'reject applicant', 'sees applicant']))
<li class="nav-item active">
  <a class="nav-link">
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


@if(auth()->user()->hasPermissionTo('submission'))
    <li class="nav-item active">
      <a class="nav-link" >
        <i class="fas fa-fw fa-fa fa-briefcase"></i>
        <span>Pegawai</span>
      </a>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        {{-- <i class="fas fa-fw fa-folder"></i> --}}
        <span>Pengajuan</span>
      </a>
      <div class="dropdown-menu" aria-labelledby="pagesDropdown">
        <h6 class="dropdown-header">Skema:</h6>
        <a class="dropdown-item" href="#">Terampil</a>
        <a class="dropdown-item" href="#">Ahli</a>
        {{-- <div class="dropdown-divider"></div>
        <h6 class="dropdown-header">Other Pages:</h6>
        <a class="dropdown-item" href="404.html">404 Page</a>
        <a class="dropdown-item" href="blank.html">Blank Page</a> --}}
      </div>
    </li>
    <li class="nav-item">
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


