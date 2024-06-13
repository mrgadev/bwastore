@extends('layouts.dashboard')
@section('title', 'Store Dashboard')
@section('content')
<!-- Section content -->
<div class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">{{$product->name}}</h2>
      <p class="dashboard-subtitle">Product Details</p>
    </div>
    <div class="dashboard-content">
      <div class="row mb-4">
        <div class="col-12">
          @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
          @endif
          <form action="{{route('dashboard-products-update', $product->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="hidden" name="users_id" value="{{Auth::user()->id}}">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="productName">Product Name</label>
                      <input type="text" name="name" class="form-control" id="productName" value="{{$product->name}}">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="productPrice">Price</label>
                      <input type="number" name="price" class="form-control" id="productPrice" value="{{$product->price}}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="productCategory">Category</label>
                      <select name="categories_id" id="" class="form-control">  
                        {{-- Mengambil value czategory yg sudah ada  --}}
                        <option value="{{$product->categories_id}}">Tidak diiganti ({{$product->categories->name}})</option>                 
                        <option value="" disabled>---</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea name="description" id="editor">{!!$product->description!!}</textarea>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col text-right">
                    <button type="submit" class="btn btn-success btn-block px-5">Save Now</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="row">
                @foreach ($product->galleries as $gallery)
                <div class="col-md-4">
                  <div class="gallery-container">
                    <img src="{{Storage::url($gallery->photos ?? '')}}" class="w-100" alt="">
                    <a href="{{route('dashboard-products-gallery-delete', $gallery->id)}}" class="delete-gallery">
                      <img src="/images/icons8-close-48.png" alt="">
                    </a>
                  </div>
                </div>
                @endforeach
                <div class="col-md-12">
                  <form action="{{route('dashboard-products-gallery-upload')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="products_id" value="{{$product->id}}">
                    {{-- Intinya, pada kode dibawahn ini, peran antara button dengan input fitukar --}}
                    {{-- Jadi, tombol digunakan untuk membuka dialog upload file --}}
                    {{-- Dan input file akan mensubmit file yg diupload dengan event onchange (sat terjadi perubahan/file sudah diupload) --}}
                    <input type="file" name="photos" id="file" style="display: none;" onchange="form.submit()">
                    <button type="button" class="btn btn-secondary mt-3 btn-block" onclick="thisFileUpload()">Add Photo</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> 
@endsection

@push('addon-script')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
  ClassicEditor
  .create( document.querySelector( '#editor' ) )
  .then( editor => {
          console.log( editor );
  } )
  .catch( error => {
          console.error( error );
  } );
  // function ini akan menautkan antara tombol Add Photo dengan input filenya
  function thisFileUpload() {
    document.getElementById('file').click();
  }
</script>
@endpush