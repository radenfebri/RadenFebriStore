@extends('frontend.layouts.master')

@section('content')

<div class="banner-area auto-height">
    <div class="box-banner">
        <div class="container">
            <div id="bootcarousel" class="carousel carousel-fade slide animate_text" data-ride="carousel">
                
                <!-- Indicators for slides -->
                <div class="carousel-indicator">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <ol class="carousel-indicators theme">
                                    <li data-target="#bootcarousel" data-slide-to="0" class="active"></li>
                                    <li data-target="#bootcarousel" data-slide-to="1"></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Wrapper for slides -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <div class="row align-center">
                            <div class="col-lg-6">
                                <div class="content">
                                    <h2 data-animation="animated fadeInLeft">women fashion <strong>Top new winter collection</strong></h2>
                                    <p class="animated fadeInUp">
                                        Northward sportsmen education. Discovery incommode earnestly no he commanded was talent enough.
                                    </p>
                                    <a data-animation="animated fadeInDown" class="btn btn-theme effect btn-sm" href="#">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="thumb" data-animation="animated fadeInUp">
                                    <img src="{{ asset('front') }}/img/thumb/1.png" alt="Thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <div class="row align-center">
                            <div class="col-lg-6">
                                <div class="content">
                                    <h2 data-animation="animated fadeInLeft">Supper value deals <strong>New fashion collection</strong></h2>
                                    <p class="animated fadeInUp">
                                        Northward sportsmen education. Discovery incommode earnestly no he commanded was talent enough.
                                    </p>
                                    <a data-animation="animated fadeInDown" class="btn btn-theme effect btn-sm" href="#">Shop Now</a>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="thumb" data-animation="animated fadeInUp">
                                    <img src="{{ asset('front') }}/img/thumb/2.png" alt="Thumb">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Wrapper for slides -->
                
                
            </div>
        </div>
    </div>
</div>
<!-- End Banner -->

