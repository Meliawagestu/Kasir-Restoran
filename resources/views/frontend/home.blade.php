@extends('layouts.frontend')
@section('content')
    <!-- slider_area-start -->
    <div class="slider_area zigzag_bg_2">
        <div class="slider_sctive owl-carousel">
            <div class="single_slider slider_img_1">
                <div class="single_slider-iner">
                    <div class="slider_contant text-center">
                         <h3>Daftar Menu <br>
                             Makanan.</h3>
                    </div>
                </div>
            </div>
            <div class="single_slider slider_img_2">
                <div class="single_slider-iner">
                    <div class="slider_contant text-center">
                         <h3>Daftar Menu <br>
                            Makanan.</h3>
                    </div>
                </div>
            </div>
            <div class="single_slider slider_img_3">
                <div class="single_slider-iner">
                    <div class="slider_contant text-center">
                         <h3>Daftar Menu<br>
                            Makanan.</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider_area-end -->

    <!-- order_area_start -->
    <div class="order_area">
        <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <form method="GET" action="{{ route('menu-masakan')}}">
                         {{ csrf_field() }}
                        <div class="section_title mb-70">
                            <h3>Daftar Menu Makanan</h3>
                            <p>Silakan pesan sesukamu, WageSweet menyediakan beberapa pilihan menu yang pastinya halal dan aman untuk dikonsumsi <br> Bahan berkualitas Harga terjangkau</p>
                        </div>
                    </form>
                 </div>
            </div>
        <div class="row">
            @foreach($data as $dt)
                <div class="col-xl-4 col-md-6">
                    <div class="single_order">
                        <div class="order_thumb">
                            <img class="card-img-top img-responsive" src="{{url('storage/gambar-masakan/' .$dt->gambar)}}" style="width: 100%; height: 280px;">
                            <div class="order_prise">
                                <span>Rp. {{number_format($dt->harga,0,',','.')}},</span>
                            </div>
                        </div>
                        <div class="order_info">
                            <h3><a href="#">{{$dt->nama_masakan}}</a></h3>
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
               
    <!-- order_area_end -->

    

   


    <!-- brand_area-start -->
    <!-- <div class="brand_area">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section_title mb-70">
                        <h3>Brands love to take Our Services</h3>
                        <p>inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct
                            standards <br> especially in the workplace. That’s why it’s crucial that, as women.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-xl-2 col-md-6 col-lg-3">
                        <div class="single_brand">
                            <img src="{{url('frontend/img/brand/1.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-3">
                        <div class="single_brand">
                            <img src="{{url('frontend/img/brand/02.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-3">
                        <div class="single_brand">
                            <img src="{{url('frontend/img/brand/03.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-3">
                        <div class="single_brand">
                            <img src="{{url('frontend/img/brand/04.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-3">
                        <div class="single_brand">
                            <img src="{{url('frontend/img/brand/05.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-3">
                        <div class="single_brand">
                            <img src="{{url('frontend/img/brand/06.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-3">
                        <div class="single_brand">
                            <img src="{{url('frontend/img/brand/7.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-3">
                        <div class="single_brand">
                            <img src="{{url('frontend/img/brand/12.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-3">
                        <div class="single_brand">
                            <img src="{{url('frontend/img/brand/9.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-3">
                        <div class="single_brand">
                            <img src="{{url('frontend/img/brand/10.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-3">
                        <div class="single_brand">
                            <img src="{{url('frontend/img/brand/11.png')}}" alt="">
                        </div>
                    </div>
                    <div class="col-xl-2 col-md-6 col-lg-3">
                        <div class="single_brand">
                            <img src="{{url('frontend/img/brand/8.png')}}" alt="">
                        </div>
                    </div>
                </div>
        </div>
    </div> -->
    <!-- brand_area-end -->
@endsection
