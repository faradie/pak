@extends('layouts.default')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Form Buat Informasi</li>
  </ol>
</nav>
<form  method="POST" class="daftar" action="{{ route('submit_information') }}">
  {{ csrf_field() }}
  {{ method_field('PATCH') }}
  <div class="form-group">
    <label for="information_title">Judul Informasi</label>
    <input type="text" class="form-control" id="information_title" name="information_title" placeholder="Ex : Informasi Pembukaan Periode">
    @if ($errors->has('information_title'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('information_title') }}</strong>
    </span>
    @endif
  </div>
  <div class="form-group">
    <label for="information_content">Isi Informasi</label>
    <textarea type="text" class="form-control" rows="3" id="information_content" name="information_content" placeholder="Ex : Penjelasan lebih detail dari isi informasi"></textarea>
    @if ($errors->has('information_content'))
    <span class="invalid-feedback" role="alert">
      <strong>{{ $errors->first('information_content') }}</strong>
    </span>
    @endif
  </div>
  <input class="btn btn-info btn-block" type="submit" value="Buat Informasi" />
</form>

@stop

