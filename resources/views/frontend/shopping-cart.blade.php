@extends('layouts.frontend')
@section('content')

<div class="container">
	<br><br><br><hr><br>


	@if(Session::has('cart'))
	<a href="{{route('cancel')}}" class="btn btn-danger"><i class="fa fa-window-close-o" aria-hidden="true"></i> Batal Memesan</a>
	<a href="{{route('menu-masakan')}}" class="btn btn-primary"></i> [+] Tambah Menu</a>
	<div class="row">
		<div class="col-md-12">
			<table class="table">
				<thead class="thead-secondary">
					<tr>
						<th scope="col">No</th>
						<th scope="col">Gambar</th>
						<th scope="col">Nama Masakan</th>
						<th scope="col">Harga Satuan</th>
						<th scope="col">Jumlah Pesanan</th>
						<th scope="col">Total</th>
						<th scope="col">&nbsp;</th>
					</tr>
				</thead>
				<tbody>
					@foreach($data as $dt)
					<tr>
						<th scope="row">{{$loop->iteration}}</th>
						<td>
							<img src="{{url('storage/gambar-masakan/'.$dt['item']['gambar'])}}" width="75" height="65">
						</td>
						<td>{{$dt['item']['nama_masakan']}}</td>
						<td>Rp.{{number_format($dt['item']['harga'],0,',','.')}},</td>
						<td>
							<a class="btn btn-success" href="{{route('reducebyone', ['id_masakan' => $dt['item']['id_masakan']])}}"><i class="fa fa-minus-circle" aria-hidden="true"></i></a>

							<span class="badge badge-dark"> {{$dt['qty']}} </span>

							<a class="btn btn-success" href="{{route('addone', ['id_masakan' => $dt['item']['id_masakan']])}}"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
							</td>
						<td>Rp.{{number_format($dt['harga'],0,',','.')}},</td>
						<td>
							<a href="{{route('remove.items', ['id_masakan' => $dt['item']['id_masakan']])}}" 
								class="btn btn-danger btn-sm btn-trash">
									<i class="fa fa-w fa-trash"></i>
								</a>
							</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<strong class="float-right" style="color: black; text-transform: uppercase;">Total : Rp.{{number_format($totalPrice,0,',','.')}},</strong>
				<br>
				<a href="{{route('checkout')}}" class="btn btn-success float-right"><span class="oi oi-check"></span> Procees to Checkout</a>
			</div>
			
		</div>
		@else
		<div class="row">
			<div class="col-sm-12 col-md-offset-3 col-sm-offset-3">
				<h1 style="text-align: center;"><strong>Tidak Ada Pesanan Dikeranjang </strong></h1>
				<h1 style="text-align: center;"><i class="fa fa-cart-plus"></i></h1>
				<h6 style="text-align: center;"><a href="{{route('menu-masakan')}}" class="btn btn-success">Ke Menu Masakan</a></h6>
			</div>
		</div>
		@endif
	</div>
</div>
<br><br><br><br><br><br><br><br><br><br><br>
@endsection  