<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Transaksi;
use App\Pemesanan;
use PDF;
use Auth;

class TransaksiController extends Controller
{
   public function index(Request $req)
    {
    	$data = Transaksi::join('users', 'tbl_transaksi.users_id', 'users.id')
            ->join('tbl_pemesanan', 'tbl_transaksi.pemesanan_id', '=', 'tbl_pemesanan.id_pemesanan')
            ->select('tbl_transaksi.*', 'users.name', 'tbl_pemesanan.*')
            ->orderBy('tbl_transaksi.updated_at','desc')
            ->paginate(10);
            return view('admin.pages.transaksi.daftar', ['data'=>$data]);
    } 

    public function kasir(Request $req)
     {
        $orders = Pemesanan::where('status_pemesanan','menunggu')->get();
        return view('admin.pages.transaksi.kasir.data', compact('orders'));
    }

    public function delete(Request $req)
    {
        $result = Transaksi::find($req->id);

        if ( $result->delete() ){
            return back()->with('result','delete');
        } else{
        return back()->with('result','fail-delete');
        }
    }

 public function payment(Request $req, $id_pemesanan)
    {
        $orders = Pemesanan::where('id_pemesanan', $id_pemesanan)->first();
        return view('admin.pages.transaksi.kasir.bayar', ['orders'=>$orders]);
    }

    public function bayar(Request $req)
    {

        $transaksi = new Transaksi;
        $transaksi->users_id = $req->users_id;
        $transaksi->pemesanan_id= $req->pemesanan_id;
        $transaksi->total_bayar = $req->total_bayar;
        $transaksi->kembalian = $req->kembalian;

        if ($req->kembalian < 0) {
            return back()->with('result','fail');
        } else {
            
            $transaksi->save();
            return back()->with('result','success');
        }
    }

    public function getFinish($id_pemesanan)
    {
        $orders = Pemesanan::where('id_pemesanan', $id_pemesanan)->first();
        $orders->update(['status_pemesanan' => 'selesai']);
        if( $orders ){
                return redirect()->route('cashier')->with('orders','update');
            } else {
                return back()->with('orders','fail');
            }
    }

    public function ExportPDF(Request $req)
    {
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
        $pdf = PDF::loadView('admin.pages.laporan.invoice', compact('data'), compact('orders'));
        return $pdf->download('report_transaksi.pdf');
    }
}


 