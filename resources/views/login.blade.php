@extends('global.default')
@section('title', 'Login')
@show
@section('content')
    <div class="page page-center">
      <div class="container container-tight py-4">
        <div class="text-center mb-4">
            <i class="ti ti-square-rounded-letter-t"></i>
            <a class="text">Dashboard Turus Asri</a>
        </div>
        <div class="card card-md">
          <div class="card-body">
          <!-- Session Status -->
          <!-- <x-auth-session-status class="mb-4" :status="session('status')" /> -->

          <!-- Validation Errors -->
          <!-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> -->
            <h2 class="h2 text-center mb-4">Silakan login</h2>
            <hr>
            @if(session('error'))
                <div class="alert alert-danger">
                  <b>Login gagal!</b> {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('login') }}" method="POST" autocomplete="off">
            @csrf
            <div class="row mb-3">
                <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>

                <div class="col-md-6">
                    <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6 offset-md-4">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                        <label class="form-check-label" for="remember">
                            {{ __('Remember Me') }}
                        </label>
                    </div>
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Login') }}
                    </button>
<!-- 
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif -->
                </div>
            </div>
            </form>
          </div>
      </div>
    </div>
@endsection