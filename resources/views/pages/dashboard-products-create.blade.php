@extends('layouts.dashboard')
@section('title', 'Store Dashboard')
@section('content')
<!-- Section content -->
<div class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">Create New Product</h2>
      <p class="dashboard-subtitle">Create your own product!</p>
    </div>
    <div class="dashboard-content">
      <div class="row">
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
          <form action="{{route('dashboard-products-store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <input type="hidden" value="{{Auth::user()->id}}" name="users_id">
            <div class="card">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="productName">Product Name</label>
                      <input type="text" name="name" class="form-control" id="productName">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="productPrice">Price</label>
                      <input type="number" name="price" class="form-control" id="productPrice">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="productCategory">Category</label>
                      <select name="categories_id" id="" class="form-control">
                                                
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="description">Description</label>
                      <textarea name="description" id="editor"></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="productThumbnail">Thumbnail</label>
                      <input type="file" name="photo" class="form-control" id="productThumbnail">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col text-right">
                    <button type="submit" class="btn btn-success px-5">Create Product</button>
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
</script>
@endpush