@extends('admin.main')
@section('title','Pembayaran')
@section('content')

<h2><i class="fas fa-money-check-alt"></i> Pembayaran</h2>
<hr>

<div class="container-fluid">

  <div class="row">

        <div class=" col-lg-5 mx-auto">

		      <div class="row">
		        <div class="card">

		            <div class="card-header bg-secondary text-white pb-1">
		                <h5 style="text-align: center;">Pembayaran</h5>
		            </div>

		            <div class="card-body">

		            	@if(session('result') == 'success')
						<div class="alert alert-success" role="alert">
						  <h4 class="alert-heading">Berhasil!</h4>Anda Telah Berhasil Melakukan Transaksi.
						  <a href="{{route('getFinish', ['id_pemesanan' => $orders->id_pemesanan])}}" class="btn btn-success btn-lg">Hapus Transaksi.</a>
						</div>
						@elseif(session('result') == 'fail')
						<div class="alert alert-danger data-dismissible" role="alert">
						  <h4 class="alert-heading">Uang Anda Kurang!</h4>Ada Kesalahan Saat Menginputkan, Silahkan Di Check Kembali.
						  <button type="button" class="close" data-dismiss="alert">&times;</button>
						</div>
						@endif
					
		            	<b> Yang Harus Dibayar :</b> <strong class="text-success-darker">Rp. {{number_format($orders->subtotal),0,',','.'}}</strong>

		              <form id="form-bayar" action="{{route('bayar')}}" method="POST">
		              	{{ csrf_field() }}
		              	<!-- Tagihan -->
		              	<input type="hidden" id="txtTotal" class="form-control" value="{{$orders->subtotal}}">

		              	<!-- Ambil ID USER -->
		              	<input type="hidden" name="users_id" value="{{$orders->id_users}}">

		              	<!-- Ambil ID ORDER -->
		              	<input type="hidden" name="pemesanan_id" value="{{$orders->id_pemesanan}}">

		              	<label>Uang</label>
		                <div class="input-group mb-3">
							<div class="input-group-prepend">
							  <span class="input-group-text bg-success-lighter text-white">Rp.</span>
							</div>
							<input type="number" name="total_bayar" id="txtBayar" class="form-control" placeholder="Uang Masuk">
						</div>
						<label>Kembalian</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
							  <span class="input-group-text bg-success-lighter text-white">Rp.</span>
							</div>
							<input type="number" class="form-control txtKembalian" placeholder="Uang Kembalian" disabled="">

							<input type="hidden" name="kembalian" class="txtKembalian">
						</div>
						
		                <div class="form-group">
		                  <button id="btnPay" type="submit" class="btn btn-secondary" onclick="return confirm('Anda Yakin ingin membayar ?')">Bayar</button>
		                </div>

		              </form>

			        </div>    
				</div>
		      </div>
		</div>
  </div>


	
</div>

@endsection

@push('js')

<script type="text/javascript">
	$("#btnPay").click(function () {
		var total = $("#txtTotal").val();
		var bayar= $("#txtBayar").val();
		var kembalian = parseInt(bayar) - parseInt(total);
		$(".txtKembalian").val(kembalian);

		$("#form-bayar").submit();
		

	});

	
</script>

@endpush