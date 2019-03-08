@extends('layouts.default')
@section('content')
<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Detail Berkas Final Penilaian : {{ "Berkas ".strtoupper($penilaian_submissions->id)." | ID Tim : ".strtoupper($penilaian_submissions->team_id)." | Anggota : ".$penilaian_submissions->position }}</li>
  </ol>
</nav>

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
          <td>Anggota {{ $individual_score->position }}</td>
          <td>{{ $individual_score->individual_score==null ? "Belum ada nilai" : $individual_score->individual_score }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </table>
</div>

<div class="panel-group" id="accordion">
  @foreach ($penilaian_files as $index => $penilaian_file)
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapse{{ $index+1 }}">
          {{ $penilaian_file->id." - ".$penilaian_file->item_name }}</a>
        </h4>
      </div>
      <div id="collapse{{ $index+1 }}" class="panel-collapse collapse in">
        <div class="panel-body">
          <div class="table-responsive">
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th scope="col">Unit Hasil</th>
                  <td>{{ $penilaian_file->unitResult }}</td>
                </tr>
                <tr>
                  <th scope="col">Poin</th>
                  <td>{{ $penilaian_file->point }}</td>
                </tr>
                <tr>
                  <th scope="col">Batas Penilaian</th>
                  <td>{{ $penilaian_file->assessmentLimits }}</td>
                </tr>
                <tr>
                  <th scope="col">Pelaksana</th>
                  <td>{{ $penilaian_file->executor }}</td>
                </tr>
                <tr>
                  <th scope="col">Bukti Fisik</th>
                  <td>{{ $penilaian_file->physicalEvidence }}</td>
                </tr>
                <tr>
                  <th scope="col">Pengali</th>
                  <td>{{ $penilaian_file->times }}</td>
                </tr><tr>
                  <th scope="col">Bukti Pengajuan</th>
                  <td><a href="#" id="{{ $penilaian_file->id }}">Lihat</a>  <div id="{{ "di".$penilaian_file->id }}" style="display:none">
                    <div>
                      <iframe onload='javascript:(function(o){o.style.height=o.contentWindow.document.body.scrollHeight+"px";}(this));' style="height:500px;width:150%;border:none;overflow:hidden;" src="{{ URL::to('/') . '/dupakFiles/' . $penilaian_file->fileUrl }}"></iframe>
                    </div>
                  </div>  |   <a href="{{  asset('dupakFiles/'.$penilaian_file->fileUrl)}}" >Download</a>
                  <script language="javascript" type="text/javascript">
                    $(document).ready(function() {
                      $('{{ "#".$penilaian_file->id }}').click(function(){
                        $("{{ "#di".$penilaian_file->id }}").dialog();
                      }); 
                    });      

                  </script>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    @endforeach

  </div> 

  <br>
  <form action="{{ route('submit_individual_score',$id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <div class="form-group">
      <label for="penilaian_individual">Berikan Nilai Akhir</label>
      <input type="number" min="1" step="any" class="form-control" id="penilaian_individual" name="penilaian_individual" aria-describedby="emailHelp" placeholder="Nilai akhir sidang">
      <small id="penilaian_individual_help" class="form-text text-muted">Penilaian ini adalah hasil akhir dari keseluruhan sidang.</small>
    </div>

    <br>

    <div class="container">
      <div class="row justify-content-md-center">
        <div class="col-md-auto">
          <input class="btn btn-danger" name="submitbutton" type="submit" value="Tolak" />
          <input class="btn btn-primary" name="submitbutton" type="submit" value="Ajukan" />
        </div>
      </div>
    </div>
  </form>
  <br>
  @stop
