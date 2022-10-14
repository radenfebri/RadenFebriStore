@extends('frontend.layouts.master')

@section('content')

<div class="validtheme-shop-area default-padding">
    
    <div class="container mb-5">
        
        <div class="mb-2">
            <div class="contact-box">
                <div class="form-items">
                    <h5><b>Ganti Password</b></h5>
                    <form action="{{ route('updatepassword') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Password Lama<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('current_password') is-invalid @enderror"  name="current_password" placeholder="Password Lama">
                                    {{-- <span class="alert-error"></span> --}}
                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Password Baru<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"  name="password" placeholder="New Password">
                                    {{-- <span class="alert-error"></span> --}}
                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Confirm Password<span class="text-danger">*</span></label>
                                    <input type="password" class="form-control @error('password_cofirmation') is-invalid @enderror"  name="password_confirmation" placeholder="Confirm Password" >
                                    {{-- <span class="alert-error"></span> --}}
                                    @error('current_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit">
                                    Update Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    <hr class="mb-5 mt-5">
    <div class="container">
        
        <div class="mb-5 mt-5">
            <div class="contact-box">
                <div class="form-items">
                    <h5><b>Change Email atau Nama</b></h5>
                    <form action="{{ route('updatedata') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Nama Baru<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" placeholder="Nama Baru" >
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">No WA<span class="text-danger">*</span></label>
                                    <input type="number" class="form-control  @error('no_hp') is-invalid @enderror" name="no_hp" value="{{ Auth::user()->no_hp }}" placeholder="083453465345" >
                                    @error('no_hp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="">Email Baru<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control  @error('email') is-invalid @enderror" value="{{ Auth::user()->email }}" name="email" placeholder="Email Baru">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-lg-12">
                                <button type="submit" name="submit" id="submit">
                                    Update Data
                                </button>
                            </div>
                        </div>
                        <!-- Alert Message -->
                        <div class="col-lg-12 alert-notification">
                            <div id="message" class="alert-msg"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
    
</div>
@endsection