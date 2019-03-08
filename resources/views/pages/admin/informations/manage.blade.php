@extends('layouts.default')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Kelola Informasi</li>
  </ol>
</nav>
<form action="{{ route('create_information') }}"><input class="btn btn-info btn-block" type="submit" value="Buat Informasi Baru" /></form>
<br>
@if(session()->has('result_berhasil'))
<div class="alert alert-success">
  {{ session()->get('result_berhasil') }}
</div>
@endif
@if(session()->has('result_gagal'))
<div class="alert alert-danger">
  {{ session()->get('result_gagal') }}
</div>
@endif
<br>
<div class="list-group">
  @if ($informations->count() != null)
    @foreach ($informations as $information)
    <a href="{{ route('detail_information',$information->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
      <div class="d-flex w-100 justify-content-between">
        <h5 class="mb-1">{{ $information->information_title }}</h5>
        <small>{{ $information->created_at }}</small>
      </div>
      <p class="mb-1">{{ $information->information_content }}</p>
      <small>{{ $information->nip==null ? "" : "Oleh : ".$information->nip }}</small>
    </a>
    @endforeach
  @else
    <!-- Page Content -->
  <div class="text-center text-dark"><h3>Belum ada Informasi</h3></div>
  @endif

  
</div>  


@stop

