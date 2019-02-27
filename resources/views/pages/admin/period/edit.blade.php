@extends('layouts.default')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Edit Periode Pengajuan</li>
  </ol>
</nav>
<form  method="POST" class="daftar" action="{{ route('submit_period_edit',$period->id) }}">
  {{ csrf_field() }}
  {{ method_field('PATCH') }}
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="startDate">Mulai Periode</label>
      <input type="date" class="form-control" name="startDate" id="startDate" value="{{ old('startDate') ?? $period->starts }}" required>
    </div>
    <div class="form-group col-md-6">
      <label for="endDate">Akhir Periode</label>
      <input type="date" class="form-control" name="endDate" id="endDate" value="{{ old('endDate') ?? $period->ends }}" required>
    </div>
    <input class="btn btn-info btn-block" type="submit" value="Edit" />
  </form>

  @stop

