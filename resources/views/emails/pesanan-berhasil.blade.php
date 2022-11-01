@component('mail::message')
## Hai, {{ $order->name }}

Kami informasikan bahwasannya Pesanan anda sudah kami terima dan status dari Unpaid menjadi Paid.<br>
Berikut Catatan dari kami & Status Pesanan dinyatakan sebagai berikut :
@if ($order->status == '0') 
## UNPAID
@else 
## PAID
@endif
<br>

<b><i>{{ $order->message_admin }}</i></b><br><br>

Terimakasih Telah order di toko kami, Ditunggu Next Ordernya!! <br><br>

<b>Terima Kasih,</b><br>
<b>Tim Raden Febri Store</b><br>
@endcomponent
