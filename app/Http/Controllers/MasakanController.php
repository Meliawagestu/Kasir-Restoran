<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Masakan;

class MasakanController extends Controller
{
    public function daftar(Request $req)
    {
        /* Menghubungkan Tabel Masakan dengan Kategori */
    	$data = Masakan::join('tbl_kategori','tbl_kategori.id','tbl_masakan.kategori_id')
                ->where('nama_masakan','like',"%{$req->keyword}%")
                ->select('tbl_masakan.*','nama_kategori')
                ->orderBy('updated_at','desc')
                ->paginate(10);
    	return view('admin.pages.masakan.daftar',['data'=>$data]);
    }

    /* fungsi add/Tambah */
    public function add()
    {
    	return view('admin.pages.masakan.add');
    }
    
    /* fungsi save/Simpan */
    public function save(Request $req)
    {

        /* Ambil ID Terakhir */
        $id = Masakan::getId();
        foreach ($id as $value);
        $idLama = $value->id_masakan;
        $idBaru = $idLama + 1;

        $kode_mkn = 'WAS'.$idBaru;
        
        \Validator::make($req->all(),[
            'nama_masakan'=>'required|between:3,100',
            'harga'=>'required|numeric',
            'kategori'=>'required|numeric',
            'status_masakan'=>'required',
            'gambar'=>'required|image',
        ])->validate();
    	

        /* Ganti nama file*/
        $filename = rand(1,999).'_'.str_replace(' ', '', $req->gambar->getClientOriginalName());

        /* Simpan file ke storage->app->public */
        $req->file('gambar')->storeAs('public/gambar-masakan',$filename);

        $result = new Masakan;
        $result->kode_masakan = $kode_mkn.sprintf("%02s", $req->kode_masakan);
        $result->nama_masakan = $req->nama_masakan;
        $result->harga = $req->harga;
        $result->kategori_id = $req->kategori;
        $result->status_masakan = $req->status_masakan;
        $result->gambar = $filename;

        if($result->save()){
            return redirect()->route('admin.masakan')->with('result','success');
        } else {
            return back()->with('result','fail')->withInput();
        }
    }


    public function edit($id_masakan)
    {
        $data = Masakan::where('id_masakan',$id_masakan)->first();
        return view('admin.pages.masakan.edit',['rc'=>$data]);
    }

    public function update(Request $req)
    {

        \Validator::make($req->all(),[
            'nama_masakan'=>'required|between:3,100',
            'harga'=>'required|numeric',
            'status_masakan'=>'required',
            'gambar'=>'nullable|image',
        ])->validate();

        if(!empty($req->gambar)){

            /* Ganti nama file*/
            $filename = rand(1,999).'_'.str_replace(' ', '',$req->gambar->getClientOriginalName());

            /* Simpan file ke storage->app->public */
            $req->file('gambar')->storeAs('public/gambar-masakan',$filename);

            $field = [
                    'nama_masakan'=>$req->nama_masakan,
                    'kategori_id'=>$req->kategori_id,
                    'harga'=>$req->harga,
                    'status_masakan'=>$req->status_masakan,
                    'gambar'=>$filename,
            ];
        } else {
             $field = [
                    'nama_masakan'=>$req->nama_masakan,
                    'kategori_id'=>$req->kategori_id,
                    'harga'=>$req->harga,
                    'status_masakan'=>$req->status_masakan,
            ];
        }

        

        $result = Masakan::where('id_masakan',$req->id_masakan)->update($field);

        if( $result ){
                return redirect()->route('admin.masakan')->with('result','update');
            } else {
                return back()->with('result','fail');
            }
     }


        public function delete(Request $req)
        {
        $result = Masakan::find($req->id_masakan);

        if ( $result->delete() ){
            return back()->with('result','delete');
        } else{
        return back()->with('result','fail-delete');
        }
    }
}
