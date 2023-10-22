@extends('frontend.layouts.master')

@section('title', "Order | Raden Febri Store")

@section('content')

<div class="validtheme-shop-area default-padding">
  
  <div class="container">
    <div class="shop-listing-contentes">
      <div class="row align-center">
        
        <div class="col-lg-7 col-md-7">
          <div class="content">
          </div>
        </div>
        
        <div class="col-lg-5 col-md-5 text-right">
          <p>
            <b> Jumlah Barang :</b> <span class="cart-count">0</span>
          </p>
        </div>
      </div>
    </div>
  </div>
  
  <div class="container">
    <div class="row">
      @if ($produk->count() > 0)
      
      <!-- Start Tab Content -->
      <div class="container">
        
        <div class="row">
          <div class="col-md-4 order-md-2 mb-4">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
              <span class="text"><b>Jumlah Barang :</b></span>
              <span class="badge badge-success badge-pill cart-count">0</span>
            </h4>
            <ul class="list-group mb-3 produk">
              @php $total = 0; @endphp
              
              @foreach ($produk as $item)
              <li class="list-group-item d-flex justify-content-between lh-condensed produk_data">
                <div>
                  <h6 class="my-0"><b>{{ \Illuminate\Support\Str::words($item->produks->name, 5, '...') }}</b></h6>
                  <small class="text-muted">{{ \Illuminate\Support\Str::words($item->produks->small_description, 5, '...') }}</small>
                </div>
                @if ($item->produks->selling_price == null)
                <span class="text-muted">Rp. {{ number_format($item->produks->original_price) }}</span>
                @else
                <span class="text-muted">Rp. {{ number_format($item->produks->selling_price) }}</span>
                @endif
              </li>
              @if ($item->produks->selling_price == null)
              @php $total += $item->produks->original_price; @endphp
              @else
              @php $total += $item->produks->selling_price; @endphp
              @endif
              @endforeach
              
              <li class="list-group-item d-flex justify-content-between">
                <span>Total Harga (Rp)</span>
                <strong>Rp. {{ number_format($total) }}</strong>
              </li>
            </ul>
            
            <hr class="mb-4">
            
          </div>
          <div class="col-md-8 order-md-1">
            <h4 class="mb-3"><b>Detail Data</b></h4>
            <form class="needs-validation" action="{{ route('placeorder') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="email">Nama <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" id="name" readonly placeholder="{{ Auth::user()->name }}" value="{{ Auth::user()->name }}">
              </div>
              
              <div class="mb-3">
                <label for="email">Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" id="email" readonly placeholder="{{ Auth::user()->email }}" value="{{ Auth::user()->email }}">
              </div>
              
              <div class="mb-3">
                <label for="no_hp">No WA <span class="text-danger">*</span></label>
                <input type="no_hp" class="form-control" name="no_hp" id="no_hp" readonly placeholder="{{ Auth::user()->no_hp }}" value="{{ Auth::user()->no_hp }}">
              </div>
              
              <div class="mb-3">
                <label for="email">Metode Pembayaran <span class="text-danger">*</span></label>
                <select class="custom-select @error('metode') is-invalid @enderror" name="metode" id="metode">
                  <option selected disabled>--Pilih Metode Bayar--</option> 
                  @foreach ($payment as $item)
                  <option value="{{ $item->kategori }}">{{ $item->kategori }}</option>
                  @endforeach
                </select>
                @error('metode')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              
              <div class="mb-3">
                <label for="message">Catatan <span class="text-danger">*</span></label>
                <textarea type="text" class="form-control  @error('message') is-invalid @enderror" id="message" value="" name="message" placeholder="Isikan salah satu data yang akan diproses [NO-HP, ID-PEL, ID, DLL.] *Contoh: 0821123412413 (Catatan Tambahan)"></textarea>
                @error('message')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              
              <hr class="mb-4">
              <button class="btn btn-primary btn-theme effect btn-lg btn-block rounded" type="submit">Lanjut ke Pembayaran</button>
            </form>
          </div>
        </div>
      </div>
      
      @else
      <div class="col-md-12 produk">
        <div class="alert alert-warning">
          <h4 class="text-center">Keranjang anda masih kosong</h4>
        </div>
      </div>
      @endif
    </div>
  </div>
</div>
<!-- End Shop -->
@endsection