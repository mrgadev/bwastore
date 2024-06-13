@extends('layouts.dashboard')
@section('title', 'Store Dashboard')
@section('content')
<!-- Section content -->
<div class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">My Account</h2>
      <p class="dashboard-subtitle">Look what you've made today!</p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12">
          <form action="{{route('dashboard-settings-redirect', 'dashboard-settings-account')}}" method="POST" id="locations">
            @csrf
            @method('POST')
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="yourName">Your Name</label>
                      <input type="text" id="yourName" class="form-control" name="name" value="{{$user->name}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">Email</label>
                      <input type="email" id="email" name="email" class="form-control" value="{{$user->email}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="address1">Address #1</label>
                      <input type="text" id="address1" class="form-control" value="{{$user->address_one}}" name="address_one">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="address2">Address #2</label>
                      <input type="text" id="address2" name="address_two" class="form-control" value="{{$user->adress_two}}">
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
                      <label for="postalCode">Postal Code</label>
                      <input type="text" id="postalCode" name="zip_code" class="form-control" value="{{$user->zip_code}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="country">Country</label>
                      <input type="text" id="country" class="form-control" name="country" value="{{$user->country}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="mobile">Mobile</label>
                      <input type="text" id="mobile" class="form-control" name="phone" value="{{$user->phone}}">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col text-right">
                    <button type="submit" class="btn btn-success px-5">Save Now</button>
                  </div>
                </div>
              </div>
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