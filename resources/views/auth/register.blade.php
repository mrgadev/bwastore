@extends('layouts.auth')
@section('title', 'Register New Account')
@section('content')
<div class="container d-none">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page content -->
<div class="page-content page-auth mt-10" id="register">
    <div class="section-store-auth" data-aos=""fade-up>
      <div class="container">
        <div class="row align-items-center justify-content-center row-login">
          <div class="col-lg-4">
            <h2>Memulai untuk jual beli
              dengan cara terbaru</h2>
            <form action="{{route('register')}}" method="POST" class="mt-3">
              @csrf
              @method('POST')
              <div class="form-group">
                <label for="name">Full Name</label>
                <input type="name" name="name" class="form-control @error('name') is-invalid @enderror" v-model="name" autofocus id="name">
                @error('name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="Email">Email Address</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" :class="{'is-invalid': this.email_unavailable}" v-model="email" @change="checkForEmailAvailability()" id="Email">
                @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="Password">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="Password">
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="password-confirm">Konfirmasi Password</label>
                <input type="password-confirm" name="password_confirmation" class="form-control @error('password_confirm') is-invalid @enderror" id="Password">
                @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="Password">Store</label>
                <p class="text-muted">Apakah anda ingin membuka toko?</p>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" name="is_store_open" v-model="is_store_open" :value="true" id="openStoreTrue">
                  <label for="openStoreTrue" class="custom-control-label">Boleh dah</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline">
                  <input type="radio" class="custom-control-input" name="is_store_open" v-model="is_store_open" :value="false" id="openStoreFalse">
                  <label for="openStoreFalse" class="custom-control-label">Ogah</label>
                </div>
              </div>
              <div class="form-group" v-if="is_store_open">
                <label for="store-name">Nama Toko</label>
                <input type="text" name="store_name" class="form-control @error('store_name') is-invalid @enderror" v-model="store-name" autofocus id="store-name">
                @error('store_name')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{$message}}</strong>
                  </span>
                @enderror
              </div>
              <div class="form-group" v-if="is_store_open">
                <label for="name">Kategori</label>
                <select name="categories_id" class="form-control" id="">
                  <option value="" selected disabled>Select a category</option>
                  @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="flex align-items-center">
                <button type="submit" class="btn btn-success btn-block mt-4" :disabled="this.email_unavailable">Register Now!</button>
                <a href="{{route('login')}}" class="btn btn-signup btn-block mt-4">Back to Sign In</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script src="https://unpkg.com/vue-toasted"></script>
<script src="https://unpkg.com/axios@1.6.7/dist/axios.min.js"></script>
{{-- <script>
  Vue.use(Toasted);

  var register = new Vue({
    el: '#register',
    mounted() {
      AOS.init();
      // this.$toasted.error(
      //   "Maaf, tampaknya email sudah terdaftar pada sistem kami",
      //   {
      //     position: "top-center",
      //     className: "rounded",
      //     duration: 1000,
      //   }
      // );
    },
    methods: {
      checkForEmailAvailability: function() {
        var self = this;
        // Make a request for a user with a given ID
        axios.get('{{route('api-register-check')}}', {
          params: {
            email: self.email,
          }
        })
          .then(function (response) {
            if(response.data == 'Available') {
              self.$toasted.show(
                "Email anda tersedia! Silahkan lanjut",
                {
                  position: "top-center",
                  className: "rounded",
                  duration: 1000,
                }
                
              );
              self.email_unavailable = false;
            } else {
              self.$toasted.error(
                "Maaf, tampaknya email sudah terdaftar pada sistem kami",
                {
                  position: "top-center",
                  className: "rounded",
                  duration: 1000,
                }
              );
              self.email_unavailable = true;  
            }
            console.log('response');
          });
      }
    },
    data() {
      return {
        name: "Muhammad Rizqi",
        email: "rizqighana@gmail.com",
        is_store_open: true,
        store_name: "",
        email_unavailable: false,
      }
    },
  });
</script> --}}
@endpush