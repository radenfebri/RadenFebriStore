@extends('frontend.layouts.master')

@section('content')


<div class="breadcrumb-area bg-gray text-center shadow dark text-light bg-cover" style="background-image: url({{ $kategoriproduk->image }});">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h1>{{ $kategoriproduk->name }}</h1>
                <ul class="breadcrumb mb-4">
                    <li><a href="{{ route('semuakategori') }}"><i class="fas fa-home"></i> Semua Kategori</a></li>
                    <li class="active">Detail Kategori</li>
                </ul>
                <ul>
                    <p>{{ $kategoriproduk->description }}</p>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="validtheme-shop-area default-padding">
    
    @if ($produk->count() > 0)
    <div class="container">
        <div class="shop-listing-contentes">
            <div class="row align-center">
                
                <div class="col-lg-7 col-md-7">
                    <div class="content">
                        <ul>
                            <b>Kategori Produk :<span class="text-success"> {{ $kategoriproduk->name }}</span></b>
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-5 col-md-5 text-right">
                    <p>
                        
                        <span><b>Jumlah Semua Produk : <span class="text-primary">{{ $produk->count() }}</span></b></span>
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
                        @foreach ($produk as $item)
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
                                        <a href="{{ $item->kategoriproduk->slug }}">{{ $item->kategoriproduk->name }}</a>
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
            
            {!! $produk->withQueryString()->links('frontend.layouts.paginator') !!}
        </div>
    </div>
    @else
    <div class="container">
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
