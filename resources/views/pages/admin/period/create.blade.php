@extends('layouts.default')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Buat Periode Pengajuan</li>
  </ol>
</nav>
<form  method="POST" class="daftar" action="{{ route('submit_period') }}">
  {{ csrf_field() }}
  {{ method_field('PATCH') }}
  
</form>

@stop

