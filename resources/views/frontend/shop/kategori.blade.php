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
    
    @if ($kategoriproduk->count() > 0)
    
    <div class="container">
        <div class="container mb-5 ">
            <form action="{{ route('semuakategori') }}">
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

        <div class="shop-listing-contentes">
            <div class="row align-center">
                
                <div class="col-lg-7 col-md-7">
                    <div class="content">
                        <ul id="tabs" class="nav nav-tabs">

                        </ul>
                        <ul>
                            {{-- <b><span class="text-success"> {{ $kategoriproduk->count() }}</span></b> --}}
                        </ul>
                    </div>
                </div>
                
                <div class="col-lg-5 col-md-5 text-right">
                    <p>
                        
                        <span><b>Jumlah Semua Kategori : <span class="text-primary">{{ $kategoriproduk->count() }}</span></b></span>
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
                        @foreach ($allkategori as $item)
                            <li class="product produk_data">
                                <div class="product-contents">
                                    <div class="product-image">
                                        @if ($item->popular == 1)
                                        <span class="onsale">Populer!</span>
                                        @else
                                        
                                        @endif
                                        <a href="{{ route('detail.kategori', $item->slug) }}">
                                            @if ($item->image == null)
                                                <img src="{{ asset('front') }}/img/800x800.png" loading="lazy" alt="Product">
                                            @else
                                                <img src="{{ asset('storage/'.$item->image) }}" loading="lazy" alt="Product Image">
                                            @endif
                                        </a>
                                        <div class="shop-action">
                                            <ul>
                                                <li class="quick-view">
                                                    <a href="{{ route('detail.kategori', $item->slug) }}" data-toggle="tooltip" data-placement="bottom" title="Lihat Detail Kategori"></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-caption">
                                        <center>
                                            <h4 class="product-title">
                                                <a href="{{ route('detail.kategori', $item->slug) }}">{{ $item->name }}</a>
                                            </h4>
                                        </center>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        
                        
                    </ul>
                </div>
                <!-- End Single -->
            </div>

            {!! $kategoriproduk->withQueryString()->links('frontend.layouts.paginator') !!}
        </div>
    </div>
    
    
    
    
    @else

    <div class="container mb-5 ">
        <form action="{{ route('semuakategori') }}">
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
    
    <div class="container">
        <div class="row">
            <div class="col-md-12 produk">
                <div class="alert alert-warning">
                    <h4 class="text-center">Kategori masih kosong</h4>
                </div>
            </div>
        </div>
    </div>
    
    @endif
    
    
    
</div>

@endsection