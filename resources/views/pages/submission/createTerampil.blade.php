@extends('layouts.default')
@section('content')

<form method="POST" class="daftar" action="{{ route('terampil_submit') }}" enctype="multipart/form-data" >
  {{ csrf_field() }}
  {{ method_field('PATCH') }}
  <nav aria-label="breadcrumb">
    <div class="alert alert-success" role="alert">
     Berkas Pengajuan Terampil
   </div>
 </nav>
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

<h4><strong>Periode Pengajuan</strong></h4>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="startDate">Mulai Periode</label>
    <input class="date form-control" id="startDate" placeholder="dd/mm/yyyy" value="{{ old('startDate') }}" required/>
    <input type="hidden" class="date" id="start" name="startDate"  value="{{ old('startDate') }}" />
  </div>
  <div class="form-group col-md-6">
    <label for="endDate">Akhir Periode</label>
    <input class="date form-control" id="endDate" placeholder="dd/mm/yyyy" value="{{ old('endDate') }}" required/>
    <input type="hidden" class="date" id="end" name="endDate"  value="{{ old('endDate') }}" />
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h3>Berkas Administrasi</small></h3>   
  </div>

  {{-- {{ dd($butir_terampil1A) }} --}}
  <table class="table">
    <tbody>
      @foreach ($item_administrations as $item_administration)
      <tr>
        <td>{{$loop->iteration}}</td>
        <th scope="row">{{ $item_administration->item_name }}</th>
        <td class="text-right">
          <div class="form-group">
            <input accept="application/pdf" type="file" name="{{ $item_administration->id }}" id="{{ $item_administration->id }}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" required />
            <label for="{{ $item_administration->id }}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
            @if ($errors->has('{{ $item_administration->id }}'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first($item_administration->id) }}</strong>
            </span>
            @endif
          </div>
        </td>
        <!-- <td class="text-right"><button class="btn btn-dark">Info</button></td> -->
      </tr>
      @endforeach
      
      
    </tbody>
  </table>
