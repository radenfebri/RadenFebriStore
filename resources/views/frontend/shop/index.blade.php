@extends('frontend.layouts.master')

@section('content')


<div class="breadcrumb-area bg-gray text-center shadow dark text-light bg-cover" style="background-image: url({{ asset('front') }}/img/2440x1578.png);">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h1>Our Products</h1>
                <ul class="breadcrumb">
                    <li><a href="{{ route('landing.index') }}"><i class="fas fa-home"></i> Home</a></li>
                    <li class="active">Shop</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="validtheme-shop-area default-padding">
    
    @if ($produks->count() > 0)
    
    <div class="container">
        <div class="container mb-5 d-xl-none d-sm-none">
            <form action="{{ route('semuaproduk') }}">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="keyword" value="{{ $keyword }}" placeholder="Search Produk.." aria-describedby="button-addon2">
                                <button class="btn" style="background-color: #f35a38; color: white; cursor: pointer;" type="submit" >Cari Produk</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="shop-listing-contentes">
            <div class="row align-center">
                
                <div class="col-lg-7 col-md-7">
                    <div class="content">
                        <ul id="tabs" class="nav nav-tabs">
                            <span><b>Jumlah Kategori Produk :</b></span>
                        </ul>
                        <ul>
                            <b><span class="text-success"> {{ $kategoriproduk->count() }}</span></b>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-5 col-md-5 text-right">
                    <p>
                        
                        <span><b>Jumlah Produk Semua : <span class="text-primary">{{ $allproduk->count() }}</span></b></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    
    <div class="container">
        <div class="row">
            <!-- Start Tab Content -->
            <div id="tabsContent" class="tab-content tab-content-info">
                <!-- Tab Single -->
                <div id="grid-view" class="tab-pane fade active show">
                    <ul class="vt-products columns-4">
                        @foreach ($allproduk as $item)
                        <li class="product produk_data">
                            <div class="product-contents">
                                <input type="hidden" value="{{ $item->id }}" class="prod_id" id="">
                                <div class="product-image">
                                    @if ($item->popular == 1)
                                    <span class="onsale">Populer!</span>
                                    @else
                                    
                                    @endif
                                    <a href="{{ route('detail.produk', $item->slug ) }}">
                                        @if ($item->cover == null)
                                        <img src="{{ asset('front') }}/img/800x800.png" alt="Product">
                                        @else
                                        <img src="{{ asset('storage/'.$item->cover) }}" alt="Product">
                                        @endif
                                    </a>
                                    <div class="shop-action">
                                        <ul>
                                            <li class="wishlist">
                                                <a href="{{ route('addfavorit') }}" class="addToWishlist" data-toggle="tooltip" data-placement="bottom" title="Favorit"></a>
                                            </li>
                                            <li class="quick-view">
                                                <a href="{{ route('detail.produk', $item->slug ) }}" data-toggle="tooltip" data-placement="bottom" title="Lihat Detail"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-caption">
                                    <div class="tags">
                                        @if ( $item->kategoriproduk == null)
                                        <a href="#">Produk no Kategori</a>
                                        @else
                                        <a href="{{ route('detail.kategori', $item->kategoriproduk->slug) }}">{{ $item->kategoriproduk->name }}</a>
                                        @endif
                                    </div>
                                    <h4 class="product-title">
                                        <a href="{{ route('detail.produk', $item->slug ) }}">{{ $item->name }}</a>
                                    </h4>
                                    <div class="review-count">
                                        @if($item->ratings->count() > 0)
                                        @php $item->ratings->count() @endphp
                                        @php $coba = $item->ratings->sum('stars_rated') / $item->ratings->count() @endphp
                                        @else   
                                        @php $coba = 0 @endphp
                                        @endif
                                        
                                        @php $rate_num = number_format($coba) @endphp
                                        <div class="rating">
                                            @for($i = 1; $i <= $rate_num; $i++)
                                            <i class="fas fa-star"></i>
                                            @endfor
                                            @for($j = $rate_num+1; $j <= 5; $j++)
                                            <i class="fas fa-star" style="color: #b4afaf"></i>
                                            @endfor
                                        </div>
                                        <span>
                                            @if($item->ratings->count() > 0)
                                            ({{ $item->ratings->count() }} Rating)
                                            @else
                                            No Rating
                                            @endif
                                        </span>
                                    </div>
                                    <div class="bottom">
                                        <div class="price">
                                            @if ($item->selling_price == null)
                                            <span>Rp.{{ number_format($item->original_price) }}</span>
                                            @elseif($item->selling_price != 0)
                                            <span><del>Rp.{{ number_format($item->original_price) }}</del></span>
                                            <span>Rp.{{ number_format($item->selling_price) }}</span>
                                            @endif
                                        </div>
                                        <div class="cart">
                                            <a href="{{ route('addcart') }}" class="addToCartBtn" data-toggle="tooltip" data-placement="left" title="Add to Cart">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                        
                        
                    </ul>
                </div>
                <!-- End Single -->
            </div>
            
            {!! $produks->withQueryString()->links('frontend.layouts.paginator') !!}
        </div>
    </div>
    
    
    
    
    @else
    <div class="container mb-5 d-xl-none d-sm-none">
        <div class="container">
            <form action="{{ route('semuaproduk') }}">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <div class="input-group">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="keyword" value="{{ $keyword }}" placeholder="Search Kategori.." aria-describedby="button-addon2">
                                <button class="btn" style="background-color: #f35a38; color: white; cursor: pointer;" type="submit" >Cari Kategori</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12 produk">
                    <div class="alert alert-warning">
                        <h4 class="text-center">Produk masih kosong</h4>
                    </div>
                </div>
            </div>
        </div>
        
        @endif
        
        
        
    </div>
    
    
    @endsection