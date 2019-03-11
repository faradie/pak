@extends('layouts.authlayout')

@section('content')
<h4 class="card-title">Register</h4>
@if(session()->has('erro_login'))
<div class="alert alert-danger">
  {{ session()->get('erro_login') }}
</div>
@endif
<form method="POST" class="daftar" action="{{ route('register') }}" enctype="multipart/form-data">
  {{ csrf_field() }}
  <div class="form-group">
   <label for="nip">{{ __('NIP') }}</label>
   <input onkeypress='validate(event)'  id="nip" min="0" maxlength="18" type="text" class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" name="nip" value="{{ old('nip') }}" placeholder="Ex : 432523543634" required autofocus>
   @if ($errors->has('nip'))
   <span class="invalid-feedback" role="alert">
    <strong>{{ $errors->first('nip') }}</strong>
  </span>
  @endif
</div>

<div class="form-group">
 <label for="name">{{ __('Nama') }}</label>
 <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" placeholder="Ex : Didik Hariyanto" name="name" required>
 @if ($errors->has('name'))
 <span class="invalid-feedback" role="alert">
  <strong>{{ $errors->first('name') }}</strong>
</span>
@endif
</div>

<div class="form-row">
  <div class="form-group col-md-6">
    <label for="inputPlace">Tempat Lahir</label>
    <input type="text" class="form-control" id="inputPlace" name="inputPlace" value="{{ old('birth_place')  }}" placeholder="Mojokerto">
  </div>
  <div class="form-group col-md-6">
    <label for="inputDate">Tanggal Lahir</label>
    <input type="date" class="form-control" name="inputDate" id="inputDate" value="{{ old('birth_date') }}">
  </div>
</div>

<div class="form-group">
 <label for="inputGender">{{ __('Jenis Kelamin') }}</label>
 <select id="inputGender" name="inputGender" class="form-control">
  <option>Pilih...</option> 
  <option value="Laki-Laki" >Laki-Laki</option>
  <option value="Perempuan" >Perempuan</option>
</select>
@if ($errors->has('inputGender'))
<span class="invalid-feedback" role="alert">
  <strong>{{ $errors->first('inputGender') }}</strong>
</span>
@endif
</div>

<div class="form-group">
 <label for="address">{{ __('Alamat') }}</label>
 <input id="address" type="text" placeholder="Ex : Jl Empu tantular No.45 Sooko Mojokerto" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}" name="address" required>
 @if ($errors->has('address'))
 <span class="invalid-feedback" role="alert">
  <strong>{{ $errors->first('address') }}</strong>
</span>
@endif
</div>

<div class="form-group">
 <label for="email">{{ __('Email') }}</label>
 <input id="email" type="email" placeholder="Ex : example@kemenag.go.id" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" name="email" required>
 @if ($errors->has('email'))
 <span class="invalid-feedback" role="alert">
  <strong>{{ $errors->first('email') }}</strong>
</span>
@endif
</div>


<div class="form-group">
 <label for="serialCard">{{ __('Nomor Seri Kartu Pegawai') }}</label>
 <input id="serialCard" placeholder="Ex : D43F52334" type="text" class="form-control{{ $errors->has('serialCard') ? ' is-invalid' : '' }}" value="{{ old('serialCard') }}" name="serialCard" required>
 @if ($errors->has('serialCard'))
 <span class="invalid-feedback" role="alert">
  <strong>{{ $errors->first('serialCard') }}</strong>
</span>
@endif
</div>

<div class="form-group">
 <label for="credit">{{ __('Kredit') }}</label>
 <input id="credit" type="number" placeholder="Angka Kredit Terakhir" class="form-control{{ $errors->has('credit') ? ' is-invalid' : '' }}" value="{{ old('credit') }}" name="credit" required>
 @if ($errors->has('credit'))
 <span class="invalid-feedback" role="alert">
  <strong>{{ $errors->first('credit') }}</strong>
</span>
@endif
</div>

<div class="form-group">
 <label for="workUnit">{{ __('Unit Kerja') }}</label>
 <select id="workUnit" name="workUnit" class="js-example-basic-single js-states form-control" required>
  @foreach ($units as $key => $unit)
  <option value="{{ $unit }}" >{{strtoupper($key)}}</option>
  @endforeach
</select>
@if ($errors->has('workUnit'))
<span class="invalid-feedback" role="alert">
  <strong>{{ $errors->first('workUnit') }}</strong>
</span>
@endif
</div>

<div class="form-group">
 <label for="pkPosition">{{ __('Jabatan Pranata Komputer') }}</label>
 <select id="pkPosition" name="pkPosition" class="form-control" required>
  <option>Pilih...</option> 
  @foreach ($pkPositions as $pk)
  <option value="{{ $pk->id }}" >{{ $pk->group }} - {{ $pk->position }}</option>
  @endforeach
</select>
@if ($errors->has('pkPosition'))
<span class="invalid-feedback" role="alert">
  <strong>{{ $errors->first('pkPosition') }}</strong>
</span>
@endif
</div>

<div class="form-group">
 <label for="password">{{ __('Password') }}</label>
 <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" name="password" required >
 @if ($errors->has('password'))
 <span class="invalid-feedback" role="alert">
  <strong>{{ $errors->first('password') }}</strong>
</span>
@endif
</div>

<div class="form-group">
 <label for="password-confirm">{{ __('Konfirmasi Password') }}</label>
 <input id="password-confirm" type="password" class="form-control{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" value="{{ old('password-confirm') }}" name="password_confirmation" required >
 @if ($errors->has('password-confirm'))
 <span class="invalid-feedback" role="alert">
  <strong>{{ $errors->first('password-confirm') }}</strong>
</span>
@endif
</div>

<div class="form-group">
  <label for="lastSKUpload">{{ __('Upload SK Terakhir (.PDF max 10MB)') }}</label>
  <input id="lastSKUpload" accept="application/pdf" type="file" class="form-control-file{{ $errors->has('lastSKUpload') ? ' is-invalid' : '' }}" value="{{ old('lastSKUpload') }}" name="lastSKUpload" required>
  @if ($errors->has('lastSKUpload'))
  <span class="invalid-feedback" role="alert">
    <strong>{{ $errors->first('lastSKUpload') }}</strong>
  </span>
  @endif
</div>

<div class="form-group">
  <label for="photoUpload">{{ __('Upload Pas Foto (jpg/png only max 2MB)') }}</label>
  <input id="photoUpload" accept="image/x-png,image/jpeg" type="file" class="form-control-file{{ $errors->has('photoUpload') ? ' is-invalid' : '' }}" value="{{ old('photoUpload') }}" name="photoUpload" required>
  @if ($errors->has('photoUpload'))
  <span class="invalid-feedback" role="alert">
    <strong>{{ $errors->first('photoUpload') }}</strong>
  </span>
  @endif
</div>



<div class="form-group no-margin">
 <button type="submit" class="btn btn-primary btn-block">
  {{ __('Daftar') }}
</button>
</div>
<div class="margin-top20 text-center">
 <a href="/">Login</a>
</div>
</form>

<script class="js-code-example-basic-single">
  $(document).ready(function() {
    $('.js-example-basic-single').select2();
  });
</script>

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

                    @endsection



