@extends('frontend.layouts.master')

@section('title', "Produk Favorit | Raden Febri Store")

@section('content')

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
                        <b> Jumlah Barang :</b> <span class="wish-count">0</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            @if ($favorit->count() > 0)
            
            <div class="container">
                
                <div class="row">
                    <div class="col-md-12 order-md-1">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text"><b>Jumlah Barang :</b></span>
                            <span class="badge badge-success badge-pill wish-count">0</span>
                        </h4>
                        <ul class="list-group mb-3 favorit">
                            
                            @foreach ($favorit as $item)
                            <li class="list-group-item d-flex justify-content-between lh-condensed produk_data">
                                <input type="hidden" class="prod_id" value="{{ $item->prod_id }}">
                                
                                <div class="col-md-6">
                                    <a href="{{ route('detail.produk', $item->produks->slug ) }}"><h6 class="my-0">{{ \Illuminate\Support\Str::words($item->produks->name, 3, '...') }}</h6></a>
                                    <small class="text-muted">{{ \Illuminate\Support\Str::words($item->produks->small_description, 5, '...') }}</small>
                                </div>
                                
                                <div class="col-md-3">
                                    <div>
                                        @if ($item->produks->selling_price == null)
                                            <span class="text-muted">Rp. {{ number_format($item->produks->original_price) }}</span>
                                        @else
                                            <span class="text-muted">Rp. {{ number_format($item->produks->selling_price) }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <span><a href="{{ route('addcart') }}" class="addToCartBtn"><i class="fas fa-shopping-cart text-primary" data-toggle="tooltip" title="Tambah ke Keranjang"></i></a></span>
                                </div>
                                <div class="col-md-2">
                                    <span><a href="{{ route('deletefavorit') }}" class="delete-favorit-item"><i class="fas fa-trash text-danger" data-toggle="tooltip" title="Hapus dari Favorit"></i></a></span>
                                </div>
                                
                            </li>
                            @endforeach
                            
                        </ul>
                        
                        <hr class="mb-4">
                    </div>
                </div>
                {!! $favorit->withQueryString()->links('frontend.layouts.paginator') !!}
                
            </div>
            
            @else
            <div class="col-md-12 produk">
                <div class="alert alert-warning">
                    <h4 class="text-center">Produk Favorit anda masih kosong</h4>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- End Shop -->
@endsection