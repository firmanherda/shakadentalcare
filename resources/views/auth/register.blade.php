@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Register') }}</div>

          <div class="card-body">
            <form method="POST" action="{{ route('register') }}">
              @csrf

              <div class="form-group row">
                <label for="nama" class="col-md-4 col-form-label text-md-right">{{ __('Nama') }}</label>

                <div class="col-md-6">
                  <input id="nama" type="text" class="form-control @error('nama') is-invalid @enderror" name="nama"
                    value="{{ old('nama') }}" required autocomplete="name" autofocus>

                  @error('nama')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="no_hp" class="col-md-4 col-form-label text-md-right">{{ __('No. HP') }}</label>

                <div class="col-md-6">
                  <input id="no_hp" type="tel" class="form-control @error('no_hp') is-invalid @enderror" name="no_hp"
                    value="{{ old('no_hp') }}" autocomplete="tel">

                  @error('no_hp')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email (opsional)') }}</label>

                <div class="col-md-6">
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" autocomplete="email">

                  @error('email')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="alamat" class="col-md-4 col-form-label text-md-right">{{ __('Alamat') }}</label>

                <div class="col-md-6">
                  <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat"
                    value="{{ old('alamat') }}" required autocomplete="street-address">

                  @error('alamat')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="tanggal_lahir" class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Lahir') }}</label>

                <div class="col-md-6">
                  <input id="tanggal_lahir" type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" name="tanggal_lahir"
                    value="{{ old('tanggal_lahir') }}" required autocomplete="bday-day">

                  @error('tanggal_lahir')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                <div class="col-md-6">
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                  @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                  @enderror
                </div>
              </div>

              <div class="form-group row">
                <label for="password-confirm"
                  class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
                    autocomplete="new-password">
                </div>
              </div>

              <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                  <button type="submit" class="btn btn-primary">
                    {{ __('Daftar') }}
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
