@extends('layouts.dashboard')
@section('title', 'Store Settings')
@section('content')
  <!-- Section content -->
  <div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">Store Settings</h2>
        <p class="dashboard-subtitle">Look what you've made today!</p>
      </div>
      <div class="dashboard-content">
        <div class="row">
          <div class="col-12">
            <form action="{{route('dashboard-settings-redirect', 'dashboard-settings-store')}}" method="POST">
              @csrf
              @method('POST')
              <div class="card">
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="namaToko">Nama Toko</label>
                        <input type="text" name="store_name" value="{{$user->store_name}}" class="form-control" id="namaToko">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="kategori">Kategori</label>
                      
                        <select name="categories_id" class="form-control" id="">
                          <option value="{{$user->categories_id}}">Tidak diganti</option>
                          @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="Password">Store</label>
                        <p class="text-muted">Apakah anda ingin membuka toko?</p>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" name="store_status" value="1" {{$user->store_status == 1 ? 'checked' : ''}} id="openStoreTrue">
                          <label for="openStoreTrue" class="custom-control-label">Buka</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input type="radio" class="custom-control-input" name="store_status" value="0" {{$user->store_status == 0 || $user->store_status == NULL ? 'checked' : ''}}  id="openStoreFalse">
                          <label for="openStoreFalse" class="custom-control-label">Sementara Tutup</label>
                        </div>
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