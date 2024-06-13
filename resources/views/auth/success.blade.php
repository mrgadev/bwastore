@extends('layouts.success')
@section('title', 'Success')
@section('content')
<!-- Page content -->
<div class="page-content page-success">
  <div class="section-success" data-aos="zoom-in">
    <div class="container">
      <div class="row align-items-center row-login justify-content-center">
        <div class="col-lg-6 text-center">
          <img src="/images/undraw_web_shopping_re_owap.svg" class="mb-4 w-75" alt="">
          <h2>Welcome to Mahir Store!</h2>
          <p>Kamu sudah berhasil terdaftar
            bersama kami. Let’s grow up now.</p>
          <div>
            <a href="dashboard.html" class="btn btn-success w-50 mt-4">My Dashboard</a>
            <a href="index.html" class="btn btn-signup mt-2 w-50">Go Shopping</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection