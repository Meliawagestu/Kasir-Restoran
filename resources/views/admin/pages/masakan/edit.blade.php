@extends('admin.main')
@section('title','Ubah Masakan')
@section('content')
<h1>Masakan <small class="text-muted">Ubah</small></h1>
<hr>
@if(session('result') == 'fail')
<div class="alert alert-danger alert-dismissiable fade show">
	<strong>Failed !</strong> Gagal disimpan.
	<button type="button" class="close" data-dismiss="alert">
		&times;
	</button>
</div>
@endif

<div class="row">
	<div class="col-md-6 mb-3">
		<form method="post" action="{{ route('admin.masakan.edit',['id_masakan'=>$rc->id_masakan]) }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="card">
				<div class="card-header"> 
					<h5>Ubah Data Masakan</h5>
				</div><!-- End Card Header-->
				<div class="card-body">
					
					<!-- Input Gambar-->
					<div class="form-group form-label-group">
						<img id="ibaru" src="{{url('storage/gambar-masakan/' .$rc->gambar)}}" width="100" align="middle">
						<input type="file" name="gambar" 
						class="form-control {{$errors->has('gambar')?'is-invalid':''}}"
						value="{{ old('gambar',$rc->gambar) }}" 
					    accept="image/*" 
					    id="iGambar" placeholder="Gambar Masakan">
						@if($errors->has('gambar'))
						<div class="invalid-feedback">{{$errors->first('gambar')}}</div>
						@endif
					</div>

					<!-- input Nama masakan -->
					<div class="form-group form-label-group">
						<input type="text" name="nama_masakan"
						 class="form-control {{$errors->has('nama_masakan')?'is-invalid':''}}"
						 value="{{ old('nama_masakan',$rc->nama_masakan) }}"
						 id="iName" placeholder="Nama Masakan" required>
						<label for="iName">Nama Masakan</label>
						@if($errors->has('nama_masakan'))
						<div class="invalid-feedback">{{$errors->first('nama_masakan')}}</div>
						@endif
					</div>

					<!-- input harga -->
					<div class="form-group form-label-group">
						<input type="number" name="harga" 
						class="form-control {{$errors->has('harga')?'is-invalid':''}}" 
						value="{{ old('harga',$rc->harga)}}" 
						id="iHarga" placeholder="Harga" required>
						<label for="iHarga">Harga</label>
						@if($errors->has('harga'))
						<div class="invalid-feedback">{{$errors->first('harga')}}</div>
						@endif
					</div>

					<!-- input kategori -->
					<div class="form-group form-label-group">
						<select name="kategori_id" 
						class="form-control {{$errors->has('kategori_id')?'is-invalid':''}}">

						<?php 
						$val = old('kategori_id',$rc->kategori_id);
						 ?>
							<option value="">Pilih Kategori :</option>
							@foreach(\App\Kategori::orderBy('nama_kategori','asc')->get() as $d)
							<option value="{{ $d->id }}" {{$val==$d->id?'selected':''}}> 
								{{ $d->nama_kategori }}
							</option>
							@endforeach
						</select>
						@if($errors->has('kategori_id'))
						<div class="invalid-feedback">{{$errors->first('kategori_id')}}</div>
						@endif
					</div>

					<!-- input status masakan -->
					<?php 
					$val = old('status_masakan',$rc->status_masakan);
					 ?>
					 <select class="form-control {{ $errors->has('status_masakan')?'is-invalid':''}}" name="status_masakan">
					 	<option value="" {{ $val==""?'selected':''}}>Pilih Status Masakan :</option>
					 	<option value="ada" {{ $val=="ada"?'selected':''}}>Ada</option>
					 	<option value="habis" {{ $val=="habis"?'selected':''}}>Habis</option>
					 </select>
						@if($errors->has('status_masakan'))
						<div class="invalid-feedback">{{$errors->first('status_masakan')}}</div>
						@endif
					</div>
				</div><!-- End Card Body-->

				<div class="card-footer">
					<button class="btn btn-primary" type="submit">Update</button>
				</div><!-- End Card Footer -->

			</div><!-- End Card -->
		</form>
	</div>
</div><!-- End Row-->
@endsection

@push('js')
<script type="text/javascript">
	/* Fungsi menampilkan gambar yang dipilih */
	function filePreview(input) {
		if(input.files && input.files[0]){
			var reader = new FileReader();
			reader.onload = function(e){
				$('#ibaru').attr('src',e.target.result )
				
			}
			reader.readAsDataURL(input.files[0]);
		}
	}

/* Perintah menjalankan fungsi filePreview */
$(function(){
	$('#iGambar').change(function(){
		filePreview(this);
	})
})
</script>
@endpush
 