</div>
<br>
@if ($this_user->lastSubmissionID == null)
<small style="color: red;">* Harap memasukkan Angka Kredit (AK) pengajuan sebelumnya pada kolom terakhir</small>
@endif
<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          I . Pendidikan
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        {{-- Table A --}}
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">A . Pendidikan sekolah dan memperoleh ijazah/gelar</li>
          </ol>
        </nav>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Butir Kegiatan</th>
                <th scope="col">Satuan Hasil</th>
                <th class="text-right" scope="col">Angka Kredit</th>
                <th scope="col">Batas Penilaian</th>
                <th scope="col">Pelaksana</th>
                <th scope="col">Bukti Fisik</th>
                <th scope="col">Pengali</th>
                <th class="text-center" scope="col">File</th>
                <th class="text-center" scope="col">Info</th>
                @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($butir_terampil1A as $butir)
              <tr>
                <td>{{$loop->iteration}}</td>
                <th scope="row">{{$butir->item_name}}</th>
                <td >{{$butir->unitResult}}</td>
                <td class="text-right">{{$butir->point}}</td>
                <td >{{$butir->assessmentLimits}}</td>
                <td >{{$butir->executor}}</td>
                <td >{{$butir->physicalEvidence}}</td>
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <br>
        {{-- akhir --}}
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">B . Pendidikan dan Pelatihan fungsional dibidang kepranataan komputer dan memperoleh surat tanda tamat pendidikan dan pelatihan</li>
          </ol>
        </nav>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Butir Kegiatan</th>
                <th scope="col">Satuan Hasil</th>
                <th class="text-right" scope="col">Angka Kredit</th>
                <th scope="col">Batas Penilaian</th>
                <th scope="col">Pelaksana</th>
                <th scope="col">Bukti Fisik</th>
                <th scope="col">Pengali</th>
                <th class="text-center" scope="col">File</th>
                <th class="text-center" scope="col">Info</th>
                @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($butir_terampil1B as $butir)
              <tr>
                <td>{{$loop->iteration}}</td>
                <th scope="row">{{$butir->item_name}}</th>
                <td >{{$butir->unitResult}}</td>
                <td class="text-right">{{$butir->point}}</td>
                <td >{{$butir->assessmentLimits}}</td>
                <td >{{$butir->executor}}</td>
                <td >{{$butir->physicalEvidence}}</td>
               <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <br>
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingTwo">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          II . Operasi Teknologi Informasi
        </button>
      </h2>
    </div>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
      <div class="card-body">
        {{-- Table A --}}
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">A . Pengoperasian Komputer</li>
          </ol>
        </nav>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Butir Kegiatan</th>
                <th scope="col">Satuan Hasil</th>
                <th class="text-right" scope="col">Angka Kredit</th>
                <th scope="col">Batas Penilaian</th>
                <th scope="col">Pelaksana</th>
                <th scope="col">Bukti Fisik</th>
                <th scope="col">Pengali</th>
                <th class="text-center" scope="col">File</th>
                <th class="text-center" scope="col">Info</th>
                @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($butir_terampil2A as $butir)
              <tr>
                <td>{{$loop->iteration}}</td>
                <th scope="row">{{$butir->item_name}}</th>
                <td >{{$butir->unitResult}}</td>
                <td class="text-right">{{$butir->point}}</td>
                <td >{{$butir->assessmentLimits}}</td>
                <td >{{$butir->executor}}</td>
                <td >{{$butir->physicalEvidence}}</td>
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <br>
        {{-- akhir --}}
        {{-- Table B --}}
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">B . Perekaman Data</li>
          </ol>
        </nav>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Butir Kegiatan</th>
                <th scope="col">Satuan Hasil</th>
                <th class="text-right" scope="col">Angka Kredit</th>
                <th scope="col">Batas Penilaian</th>
                <th scope="col">Pelaksana</th>
                <th scope="col">Bukti Fisik</th>
                <th scope="col">Pengali</th>
                <th class="text-center" scope="col">File</th>
                <th class="text-center" scope="col">Info</th>
                @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($butir_terampil2B as $butir)
              <tr>
                <td>{{$loop->iteration}}</td>
                <th scope="row">{{$butir->item_name}}</th>
                <td >{{$butir->unitResult}}</td>
                <td class="text-right">{{$butir->point}}</td>
                <td >{{$butir->assessmentLimits}}</td>
                <td >{{$butir->executor}}</td>
                <td >{{$butir->physicalEvidence}}</td>
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <br>
        {{-- akhir --}}
        {{-- Table C --}}
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">C . Pemasangan dan Pemeliharaan Sistem Komputer dan Sistem Jaringan Komputer</li>
          </ol>
        </nav>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Butir Kegiatan</th>
                <th scope="col">Satuan Hasil</th>
                <th class="text-right" scope="col">Angka Kredit</th>
                <th scope="col">Batas Penilaian</th>
                <th scope="col">Pelaksana</th>
                <th scope="col">Bukti Fisik</th>
                <th scope="col">Pengali</th>
                <th class="text-center" scope="col">File</th>
                <th class="text-center" scope="col">Info</th>
                @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($butir_terampil2C as $butir)
              <tr>
                <td>{{$loop->iteration}}</td>
                <th scope="row">{{$butir->item_name}}</th>
                <td >{{$butir->unitResult}}</td>
                <td class="text-right">{{$butir->point}}</td>
                <td >{{$butir->assessmentLimits}}</td>
                <td >{{$butir->executor}}</td>
                <td >{{$butir->physicalEvidence}}</td>
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <br>
        {{-- akhir --}}

      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingThree">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          III . Implementasi Teknologi Informasi
        </button>
      </h2>
    </div>
    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
      <div class="card-body">
        {{-- Table A --}}
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">A . Pemrograman Dasar</li>
          </ol>
        </nav>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Butir Kegiatan</th>
                <th scope="col">Satuan Hasil</th>
                <th class="text-right" scope="col">Angka Kredit</th>
                <th scope="col">Batas Penilaian</th>
                <th scope="col">Pelaksana</th>
                <th scope="col">Bukti Fisik</th>
                <th scope="col">Pengali</th>
                <th class="text-center" scope="col">File</th>
                <th class="text-center" scope="col">Info</th>
                @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($butir_terampil3A as $butir)
              <tr>
                <td>{{$loop->iteration}}</td>
                <th scope="row">{{$butir->item_name}}</th>
                <td >{{$butir->unitResult}}</td>
                <td class="text-right">{{$butir->point}}</td>
                <td >{{$butir->assessmentLimits}}</td>
                <td >{{$butir->executor}}</td>
                <td >{{$butir->physicalEvidence}}</td>
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <br>
        {{-- akhir --}}
        {{-- Table B --}}
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">B . Pemrograman Menengah</li>
          </ol>
        </nav>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Butir Kegiatan</th>
                <th scope="col">Satuan Hasil</th>
                <th class="text-right" scope="col">Angka Kredit</th>
                <th scope="col">Batas Penilaian</th>
                <th scope="col">Pelaksana</th>
                <th scope="col">Bukti Fisik</th>
                <th scope="col">Pengali</th>
                <th class="text-center" scope="col">File</th>
                <th class="text-center" scope="col">Info</th>
                @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($butir_terampil3B as $butir)
              <tr>
                <td>{{$loop->iteration}}</td>
                <th scope="row">{{$butir->item_name}}</th>
                <td >{{$butir->unitResult}}</td>
                <td class="text-right">{{$butir->point}}</td>
                <td >{{$butir->assessmentLimits}}</td>
                <td >{{$butir->executor}}</td>
                <td >{{$butir->physicalEvidence}}</td>
               <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <br>
        {{-- akhir --}}
        {{-- Table C --}}
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">C . Pemrograman Lanjutan</li>
          </ol>
        </nav>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Butir Kegiatan</th>
                <th scope="col">Satuan Hasil</th>
                <th class="text-right" scope="col">Angka Kredit</th>
                <th scope="col">Batas Penilaian</th>
                <th scope="col">Pelaksana</th>
                <th scope="col">Bukti Fisik</th>
                <th scope="col">Pengali</th>
                <th class="text-center" scope="col">File</th>
                <th class="text-center" scope="col">Info</th>
                @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($butir_terampil3C as $butir)
              <tr>
                <td>{{$loop->iteration}}</td>
                <th scope="row">{{$butir->item_name}}</th>
                <td >{{$butir->unitResult}}</td>
                <td class="text-right">{{$butir->point}}</td>
                <td >{{$butir->assessmentLimits}}</td>
                <td >{{$butir->executor}}</td>
                <td >{{$butir->physicalEvidence}}</td>
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <br>
        {{-- akhir --}}
        {{-- Table D --}}
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">D . Penerapan Sistem Komputer</li>
          </ol>
        </nav>
        <div class="table-responsive">
          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">Butir Kegiatan</th>
                <th scope="col">Satuan Hasil</th>
                <th class="text-right" scope="col">Angka Kredit</th>
                <th scope="col">Batas Penilaian</th>
                <th scope="col">Pelaksana</th>
                <th scope="col">Bukti Fisik</th>
                <th scope="col">Pengali</th>
                <th class="text-center" scope="col">File</th>
                <th class="text-center" scope="col">Info</th>
                @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
              </tr>
            </thead>
            <tbody>
              @foreach ($butir_terampil3D as $butir)
              <tr>
                <td>{{$loop->iteration}}</td>
                <th scope="row">{{$butir->item_name}}</th>
                <td >{{$butir->unitResult}}</td>
                <td class="text-right">{{$butir->point}}</td>
                <td >{{$butir->assessmentLimits}}</td>
                <td >{{$butir->executor}}</td>
                <td >{{$butir->physicalEvidence}}</td>
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <br>
        {{-- akhir --}}
      </div>
    </div>
  </div>
  <div class="card">
    <div class="card-header" id="headingFour">
      <h2 class="mb-0">
        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
          IV . Pengembangan Profesi
        </button>
      </h2>
    </div>
    <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
      <div class="card-body">
       {{-- Table A --}}
       <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">A . Pembuatan Karya Tulis / Karya Ilmiah dibidang Teknologi Informasi</li>
        </ol>
      </nav>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Butir Kegiatan</th>
              <th scope="col">Satuan Hasil</th>
              <th class="text-right" scope="col">Angka Kredit</th>
              <th scope="col">Batas Penilaian</th>
              <th scope="col">Pelaksana</th>
              <th scope="col">Bukti Fisik</th>
              <th scope="col">Pengali</th>
              <th class="text-center" scope="col">File</th>
              <th class="text-center" scope="col">Info</th>
              @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
            </tr>
          </thead>
          <tbody>
            @foreach ($butir_terampil4A as $butir)
            <tr>
              <td>{{$loop->iteration}}</td>
              <th scope="row">{{$butir->item_name}}</th>
              <td >{{$butir->unitResult}}</td>
              <td class="text-right">{{$butir->point}}</td>
              <td >{{$butir->assessmentLimits}}</td>
              <td >{{$butir->executor}}</td>
              <td >{{$butir->physicalEvidence}}</td>
              <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <br>
      {{-- akhir --}}
      {{-- Table B --}}
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">B . Penyusunan Petunjuk Teknis Pelaksanaan Pengelolaan Kegiatan Teknologi Informasi</li>
        </ol>
      </nav>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Butir Kegiatan</th>
              <th scope="col">Satuan Hasil</th>
              <th class="text-right" scope="col">Angka Kredit</th>
              <th scope="col">Batas Penilaian</th>
              <th scope="col">Pelaksana</th>
              <th scope="col">Bukti Fisik</th>
              <th scope="col">Pengali</th>
              <th class="text-center" scope="col">File</th>
              <th class="text-center" scope="col">Info</th>
              @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
            </tr>
          </thead>
          <tbody>
            @foreach ($butir_terampil4B as $butir)
            <tr>
              <td>{{$loop->iteration}}</td>
              <th scope="row">{{$butir->item_name}}</th>
              <td >{{$butir->unitResult}}</td>
              <td class="text-right">{{$butir->point}}</td>
              <td >{{$butir->assessmentLimits}}</td>
              <td >{{$butir->executor}}</td>
              <td >{{$butir->physicalEvidence}}</td>
             <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <br>
      {{-- akhir --}}
      {{-- Table C --}}
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">C . Penerjemahan / Penyaduran Buku dan Bahan-Bahan Lain di Bidang Kegiatan Teknologi Informasi</li>
        </ol>
      </nav>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">No</th>
              <th scope="col">Butir Kegiatan</th>
              <th scope="col">Satuan Hasil</th>
              <th class="text-right" scope="col">Angka Kredit</th>
              <th scope="col">Batas Penilaian</th>
              <th scope="col">Pelaksana</th>
              <th scope="col">Bukti Fisik</th>
              <th scope="col">Pengali</th>
              <th class="text-center" scope="col">File</th>
              <th class="text-center" scope="col">Info</th>
              @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
            </tr>
          </thead>
          <tbody>
            @foreach ($butir_terampil4C as $butir)
            <tr>
              <td>{{$loop->iteration}}</td>
              <th scope="row">{{$butir->item_name}}</th>
              <td >{{$butir->unitResult}}</td>
              <td class="text-right">{{$butir->point}}</td>
              <td >{{$butir->assessmentLimits}}</td>
              <td >{{$butir->executor}}</td>
              <td >{{$butir->physicalEvidence}}</td>
              <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <br>
      {{-- akhir --}}
    </div>
  </div>
