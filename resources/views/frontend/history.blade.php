@extends('layouts.frontend')
@section('content')

<div class="container">

	<br><br><br><hr>

<div class="container">
	<h1 class="text-center mt-4 mb-4">Riwayat Semua Data Order User Ini</h1>

	<div class="col-lg-9 mx-auto">
		<div class="card mb-3">
		  @foreach($orders as $order)
		  <div class="card-header bg-dark text-white">
		    Orderan ke {{$loop->iteration}} | {{$order->kode_pemesanan}}<br>
		    <small>{{date('d F Y - H:i',strtotime($order->created_at))}}</small>
		  </div>
		  <div class="card-body">
		    <ul class="list-group list-group-flush">
				@foreach($order->cart->items as $item)
			    <li class="list-group-item">
			    	<span class="badge badge-dark float-right">Rp.{{number_format($item['harga'],0,',','.')}},</span>
			    	{{$item['item']['nama_masakan']}}<span class="badge badge-warning float-right">{{$item['qty']}} Qty</span> 
			    </li>
				@endforeach
			 </ul>
		  </div>
		  <div class="card-footer mb-4">
		    <strong class="float-right" style="text-transform: uppercase; color: green;">Total : Rp.{{number_format($order->cart->totalPrice,0,',','.')}},</strong>
		 	Status : 
		    <?php 
			if ($order['status_pemesanan']=='tunggu') {
				echo "<span class='badge badge-danger'>Tunggu</span>";
				} elseif($order['status_pemesanan']=='menunggu') {
				echo "<span class='badge badge-warning'>Menunggu Pembayaran</span>";
				} elseif($order['status_pemesanan']=='selesai') {
				echo "<span class='badge badge-success'>Selesai</span>";		
				}
			 ?>
			 <hr style="border-top: 3px double #8c8c8c;">
		    <br>
		    <small>Ket Status: <br>
		      <span class="badge badge-danger">tunggu</span>   = Pesanan sedang diproses <br>
		     <span class="badge badge-warning">menunggu</span> = Harus Melakukan Pembayaran <br>
		      <span class="badge badge-success">Selesai</span> = Pesanan siap diantar</small>
		  </div>
		  @endforeach
		</div>
	</div>
</div>
	
</div>
<br><br><br><br><br>
@endsection  



	
			