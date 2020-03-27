@extends('layouts.frontend')
@section('title','Checkout')
@section('content')

<div class="container">

	<br><br><br><hr>

	<div class="row">
		<div class="col-md-6 pt-4 mx-auto">
			<form method="POST" action="{{route('postcheckout')}}">
				{{ csrf_field() }}
				<div class="card border-dark">
					<div class="card-header bg-success-darker pb-1">
						<h5 class="text-light"><span class="oi oi-cart"></span> Masukan Nomer Meja</h5>
					</div>

					@if(session('info') == 1)
			   		<div class="alert alert-warning alert-dismissible fade show" role="alert">
					  <strong>Meja Sedang Digunakan</strong> Saat ini, Nomor Meja yang anda pilih sedang dipakai,silahkan cek nomor meja anda sendiri.
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>
			   		@endif

					<div class="card-body">

						<div class="form-group form-label-group">
							<label for="">Nomer Meja Anda</label>
							<input type="number"  min="1" max="50" name="no_meja"
							class="form-control {{ $errors->has('no_meja')? 'is-invalid': ''}}"
							value="{{ old('no_meja') }}"
							id="" placeholder="Masukan Nomer Meja Anda....." required autofocus>
							@if($errors->has('no_meja'))
							<div class="invalid-feedback">{{ $errors->first('no_meja') }}</div>
							@endif
							<small class="text-muted">ex**: 1,2,3,dsb.</small>
						</div>

						<div class="form-group form-label-group">
							<label for="">Keterangan</label>
							<textarea name="keterangan"
							class="form-control {{$errors->has('keterangan')?'is-invalid':'' }}"
							value="{{ old('keterangan') }}"
							id="" placeholder="Masukan keterangan terkait masakan yang akan pesan..."></textarea> 
							@if($errors->has('keterangan'))
							<div class="invalid-feedback">{{ $errors->first('keterangan') }}</div>
							@endif
							<small class="text-muted">ex**: Pake Keju yang banyak</small>
						</div>
						<small class="text-muted"></small>

						<input type="hidden" name="id_users" value="{{Auth::user()->id}}">
						<input type="hidden" name="status_pemesanan" value="Tunggu">
					</div>

					<div class="card-footer">
						<button class="btn btn-success" type="submit"><span class="oi oi-check"></span> Simpan</button>
					</div>

				</div>
			</form>
		</div>
	</div>
	
</div>
<br><br>
@endsection