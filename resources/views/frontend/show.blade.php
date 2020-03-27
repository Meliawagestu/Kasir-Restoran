@extends('layouts.frontend')
@section('content')

<div class="container">
<br><br><br><br>
	<div class="row">

		<div class="col-md-5">
		<div class="card">
			<div class="card-body">
			<img src="{{url('storage/gambar-masakan/'.$data->gambar)}}" width="400">
		</div>
	</div>
</div>

<div class="col-md-6">
	<div class="card-group">
		<div class="card">
			<div class="card-body">
				<h2>{{$data->nama_masakan}}</h2>
				<hr>
				<h4 class="badge badge-primary">Rp.{{number_format($data->harga,0,',','.')}},</h4>
				<form>
					<div class="form-group">
						<input type="number" class="form-control" placeholder="Jumlah item">
						<small class="form-text text-muted">**ex:Masukan Jumlah yang ingin anda pesan.</small>
					</div>
					<div class="form-group">
						<textarea type="text" class="form-control" placeholder="Masukan Keterangan"></textarea>
						<small class="form-text text-muted">**ex:Pedesnya level 1 aja mba/mas.</small>
					</div>
					<a href="{{route('add.cart', ['id_masakan' => $data->id_masakan])}}" class="btn btn-success btn-block"><i class="fa fa-cart-plus" aria-hidden="true"></i>Tambahkan Ke Keranjang</a>
				</form>
			</div>
		</div>
	</div>
</div>
</div> 
</div>
<br><br><br>
@endsection