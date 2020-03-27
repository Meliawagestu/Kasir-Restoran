@extends('admin.main')
@section('title','Pemesanan | ')
@section('content')
<h1><i class="fas fa-shopping-cart"></i> History Pemesanan</h1>
<hr>

<!-- Baris Daftar data --> 
<table class="table table-striped mb-3">
	<tr>
		<th>No</th>
		<th>Kode Pemesanan</th>
		<th>Nomer Meja</th>
		<th>Tanggal Order</th>
		<th>Pemesan</th>
		<th>Keterangan</th>
		<th>Status</th>
		<th>&nbsp;</th>
	</tr>
	@foreach($data as $dt)
	<tr>	
		<td>{{ $loop->iteration }}</td>
		<td>{{ $dt->kode_pemesanan }}</td>
		<td>{{ $dt->no_meja }}</td>
		<td>{{ $dt->created_at }}</td>
		<td>{{ $dt->name }}</td>
		<td>{{ $dt->keterangan }}</td>
		<td>
			<?php 
			if ($dt['status_pemesanan']=='tunggu') {
				echo "<span class='badge badge-danger'>Tunggu</span>";
				} elseif($dt['status_pemesanan']=='menunggu') {
				echo "<span class='badge badge-warning'>Menunggu Pembayaran</span>";
				} elseif($dt['status_pemesanan']=='selesai') {
				echo "<span class='badge badge-success'>Selesai</span>";		
				}
			 ?>
		</td>
	</tr>
	@endforeach
</table>

<!-- Pagging/Halaman -->
{{
	$data->appends( request()->only('keyword') )
	->links('vendor.pagination.bootstrap-4')
}}
@endsection

