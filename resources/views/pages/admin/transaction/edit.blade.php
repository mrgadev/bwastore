@extends('layouts.admin')
@section('title', 'Add New Transaction')
@section('content')
<!-- Section content -->
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
      <div class="dashboard-heading">
        <h2 class="dashboard-title">Create New Transaction</h2>
        <nav aria-label="breadcrumb" class="">
            <ol class="breadcrumb bg-transparent px-0 py-2">
                <li class="breadcrumb-item"><a href="{{route('admin-dashboard')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{route('transaction.index')}}">All Transaction</a></li>
                <li class="breadcrumb-item active" aria-current="page">Create New Transaction</li>
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
                        <form action="{{route('transaction.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Status Transaksi</label>
                                        <select name="transaction_status" id="" class="form-control">
                                            <option value="{{$item->transaction_status}}" selected>{{$item->transaction_status}}</option>
                                            <option value="" disabled>-------</option>
                                            <option value="PENDING">Pending</option>
                                            <option value="SHIPPING">Shipping</option>
                                            <option value="SUCCESS">Success</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Total Harga</label>
                                        <input type="number" name="total_price" class="form-control" value="{{$item->total_price}}" required id="">
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