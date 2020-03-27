<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'tbl_transaksi';
    protected $guarded = ['id','created_at','updated_at'];

    public function order()
	{
		return $this->belongsTo(Pemesanan::class);
	}
}
