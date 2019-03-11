@extends('layouts.default')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Detail Berkas Final Penilaian : {{ "Berkas ".strtoupper($penilaian_submissions->id)." | ID Tim : ".strtoupper($penilaian_submissions->team_id)." | Anggota : ".$penilaian_submissions->position }}</li>
  </ol>
</nav>
<h4>Periode : {{ \Carbon\Carbon::parse($penilaian_submissions->starts)->format('d / M / Y')." - ".\Carbon\Carbon::parse($penilaian_submissions->ends)->format('d / M / Y') }}</h4>
<div class="table-responsive">
  <table class="table">
    <table class="table table-hover table-primary">
      <thead>
        <tr>
          <th scope="col">No</th>
          <th scope="col">Anggota</th>
          <th scope="col">Nilai</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($individual_scores as $individual_score)
        <tr>
          <th scope="row">{{$loop->iteration}}</th>
          <td>{{ $individual_score->nama }} : Anggota {{ $individual_score->position }}</td>
          <td>{{ $individual_score->individual_score==null ? "Belum ada nilai" : $individual_score->individual_score }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </table>
</div>

<form action="{{ route('submit_final_score',$id) }}" method="post">
  {{ csrf_field() }}
  {{ method_field('PATCH') }}
  <div class="card">
    <div class="card-body">
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
              <th scope="col">Pengali Pemohon</th>
              <th class="text-center" scope="col">File</th>
              <th class="text-center col-md-2" scope="col">Pengali Penilai</th>
              <th class="text-center col-md-2" scope="col">Nilai Butir</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($penilaian_files as $index => $butir)
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
                  {{ $butir->times }}
                </div>                     
              </td>
              <td class="text-center">
                <a href="#" id="{{ $butir->id }}">Lihat</a>  <div id="{{ "di".$butir->id }}" style="display:none">
                  <div>
                    <iframe onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));' style="height:500px;width:150%;border:none;overflow:hidden;" src="{{ URL::to('/') . '/dupakFiles/' . $butir->fileUrl }}"></iframe>
                  </div>
                </div>
                <a href="{{  asset('dupakFiles/'.$butir->fileUrl)}}" >Download</a>
                <script language="javascript" type="text/javascript">
                  $(document).ready(function() {
                    $('{{ "#".$butir->id }}').click(function(){
                      $("{{ "#di".$butir->id }}").dialog();
                    }); 
                  });      

                </script>
              </td>
              <td >
                <div class="form-group">
                 <input onkeypress='validate(event)'  id="{{ $butir->id."timesPenilai" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."timesPenilai") ? ' is-invalid' : '' }}" name="{{ $butir->id."timesPenilai" }}" value="{{ old($butir->id."timesPenilai") }}" required>
                 {{-- @if ($errors->has('{{ $butir->id."timesPenilai" }}'))
                 <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first($butir->id."timesPenilai") }}</strong>
                </span>
                @endif --}}
              </div>
            </td>
            <td >
              <div class="form-group">
               <input onkeypress='validate(event)'  id="{{ $butir->id."item_score" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."item_score") ? ' is-invalid' : '' }}" name="{{ $butir->id."item_score" }}" value="{{ old($butir->id."item_score") }}" required>
               {{-- @if ($errors->has('nip'))
               <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('nip') }}</strong>
              </span>
              @endif --}}
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  <br>
</div>
</div>

<br>

@if ($penilaian_submissions->lastSubmissionID == null)
<div class="alert alert-success">
 <h5>Dikarenakan belum adanya data pengajuan sebelumnya, maka lengkapi dahulu data pengajuan sebelumnya untuk user {{ $penilaian_submissions->nip }} </h5>
</div>

<div class="accordion" id="accordionExample">
  <div class="card">
    <div class="card-header" id="headingOne">
      <h2 class="mb-0">
        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Butir-butir Terampil
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Terampil</li>
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
                <th scope="col" class="col-md-2">Pengali</th>
                <th scope="col" class="col-md-2">Nilai Butir</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($terampil_items as $butir)
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
                    <input onkeypress='validate(event)'  id="{{ $butir->id.'previousTimes_terampil' }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id.'previousTimes_terampil') ? ' is-invalid' : '' }}" name="{{ $butir->id.'previousTimes_terampil' }}" value="{{ old($butir->id.'previousTimes_terampil') }}" >
                 </div>
               </td>
               <td>
                <div class="form-group">
                 <input onkeypress='validate(event)'  id="{{ $butir->id.'previousScore_terampil' }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id.'previousScore_terampil') ? ' is-invalid' : '' }}" name="{{ $butir->id.'previousScore_terampil' }}" value="{{ old($butir->id.'previousScore_terampil') }}" >
               </div>
             </td>
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
  <div class="card-header" id="headingOne">
    <h2 class="mb-0">
      <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
        Butir-butir Ahli
      </button>
    </h2>
  </div>

  <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
    <div class="card-body">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">Ahli</li>
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
              <th scope="col" class="col-md-2">Pengali</th>
              <th scope="col" class="col-md-2">Nilai Butir</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($terampil_items as $butir)
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
                 <input onkeypress='validate(event)'  id="{{ $butir->id.'previousTimes_ahli' }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id.'previousTimes_ahli') ? ' is-invalid' : '' }}" name="{{ $butir->id.'previousTimes_ahli' }}" value="{{ old($butir->id.'previousTimes_ahli') }}" >
               </div>                    
             </td>
             <td>
              <div class="form-group">
               <input onkeypress='validate(event)'  id="{{ $butir->id.'previousScore_ahli' }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id.'previousScore_ahli') ? ' is-invalid' : '' }}" name="{{ $butir->id.'previousScore_ahli' }}" value="{{ old($butir->id.'previousScore_ahli') }}" >
             </div>
           </td>
         </tr>
         @endforeach
       </tbody>
     </table>
   </div>
   <br>
 </div>
</div>
</div>
</div>
@endif

<br>

@if ($check_score_null->count() == null)
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-md-auto">
      <input class="btn btn-danger" name="submitbutton" type="submit" value="Tolak" />
      <input class="btn btn-primary" name="submitbutton" type="submit" value="Ajukan" />
    </div>
  </div>
</div>
@endif


</form>
<br>

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
@stop
