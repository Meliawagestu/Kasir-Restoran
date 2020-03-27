<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pemesanan extends Model
{
    protected $table = 'tbl_pemesanan';

    //deklarasi primarykey
    protected $primaryKey = 'id_pemesanan';
    protected $fillable = ['no_meja','kode_pemesanan','id_users','keterangan','status_pemesanan'];

    public static function getId()
	{

	return $getId = DB::table('tbl_pemesanan')->orderBy('id_pemesanan','DESC')->take(1)->get();
	}

	public static function arrayCart(Request $req)
	{
		$orders = Pemesanan::where('id_pemesanan', $req->id_pemesanan)->get();
		$orders->transform(function($order)
		{
			$order->cart = unserialize($order->cart);
			return $order;
		});
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
     }
}
