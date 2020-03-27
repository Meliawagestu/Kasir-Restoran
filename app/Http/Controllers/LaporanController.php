<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use PDF;
use App\Pemesanan;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function invoice(Request $req){
    	$data = DB::table('tbl_transaksi')
            ->join('users', 'tbl_transaksi.users_id', '=', 'users.id')
            ->join('tbl_pemesanan', 'tbl_transaksi.pemesanan_id', '=', 'tbl_pemesanan.id_pemesanan')
            ->select('tbl_transaksi.*', 'users.name', 'tbl_pemesanan.*')
            ->where('tbl_pemesanan.kode_pemesanan', $req->kode_pemesanan)
            ->get();

        $orders = Pemesanan::where('kode_pemesanan',$req->kode_pemesanan)->get();
        $orders->transform(function($order) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
    	return view('admin.pages.laporan.invoice', compact('data'), compact('orders'));
    }


        public function daftar(Request $req){
        $data = DB::table('tbl_transaksi')
            ->join('users', 'tbl_transaksi.users_id', '=', 'users.id')
            ->join('tbl_pemesanan', 'tbl_transaksi.pemesanan_id', '=', 'tbl_pemesanan.id_pemesanan')
            ->select('tbl_transaksi.*', 'users.name', 'tbl_pemesanan.*')
            ->where('tbl_pemesanan.kode_pemesanan', $req->kode_pemesanan)
            ->get();

        $orders = Pemesanan::where('kode_pemesanan',$req->kode_pemesanan)->get();
        $orders->transform(function($order) {
            $order->cart = unserialize($order->cart);
            return $order;
        });
        return view('admin.pages.laporan.laporan', compact('data'), compact('orders'));
    }
      public function LaporanOwner()
    {
        $data = DB::table('tbl_transaksi')
            ->join('users', 'tbl_transaksi.users_id', '=', 'users.id')
            ->join('tbl_pemesanan', 'tbl_transaksi.pemesanan_id', '=', 'tbl_pemesanan.id_pemesanan')
            ->select('tbl_transaksi.*', 'users.name', 'tbl_pemesanan.*')
            ->get();

        $pendapatan = Pemesanan::where('status_pemesanan','selesai')->sum('subtotal'); 

        $pdf = PDF::loadView('admin.pages.laporan.laporan', compact('data'), compact('pendapatan'));
        return $pdf->download('report_transaksi.pdf');
    }

}
