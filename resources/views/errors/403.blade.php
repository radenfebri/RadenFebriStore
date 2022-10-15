@extends('frontend.layouts.master')

@section('content')

<div class="error-page-area text-center default-padding">
    <div class="container">
        <div class="error-box">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <h1>403</h1>
                    <h2>Anda tidak memiliki akses!</h2>
                    <p>
                        Maaf, anda tidak memiliki akses ke link ini kemungkinan anda sekarang masih memiliki role biasa, silahkan hubungi admin apabila anda memiliki suatu pertanyaan.  
                    </p>

                    <a class="btn btn-theme effect btn-md" href="{{ route('landing.index') }}">Back To Home</a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection