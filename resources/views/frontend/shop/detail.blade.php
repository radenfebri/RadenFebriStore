@extends('frontend.layouts.master')

@section('content')


<div class="breadcrumb-area bg-gray text-center shadow dark text-light bg-cover" style="background-image: url({{ asset('front') }}/img/2440x1578.png);">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">
                <h1>Shop Details</h1>
                <ul class="breadcrumb">
                    <li><a href="{{ route('semuaproduk') }}"><i class="fas fa-shopping-cart"></i> Shop</a></li>
                    <li class="active">Details</li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="validtheme-shop-single-area default-padding">
    <div class="container">
        <div class="product-details">
            <div class="row">
                
                <div class="col-lg-6">
                    <div class="product-thumb">
                        <div class="carousel slide" data-ride="carousel" id="timeline-carousel">
                            @if ($images->count() > 0)
                            <div class="carousel-inner item-box">
                                @if ($images->count() > 0)
                                @foreach ($images as $key => $item)
                                <div class="carousel-item product-item {{ $key == '0' ? 'active':'' }}">
                                    <a href="{{ asset('storage/images-produk/'. $item->image) }}" class="item popup-gallery">
                                        <img src="{{ asset('storage/images-produk/'. $item->image) }}" alt="{{ $produk->name }}">
                                    </a>
                                    @if ($produk->popular == 1)
                                    <span class="onsale">Populer!</span>
                                    @else
                                    
                                    @endif
                                </div>
                                @endforeach
                                @else
                                <div class="carousel-item product-item active">
                                    <a href="{{ asset('front') }}/img/800x800.png" class="item popup-gallery">
                                        <img src="{{ asset('front') }}/img/800x800.png" alt="Thumb">
                                    </a>
                                    @if ($produk->popular == 1)
                                    <span class="onsale">Populer!</span>
                                    @else
                                    
                                    @endif
                                </div>
                                @endif
                            </div>
                            @else
                            <div class="carousel-inner item-box">
                                <div class="carousel-item product-item active">
                                    <a href="{{ asset('front') }}/img/800x800.png" class="item popup-gallery">
                                        <img src="{{ asset('front') }}/img/800x800.png" alt="Thumb">
                                    </a>
                                    @if ($produk->popular == 1)
                                    <span class="onsale">Populer!</span>
                                    @else
                                    
                                    @endif
                                </div>
                                <div class="carousel-item product-item">
                                    <a href="{{ asset('front') }}/img/800x800.png" class="item popup-gallery">
                                        <img src="{{ asset('front') }}/img/800x800.png" alt="Thumb">
                                    </a>
                                    @if ($produk->popular == 1)
                                    <span class="onsale">Populer!</span>
                                    @else
                                    
                                    @endif
                                </div>
                                <div class="carousel-item product-item">
                                    <a href="{{ asset('front') }}/img/800x800.png" class="item popup-gallery">
                                        <img src="{{ asset('front') }}/img/800x800.png" alt="Thumb">
                                    </a>
                                    @if ($produk->popular == 1)
                                    <span class="onsale">Populer!</span>
                                    @else
                                    
                                    @endif
                                </div>
                                <div class="carousel-item product-item">
                                    <a href="{{ asset('front') }}/img/800x800.png" class="item popup-gallery">
                                        <img src="{{ asset('front') }}/img/800x800.png" alt="Thumb">
                                    </a>
                                    @if ($produk->popular == 1)
                                    <span class="onsale">Populer!</span>
                                    @else
                                    
                                    @endif
                                </div>
                            </div>
                            @endif
                            
                            
                            <!-- Carousel Indicators -->
                            <ol class="carousel-indicators">
                                <div class="product-gallery-carousel owl-carousel owl-theme">
                                    @if ($images->count() > 0) 
                                    @foreach ($images as $key => $item)
                                    <li data-target="#timeline-carousel" data-slide-to="{{ $key }}" class="active">
                                        <img src="{{ asset('storage/images-produk/'. $item->image) }}" alt="{{ $produk->name }}">
                                    </li>
                                    @endforeach
                                    @else
                                    <li data-target="#timeline-carousel" data-slide-to="0" class="active">
                                        <img src="{{ asset('front') }}/img/800x800.png" alt="{{ $produk->name }}">
                                    </li>
                                    @endif
                                </div>
                            </ol>
                            
                            
                            <!-- Left and right controls -->
                            <a class="left carousel-control light" href="#timeline-carousel" data-slide="prev">
                                <i class="fas fa-angle-left"></i>
                            </a>
                            <a class="right carousel-control light" href="#timeline-carousel" data-slide="next">
                                <i class="fas fa-angle-right"></i>
                            </a>
                            
                            
                            <!-- End Carousel Content -->
                            
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 produk_data">
                    <input type="hidden" value="{{ $produk->id }}" class="prod_id" id="">
                    <div class="single-product-contents">
                        <h2 class="product-title">
                            {{ $produk->name }}
                        </h2>
                        <div class="summary-top-box">
                            <div class="review-count">
                                @php $rate_num = number_format($rating_avg) @endphp
                                <div class="rating">
                                    @for($i = 1; $i <= $rate_num; $i++)
                                    <i class="fas fa-star"></i>
                                    @endfor
                                    @for($j = $rate_num+1; $j <= 5; $j++)
                                    <i class="fas fa-star" style="color: #b4afaf"></i>
                                    @endfor
                                </div>
                                <span>
                                    @if($ratings->count() > 0)
                                    ({{ $ratings->count() }} Rating)
                                    @else
                                    No Rating
                                    @endif
                                </span>
                            </div>
                        </div>
                        <div class="price">
                            @if ($produk->selling_price == null)
                            <span>Rp.{{ number_format($produk->original_price) }}</span>
                            @elseif($produk->selling_price != null)
                            <span><del>Rp.{{ number_format($produk->original_price) }}</del></span>
                            <span>Rp.{{ number_format($produk->selling_price) }}</span>
                            @endif
                        </div>
                        <p>
                            {{ $produk->small_description }}
                        </p>
                        <div class="product-purchase-list">
                            <a href="{{ route('addcart') }}" class="btn addToCartBtn">
                                <i class="ti-shopping-cart"></i>
                                <span>Add to cart</span>
                            </a>
                            <div class="shop-action addToWishlist">
                                <ul>
                                    <li class="wishlist">
                                        <a href="{{ route('addfavorit') }}"></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="product-estimate-delivary">
                            <i class="fas fa-box-open"></i>
                            <strong> 1x24 Jam Proses</strong>
                            <span>Pengiriman pesanan cepat dan terpercaya!</span>
                        </div>
                        <div class="product-meta">
                            <span class="posted-in">
                                <strong>Kategori :</strong>
                                @if ( $produk->kategoriproduk == null )
                                <a href="#">Produk non Kategori</a>
                                @else
                                <a href="{{ route('detail.kategori', $produk->kategoriproduk->slug) }}">{{ $produk->kategoriproduk->name }}</a>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Product Bottom Info  -->
        <div class="single-product-bottom-info">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Tab Nav -->
                    <ul id="tabs" class="nav nav-tabs">
                        <li class="nav-item">
                            <a  href="" data-target="#description" data-toggle="tab" class="active nav-link">
                                Deskripsi
                            </a>
                        </li>
                        <li class="nav-item">
                            <a  href="" data-target="#review" data-toggle="tab" class="nav-link">
                                Penilaian
                            </a>
                        </li>
                    </ul>
                    <!-- End Tab Nav -->
                    <!-- Start Tab Content -->
                    <div id="tabsContent" class="tab-content tab-content-info">
                        
                        <!-- Tab Single -->
                        <div id="description" class="tab-pane fade active show">
                            <p>
                                {!! $produk->description !!}
                            </p>
                        </div>
                        <!-- End Single -->
                        
                        <!-- Tab Single -->
                        <div id="review" class="tab-pane fade">
                            <h4 class="shop-bottom-title">{{ $ratings->count() }} Penilaian produk <strong> {{ $produk->name }}</strong></h4>
                            <div class="review-items mb-5">
                                
                                @forelse ($ratings as $item)
                                <div class="item">
                                    <div class="thumb">
                                        <img src="{{ asset('front') }}/img/user.jpeg" alt="Thumb">
                                    </div>
                                    <div class="info">
                                        <div class="rating">
                                            @php
                                            $rating = App\Models\Rating::where('prod_id', $produk->id)->where('user_id', $item->user->id)->first();
                                            
                                            @endphp
                                            @if ($rating)
                                            @php $user_rated = $rating->stars_rated @endphp
                                            @for($i = 1; $i <= $user_rated; $i++)
                                            <i class="fas fa-star"></i>
                                            @endfor
                                            @for($j = $user_rated+1; $j <= 5; $j++)
                                            <i class="fas fa-star" style="color: #b4afaf"></i>
                                            @endfor
                                            @endif
                                        </div>
                                        <div class="review-date">{{ $item->created_at->format('d M Y') }}</div>
                                        <div class="review-authro"><h5>{{ $item->user->name }}</h5></div>
                                        <p>
                                            {{ $item->user_review }}.
                                        </p>
                                    </div>
                                </div>
                                @empty
                                <div class="review-items">
                                    <div class="item">
                                        <div class="info">
                                            <div class="review-authro"><h5><center>Belum ada penilaian</center></h5></div>
                                        </div>
                                    </div>
                                </div>
                                @endforelse
                                {{-- {!! $ratings->withQueryString()->links('frontend.layouts.paginator') !!} --}}
                                
                            </div>
                            
                            
                            @guest
                            
                            @else
                            
                            @if ($cek_user->count() > 0)
                            
                            <div class="review-form mt-5">
                                <h4 class="shop-bottom-title">Berikan penilaian anda</h4>
                                <form action="{{ route('rating') }}" method="POST">
                                    @csrf 
                                    <input type="hidden" name="produk_id" value="{{ $produk->id }}">
                                    <div class="add-rating">
                                        <div class="rating-css">
                                            <div class="container">
                                                <div class="row">
                                                    <div class="col-lg-8 offset-lg-2">
                                                        <div class="star-icon">
                                                            @if($user_rating)
                                                            
                                                            @for($i = 1; $i <= $user_rating->stars_rated; $i++)
                                                            <input type="radio" value="{{ $i }}" name="produk_rating" checked id="rating{{ $i }}">
                                                            <label for="rating{{ $i }}" class="fa fa-star"></label>
                                                            @endfor
                                                            
                                                            @for($j = $user_rating->stars_rated+1; $j <= 5; $j++)
                                                            <input type="radio" value="{{ $j }}" name="produk_rating" id="rating{{ $j }}">
                                                            <label for="rating{{ $j }}" class="fa fa-star"></label>
                                                            @endfor
                                                            
                                                            @else
                                                            
                                                            <input type="radio" value="1" name="produk_rating" checked id="rating1">
                                                            <label for="rating1" class="fa fa-star"></label>
                                                            <input type="radio" value="2" name="produk_rating" id="rating2">
                                                            <label for="rating2" class="fa fa-star"></label>
                                                            <input type="radio" value="3" name="produk_rating" id="rating3">
                                                            <label for="rating3" class="fa fa-star"></label>
                                                            <input type="radio" value="4" name="produk_rating" id="rating4">
                                                            <label for="rating4" class="fa fa-star"></label>
                                                            <input type="radio" value="5" name="produk_rating" id="rating5">
                                                            <label for="rating5" class="fa fa-star"></label>
                                                            
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @if($user_rating == null)
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group comments">
                                                <textarea class="form-control" id="user_review" name="user_review" placeholder="Berikan Penilaian anda mengenai produk ini *"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="row">
                                            <button type="submit" name="submit" id="submit">
                                                Kirim Penilaian <i class="fa fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    @else
                                    
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group comments">
                                                <textarea class="form-control" id="user_review" name="user_review" placeholder="Berikan Penilaian anda mengenai produk ini *">{{ $user_rating->user_review }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <button type="submit" name="submit" id="submit">
                                                Update Penilaian <i class="fa fa-paper-plane"></i>
                                            </button>
                                        </div>
                                    </div>   
                                    @endif
                                    
                                </form>
                                
                                
                                <!-- Alert Message -->
                                <div class="col-md-12 alert-notification">
                                    <div id="message" class="alert-msg"></div>
                                </div>
                                
                                
                            </div>
                            
                            @else
                            
                            @endif
                            
                            @endguest
                        </div>
                        <!-- End Tab Single -->
                        
                    </div>
                    <!-- End Tab Content -->
                </div>
            </div>
        </div>
        <!-- End Product Bottom Info  -->
        
        <!-- Related Product  -->
        <div class="related-products carousel-shadow ">
            <div class="row">
                <div class="col-lg-12">
                    <h3>Produk Populer</h3>
                    <ul class="vt-products related-product-carousel owl-carousel owl-theme">
                        @if ($populer->count() > 0)
                        @foreach ($populer as $item)
                        <!-- Single product -->
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
                                            <span><del>Rp.{{ number_format($item->original_price) }}</del></span>
                                            <span>Rp.{{ number_format($item->selling_price) }}</span>
                                            @endif
                                        </div>
                                        <div class="cart">
                                            <a href="{{ route('addcart') }}" class="addToCartBtn" data-toggle="tooltip" data-placement="left" title="Tambah ke Keranjang">
                                                <i class="fas fa-shopping-cart"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <!-- Single product -->
                        @endforeach
                        @else
                        
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Related Product  -->
    </div>
</div>
<!-- End Shop -->

@endsection