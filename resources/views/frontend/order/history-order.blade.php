@extends('frontend.layouts.master')

@section('content')


<div class="validtheme-shop-area default-padding">
    
    <div class="container">
        <div class="shop-listing-contentes">
            <div class="row align-center">
                
                <div class="col-lg-7 col-md-7">
                    <div class="content">
                        <b>Status : <span class="text-success">Sudah Lunas ({{ $orders->metode }})</span></b>
                    </div>
                </div>
                
                <div class="col-lg-5 col-md-5 text-right">
                    <p>
                        <b>Total Pembayaran : <span class="text-success">Rp. {{ number_format($orders->total_price) }}</span></b>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">    
            
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
                                <div class="col-md-6">
                                    <a href="{{ route('detail.produk', $item->produks->slug ) }}"><h6 class="my-0"><b>{{ \Illuminate\Support\Str::words($item->produks->name, 3, '...') }}</b></h6></a>
                                    <small class="text-muted">{{ date('d F Y',strtotime($item->created_at)) }}</small>
                                </div>
                                <div class="col-md-4">
                                    @if ($item->produks->image)
                                    <img src="{{ asset('storage/'. $item->produks->image) }}" style="width: 50px; height: 50px;" alt="{{ $item->name }}">
                                    @else
                                    <img src="{{ asset('front') }}/img/800x800.png"  style="width: 50px; height: 50px;" alt="{{ $item->name }}">
                                    @endif
                                </div>
                                    <span class="text-muted">Rp. {{ number_format($item->price) }}</span>
                            </li>
                            @php $total += $item->price; @endphp
                            @endforeach
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total Harga Murni (Rp)</span>
                                <strong class="text-success">Rp. {{ number_format($total) }}</strong>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span><b>Total Harga yang sudah di Bayar (Rp)</b></span>
                                <strong class="text-danger">Rp. {{ number_format($orders->total_price) }}</strong>
                            </li>
                        </ul>
                        @if($orders->message_admin == null)

                        @else
                            <h4 class="d-flex justify-content-between align-items-center mb-3 mt-5"> 
                                <span class="text"><b>Catatan dari Admin :</b></span>
                            </h4>
                            <ul class="list-group mb-3 produk">
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><b>{{ $orders->message_admin }}</b></span>
                                </li>
                            </ul>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection