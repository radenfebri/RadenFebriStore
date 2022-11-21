@extends('frontend.layouts.master')

@section('title', "Keranjang | Raden Febri Store")

@section('content')
<!-- Start Shop 
    ============================================= -->
    <div class="validtheme-shop-area default-padding">
        
        <div class="container">
            <div class="shop-listing-contentes">
                <div class="row align-center">
                    
                    <div class="col-lg-7 col-md-7">
                        <div class="content">
                        </div>
                    </div>
                    
                    <div class="col-lg-5 col-md-5 text-right">
                        <p>
                            <b> Jumlah Barang :</b> <span class="cart-count">0</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="row">
                @if ($produk->count() > 0)
                
                <!-- Start Tab Content -->
                <div class="container">
                    
                    <div class="row">
                        <div class="col-md-12 order-md-1">
                            <h4 class="d-flex justify-content-between align-items-center mb-3">
                                <span class="text"><b>Jumlah Barang :</b></span>
                                <span class="badge badge-success badge-pill cart-count">0</span>
                            </h4>
                            <ul class="list-group mb-3 produk">
                                @php $total = 0; @endphp
                                
                                @foreach ($produk as $item)
                                <li class="list-group-item d-flex justify-content-between lh-condensed produk_data">
                                    <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                                    <div class="col-md-8">
                                        <a href="{{ route('detail.produk', $item->produks->slug ) }}"><h6 class="my-0">{{ \Illuminate\Support\Str::words($item->produks->name, 5, '...') }}</h6></a>
                                        <small class="text-muted">{{ \Illuminate\Support\Str::words($item->produks->small_description, 5, '...') }}</small>
                                    </div>
                                    <div class="col-md-2">
                                        @if ($item->produks->selling_price == null)
                                            <span class="text-muted">Rp. {{ number_format($item->produks->original_price) }}</span>
                                        @else
                                            <span class="text-muted">Rp. {{ number_format($item->produks->selling_price) }}</span>
                                        @endif
                                    </div>
                                    <span>
                                        <a href="{{ route('deletecart') }}" class="delete-cart-item">
                                            <i class="fas fa-trash text-danger" data-toggle="tooltip" title="Hapus Produk"></i>
                                        </a>
                                    </span>

                                </li>
                                @if ($item->produks->selling_price == null)
                                    @php $total += $item->produks->original_price; @endphp
                                @else
                                @php $total += $item->produks->selling_price; @endphp
                                @endif
                                @endforeach
                                
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><b>Total Harga (Rp)</b></span>
                                    <strong>Rp. {{ number_format($total) }}</strong>
                                </li>
                            </ul>
                            
                            <hr class="mb-4">
                            @if ($total > 0)
                                <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-theme effect btn-lg btn-block rounded" type="submit">Lanjut order sekarang</a>
                            @else

                            @endif
                        </div>
                    </div>
                </div>
                
                @else
                <div class="col-md-12 produk">
                    <div class="alert alert-warning">
                        <h4 class="text-center">Keranjang anda masih kosong</h4>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- End Shop -->
    @endsection