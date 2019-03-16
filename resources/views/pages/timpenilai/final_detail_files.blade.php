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
              <th scope="col">Item</th>
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
              <td><strong>{{ strtoupper(substr($butir->id, 1)) }}</strong></td>
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
                @if ($penilaian_submissions->submission_score == null)
                <div class="form-group">
                 <input onkeypress='validate(event)'  id="{{ $butir->id."timesPenilai" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."timesPenilai") ? ' is-invalid' : '' }}" name="{{ $butir->id."timesPenilai" }}" value="{{ old($butir->id."timesPenilai") }}" required>
               </div>
               @else
               @foreach ($check_available_score as $check_available)
               @if ($check_available->item_id == $butir->id)
               <p class="text-center">{{ $check_available->times }}</p>
               @endif
               @endforeach
               @endif

             </td>
             <td >
              @if ($penilaian_submissions->submission_score == null)
              <div class="form-group">
               <input onkeypress='validate(event)'  id="{{ $butir->id."item_score" }}" min="0" maxlength="18" type="text" class="form-control{{ $errors->has($butir->id."item_score") ? ' is-invalid' : '' }}" name="{{ $butir->id."item_score" }}" value="{{ old($butir->id."item_score") }}" required>
             </div>
             @else
             @foreach ($check_available_score as $check_available)
             @if ($check_available->item_id == $butir->id)
             <p class="text-center">{{ $check_available->item_score }}</p>
             @endif
             @endforeach
             @endif
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

@if ($check_score_null->count() == null)
@if ($score_submission_check->submission_score == null)
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-md-auto">
      <input class="btn btn-danger" name="submitbutton" type="submit" value="Tolak" />
      <input class="btn btn-primary" name="submitbutton" type="submit" value="Ajukan" />
    </div>
  </div>
</div>
@else
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-md-auto">
      <input class="btn btn-primary" name="submitbutton" type="submit" value="Rincian PAK" />
      <input class="btn btn-dark" name="submitbutton" type="submit" value="Download" />
      <input class="btn btn-success" name="submitbutton" type="submit" value="Teruskan" />
    </div>
  </div>
</div>
@endif

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
