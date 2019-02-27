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
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="startDate">Mulai Periode</label>
      <input type="date" class="form-control" name="startDate" id="startDate" value="{{ old('startDate') }}" required>
    </div>
    <div class="form-group col-md-6">
      <label for="endDate">Akhir Periode</label>
      <input type="date" class="form-control" name="endDate" id="endDate" value="{{ old('endDate') }}" required>
    </div>
    <input class="btn btn-info btn-block" type="submit" value="Buat" />
  </form>

  @stop

