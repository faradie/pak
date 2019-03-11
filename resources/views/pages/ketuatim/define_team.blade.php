@extends('layouts.default')
@section('content')

<div class="card">
  <div class="card-header">
    <h3>Tentukan Tim Penilai</h3>   
  </div>
  <form action="{{ route('define_teams',$submissions->id) }}" method="post">
    {{ csrf_field() }}
    {{ method_field('PATCH') }}
    <table class="table">
      <tbody>
        <tr>
          <th scope="row">*Anggota 1</th>
          <td>
            <select id="anggota1" name="anggota1" class="js-example-basic-single js-states form-control" required>
              <option value="">Pilih..</option>
              @foreach ($usersTIM as $userTIM)
              <option value="{{ $userTIM->id }}" >{{strtoupper($userTIM->nama)}}</option>
              @endforeach
            </select>
            @if ($errors->has('anggota1'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('anggota1') }}</strong>
            </span>
            @endif
          </td>
        </tr>
        <tr>
          <th scope="row">Anggota 2</th>
          <td>
            <select id="anggota2" name="anggota2" class="js-example-basic-single js-states form-control" >
              <option value="">Pilih..</option>
              @foreach ($usersTIM as $userTIM)
              <option value="{{ $userTIM->id }}" >{{strtoupper($userTIM->nama)}}</option>
              @endforeach
            </select>
            @if ($errors->has('anggota2'))
            <span class="invalid-feedback" role="alert">
              <strong>{{ $errors->first('anggota2') }}</strong>
            </span>
            @endif
          </td>
        </tr>
        <tr>
          <th scope="row">Anggota 3</th>
          <td>
           <select id="anggota3" name="anggota3" class="js-example-basic-single js-states form-control" >
            <option value="">Pilih..</option>
            @foreach ($usersTIM as $userTIM)
            <option value="{{ $userTIM->id }}" >{{strtoupper($userTIM->nama)}}</option>
            @endforeach
          </select>
          @if ($errors->has('anggota3'))
          <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('anggota3') }}</strong>
          </span>
          @endif
        </td>
      </tr>

    </tbody>
  </table>

</div>
<br>
<input class="btn btn-primary btn-block" name="submitbutton" type="submit" value="Buat" />
<br>
{{-- <div class="container">
  <div class="row justify-content-md-center">
    <div class="col-md-auto">
      <input class="btn btn-danger" name="submitbutton" type="submit" value="Tolak" />
    </div>
  </div>
</div> --}}
</form>
<script>
  $(document).ready(function(){  
    $("select").change(function() {   
      $("select").not(this).find("option[value="+ $(this).val() + "]").attr('disabled', true);
    }); 
  }); 
</script>
@stop