</div>
<div class="card">
  <div class="card-header" id="headingFive">
    <h2 class="mb-0">
      <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
        V . Pendukung Kegiatan Pranata Komputer
      </button>
    </h2>
  </div>
  <div id="collapseFive" class="collapse" aria-labelledby="headingFive" data-parent="#accordionExample">
    <div class="card-body">
     {{-- Table A --}}
     <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">A . Mengajar atau Melatih dibidang Teknologi Informasi</li>
      </ol>
    </nav>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Butir Kegiatan</th>
            <th scope="col">Satuan Hasil</th>
            <th class="text-right" scope="col">Angka Kredit</th>
            <th scope="col">Batas Penilaian</th>
            <th scope="col">Pelaksana</th>
            <th scope="col">Bukti Fisik</th>
            <th scope="col">Pengali</th>
            <th class="text-center" scope="col">File</th>
            <th class="text-center" scope="col">Info</th>
            @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
          </tr>
        </thead>
        <tbody>
          @foreach ($butir_terampil5A as $butir)
          <tr>
            <td>{{$loop->iteration}}</td>
            <th scope="row">{{$butir->item_name}}</th>
            <td >{{$butir->unitResult}}</td>
            <td class="text-right">{{$butir->point}}</td>
            <td >{{$butir->assessmentLimits}}</td>
            <td >{{$butir->executor}}</td>
            <td >{{$butir->physicalEvidence}}</td>
            <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <br>
    {{-- akhir --}}
    {{-- Table B --}}
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">B . Peran serta dalam Seminar / Lokakarya / Konferensi</li>
      </ol>
    </nav>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Butir Kegiatan</th>
            <th scope="col">Satuan Hasil</th>
            <th class="text-right" scope="col">Angka Kredit</th>
            <th scope="col">Batas Penilaian</th>
            <th scope="col">Pelaksana</th>
            <th scope="col">Bukti Fisik</th>
            <th scope="col">Pengali</th>
            <th class="text-center" scope="col">File</th>
            <th class="text-center" scope="col">Info</th>
            @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
          </tr>
        </thead>
        <tbody>
          @foreach ($butir_terampil5B as $butir)
          <tr>
            <td>{{$loop->iteration}}</td>
            <th scope="row">{{$butir->item_name}}</th>
            <td >{{$butir->unitResult}}</td>
            <td class="text-right">{{$butir->point}}</td>
            <td >{{$butir->assessmentLimits}}</td>
            <td >{{$butir->executor}}</td>
            <td >{{$butir->physicalEvidence}}</td>
           <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <br>
    {{-- akhir --}}
    {{-- Table C --}}
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">C . Keanggotaan dalam Tim Penilai JFPK</li>
      </ol>
    </nav>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Butir Kegiatan</th>
            <th scope="col">Satuan Hasil</th>
            <th class="text-right" scope="col">Angka Kredit</th>
            <th scope="col">Batas Penilaian</th>
            <th scope="col">Pelaksana</th>
            <th scope="col">Bukti Fisik</th>
            <th scope="col">Pengali</th>
            <th class="text-center" scope="col">File</th>
            <th class="text-center" scope="col">Info</th>
            @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
          </tr>
        </thead>
        <tbody>
          @foreach ($butir_terampil5C as $butir)
          <tr>
            <td>{{$loop->iteration}}</td>
            <th scope="row">{{$butir->item_name}}</th>
            <td >{{$butir->unitResult}}</td>
            <td class="text-right">{{$butir->point}}</td>
            <td >{{$butir->assessmentLimits}}</td>
            <td >{{$butir->executor}}</td>
            <td >{{$butir->physicalEvidence}}</td>
            <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <br>
    {{-- akhir --}}
    {{-- Table D --}}
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">D . Keanggotaan dalam Organisasi Profesi</li>
      </ol>
    </nav>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Butir Kegiatan</th>
            <th scope="col">Satuan Hasil</th>
            <th class="text-right" scope="col">Angka Kredit</th>
            <th scope="col">Batas Penilaian</th>
            <th scope="col">Pelaksana</th>
            <th scope="col">Bukti Fisik</th>
            <th scope="col">Pengali</th>
            <th class="text-center" scope="col">File</th>
            <th class="text-center" scope="col">Info</th>
            @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
          </tr>
        </thead>
        <tbody>
          @foreach ($butir_terampil5D as $butir)
          <tr>
            <td>{{$loop->iteration}}</td>
            <th scope="row">{{$butir->item_name}}</th>
            <td >{{$butir->unitResult}}</td>
            <td class="text-right">{{$butir->point}}</td>
            <td >{{$butir->assessmentLimits}}</td>
            <td >{{$butir->executor}}</td>
            <td >{{$butir->physicalEvidence}}</td>
            <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <br>
    {{-- akhir --}}
    {{-- Table E --}}
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">E . Perolehan Piagam Kehormatan</li>
      </ol>
    </nav>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Butir Kegiatan</th>
            <th scope="col">Satuan Hasil</th>
            <th class="text-right" scope="col">Angka Kredit</th>
            <th scope="col">Batas Penilaian</th>
            <th scope="col">Pelaksana</th>
            <th scope="col">Bukti Fisik</th>
            <th scope="col">Pengali</th>
            <th class="text-center" scope="col">File</th>
            <th class="text-center" scope="col">Info</th>
            @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
          </tr>
        </thead>
        <tbody>
          @foreach ($butir_terampil5E as $butir)
          <tr>
            <td>{{$loop->iteration}}</td>
            <th scope="row">{{$butir->item_name}}</th>
            <td >{{$butir->unitResult}}</td>
            <td class="text-right">{{$butir->point}}</td>
            <td >{{$butir->assessmentLimits}}</td>
            <td >{{$butir->executor}}</td>
            <td >{{$butir->physicalEvidence}}</td>
            <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <br>
    {{-- akhir --}}
    {{-- Table F --}}
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">F . Perolehan Gelar Kesarjanaan lainnya</li>
      </ol>
    </nav>
    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">No</th>
            <th scope="col">Butir Kegiatan</th>
            <th scope="col">Satuan Hasil</th>
            <th class="text-right" scope="col">Angka Kredit</th>
            <th scope="col">Batas Penilaian</th>
            <th scope="col">Pelaksana</th>
            <th scope="col">Bukti Fisik</th>
            <th scope="col">Pengali</th>
            <th class="text-center" scope="col">File</th>
            <th class="text-center" scope="col">Info</th>
            @if ($this_user->lastSubmissionID == null)
                <th class="text-center" scope="col">AK pengajuan terakhir</th>
                @endif
          </tr>
        </thead>
        <tbody>
          @foreach ($butir_terampil5F as $butir)
          <tr>
            <td>{{$loop->iteration}}</td>
            <th scope="row">{{$butir->item_name}}</th>
            <td >{{$butir->unitResult}}</td>
            <td class="text-right">{{$butir->point}}</td>
            <td >{{$butir->assessmentLimits}}</td>
            <td >{{$butir->executor}}</td>
            <td >{{$butir->physicalEvidence}}</td>
            <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."times" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."times") ? ' is-invalid' : '' }}" name="{{ $butir->id."times" }}" value="{{ old($butir->id."times") }}">
                  </div>
                </td>
                <td class="text-center">
                  <div class="form-group">
                    <input accept="application/pdf" type="file" name="{{$butir->id}}" id="{{$butir->id}}" class="inputfile inputfile-1" data-multiple-caption="{count} files selected" />
                    <label for="{{$butir->id}}"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>Cari&hellip;</span></label>
                    @if ($errors->has('{{$butir->id}}'))
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $errors->first($butir->id) }}</strong>
                    </span>
                    @endif
                  </div>
                </td>
                <td >
                  <a href="#" type="button" title="Info" data-mytitleinfo="{{ $butir->item_name }}" data-myinfo="{{ $butir->info }}"  data-type="{{ $butir->type }}" data-toggle="modal" data-target="#infoModal" class="btn btn-dark">Info</a>
                </td>
                @if ($this_user->lastSubmissionID == null)
                <td >
                  <div class="form-group">
                    <input onkeypress='validate(event)'  id="{{ $butir->id."previous" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."previous") ? ' is-invalid' : '' }}" name="{{ $butir->id."previous" }}" value="{{ old($butir->id."previous") }}">
                  </div>
                </td>
                @endif
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <br>
    {{-- akhir --}}
  </div>
