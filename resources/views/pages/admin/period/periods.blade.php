@extends('layouts.default')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Kelola Periode Pengajuan</li>
  </ol>
</nav>
<form action="{{ route('create_period') }}"><input class="btn btn-info btn-block" type="submit" value="Buat Periode Pengajuan" /></form>
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
<div class="table-responsive">
  <table id="myTable" class="table table-striped">
    <thead>
      <tr>
        <th scope="col">No
        </th>
        <th scope="col">Mulai
        </th>
        <th scope="col">Akhir
        </th>
        <th scope="col">Status
        </th>
        <th scope="col">Dibuat pada
        </th>
        <th scope="col">Action
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($periods as $period)
      <tr>
        <th  scope="row">{{$loop->iteration}}</th >
        <td>{{ \Carbon\Carbon::parse($period->starts)->format('d/M/Y')}}</td>
        <td>{{\Carbon\Carbon::parse($period->ends)->format('d/M/Y')}}</td>
        <td>
          @if (\Carbon\Carbon::parse($period->starts)->timestamp - time() < 0 && time() - \Carbon\Carbon::parse($period->ends)->timestamp < 0 )
          Aktif
          @else
          Non-Aktif
          @endif
        </td>
        <td>{{$period->created_at}}</td>
        <td >
          <div class="btn-group" role="group" aria-label="...">
            <a class="btn btn-dark" name="editData" type="button" value="Edit" href="{{ route('edit_period',$period->id) }}">Edit</a>
            <a class="btn btn-danger" data-toggle="modal" data-nameid="{{$period->id}}" data-target="#deletePeriodModal" href="#">Hapus</a>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>


  </table>
</div>


@if ($periods->count() != null)
<!-- periode delete Modal-->
<div class="modal fade" id="deletePeriodModal" tabindex="-1" role="dialog" aria-labelledby="deletePeriodModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deletePeriodModal">Konfirmasi</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <form action="{{ route('delete_period','test') }}" method="POST">
        {{ method_field('delete') }}
        {{ csrf_field() }}
        <div class="modal-body">Apakah anda yakin ingin menghapus periode?
          <input type="hidden" name="name_id" id="name_id" value="">
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <button class="btn btn-danger" type="submit">Hapus</button>
        </div>
      </form>

    </div>
  </div>
</div>
@endif


@stop

