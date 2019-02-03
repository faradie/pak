@extends('layouts.authlayout')

@section('content')
<h4 class="card-title">Login</h4>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="form-group">
        <label for="id">NIP</label>

        <input id="id" type="text" type="id" class="form-control{{ $errors->has('id') ? ' is-invalid' : '' }}" name="id" value="{{ old('id') }}" required autofocus>
                                @if ($errors->has('id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                @endif
    </div>

    <div class="form-group">
        <label for="password">Password
            <a href="forgot.html" class="float-right">
                Lupa Password?
            </a>
        </label>
        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required data-eye>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
    </div>

    <div class="form-group">
        <label>
            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Ingat saya
        </label>
    </div>

    <div class="form-group no-margin">
        <button type="submit" class="btn btn-primary btn-block">
            {{ __('Login') }}
        </button>
    </div>
    <div class="margin-top20 text-center">
        <a href="{{ route('register') }}">Buat akun</a>
    </div>
</form>
@endsection

    <script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/js/my-login.js') }}"></script>