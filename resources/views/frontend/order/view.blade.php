@extends('frontend.layouts.master')

@section('content')


<div class="validtheme-shop-area default-padding">
    
    <div class="container">
        <div class="shop-listing-contentes">
            <div class="row align-center">
                
                <div class="col-lg-7 col-md-7">
                    <div class="content">
                        <b>Status : <span class="text-danger">Belum Lunas ({{ $orders->metode }})</span></b>
                    </div>
                </div>
                
                <div class="col-lg-5 col-md-5 text-right">
                    <p>
                        <b>Total Pembayaran : <span class="text-danger">Rp. {{ number_format($orders->total_price) }}</span></b>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">    
            {{-- PRODUK --}}
            
            <!-- Start Tab Content -->
            <div class="container">
                <div class="row">
                    <div class="col-md-12 order-md-1">
                        <h4 class="d-flex justify-content-between align-items-center mb-3"> 
                            <span class="text"><b>Jumlah Produk :</b></span>
                            <span class="badge badge-success badge-pill">{{ $orders->orderitem()->count() }}</span>
                        </h4>
                        <ul class="list-group mb-3 produk">
                            @php $total = 0; @endphp
                            
                            @foreach ($orders->orderitem as $item)  
                            <li class="list-group-item d-flex justify-content-between lh-condensed produk_data">
                                <div class="col-md-4">
                                    <a href="{{ route('detail.produk', $item->produks->slug ) }}"><h6 class="my-0"><b>{{ \Illuminate\Support\Str::words($item->produks->name, 3, '...') }}</b></h6></a>
                                    <small class="text-muted">{{ date('d F Y',strtotime($item->created_at)) }}</small>
                                </div>
                                <div class="col-md-4">
                                    @if ($item->produks->cover)
                                    <img src="{{ asset('storage/'. $item->produks->cover) }}" style="width: 50px; height: 50px;" alt="{{ $item->name }}">
                                    @else
                                    <img src="{{ asset('front') }}/img/800x800.png"  style="width: 50px; height: 50px;" alt="{{ $item->name }}">
                                    @endif
                                </div>
                                <div>
                                    <span class="text-muted">Rp. {{ number_format($item->price) }}</span>
                                </div>
                            </li>
                            @php $total += $item->price; @endphp
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between">
                                <div class="col-md-4">
                                    <span>Total Harga Murni (Rp)</span>
                                </div>
                                <strong class="text-success">Rp. {{ number_format($total) }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <div class="col-md-4">
                                    <span><b>Total Harga yang harus di Bayar (Rp)</b></span>
                                </div>
                                <strong class="text-danger">Rp. {{ number_format($orders->total_price) }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="containe">
            {{-- PAYMENT METODE --}}
            <div class="justify-content-center mt-5 mb-5">
                
                <div class="col-md-12 order-md-1">  
                    
                    <span><b>Metode Pembayaran :</b></span>
                    <div class="card">
                        
                        <div class="accordion" id="accordionExample">
                            
                            @if ($orders->metode == $metode->kategori && $orders->metode != 'QRIS' )
                            
                            <div class="card">
                                <div class="card-header p-0">
                                    <h2 class="mb-0">
                                        <button class="btn btn-light btn-block text-left p-3 rounded-0" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <span><b>{{ $metode->kategori }}</b></span>
                                                <div class="icons">
                                                    <img src="{{ asset('storage/'. $metode->image ) }}" width="30">
                                                </div>
                                                
                                            </div>
                                        </button>
                                    </h2>
                                </div>
                                
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body payment-card-body">
                                        
                                        <div class="row mt-3 mb-3">
                                            
                                            <div class="col-md-6 mt-3">
                                                
                                                <span class="font-weight-normal card-text">Atas Nama</span>
                                                <div class="input">
                                                    
                                                    <input type="text" class="form-control" value="{{ $metode->atas_nama }}" placeholder="{{ $metode->atas_nama }}">
                                                    
                                                </div> 
                                                
                                            </div>
                                            
                                            
                                            <div class="col-md-6 mt-3">
                                                
                                                <span class="font-weight-normal card-text">No Rekening</span>
                                                <div class="input">
                                                    
                                                    <div class="input-group mb-3 copy-text">
                                                        <input type="text" class="form-control"value="{{ $metode->no_rek }}" placeholder="{{ $metode->no_rek }}" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                                        <button class="input-group-text btn-theme"><i class="fas fa-clone"></i></button>
                                                    </div>
                                                </div> 
                                                
                                            </div>
                                            
                                        </div>
                                        
                                        <span class="text-muted certificate-text"><i class="fa fa-lock"></i> Your transaction is secured with ssl certificate</span>
                                        
                                    </div>
                                </div>
                            </div>
                            
                            @elseif($orders->metode == 'QRIS')
                            
                            <div class="card">
                                <div class="card-header p-0" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="btn btn-light btn-block text-left p-3 rounded-0" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                            <div class="d-flex align-items-center justify-content-between">
                                                
                                                <span><b>Qris / E-Wallet</b></span>
                                                <div class="icons">
                                                    <img src="{{ asset('storage/'. $metode->image ) }}" width="30">
                                                </div>    
                                            </div>
                                        </button>
                                    </h2>
                                </div>
                                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">
                                        <center>
                                            <div class="mt-3 mb-2">
                                                <span><label for=""><b>Kalian Bisa langsung Scan disini / <a href="{{ asset('storage/'. $metode->image ) }}" download alt="{{ $metode->name }}"><i>Download disni</i></a></b></label></span>
                                                
                                            </div>
                                            <img src="{{ asset('storage/'. $metode->image ) }}" alt="Product" width="40%" height="40%">
                                            <div class="mt-3 mb-2">
                                                <span><label for=""><b><i class="fas fa-store"></i> {{ $metode->atas_nama }}</b></label></span><br>
                                                <label for=""><i>Note: Bayar sesuai total harga yang sudah tertera <b class="text-danger">Rp. {{ number_format($orders->total_price) }}</b></i></label>
                                            </div>
                                        </center>
                                    </div>
                                </div>
                            </div>
                            
                            @endif
                            
                            
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
    </div>
    
</div>

@include('frontend.layouts.includes.copy')


@endsection