@extends('frontend.layouts.master')

@section('title', "Orderan Saya | Raden Febri Store")

@section('content')

<div class="validtheme-shop-area default-padding">
    
    <div class="container">
        <div class="shop-listing-contentes">
            <div class="row align-center">
                
                <div class="col-lg-7 col-md-7">
                    <div class="content">
                        <!-- Tab Nav -->
                        {{-- <input type="search"> --}}
                        <!-- End Tab Nav -->
                    </div>
                </div>
                
                <div class="col-lg-5 col-md-5 text-right">
                    <p>
                        <b>Total Orderan : <span class="order-count">0</span></b>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container">
        <div class="row">
            @if ($orders->count() > 0)
            
            <!-- Start Tab Content -->
            <div class="container">
                
                <div class="row">
                    <div class="col-md-12 order-md-1">
                        <h4 class="d-flex justify-content-between align-items-center mb-3"> 
                            <span class="text"><b>Jumlah Order :</b></span>
                            <span class="badge badge-success badge-pill order-count">0</span>
                        </h4>
                        <ul class="list-group mb-3 produk">
                            @foreach ($orders as $item)
                            <li class="list-group-item d-flex justify-content-between lh-condensed produk_data">
                                <div>
                                    @if ($item->status == '1')
                                        <a href="{{ route('historyorder', encrypt($item->id)) }}"><h6 class="my-0"><b>{{ $item->tracking_no }}</b></h6></a>
                                    @else
                                        <a href="{{ route('orderbayar', encrypt($item->id)) }}"><h6 class="my-0"><b>{{ $item->tracking_no }}</b></h6></a>
                                    @endif
                                    <small class="text-muted">{{ date('d F Y',strtotime($item->created_at)) }}</small>
                                </div>
                                <span class="text-muted">Rp. {{ number_format($item->total_price) }}</span>
                                @if ($item->status == '0')
                                <span class="text-danger text-center"><b>Unpaid</b></span>
                                @else
                                <span class="text-success text-center"><b>Paid</b></span>
                                @endif
                                <div class="input-group-prepend">
                                    <a href="#" class="text-primary dropdown-toggle" data-toggle="dropdown"><i class="fas fa-eye"></i></a>
                                    <div class="dropdown-menu">
                                        @if ($item->status == '1')
                                        <a class="dropdown-item" href="{{ route('historyorder', encrypt($item->id)) }}">Detail Produk</a>
                                        @else
                                        <a class="dropdown-item" href="{{ route('orderbayar', encrypt($item->id)) }}">Detail Bayar</a>
                                        @endif
                                        @if ($item->status == '0')
                                        <a href="https://api.whatsapp.com/send?phone=62085156000254&text=Hallo%20kak%20%2ARaden%20Febri%2A%2C%20saya%20mau%20Konfirmasi%20sudah%20melakukan%20pembayaran%20dengan%20data%20berikut%3A%0D%0A%0D%0ANama%20%3A%20%2A{{ $item->name }}%2A%0D%0AEmail%20%3A%20%2A{{ $item->email }}%2A%0D%0ANo%20Pesanan%20%3A%20%2A%23{{ $item->tracking_no }}%2A%0D%0ASudah%20Membayar%20%3A%20%2ARp.%20{{ number_format($item->total_price) }}%2A%0D%0ATanggal%20Pesanan%20dibuat%20%3A%20%2A{{ date('d F Y h:i:s',strtotime($item->created_at)) }}%2A%0D%0ACatatan%20%3A%20%2A{{ $item->message }}%2A%0D%0A%0D%0ATolong%20Segera%20di%20Proses%20ya%20kak%21%21%21%0D%0ASaya%20Ucapkan%20%2ATerima%20kasih%2A" class="dropdown-item" target="_blank">
                                            Konfirmasi Bayar
                                        </a>
                                        {{-- <a class="dropdown-item" href="#">Separated link</a> --}}
                                        @endif
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    {!! $orders->withQueryString()->links('frontend.layouts.paginator') !!}

                </div>
                
                @else
                <div class="col-md-12 produk">
                    <div class="alert alert-warning">
                        <h4 class="text-center">Orderan anda masih Kosong</h4>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
    <!-- End Shop -->

    @endsection