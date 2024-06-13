@extends('layouts.dashboard')
@section('title', 'Store Dashboard')
@section('content')
<!-- Section content -->
<div class="section-content section-dashboard-home" data-aos="fade-up">
  <div class="container-fluid">
    <div class="dashboard-heading">
      <h2 class="dashboard-title">Transactions</h2>
      <p class="dashboard-subtitle">Look what you've made today!</p>
    </div>
    <div class="dashboard-content">
      <div class="row">
        <div class="col-12 mt-2">
          <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Sell Product</a>
            </li>
            <li class="nav-item" role="presentation">
              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Buy Product</a>
            </li>
          </ul>
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
              @foreach ($sellTransactions as $sellTransaction)  
                <a href="{{route('dashboard-transactions-details', $sellTransaction->id)}}" class="card card-list d-block">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-1">
                        <img src="{{Storage::url($sellTransaction->product->galleries->first()->photos ?? ' ')}}" class="w-100" alt="">
                      </div>
                      <div class="col-md-4">
                        {{$sellTransaction->product->name}}
                      </div>
                      <div class="col-md-3">
                        {{$sellTransaction->product->user->store_name}}
                      </div>
                      <div class="col-md-3">
                       {{$sellTransaction->createrd_add}}
                      </div>
                      <div class="col-md-1 d-md-block">
                        <span class="material-symbols-rounded">chevron_right</span>
                      </div>
                    </div>
                  </div>
                </a>
              @endforeach
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
              @foreach ($buyTransactions as $buyTransaction)  
                <a href="{{route('dashboard-transactions-details', $buyTransaction->id)}}" class="card card-list d-block">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-1">
                        <img src="{{Storage::url($buyTransaction->product->galleries->first()->photos ?? '')}}" class="w-100" alt="">
                      </div>
                      <div class="col-md-4">
                        {{$buyTransaction->product->name}}
                      </div>
                      <div class="col-md-3">
                        {{$buyTransaction->product->user->store_name}}
                      </div>
                      <div class="col-md-3">
                        {{$buyTransaction->created_at}}
                      </div>
                      <div class="col-md-1 d-md-block">
                        <span class="material-symbols-rounded">chevron_right</span>
                      </div>
                    </div>
                  </div>
                </a>
              @endforeach
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