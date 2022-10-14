@extends('frontend.layouts.master')

@section('content')



<div class="error-page-area text-center default-padding">
    <div class="container">
        <div class="error-box">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1>404</h1>
                    <h2>Maaf Halaman Tidak Ditemukan!</h2>
                    <p>
                        Maaf, kami mengalami kesulitan dalam melayani permintaan Anda. Ada kemungkinan Anda mem-bookmark halaman yang lama atau menemui tautan yang tidak bekerja. Silahkan merujuk ke tauan di bawah ini untuk membantu Anda menemukan apa yang Anda cari.  
                    </p>
                    
                    <a class="btn btn-theme effect btn-md" href="{{ route('landing.index') }}">Back To Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection