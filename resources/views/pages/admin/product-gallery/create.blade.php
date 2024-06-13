@extends('layouts.admin')
@section('title', 'Add New Photo')
@section('content')
<!-- Section content -->
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">Add New Photo</h2>
        <nav aria-label="breadcrumb" class="">
            <ol class="breadcrumb bg-transparent px-0 py-2">
                <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('product-gallery.index')}}">Product Gallery</a></li>
                <li class="breadcrumb-item active" aria-current="page">Upload Photo</li>
            </ol>
        </nav>
      </div>
      <div class="dashboard-content">
        <div class="row">
            <div class="col-md-12">
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('product-gallery.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Pemilik Produk</label>
                                        <select name="products_id" id="" class="form-control">
                                            @foreach ($products as $product)
                                                <option value="{{$product->id}}">{{$product->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Foto Produk</label>
                                        <input type="file" name="photos" class="form-control" required  id="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col text-right">
                                    <button type="submit" class="btn btn-success px-3">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
      </div>
    </div>
  </div>
</div>
@endsection