<a class="navbar-brand mr-1" href="{{ url('/') }}">{{ config('app.name', 'Laravel') }}</a>

<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
  <i class="fas fa-bars"></i>
</button>

{{-- <!-- Navbar Search -->
<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
  <div class="input-group">
    <input type="text" class="form-control" placeholder="Search ..." aria-label="Search" aria-describedby="basic-addon2">
    <div class="input-group-append">
      <button class="btn btn-primary" type="button">
        <i class="fas fa-search"></i>
      </button>
    </div>
  </div>
</form> --}}

<!-- Navbar -->
<ul class="navbar-nav ml-auto my-2 my-lg-0">
  <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      @if (auth()->user()->unreadNotifications()->groupBy('notifiable_type')->count() != null)
      <span class="badge badge-pill badge-danger">{{ auth()->user()->unreadNotifications()->groupBy('notifiable_type')->count() }}</span>
      @endif
      <i class="fas fa-bell fa-fw"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
      @if (auth()->user()->unreadNotifications()->groupBy('notifiable_type')->count() != null)
      @foreach (auth()->user()->unreadNotifications->sortByDesc('created_at')->take(3) as $notification)
      <a href="{{ route('readNotif',$notification) }}">
        <div class="col dropdown-item" style="max-width: 400px;background-color: #fefbd8">
        <div class="row">
          <div class="col">
            <strong class="text-info">{{ strtoupper($notification->data['notification_subject']) }}</strong>
          </div>
          <div class="col">
            <p>{{ $notification->data['notification_content'] }}</p>
          </div>
        </div>
        <small class="text-danger">{{ $notification->created_at }}</small>  
      </div>
      </a>
      <div class="dropdown-divider"></div>
      {{-- <a class="dropdown-item" href="#">{{ $notification->data['notification_content'].' oleh '. $notification->data['notification_subject']}}</a>
      <div class="dropdown-divider"></div> --}}
      @endforeach
      @foreach (auth()->user()->readNotifications->sortByDesc('created_at')->take(2) as $notification)
      <div class="col dropdown-item" style="max-width: 400px;">
        <div class="row">
          <div class="col">
            <strong class="text-info">{{ strtoupper($notification->data['notification_subject']) }}</strong>
          </div>
          <div class="col">
            <p>{{ $notification->data['notification_content'] }}</p>
          </div>
        </div>
        <small class="text-danger">{{ $notification->created_at }}</small>  
      </div>
      <div class="dropdown-divider"></div>
      {{-- <a class="dropdown-item" href="#">{{ $notification->data['notification_content'].' oleh '. $notification->data['notification_subject']}}</a>
      <div class="dropdown-divider"></div> --}}
      @endforeach
      @else
      <div class="col dropdown-item">
        <div class="row">
          <div class="col">
           <a class="text-primary">Tidak ada pemberitahuan Terbaru</a>
         </div>
       </div>
     </div>
     @endif
     <div class="text-center">
      <a type="button" href="{{ route('allNotification') }}" class="text-info">Lihat Semua</a>  
    </div>
  </div>
</li>
  {{-- <li class="nav-item dropdown no-arrow mx-1">
    <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-envelope fa-fw"></i>
      <span class="badge badge-danger">7</span>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
      <a class="dropdown-item" href="#">Action</a>
      <a class="dropdown-item" href="#">Another action</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#">Something else here</a>
    </div>
  </li> --}}
  <li class="nav-item dropdown no-arrow">
    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <i class="fas fa-user-circle fa-fw"></i>
    </a>
    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
      <a class="dropdown-item"><strong>{{auth()->user()->nama}}</strong></a>      
      <a class="dropdown-item" href="#">Pengajuan Tersimpan</a>
      <a class="dropdown-item" href="#">Riwayat Pengajuan</a>
      <a class="dropdown-item" href="{{ route('user.settings',auth()->user()->id) }}">Pengaturan</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
    </div>
  </li>
</ul>