</div>
</div>
</div>
<br>
<div class="form-group no-margin">
  <input type="submit" name="submitbutton" class="btn btn-secondary btn-block" value="Simpan"/>
</div>

<div class="form-group no-margin">
  <input type="submit" name="submitbutton" class="btn btn-primary btn-block" value="Ajukan"/>
</div>

</form>

<!-- Logout Modal-->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><p id="p1"></p></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body">
        <p id="p2">isi</p>
      </div>
      <div class="modal-footer">
        <p id="by"></p>
      </div>
    </div>
  </div>
</div>


<script>
  function validate(evt) {
    var theEvent = evt || window.event;

                          // Handle paste
                          if (theEvent.type === 'paste') {
                            key = event.clipboardData.getData('text/plain');
                          } else {
                          // Handle key press
                          var key = theEvent.keyCode || theEvent.which;
                          key = String.fromCharCode(key);
                        }
                        var regex = /[0-9]|\./;
                        if( !regex.test(key) ) {
                          theEvent.returnValue = false;
                          if(theEvent.preventDefault) theEvent.preventDefault();
                        }
                      }
                      


                    </script>

                    <script>
                      $("#startDate").datepicker({
                        dateFormat: "dd/MM/yy",
                        altField: "#start",
                        altFormat: "yy-mm-dd"
                      })
                    </script>

                    <script>
                      $("#endDate").datepicker({
                        dateFormat: "dd/MM/yy",
                        altField: "#end",
                        altFormat: "yy-mm-dd"
                      })
                    </script>

                    @stop

