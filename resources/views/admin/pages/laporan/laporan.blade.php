<h1 align="center">Laporan Transaksi & Pendapatan</h1>
<br>
<table class="table table-striped mb-3" border="1" align="center">
<tr>
	<th>No</th>
	<th>Nama Pemesan</th>
	<th>Kode</th>
	<th>Tanggal</th>
	<th>Total</th>
</tr>
@foreach($data as $dt)
<tr>
	<td>{{$loop->iteration}}</td>
	<td>{{ $dt->name}}</td>
	<td>{{ $dt->kode_pemesanan}}</td>
	<td>{{date('d F Y - H:i',strtotime($dt->created_at))}}</td> 
	<td>Rp.{{number_format($dt->subtotal,0,',','.')}},</td>
</tr>
@endforeach
</table>
<hr>
<h3 style="text-align: center;">Total Pendapatan Rp.{{number_format($pendapatan,0,',','.')}},</h3>

