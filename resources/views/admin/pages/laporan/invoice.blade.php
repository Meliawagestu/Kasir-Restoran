@extends('layouts.report')
@section('title','Report ')
@section('content')

<div class="row contacts">
	    <div class="col invoice-to">
	        <div class="text-gray-light" style="">INVOICE TO:</div>
	        @foreach($data as $dt)
	        <h2 class="to">{{$dt->name}}</h2>
	        @endforeach
	    </div>
	    <div class="col invoice-details">
	    	@foreach($data as $dt)
	        <h1 class="invoice-id" style="text-align: right;">{{$dt->kode_pemesanan}}</h1>
	        <div class="date" style="text-align: right;">{{date('d F Y - H:i',strtotime($dt->created_at))}}</div>
	        <br>
	        @endforeach
	    </div>
	</div>

	<div class="row">
    <div class="col-md-12">
      <table class="table table-striped mb-3">
        <thead class="thead-dark">
          <tr>
            <th>Nomor Meja</th>
            <th>Detail Pesanan</th>
            <th>Total</th>
      
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
          <tr>
            <td>{{$order->no_meja}}</td>
            <td>
              @foreach($order->cart->items as $item)
              
                <li class="list-group-item">
                  <span class="badge badge-light">{{$item['item']['nama_masakan']}}</span>
                  <span class="badge badge-warning"> {{$item['qty']}}</span>
                </li>
              
              @endforeach
            </td>
     
            <td class="text-success-darkest"><strong>Rp.{{number_format($order->subtotal),0,',','.'}}</strong></td>
          </tr>

          @endforeach
    </tbody>
  </table>
</div>
</div>
	        <tr>
	            <td colspan="2">Uang Masuk
	            @foreach($data as $dt)
	           <strong class="text-success-darker"> Rp.{{number_format($dt->total_bayar),0,',','.'}}</strong></td>
	           <hr>
	            @endforeach
	        </tr>
	        <tr>
	            <td colspan="2">Kembalian
	            @foreach($data as $dt)
	            <strong class="text-dark"> Rp.{{number_format($dt->kembalian),0,',','.'}}</strong></td><hr>
	            @endforeach
	        </tr>
	    </tfoot>
	</table>

@endsection

@push('js')
<script type="text/javascript">
	window.onload = function(){
		window.print();
	}
</script>

<script type="text/javascript">
	$(document).ready(function() {
		window.print();
	});
</script>
@endpush