<!-- Star Product
    ============================================= -->
    <div class="product-area default-padding bottom-less">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="heading-center text-center">
                        <h5>Produk Baru</h5>
                        <h2>Berikut Produk Baru Rilis</h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <ul class="vt-products columns-3">
                    <!-- Single product -->
                    
                    
                    @forelse ($produks as $item)
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
                                    @if ($item->kategoriproduk == null)
                                    <a href="#">Produk non Kategori</a>
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
                                        @elseif($item->selling_price != null)
                                        <span><del>{{ number_format($item->original_price) }}</del></span>
                                        <span>Rp.{{ number_format($item->selling_price) }}</span>
                                        @endif
                                    </div>
                                    <div class="cart">
                                        <a href="{{ route('addcart') }}" class="addToCartBtn" data-toggle="tooltip" data-placement="left" title="Tambah Ke Keranjang">
                                            <i class="fas fa-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    
                    
                    @empty
                    <span>Data Masih Kosong</span>
                    @endforelse
                    <!-- Single product -->
                    
                </ul>
            </div>
        </div>
    </div>
    
    
    <!-- End Product -->
    
    <!-- Start Offer Area
        ============================================= -->
        <div class="product-offer-area default-padding-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 single-item">
                        <div class="item" style="background-image: url({{ asset('front') }}/img/800x800.png);">
                            <p>Smar Offer</p>
                            <h2>Save 20% on <br> Woman Bag</h2>
                            <a href="#">Shop Now <i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-6 single-item">
                        <div class="item" style="background-image: url({{ asset('front') }}/img/800x800.png);">
                            <p>Summer Offer</p>
                            <h2>Save 45% on <br> Great Summer Collection</h2>
                            <a href="#">Shop Now <i class="far fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Offer Area -->
        
        <!-- Start Category
            ============================================= -->
            <div class="product-category-area default-padding bg-gray">
                <div class="container">
                    <div class="heading-left">
                        <div class="row">
                            <div class="col-lg-6">
                                <h2>Kategori Populer</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="category-carousel owl-carousel owl-theme">
                                @if ($kategoriproduk->count() > 0)
                                @foreach ($kategoriproduk as $item)
                                <div class="item">
                                    <a href="{{ route('detail.kategori', $item->slug) }}">
                                        @if ($item->image == null)
                                        <img src="{{ asset('front') }}/img/category/phone.png" alt="Thumb">
                                        @else
                                        <img src="{{ asset('storage/'.$item->image) }}" alt="Thumb">
                                        @endif
                                        <h6>{{ $item->name }}</h6>
                                    </a>
                                </div>
                                @endforeach
                                @else
                                Data Masih Kosong
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Category -->
            
            <!-- Star Product
                ============================================= -->
                <div class="featured-product-area carousel-shadow default-padding">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-6 offset-lg-3">
                                <div class="heading-center text-center">
                                    <h5>Produk Populer</h5>
                                    <h2>Berikut Produk Best Seller</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container-full">
                        <div class="row">
                            <div class="col-lg-4 product-info" style="background-image: url({{ asset('front') }}/img/800x800.png);">
                                <div class="content">
                                    <h4>Women Fashion</h4>
                                    <h2>Get <strong>45%</strong> off</h2>
                                    <a class="btn circle btn-theme effect btn-sm" href="#">View all Products</a>
                                </div>
                            </div>
                            
                            <div class="col-lg-8">
                                <ul class="vt-products featured-product-carousel owl-carousel owl-theme">
                                    <!-- Single product -->
                                    @forelse ($popular as $item)
                                    <li class="product produk_data">
                                        <input type="hidden" value="{{ $item->id }}" class="prod_id" id="">
                                        <div class="product-contents">
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
                                                            <a href="{{ route('addfavorit') }}" class="addToWishlist"></a>
                                                        </li>
                                                        <li class="quick-view">
                                                            <a href="{{ route('detail.produk', $item->slug ) }}"></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="product-caption">
                                                <div class="tags">
                                                    @if ($item->kategoriproduk == null)
                                                    <a href="#">Produk non Kategori</a>
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
                                                        @elseif($item->selling_price != null)
                                                        <span><del>{{ number_format($item->original_price) }}</del></span>
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
                                    @empty
                                    Data Masih Kosong
                                    @endforelse
                                    
                                    <!-- Single product -->
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Product -->
                
                <!-- Star Shop Features
                    ============================================= -->
                    <div class="shop-features-area bg-gray default-padding text-center">
                        <div class="container">
                            <div class="features-content">
                                <div class="row">
                                    <!-- Single item -->
                                    <div class="single-item col-lg-4 col-md-6">
                                        <div class="item">
                                            <i class="fas fa-box"></i>
                                            <h4>Shipping Worldwide</h4>
                                            <p>
                                                Special financing and earn rewards.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- End Single item -->
                                    <!-- Single item -->
                                    <div class="single-item col-lg-4 col-md-6">
                                        <div class="item">
                                            <i class="fa fa-undo"></i>
                                            <h4>Product Return</h4>
                                            <p>
                                                14-days free return policy.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- End Single item -->
                                    <!-- Single item -->
                                    <div class="single-item col-lg-4 col-md-6">
                                        <div class="item">
                                            <i class="fas fa-shield-alt"></i>
                                            <h4>Security Payment</h4>
                                            <p>
                                                We accept all major credit cards.
                                            </p>
                                        </div>
                                    </div>
                                    <!-- End Single item -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Shop Features -->
                    
                    <!-- Star Blog
                        ============================================= -->
                        <div class="blog-area full-blog default-padding bottom-less">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-6 offset-lg-3">
                                        <div class="heading-center text-center">
                                            <h5>Latest News</h5>
                                            <h2>Most Popular Breaking News & Top Stories</h2>
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-items">
                                    <div class="row">
                                        <!-- Single Item -->
                                        <div class="col-lg-4 col-md-6 single-item">
                                            <div class="item">
                                                <div class="thumb">
                                                    <img src="{{ asset('front') }}/img/1500x1000.png" alt="Thumb">
                                                    <div class="date">15 Jul, 2021</div>
                                                </div>
                                                <div class="info">
                                                    <h4>
                                                        <a href="#">Discovery incommode earnestly commanded</a>
                                                    </h4>
                                                    <div class="footer-meta">
                                                        <ul>
                                                            <li>
                                                                <img src="{{ asset('front') }}/img/100x100.png" alt="Author">
                                                                <span>By </span>
                                                                <a href="#">John Baus</a>
                                                            </li>
                                                            <li>
                                                                <span>In </span>
                                                                <a href="#">Agency</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <p>
                                                        Sitting mistake towards his few country ask. You delighted two rapturous pointing depending objection happiness.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Item -->
                                        <!-- Single Item -->
                                        <div class="col-lg-4 col-md-6 single-item">
                                            <div class="item">
                                                <div class="thumb">
                                                    <img src="{{ asset('front') }}/img/1500x1000.png" alt="Thumb">
                                                    <div class="date">26 Aug, 2021</div>
                                                </div>
                                                <div class="info">
                                                    <h4>
                                                        <a href="#">Extremely depending he gentleman improving. </a>
                                                    </h4>
                                                    <div class="footer-meta">
                                                        <ul>
                                                            <li>
                                                                <img src="{{ asset('front') }}/img/100x100.png" alt="Author">
                                                                <span>By </span>
                                                                <a href="#">Mun Paul</a>
                                                            </li>
                                                            <li>
                                                                <span>In </span>
                                                                <a href="#">Digital</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <p>
                                                        Sitting mistake towards his few country ask. You delighted two rapturous pointing depending objection happiness.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Item -->
                                        <!-- Single Item -->
                                        <div class="col-lg-4 col-md-6 single-item">
                                            <div class="item">
                                                <div class="thumb">
                                                    <img src="{{ asset('front') }}/img/1500x1000.png" alt="Thumb">
                                                    <div class="date">18 Sep, 2021</div>
                                                </div>
                                                <div class="info">
                                                    <h4>
                                                        <a href="#">Prevailed remainder may propriety can and. </a>
                                                    </h4>
                                                    <div class="footer-meta">
                                                        <ul>
                                                            <li>
                                                                <img src="{{ asset('front') }}/img/100x100.png" alt="Author">
                                                                <span>By </span>
                                                                <a href="#">Hesam Doe</a>
                                                            </li>
                                                            <li>
                                                                <span>In </span>
                                                                <a href="#">Creative</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <p>
                                                        Sitting mistake towards his few country ask. You delighted two rapturous pointing depending objection happiness.
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Item -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Blog -->
                        
                        
                        
                        @endsection