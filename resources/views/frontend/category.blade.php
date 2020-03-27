@extends('layouts.frontend')
@section('title','Halaman Kategori')
@section('content')

 <div class="order_area">
        <div class="container">
<hr>
                <div class="row">
                    <div class="col-xl-12">
                        <form method="GET" action="{{ route('menu-masakan')}}">
                         {{ csrf_field() }}
                        <div class="section_title mb-70">
                            <h3>Daftar Menu Makanan</h3>
                        </div>
                    </form>
                 </div>
            </div>
        <div class="row">
            @foreach($data as $dt)
                <div class="col-xl-4 col-md-6">
                    <div class="single_order">
                        <div class="order_thumb">
                            <img class="card-img-top img-responsive" src="{{url('storage/gambar-masakan/' .$dt->gambar)}}" style="width: 100%; height: 250px;">
                            <div class="order_prise">
                                <span>Rp. {{number_format($dt->harga,0,',','.')}},</span>
                            </div>
                        </div>
                        <div class="order_info">
                            <h3><a>{{$dt->nama_masakan}}</a></h3>
                            <p>{{$dt->kode_masakan}} | {{$dt->nama_kategori}}</p>
                            <p>
                                <?php 
                                if ($dt['status_masakan']=='ada') {
                                    echo "<span class='badge badge-success'>Ada</span>";
                                    } else {
                                    echo "<span class='badge badge-danger'>Habis</span>";   
                                    }
                                 ?>
                            </p>
                            <div class="card-footer">
                                @if($dt['status_masakan']=='ada')
                                <a href="{{route('add.cart', ['id_masakan' => $dt->id_masakan])}}" class="boxed_btn_ada"><i class="fa fa-cart-plus">  Order Now!</i></a>
                                @else
                                <a class="boxed_btn_habis" disabled> Order Now!</a>
                                @endif
                            </div>
                        </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                </div>
            </div>
    </div>
@endsection