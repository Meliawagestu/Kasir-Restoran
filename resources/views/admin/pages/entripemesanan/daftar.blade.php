@extends('admin.main')
@section('title','Entri | ')
@section('content')
<h1><i class="fa fa-cart-plus"></i> Entri Order</h1>
<hr>

@if(session('orders') == 'update')
<div class="alert alert-success alert-dismissible fade show">
  <strong>Updated !</strong> Berhasil diterima.
  <button type="button" class="close" data-dismiss="alert">
    &times;
  </button>
</div>
@endif

@if(session('orders') == 'delete')
<div class="alert alert-success alert-dismissible fade show">
  <strong>Deleted!</strong> Berhasil dihapus.
  <button type="button" class="close" data-dismiss="alert">
    &times;
  </button>
</div>
@endif

<div class="row">
    <div class="col-md-12">
      <table class="table table-striped mb-3">
        <thead class="thead-secondary">
          <tr>
            
            <th>Kode Pemesanan</th>
            <th>Nomor Meja</th>
            <th>Menu</th>
            <th>Keterangan</th>
            <th>Total</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($orders as $order)
          <tr>
            
            <td>{{$order->kode_pemesanan}}</td>
            <td>{{$order->no_meja}}</td>
            <td>
              @foreach($order->cart->items as $item)
              
                <li class="list-group-item">
                  <span class="badge badge-light">{{$item['item']['nama_masakan']}}</span>
                  <span class="badge badge-warning"> {{$item['qty']}}</span>
                </li>
              
              @endforeach
            </td>
            <td>{{$order->keterangan}}</td>
            <td class="text-success-darkest"><strong>Rp.{{number_format($order->subtotal),0,',','.'}}</strong></td>
            <td>
              <a  class="btn btn-success" href="{{route('entri.accept',['id_pemesanan'=>$order->id_pemesanan])}}" onclick="return confirm('Terima Pesanan?')"><i class="fas fa-check"></i></a>

              <button type="button" class="btn btn-danger btn-sm btn-trash"
                data-id="{{ $order->id_pemesanan }}"> 
               <i class="fa fa-w fa-trash"></i>
               </button>
            </td>
          </tr>
          @endforeach
    </tbody>
  </table>

  
</div>
</div>
@endsection


@push('modal')
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title text-white">Delete</h5>
        <button class="close" type="button" data-dismiss="modal">
          <span class="text-white">x</span>
        </button>
      </div><!-- End Modal Header-->

      <div class="modal-body">
        Apakah anda yakin ingin menghapusnya?
        <form id="form-delete" method="post" action="{{ route('admin.entripemesanan')}}">
        {{ csrf_field() }}
        {{ method_field('delete') }}
        <input type="hidden" name="id_pemesanan" id="input-id">
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
    id = $(this).attr('data-id');
    $('#input-id').val(id);
    $('#deleteModal').modal('show');
  });

  $('.btn-delete').click(function(){
    $('#form-delete').submit();
  });
})
</script>
@endpush