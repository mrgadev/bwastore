@extends('layouts.app')
@section('title', 'Home')
@section('content')
<div class="page-content page-home">
    <section class="store-carousel">
      <div class="container">
        <div class="row">
          <div class="col-lg-12" data-aos="zoom-in">
            <div id="storeCarousel" class="carousel slide" data-ride="carousel">
              <ol class="carousel-indicators">
                <li class="active" data-target="#storeCarousel" data-slide-to="0"></li>
                <li class="active" data-target="#storeCarousel" data-slide-to="1"></li>
                <li class="active" data-target="#storeCarousel" data-slide-to="2"></li>
              </ol>
              <div class="carousel-inner">
                <div class="carousel-item active">
                  <img src="images/banner.jpg" class="d-block w-100" alt="">
                </div>
                <div class="carousel-item">
                  <img src="images/banner.jpg" class="d-block w-100" alt="">
                </div>
                <div class="carousel-item">
                  <img src="images/banner.jpg" class="d-block w-100" alt="">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section class="store-trend-categories">
      <div class="container">
        <div class="row">
          <div class="col-12" data-aos="fade-up">
            <h5 class="font-weight-bold">Trend Categories</h5>
          </div>
        </div>
        <div class="row">
          @php $incrementCategory = 0; @endphp
          @forelse ($categories as $category)  
          <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up" data-aos-delay="{{$incrementCategory += 100}}">
            <a href="{{route('categories-detail', $category->slug)}}" class="component-categories d-block">
              <div class="categories-image text-center">
                <img src="{{Storage::url($category->photo)}}" class="w-50" alt="">
              </div>
              <p class="categories-text">{{$category->name}}</p>
            </a>
            </div>
          @empty
          <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="150">
            Categories is Empty!
          </div>
          @endforelse
        </div>
      </div>
    </section>

    <section class="store-new-products">
      <div class="container">
        <div class="row">
          <div class="col-12" data-aos="fade-up">
            <h5 class="font-weight-bold">New Products</h5>
          </div>
        </div>
        <div class="row">
          @php
            $incrementProduct = 0;
          @endphp
          @forelse ($products as $product)
            
          <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{$incrementProduct += 100}}">
            <a href="{{route('detail', $product->slug)}}" class="component-products d-block">
              <div class="products-thumbnail">
                <div class="products-image" style="
                  @if($product->galleries)  
                  background-image: url('{{Storage::url($product->galleries->first()->photos)}}');
                  @else
                  background-color: #eee;
                  @endif
                ">

                </div>
                
              </div>
              <div class="products-text">
                {{$product->name}}
              </div>
              <div class="products-price">
                Rp. {{number_format($product->price, 0, ',','.')}}
              </div>
            </a>
          </div>
          @empty
          <div class="col-12 text-center py-5" data-aos="fade-up" data-aos-delay="150">
            Products is Empty!
          </div>
          @endforelse
        </div>
      </div>
    </section>
  </div>
</div>
@endsection
@push('addon-script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (Session::has('success'))  
  <script>
    Swal.fire({
    position: "top-end",
    text: "{{Session::get('success')}}",
    background: "#365E32",
    color:"#fff",
    showConfirmButton: false,
    timer: 1500
  });
  </script>
@endif
@endpush