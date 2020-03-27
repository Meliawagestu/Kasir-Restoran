<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Masakan extends Model
{
    protected $table = 'tbl_masakan';

    //deklarasi primarykey
    protected $primaryKey = 'id_masakan';
    protected $fillable = ['nama_masakan','kode_masakan','kategori_id','harga','status_masakan','gambar'];

 	public static function getId()
	{

	return $getId = DB::table('tbl_masakan')->orderBy('id_masakan','DESC')->take(1)->get();
	}
}