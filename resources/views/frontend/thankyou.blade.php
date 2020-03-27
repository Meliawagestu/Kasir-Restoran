@extends('layouts.frontend')
@section('content')
<br><br><br><hr>

<div class="testmonial_area banner-3" style="background-color: transparent;">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title white mb-60">
                        <h3 style="text-align: center;">Pesanan Sedang diproses...</h3>
                    </div>
                </div>
            </div>


<div class="row">
	@foreach($orders as $order)
	<div class="col-md-6 pt-4 mx-auto">
			<form method="" action="">
				<div class="card border-success-3">
					<div class="card-header bg-success-darker pb-1">
						<h5 class="text-dark" style="text-align: center;"><span class="oi oi-cart"></span> Pesanan Anda :</h5><br>
						@foreach($order->cart->items as $item)
						<h6 style="text-align: center;">
						<span>{{ $loop->iteration }}. </span>
						<span>{{$item['item']['nama_masakan']}}</span>
						<span class="badge badge-warning">{{$item['qty']}}</span>
						</h6>
						@endforeach
						<h5 style="text-align: center;"><strong>Total Pembayaran : Rp.{{number_format($order->subtotal),0,',','.'}}</strong></h5>
						<h6 style="text-align: center;"><a href="{{route('history')}}" class="btn btn-dark"> Lihat Riwayat Order</a></h6>
					</div>
				</div>
			</form>
	</div>
	@endforeach
</div>



	</div><!-- tutup container-->
</div><!-- tutup banner-->
<br><br><br>
@endsection