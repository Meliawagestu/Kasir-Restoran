@extends('admin.main')
@section('title','Masakan | ')
@section('content')
<h1><i class="fas fa-utensils"></i> Menu Masakan</h1>
<hr>

<!-- Alert jika berhasil ditambahkan -->
@if(session('result') == 'success')
<div class="alert alert-success alert-dismissiable fade show">
	<strong>Saved !</strong> Berhasil disimpan.
	<button type="button" class="close" data-dismiss="alert">
		&times;
	</button>
</div>
@endif

@if(session('result') == 'update')
<div class="alert alert-success alert-dismissiable fade show">
	<strong>Updated !</strong> Berhasil diupdate.
	<button type="button" class="close" data-dismiss="alert">
		&times;
	</button>
</div>
@endif


@if(session('result') == 'delete')
<div class="alert alert-success alert-dismissiable fade show">
	<strong>Deleted !</strong> Berhasil dihapus.
	<button type="button" class="close" data-dismiss="alert">
		&times;
	</button>
</div>
@endif

@if(session('result') == 'fail-delete')
<div class="alert alert-danger alert-dismissiable fade show">
	<strong>Failed !</strong> Gagal dihapus.
	<button type="button" class="close" data-dismiss="alert">
		&times;
	</button>
</div>
@endif

<!-- Baris Tambah dan Pencarian -->
<div class="row">
	<!-- Tombol Tambah -->
	<div class="col-md-6 mb-3">
		<a href="{{ route('admin.masakan.add') }}" class="btn btn-dark">[+] Tambah</a>
	</div>

	<!-- Formulir Pencarian -->
	<div class="col-md-6 mb-3">
		<form method="GET" action="{{ route('admin.masakan') }}">
			<div class="input-group">
				<input type="text" name="keyword" class="form-control" value="{{ request('keyword') }}">
				<div class="input-group-append">
					<button type="submit" class="btn btn-primary">
						Cari !
					</button>
				</div>
			</div>
		</form>
	</div>
</div><!-- End Row -->

<!-- Baris Daftar data --> 
<table class="table table-striped mb-3">
	<tr>
		<th>No</th>
		<th>Kode Masakan</th>
		<th>Gambar</th>
		<th>Nama Masakan</th>
		<th>Status</th>
		<th>Harga</th>
		<th>&nbsp;</th>
	</tr>
	@foreach($data as $dt)
	<tr>	
		<td>{{ $loop->iteration }}</td>
		<td>{{ $dt->kode_masakan }}</td>
		<td>
			<img src="{{url('storage/gambar-masakan/'.$dt->gambar)}}" width="75" height="65">
		</td>
		<td>{{ $dt->nama_masakan }}<br>
			<small class="text-muted">{{$dt->nama_kategori}}</small>
		</td>
		
		<td>
			<?php 
			if ($dt['status_masakan']=='ada') {
				echo "<span class='badge badge-success'>Ada</span>";
				} else {
				echo "<span class='badge badge-danger'>Habis</span>";	
				}
			 ?>
		</td>
		<td>Rp.{{number_format($dt->harga,0,',','.') }}</td>
			<!-- Kolom Tombol -->
			<td>	
					<!-- Tombol Edit -->
					<a href="{{ route('admin.masakan.edit',['id_masakan'=>$dt->id_masakan]) }}"
					class="btn btn-success btn-sm"
					><i class="fa fa-w fa-edit"></i></a>

					<!-- Tombol Hapus -->
					<button type="button" data-id="{{$dt->id_masakan}}"
						class="btn btn-danger btn-sm btn-trash">
						<i class="fa fa-w fa-trash"></i>
					</button>
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


@push('modal')
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header btn-danger">
				<h5 class="modal-title text-white">Delete</h5>
				<button class="close" type="button" data-dismiss="modal">
					<span class="text-white">x</span>
				</button>
			</div><!-- End Modal Header-->

			<div class="modal-body">
				Apakah anda yakin ingin menghapusnya?
				<form id="form-delete" method="post" action="{{ route('admin.masakan')}}">
				{{ csrf_field() }}
				{{ method_field('delete') }}
				<input type="hidden" name="id_masakan" id="input-id">
				</form>
			</div><!-- End Modal Body-->
			
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
				<button class="btn btn-danger btn-delete" type="button">Delete</button>
			</div>

		</div><!-- End Modal Content-->
	</div><!-- End Modal Dialog-->
	
</div>
@endpush

@push('js')
<script type="text/javascript">
$(function(){
	$('.btn-trash').click(function(){
		id_masakan = $(this).attr('data-id');
		$('#input-id').val(id_masakan);
		$('#deleteModal').modal('show');
	});

	$('.btn-delete').click(function(){
		$('#form-delete').submit();
	});
})
</script>
@endpush