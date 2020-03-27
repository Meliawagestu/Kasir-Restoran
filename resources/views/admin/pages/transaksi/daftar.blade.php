@extends('admin.main')
@section('title','Data Transaksi | ')
@section('content')

<div class="row pl-3 pt-2 mb-5">
    <div class="col-lg-11 pl-5">
    	<h1>Rekap Data Transaksi</h1>

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

        <table id="datatabled" class="table">
            <thead class="border-0">
              <tr>
                  <th scope="col">#</th>
			      <th scope="col">Pemesan</th>
			      <th scope="col">Kode Order</th>
			      <th scope="col">Tanggal</th>
			      <th scope="col">Total Bayar</th>
			      <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $dt)
              <tr>
                  <th scope="row">{{$loop->iteration}}</th>
			      <td>{{$dt->name}}</td>
			      <td>{{$dt->kode_pemesanan}}</td>
			      <td>{{date('d F Y - H:i',strtotime($dt->created_at))}}</td>
			      <td>Rp.{{number_format($dt->total_bayar,0,',','.')}},</td>
			      <td>
			          <a href="{{route('invoice', ['kode_pemesanan' => $dt->kode_pemesanan])}}" class="btn btn-success btn-sm" target="_blank">
			          	<i class="fas fa-print"></i>
			          </a>
			      </td>
              </tr>
              @endforeach
            </tbody>
    </table>
      </div>  
</div>

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
				<div class="modal-header bg-danger">
					<h3 class="modal-title text-white">Hapus Data Ini?</h3>
					<button class="close" type="button" data-dismiss="modal">
						<span class="text-white">x</span>
					</button>
				</div>
				
				<div class="modal-body">
					Data Tidak Bisa Dikembalikan setelah Terhapus,Anda Yakin?
					<form id="form-delete" action="{{ route('admin.transaksi') }}" method="post" >
						
						{{ csrf_field() }}
						<input type="hidden" name="id" id="input-id">
					</form>
				</div>

				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
					<button class="btn btn-danger btn-delete" type="button">Hapus</button>
				</div>

			</div>
		</div>
	</div>	

@endpush

@push('js')

<script type="text/javascript">
	$(function() {
		$('.btn-trash').click(function() {
			id = $(this).attr('data-id');
			$('#input-id').val(id);
			$('#deleteModal').modal('show');
		});

		$('.btn-delete').click(function() {
			$('#form-delete').submit();
		});

	})
</script>

@endpush
