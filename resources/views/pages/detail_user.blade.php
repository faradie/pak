@extends('layouts.default')
@section('content')
<div class="row justify-content-md-center"">
  <div class=" col-md-3 col-xs-12">
    <div class="card">
      <img src="{{ $detail_user->photoUrl == null ? asset('dupakFiles/avatar_employee.png') : asset('dupakFiles/' . $detail_user->photoUrl )}}" class="card-img-top img-thumbnail" alt="Responsive image">
    </div>
  </div>
</div>
<br>
<div class="card">
  <div class="card-header">
    <h3>{{$detail_user->id}} - <small class="text-muted">{{$detail_user->nama}}</small></h3>   
  </div>
  <table class="table">
    <tbody>
      <tr>
        <th scope="row">Email</th>
        <td>{{$detail_user->email}}</td>
      </tr>
      <tr>
        <th scope="row">Tempat, tanggal lahir</th>
        <td>{{$detail_user->birth_place}}, {{$detail_user->birth_date}}</td>
      </tr>
      <tr>
        <th scope="row">Jenis Kelamin</th>
        <td>{{$detail_user->gender == null ? 'Jenis kelamin belum diatur' : $detail_user->gender}}</td>
      </tr>
      <tr>
        <th scope="row">Alamat</th>
        <td>{{$detail_user->address}}</td>
      </tr>
      <tr>
        <th scope="row">Nomor Seri Kartu Pegawai</th>
        <td>{{$detail_user->CardSerialNumber}}</td>
      </tr>
      <tr>
        <th scope="row">Unit</th>
        <td>{{$unitsName->workUnit}}</td>
      </tr>
      <tr>
        <th scope="row">Jabatan Pranata Komputer</th>
        <td>{{$positionName->group}} - {{$positionName->position}}</td>
      </tr>
      <tr>
        <th scope="row">Kredit</th>
        <td>{{$detail_user->credit}}</td>
      </tr>
      <tr>
        <th scope="row">Daftar Pada</th>
        <td>{{$detail_user->created_at}}</td>
      </tr>
    </tbody>
  </table>

</div>
<br>

<br>
<div class="container">
  <div id="viewpdf"></div>
</div>

<br>

<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-md-auto">
      <form action="{{ route('acccept_applicant',$detail_user->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('PATCH') }}
        <input class="btn btn-danger" name="submitbutton" type="submit" value="Tolak" />
        <input class="btn btn-primary" name="submitbutton" type="submit" value="Terima" />
      </form>
      
    </div>
  </div>
</div>



<script src="{{ asset('assets/js/pdfobject.min.js') }}"></script>
<script>
 var viewer = $('#viewpdf');
 PDFObject.embed('{{ URL::to('/') . '/dupakFiles/' . $skUrls->skUrl }}', viewer);
</script>
@stop
