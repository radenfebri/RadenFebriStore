@extends('frontend.layouts.master')

@section('content')

<div class="validtheme-shop-area default-padding">
    
    <div class="container mb-5">
        
        <div class="mb-2">
            <div class="contact-box">
                <div class="form-items">
                    <h5><b>Ganti Password</b></h5>
                    <form action="{{ route('update_data_password_google') }}" method="POST" enctype="multipart/form-data">
                        @csrf
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

    
</div>
@endsection