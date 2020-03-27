<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Tampilkan halaman login di awal
Route::get('/', function() {
	return view('auth.login');
});

Route::group(['prefix' => 'frontend','middleware'=>['auth']], function(){
	Route::get('/', function() {
		return redirect('/frontend/menu');
	})->name('admin.home');
	
	// tampilkan menu masakan dari database
	Route::get('/menu', 'FrontendController@menu')->name('menu-masakan');
	//menambahkan item ke cart menggunakan session
	Route::get('/cart/{id_masakan}','FrontendController@AddToCart')->name('add.cart');

	//view cart
	Route::get('/shopping-cart','FrontendController@getCart')->name('shopping.cart');
	//kirim data cart ke tabel order
	Route::post('/shopping-cart','FrontendController@postCart')->name('postcart');

	//menampilkan kategori
	Route::get('/category{nama_kategori}' ,'FrontendController@showCates')->name('show.category');

	//menampilkan history ketika belum ada yang pesan
	Route::get('/history','FrontendController@getHistory')->name('history');
	

	//fungsi show,menambah,menghapus item session yang ada pada cart
	Route::get('/show/{id_masakan}','FrontendController@showItem')->name('show.item');
	Route::get('/add/{id_masakan}','FrontendController@getAddOne')->name('addone');
	Route::get('/reduce/{id_masakan}','FrontendController@getReduceByOne')->name('reducebyone');
	Route::get('/remove/{id_masakan}','FrontendController@getRemoveItem')->name('remove.items');
	Route::get('/cancel','FrontendController@destroy')->name('cancel');
	

	//view checkout untuk verifikasi tagihan
	Route::get('/checkout','FrontendController@getCheckout')->name('checkout');
	//kirim data ke tabel detail order
	Route::post('/checkout','FrontendController@postCheckout')->name('postcheckout');

	//view thankyou
	Route::get('/thankyou','FrontendController@getThankyou')->name('thankyou');
	
	Route::get('/about','FrontendController@about')->name('about');

});

	/* Admin */
	Route::group(['prefix'=>'admin','middleware'=>['auth']], function(){
		Route::get('/', function(){
			return view('admin.pages.dashboard');
		})->name('admin.home')->middleware('akses.admin:owner');

		/* User */
		Route::prefix('user')->group(function(){
			Route::get('/','UserController@daftar')->name('admin.user')->middleware('akses.admin');
			Route::delete('/','UserController@delete')->middleware('akses.admin');

			Route::get('/add','UserController@add')->name('admin.user.add')->middleware('akses.admin');
			Route::post('/add','UserController@save')->middleware('akses.admin');

 			Route::get('/edit/{id}','UserController@edit')->name('admin.user.edit')
					->middleware('akses.admin');
			Route::post('/edit/{id}','UserController@update')
					->middleware('akses.admin');

			Route::get('/setting','UserSettingController@form')->name('admin.user.setting');
			Route::post('/setting','UserSettingController@update');
		});


		/* Kategori */
		Route::group(['prefix'=>'Kategori','middleware'=>'akses.admin'], function() {
		Route::get('/','KategoriController@daftar')->name('admin.kategori');
		Route::delete('/','KategoriController@delete');

		Route::get('/add','KategoriController@add')->name('admin.kategori.add');
		Route::post('/add','KategoriController@save');

		Route::get('/edit{id}','KategoriController@edit')->name('admin.kategori.edit');
		Route::post('/edit{id}','KategoriController@update');
	});
		

		/* Masakan */
		Route::group(['prefix'=>'masakan','middleware'=>'akses.admin'], function(){
		Route::get('/','MasakanController@daftar')->name('admin.masakan');
		Route::delete('/','MasakanController@delete')->middleware('akses.admin');

		Route::get('/add','MasakanController@add')->name('admin.masakan.add');
		Route::post('/add','MasakanController@save');

		Route::get('/edit/{id_masakan}','MasakanController@edit')->name('admin.masakan.edit');
		Route::post('/edit/{id_masakan}','MasakanController@update');
			
		});

		/* Entri Pemesanan */
		Route::group(['prefix'=>'entripemesanan','middleware'=>'akses.admin:waiter'], function(){
			Route::get('/','PemesananController@entri')->name('admin.entripemesanan');
			Route::delete('/','PemesananController@delete');
			Route::get('/terimaEntri{id_pemesanan}','PemesananController@terimaEntri')->name('entri.accept');
			});


		/* History Pemesanan */
		Route::group(['prefix'=>'pemesanan','middleware'=>'akses.admin:waiter'], function(){
			Route::get('/','PemesananController@daftar')->name('admin.pemesanan');
			});

		
		/* Kasir */
		Route::group(['prefix'=>'cashier','middleware'=>'akses.admin:kasir'], function(){
		Route::get('/','TransaksiController@kasir')->name('cashier');
		Route::get('/payment/{id_pemesanan}','TransaksiController@payment')->name('payment');
		Route::post('/payment','TransaksiController@bayar')->name('bayar');
		Route::get('/finish/{id_pemesanan}','TransaksiController@getFinish')->name('getFinish');
		});
		// End Kasir//

	// Transaksi Route
	Route::group(['prefix'=>'transaksi','middleware'=>'akses.admin:kasir'], function(){
		Route::get('/', 'TransaksiController@index')->name('admin.transaksi');
		Route::delete('/', 'TransaksiController@delete');
	});
		
	// Laporan
	Route::group(['prefix'=>'invoice'], function(){
		Route::get('/invoice/{kode_pemesanan}','LaporanController@invoice')->name('invoice');
		Route::get('/laporan','LaporanController@LaporanOwner')->name('laporan.owner');
		
		});
	});
	// End Laporan //




Auth::routes();




