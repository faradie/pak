@extends('layouts.default')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item active" aria-current="page">Pengaturan</li>
    </ol>
  </nav>
  <div class="row">
          <div class="col-sm-3 col-md-3 col-xs-12">
                  <div class="card">
                          <img src="{{ $user->photoUrl == null ? asset('dupakFiles/avatar_employee.png') : asset('dupakFiles/' . $user->photoUrl )}}" class="card-img-top img-thumbnail" alt="Responsive image">
                  </div>
          </div>
              <div class="col-sm-9 col-md-9 col-xs-12">
                <form class="" action="{{ route('user.edit',$user) }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PATCH') }}
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="inputNama">Nama</label>
                        <input type="text" class="form-control" id="inputNama" placeholder="Nama" name="inputNama" value="{{ old('nama') ?? $user->nama }}">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="inputEmail">Email</label>
                        <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="inputEmail" value="{{ old('email') ?? $user->email }}">
                      </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPhoto">Upload Foto</label>
                        <input type="file" class="form-control-file" id="inputPhoto" name="inputPhoto">
                      </div>
                    <div class="form-group">
                      <label for="inputAddress">Alamat</label>
                      <input type="text" class="form-control" id="inputAddress" name="inputAddress" placeholder="Jl Raya Bojong Gede No.123 Jakarta Utara 11750" value="{{ old('address') ?? $user->address }}">
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-4">
                        <label for="inputPlace">Tempat Lahir</label>
                        <input type="text" class="form-control" id="inputPlace" name="inputPlace" value="{{ old('birth_place') ?? $user->birth_place }}" placeholder="Mojokerto">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputDate">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="inputDate" id="inputDate" value="{{ old('birth_date') ?? $user->birth_date }}">
                      </div>
                      <div class="form-group col-md-4">
                        <label for="inputGender">Jenis Kelamin</label>
                        <select id="inputGender" name="inputGender" class="form-control">
                          <option>Pilih...</option> 
                          <option value="Laki-Laki" {{ $user->gender == "Laki-Laki" ? "selected" : "" }}>Laki-Laki</option>
                          <option value="Perempuan" {{ $user->gender == "Perempuan" ? "selected" : "" }}>Perempuan</option>
                        </select>
                      </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" value="save" >Simpan</button>
                  </form>   
              </div>
  </div>
@stop