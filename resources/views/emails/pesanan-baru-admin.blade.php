@component('mail::message')
## Hai, Admin Raden Febri Store

Berikut ada rincian Pesanan masuk dari E-Commerce Raden Febri Store:<br>


@component('mail::table')

| Nama Produk                 | Harga Produk                                      |
| ----------------------------|:-------------------------------------------------:|
@php $total = 0; @endphp
@foreach ($detail->orderitem as $item)
| {{ $item->produks->name }}  | Rp. {{ number_format($item->price) }}             |
@php $total += $item->price; @endphp
@endforeach
|                             |                                                   |
| **Total Bayar:**            | **Rp. {{ number_format($total) }}**               |
| **Total Bayar + Kode Unik:**| **Rp. {{ number_format($detail->total_price) }}** |

@endcomponent



Nama Pelanggan: <b>{{ $detail->name }}</b><br>
Email Pelanggan: <b>{{ $detail->email }}</b><br>
No WA Pelanggan: <b>{{ $detail->no_hp }}</b><br>
Metode Pembayaran: <b>{{ $detail->metode }}</b><br>
Nomor Pesanan: <b>{{ $detail->tracking_no }}</b><br>
Total Pembayaran: <b>Rp. {{ number_format($detail->total_price) }}</b><br>
Pesan Tambahan: <b>{{ $detail->message }}</b><br>
Dibuat Pada Tanggal: <b>{{ date('d F Y',strtotime($detail->created_at)) }}</b><br>

@component('mail::button', ['url' => url('/detail-bayar/'. encrypt($detail->id))])
Lihat Pesanan
@endcomponent

Mohon Segera Diproses!! <br><br>

## Salam,
## Layanan Toko Online Raden Febri Store <br> <br>

Terima Kasih,<br>
Tim Raden Febri Store <br>
@endcomponent
