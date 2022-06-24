@extends('layouts.app')

@section('content')
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-5 col-lg-6 col-md-4">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 fw-bold mb-4">Login</h1>
                  </div>
                  <form class="user" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                      <input type="email" class="form-control form-control-user  @error('email') is-invalid @enderror"
                        name="email" value="{{ old('email') }}" id="email" aria-describedby="emailHelp"
                        placeholder="Email">

                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <input type="password"
                        class="form-control form-control-user  @error('password') is-invalid @enderror" name="password"
                        id="password" placeholder="Password" required autocomplete="current-password">

                      @error('password')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                    <div class="mb-4">
                      <div class="form-chceck custom-checkbox small">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember"
                          {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label align-middle" for="remember">Remember
                          Me</label>
                      </div>
                    </div>
                    <div class="d-grid gap-2">
                      <button type="submit" class="btn btn-primary btn-user text-white">
                        Login
                      </button>
                    </div>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small link-primary" href="{{ route('password.request') }}">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small link-primary" href="{{ route('register') }}">Create an Account!</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
@endsection
