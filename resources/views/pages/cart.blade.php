@extends('layouts.app')
@section('title', 'Cart')
@section('content')
<!-- Page content -->
<div class="page-content page-cart">
    <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100"> 
      <div class="container">
        <div class="row">
          <div class="col-12">
            <nav>
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                  <a href="{{route('home')}}">Home</a>
                </li>
                <li class="breadcrumb-item active">
                  Cart
                </li>
              </ol>
            </nav>
          </div>
        </div>
      </div>
    </section>
    <section class="store-cart">
      <div class="container">
        <div class="row" data-aos="fade-up" data-aos-delay="100">
          <div class="col-12 table-responsive">
            <table class="table table-borderless table-cart">
              <thead>
                <tr>
                  <td>Image</td>
                  <td>Name & Seller</td>
                  <td>Price</td>
                  <td>Menu</td>
                </tr>
              </thead>
              <tbody>
                @php
                  $totalPrice = 0
                @endphp
                @foreach ($carts as $cart)  
                  <tr>
                    <td style="width: 25%;">
                      @if ($cart->product->galleries)
                        <img src="{{Storage::url($cart->product->galleries->first()->photos)}}" class="card-image w-100" alt="">
                      
                      @endif
                    </td>
                    <td style="width: 35%;">
                      <div class="product-title">{{$cart->product->name}}</div>
                      <div class="product-subtitle">{{$cart->product->user->store_name}}</div>
                    </td>
                    <td style="width: 35%;">
                      <div class="product-title">Rp. {{number_format($cart->product->price, 0, ',','.')}}</div>
                      <div class="product-subtitle">IDR</div>
                    </td>
                    <td style="width: 15%;">
                      <form action="{{route('cart-delete', $cart->id)}}" method="POST">
                        @csrf
                        @method('POST')
                        <button class="btn btn-remove-cart d-flex align-items-center gap-3">
                          <span class="material-symbols-rounded">delete</span>Remove
                        </button>
                      </form>
                      
                    </td>
                  </tr>
                  @php
                    $totalPrice += $cart->product->price
                  @endphp
                @endforeach
                
              </tbody>
            </table>
          </div>
        </div>
        <div class="row" data-aos="fade-up" data-aos-delay="150">
          <div class="col-12">
            <hr>
          </div>
          <div class="col-12">
            <h2 class="mb-4">Shipping Details</h2>
          </div>
        </div>
    
        <form action="{{route('checkout')}}" method="POST" id="locations">
          @csrf
          @method('POST')
          <!-- Shipping Form Row #1 -->
          <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
            <div class="col-md-6">
              <div class="form-group">
                <label for="address_one">Address #1</label>
                <input type="text" id="address_one" class="form-control" name="address_one" value="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="address_two">Address #2</label>
                <input type="text" id="address_two" name="address_two" class="form-control" value="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="provinces_id">Province</label>
                <select name="provinces_id" id="provinces_id" class="form-control" v-if="provinces" v-model="provinces_id">
                  <option v-for="province in provinces" :value="province.id">@{{province.name}}</option>
                </select>
                <select name="" v-else class="form-control" id=""></select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="regencies_id">City</label>
                <select name="regencies_id" id="regencies_id" class="form-control" v-if="regencies" v-model="regencies_id">
                  <option v-for="regency in regencies" :value="regency.id">@{{regency.name}}</option>
                </select>
                <select name="" v-else class="form-control" id=""></select>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="zip_code">Postal Code</label>
                <input type="text" id="zip_code" name="zip_code" class="form-control" value="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="country">Country</label>
                <input type="text" id="country" name="country" class="form-control" value="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">Mobile</label>
                <input type="text" id="phone" name="phone" class="form-control" value="">
              </div>
            </div>
          </div>
          <!-- Shipping Form Row #2 -->
          <div class="row mb-2" data-aos="fade-up" data-aos-delay="200">
          </div>
          <div class="row" data-aos="fade-up" data-aos-delay="150">
            <div class="col-12">
              <hr>
            </div>
            <div class="col-12">
              <h2 class="mb-2">Payment Informations</h2>
            </div>
          </div>
          <!-- Shipping Information Section -->
          <div class="row" data-aos="fade-up" data-aos-delay="200">
            <div class="col-4 col-md-2">
              <div class="product-title">$10</div>
              <div class="product-subtitle">Country Tax</div>
            </div>
            <div class="col-4 col-md-3">
              <div class="product-title">$580</div>
              <div class="product-subtitle">Product Insurance</div>
            </div>
            <div class="col-4 col-md-2">
              <div class="product-title">$100</div>
              <div class="product-subtitle">Ship to Jakarta</div>
            </div>
            <div class="col-4 col-md-2">
              <div class="product-title text-success">Rp. {{number_format($totalPrice ?? 0,0,',','.')}}</div>
              <input type="hidden" value="{{$totalPrice}}" name="total_price">
              <div class="product-subtitle">Total</div>
            </div>
            <div class="col-8 col-md-3">
              <button type="submit" class="btn btn-success mt-4 px-4 btn-block">Checkout now!</button>
            </div>
          </div>
        </form>
      </div>
    </section>
  </div>
@endsection
@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/axios@1.6.7/dist/axios.min.js"></script>

<script>
  var locations = new Vue({
    el: "#locations",
    mounted() {
      AOS.init();
      this.getProvincesData();
    },
    data: {
      provinces: null,
      regencies:null,
      provinces_id: null,
      regencies_id: null,
      // zip_code: null,
      // country: null,
      // phone_number: null,
    },
    methods: {
      getProvincesData() {
        var self = this;
        axios.get('{{route('api-provinces')}}')
          .then(function(response) {
            self.provinces = response.data;
            // console.log(self.provinces);
          })
      },
      getRegenciesData() {
        var self = this;
        axios.get('{{url('api/regencies')}}/' + self.provinces_id)
          .then(function(response) {
            self.regencies = response.data;
            // console.log(self.provinces);
          })
        
      }
    },
    watch: {
      provinces_id: function(val, oldVal) {
        this.regencies_id = null;
        this.getRegenciesData();
      }
    }
  }); 
  
</script>
@endpush