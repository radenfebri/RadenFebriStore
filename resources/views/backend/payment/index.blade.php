@extends('backend.layouts.master-lainnya')

@section('content')

<div id="content" class="main-content">
    <div class="layout-px-spacing">
        
        <div class="middle-content container-xxl p-0">
            
            <div class="page-meta">
                <nav class="breadcrumb-style-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Kategori Produk</li>
                    </ol>
                </nav>
            </div>
            
            <div class="row mb-4 layout-spacing layout-top-spacing">
                
                <div class="col-xxl-9 col-xl-12 col-lg-12 col-md-12 col-sm-12">
                    <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="widget-content widget-content-area blog-create-section">
                            
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label>Atas Nama<span class="text-danger">*</span></label>
                                    <input type="text" name="atas_nama" value="{{ old('atas_nama') }}" class="form-control @error('atas_nama') is-invalid @enderror" id="post-title" placeholder="Atas Nama Bank">
                                    @error('atas_nama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label>Nomor Rekening</label>
                                    <input type="number" name="no_rek" value="{{ old('no_rek') }}" class="form-control @error('no_rek') is-invalid @enderror" id="post-title" placeholder="782345923423">
                                    @error('no_rek')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row mb-4">
                                <div class="col-sm-12">
                                    <label>Nama Bank<span class="text-danger">*</span></label>
                                    <input type="text" name="kategori" value="{{ old('kategori') }}" class="form-control @error('kategori') is-invalid @enderror" id="post-title" placeholder="TRANSFER BSI, VA BANK BRI, QRIS">
                                    @error('kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="col-xxl-3 col-xl-12 col-lg-12 col-md-12 col-sm-12 mt-xxl-0 mt-4">
                        <div class="widget-content widget-content-area blog-create-section">
                            <div class="row">
                                <div class="col-xxl-12 col-md-12 mb-4">
                                    
                                    <label for="product-images">Image<span class="text-danger">*</span></label>
                                    <div class="multiple-file-upload">
                                        <input class="form-control @error('iamge') is-invalid @enderror file-upload-input" name="image" type="file">
                                    </div>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                
                                <div class="col-xxl-12 col-sm-4 col-12 mx-auto">
                                    <button class="btn btn-success w-100" type="submit">Submit Payment</button>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </form>
                
                
                
            </div>
            
            <div class="row layout-spacing">
                <div class="col-lg-12">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <table id="style-3" class="table style-3 dt-table-hover">
                                <thead>
                                    <tr>
                                        <th class="checkbox-column text-center"> Record Id </th>
                                        <th class="text-center">Image</th>
                                        <th>Nama Bank</th>
                                        <th>Atas Nama</th>
                                        <th>No Rekening</th>
                                        <th class="text-center dt-no-sorting">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($payments as $no => $item)
                                    
                                    <tr>
                                        <td class="checkbox-column text-center"> {{ $no + 1 }} </td>
                                        <td class="text-center">
                                            @if ($item->image)
                                            <span><img src="{{ asset('storage/'. $item->image ) }}" class="profile-img" loading="lazy" alt="{{ $item->name }}"></span>
                                            @else
                                            <span><img src="{{ asset('back') }}/src/assets/img/profile-17.jpeg" class="profile-img" loading="lazy" alt="{{ $item->name }}"></span>
                                            @endif
                                        </td>
                                        <td>{{ $item->kategori }}</td>
                                        <td>{{ $item->atas_nama }}</td>
                                        <td>{{ $item->no_rek }}</td>
                                        
                                        <td class="text-center">
                                            <ul class="table-controls">
                                                <li>
                                                    <a href="{{ route('payment.edit', encrypt($item->id)) }}" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit" data-original-title="Edit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-8 mb-1">
                                                            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path>
                                                        </svg>
                                                    </a>
                                                </li>
                                                
                                                <li>
                                                    <a href="{{ route('payment.destroy', encrypt($item->id)) }}" onclick="return confirm('Yakin anda akan menghapus rekening {{ $item->kategori }}?')" class="bs-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete" data-original-title="Delete">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-8 mb-1">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        </svg>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
            @include('backend.layouts.footer')
            
            
        </div>    
    </div>
</div>
@endsection
