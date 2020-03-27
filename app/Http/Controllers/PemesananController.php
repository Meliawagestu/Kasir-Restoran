<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pemesanan;

class PemesananController extends Controller
{
    public function daftar(Request $req)
    {
    	$data = Pemesanan::join('users','users.id','tbl_pemesanan.id_users')
                ->where('kode_pemesanan','like',"%{$req->keyword}%")
                ->select('tbl_pemesanan.*','name')
                ->orderBy('updated_at','desc')
                ->paginate(10);
    	return view('admin.pages.pemesanan.daftar',['data'=>$data]);
    } 

    public function entri(Request $req)
    {
        $orders = Pemesanan::where('status_pemesanan','tunggu')->get();
        $orders->transform(function($order) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('admin.pages.entripemesanan.daftar', compact('orders'));
    }

    public function terimaEntri($id_pemesanan)
    {
        $orders = Pemesanan::where('id_pemesanan',$id_pemesanan)->first();
        $orders->update(['status_pemesanan' => 'menunggu']);
        if( $orders ){
                return redirect()->route('admin.entripemesanan')->with('orders','update');
            } else {
                return back()->with('orders','fail');
            }
    } 

    public function delete(Request $req)
        {
        $orders = Pemesanan::find($req->id_pemesanan);

        if ( $orders->delete() ){
            return back()->with('orders','delete');
        } else{
        return back()->with('orders','fail-delete');
        }
    }

}


