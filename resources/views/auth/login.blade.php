@extends('layouts.auth')
@section('title', 'Login to Mahir Store')
@section('content')
<!-- Page content -->
<div class="page-content page-auth">
    <div class="section-store-auth" data-aos=""fade-up>
      <div class="container">
        <div class="row align-items-center row-login">
          <div class="col-lg-6 text-center">
            <img src="images/undraw_shopping_app_flsj.svg" class="w-75 mb-4 mb-lg-none" alt="">
          </div>
          <div class="col-lg-5">
            <h2>Belanja kebutuhan utama, jadi lebih mudah</h2>
            <form action="{{route('login')}}" method="POST" class="mt-3">
              @csrf
              @method('POST')
              <div class="form-group">
                <label for="Email">Email Address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="Email">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror " id="Password">
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                  </span>
                @enderror
              </div>
              <div class="flex align-items-center">
                <button type="submit" class="btn btn-success btn-block mt-4">Sign into My Account</button>
                <a href="{{route('register')}}" class="btn btn-signup btn-block mt-4">Register an Account</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
