@extends('layouts.authlayout')

@section('content')
<h4 class="card-title">Register</h4>
<form method="POST" class="daftar" action="{{ route('register') }}">
    @csrf
								<div class="form-group">
									<label for="nip">{{ __('NIP') }}</label>
                                    <input id="nip" type="number" class="form-control{{ $errors->has('nip') ? ' is-invalid' : '' }}" name="nip" value="{{ old('nip') }}" required autofocus>
                                    @if ($errors->has('nip'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('nip') }}</strong>
                                        </span>
                                    @endif
								</div>

								<div class="form-group">
									<label for="name">{{ __('Nama') }}</label>
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" name="name" required>
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                                </div>
                                
                                <div class="form-group">
									<label for="address">{{ __('Alamat') }}</label>
                                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" value="{{ old('address') }}" name="address" required>
                                    @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                                </div>
                                
                                <div class="form-group">
									<label for="email">{{ __('Email') }}</label>
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" name="email" required>
                                    @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                                </div>
                                
                                <div class="form-group">
									<label for="credit">{{ __('Kredit') }}</label>
                                    <input id="credit" type="number" class="form-control{{ $errors->has('credit') ? ' is-invalid' : '' }}" value="{{ old('credit') }}" name="credit" required>
                                    @if ($errors->has('credit'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('credit') }}</strong>
                                    </span>
                                @endif
                                </div>

                                <div class="form-group">
									<label for="password">{{ __('Password') }}</label>
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" value="{{ old('password') }}" name="password" required data-eye>
                                    @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                </div>

                                <div class="form-group">
									<label for="password-confirm">{{ __('Konfirmasi Password') }}</label>
                                    <input id="password-confirm" type="password" class="form-control{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}" value="{{ old('password-confirm') }}" name="password_confirmation" required data-eye>
                                    @if ($errors->has('password-confirm'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password-confirm') }}</strong>
                                    </span>
                                @endif
                                </div>

								{{-- <div class="form-group">
									<label>
										<input type="checkbox" name="aggree" value="1"> I agree to the Terms and Conditions
									</label>
								</div> --}}

								<div class="form-group no-margin">
									<button type="submit" class="btn btn-primary btn-block">
                                        {{ __('Daftar') }}
									</button>
								</div>
								<div class="margin-top20 text-center">
									<a href="/">Login</a>
								</div>
							</form>
@endsection
