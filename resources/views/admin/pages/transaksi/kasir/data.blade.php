@extends('admin.main')
@section('title','Kasir | ')
@section('content')
<h1><i class="fas fa-money-check-alt"></i> Transaksi</h1>
<hr>





<table class="table table-bordered" id="datatabled">
  <thead class="border-0">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Kode Order</th>
      <th scope="col">No Meja</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    @foreach($orders as $order)
    <tr>
      <th scope="row">{{$loop->iteration}}</th>
      <td>{{$order->kode_pemesanan}}</td>
      <td>{{$order->no_meja}}</td>
      <td>
        <a class="btn btn-success" href="{{route('payment', ['id_pemesanan' => $order->id_pemesanan])}}">Bayar</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>

@endsection