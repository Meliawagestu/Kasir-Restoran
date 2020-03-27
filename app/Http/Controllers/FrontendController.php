<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Masakan;
use App\Kategori;
use App\Cart;
use App\Pemesanan;
use Session;
use Auth;


class FrontendController extends Controller
{
    public function index()
    {
    	return view('frontend.home');
    }

    public function about()
    {
        return view('frontend.about'); 
    }

    public function menu(Request $req)
    {
    	$data = Masakan::join('tbl_kategori','tbl_kategori.id','tbl_masakan.kategori_id')
    		->orWhere('nama_masakan','like',"%{$req->keyword}%")
    		->orWhere('tbl_kategori.id', $req->kategori_id)
    		->select('tbl_masakan.*','nama_kategori')
    		->orderBy('updated_at','desc')
    		->paginate(10);
    		return view('frontend.home', ['data'=>$data]);
    }

    public function showItem(Request $req, $id_masakan)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $data = Masakan::where('id_masakan', $id_masakan)->first();
        return view('frontend.show', ['data'=>$data]);
    }

    public function showCates($id)
    {
        $data = Masakan::join('tbl_kategori','tbl_kategori.id', 'tbl_masakan.kategori_id')
        ->where('kategori_id',$id)
        ->orderBy('tbl_masakan.updated_at','desc')
        ->get();
        return view('frontend.category', compact('data')); 
    }
 
    public function getCart()
    {
        if (!Session::has('cart')) {
            return view('frontend.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('frontend.shopping-cart', ['data' => $cart->items, 'totalPrice'=>$cart->totalPrice]);
    }

    public function getHistory()
    {

        $orders = Pemesanan::where('id_users',Auth::id())
                    ->orderBy('updated_at','desc')->get();
        $orders->transform(function($order) {
        $order->cart = unserialize($order->cart);
        return $order;
        });

        return view('frontend.history', compact('orders'));
    } 
    
    public function AddToCart(Request $req, $id_masakan)
    {
        $data = Masakan::find($id_masakan);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($data, $data->id_masakan);

        $req->session()->put('cart', $cart);
        return redirect()->route('menu-masakan');
    }

    public function getRemoveItem($id_masakan)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeItem($id_masakan);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('shopping.cart');
    }

    public function getReduceByOne($id_masakan)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id_masakan);

        if (count($cart->items) > 0) {
            Session::put('cart', $cart);
        } else {
            Session::forget('cart');
        }

        return redirect()->route('shopping.cart');
    }

    public function getAddOne($id_masakan)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->addone($id_masakan);

        Session::put('cart', $cart);
        return redirect()->route('shopping.cart');
    }

    public function destroy()
    {
        Session::forget('cart');
        return redirect()->route('menu-masakan');
    }
    
    public function getCheckout()
    {
        if (!Session::has('cart')) {
            return view('frontend.shopping-cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('frontend.checkout', ['data' => $cart->items, 'total' => $total]);
    }

    public function postCheckout(Request $req)
    {
        if (!Session::has('cart')) {
            return redirect()->route('shopping.cart');
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);

        $check = Pemesanan::where('no_meja', $req->no_meja)->where('status_pemesanan','!=','selesai')->count();
        if ($check > 0) {
            return back()->with('info',1);
        }

        //Ambil ID Terakhir
        $id = Pemesanan::getId();
        foreach($id as $value);
        $idLama = $value->id_pemesanan;
        $idBaru = $idLama + 1;
        $blt = date('mY');

        $kode_ord = 'PSA'.$blt.$idBaru;

        try {
            //insert pemesanan
            $Pemesanan = new Pemesanan;
            $Pemesanan->kode_pemesanan = $kode_ord.sprintf("%02s", $req->kode_pemesanan);
            $Pemesanan->no_meja = $req->no_meja;
            $Pemesanan->id_users = $req->id_users;
            $Pemesanan->cart = serialize($cart);
            $Pemesanan->subtotal = $cart->totalPrice;
            $Pemesanan->keterangan = $req->keterangan;
            $Pemesanan->status_pemesanan = $req->status_pemesanan;

            $Pemesanan->save();

        } catch (Exception $e) {
        }
    
        Session::forget('cart');
        return redirect()->route('thankyou')->with('result','success');

        }

        public function getThankyou()
        {
            $orders = Auth::user()->orders;
            $orders->transform(function($order) {
                $order->cart = unserialize($order->cart);
                return $order;
            });
           
        return view('frontend.thankyou', compact('orders'));
        }
    }



 