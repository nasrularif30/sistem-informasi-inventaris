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
            <h2 class="h2 text-center mb-4">Silakan login</h2>
            <hr>
            @if(session('error'))
                <div class="alert alert-danger">
                  <b>Login gagal!</b> {{ session('error') }}
                </div>
            @endif
            <form action="{{ route('login.auth') }}" method="POST" autocomplete="off">
                @csrf
              <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="username" class="form-control" name="username" id="username" placeholder="username" autocomplete="off" required>
              </div>
              <div class="mb-2">
                <label class="form-label">
                  Password
                  <!-- <span class="form-label-description">
                    <a href="./forgot-password.html">I forgot password</a>
                  </span> -->
                </label>
                <div class="input-group input-group-flat">
                  <input type="password" class="form-control" name="password" id="password" placeholder="password"  autocomplete="off" required>
                  <span class="input-group-text">
                    <a href="#" class="link-secondary" title="Show password" data-bs-toggle="tooltip"><!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                      <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" /><path d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" /></svg>
                    </a>
                  </span>
                </div>
              </div>
              <div class="mb-2">
                <label class="form-check">
                  <input type="checkbox" class="form-check-input"/>
                  <span class="form-check-label">Ingat saya</span>
                </label>
              </div>
              <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">Login</button>
              </div>
            </form>
          </div>
      </div>
    </div>
@endsection