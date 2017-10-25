<?php
use App\Homestay;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    $data  = Homestay::all();
    return view('index')->with('data',$data);
});

Route::get('test', function (Request $request) {

    dd($request);

    $data  = Homestay::all();
    return view('searchhomestay')->with('data',$data);
});

Route::get('test', function(){
    return view('index');
});

//test saja
Route::get('editprofiles', function(){
    return view('editprofiles');
});

//web
Route::get('history', function(){
    return view('History');
});



Route::get('profiles', function(){
    return view('profiles');
});

Route::group(['middleware' => 'auth'], function () {
});

Route::get('adminlte', function(){
    return view('welcome');
});

//Coba cart
Route::get('chartjs', 'OwnerController@chartjs');
//

Route::get('AddBook', function(){
    return view('adminlte::layouts.owner.AddBookManual');
});
Route::get('DataPemesanan', function(){
    return view('adminlte::layouts.admin.dataPemesanan');
});

Route::group(['middleware' => 'owner'], function () {
    Route::post('batalkan','OwnerController@batalkan');
    Route::post('printreport','OwnerController@printReport');
    Route::put('asread/{id}','OwnerController@Asread');
    Route::get('record','OwnerController@Record');
    Route::get('report','OwnerController@Report');
    Route::get('report/{id}/{tahun}','OwnerController@findReport');
    Route::get('report/{id}','OwnerController@dfindReport');
    Route::put('check/{id}','OwnerController@Check');
    Route::put('editRoom/{id}','OwnerController@updateRoom');
    Route::post('addManual','OwnerController@addBookManual');
    Route::put('konfirmasiPemesanan/{id}','OwnerController@konfirmasiPemesanan');
    Route::get('editRoom/{id}','OwnerController@editRoom') ;
    Route::get('daftarBooking','OwnerController@listOfBook');
    Route::get('daftarKamar','OwnerController@daftarKamar');
    Route::get('pesanan','OwnerController@listTransaction');
    Route::get('reqFasilitas','OwnerController@requestFasilitas');
    Route::post('reqFasilitas','OwnerController@storeRequest');
    Route::get('updateHomestay','OwnerController@update');
    Route::put('updateHomestay/{id}','OwnerController@updateHomestay');
    Route::get('profile','OwnerController@profile');
    Route::get('profiledit/{id}','OwnerController@profileEdit');
    Route::put('profileupdate/{id}','OwnerController@updateProfil');
    route::get('profile','OwnerController@profile');
    Route::get('profile/{id}/profiledit','OwnerController@editProfile');
    Route::get('profileUpdate/{id}','OwnerController@updatePro');
    Route::resource('owner','OwnerController');
    Route::get('pengajuanHomestay','OwnerController@pengajuan');
    Route::post('pengajuanHomestay','OwnerController@storePengajuan');
    Route::get('listPengajuan','OwnerController@listPengajuan');
    Route::get('listPengajuanFasilitas','OwnerController@listPengajuanFasilitas');
    Route::get('listFeedback','OwnerController@feddback');
    Route::get('home','OwnerController@index');
    Route::get('detailpesanan/{id}','OwnerController@detailpesanan');
    Route::get('pesanan/{id}','OwnerController@pesanan');
    Route::resource('pdf','PDFController@showPDF');
    Route::get('printReportOwner','OwnerController@printReportOwner');
});

Route::post('booking','GuestController@booking');
Route::get('homestay/{id}/{tm}/{lm}/{ts}/{jt}/{jk}','GuestController@homestay');
Route::get('cari','GuestController@cari');
Route::get('detailhomestay/{id}','GuestController@detailhomestay');
Route::get('daftar','GuestController@register');
Route::post('daftar','GuestController@registerStore');
Route::get('rincianpemesanan/{id}','GuestController@rincianpemesanan');
Route::post('feedback/{id}','GuestController@sendFeedback');

Route::group(['middleware' => 'customer'], function () {
    Route::get('updatepesanan/{id}','CustomerController@updatePesanan');
    Route::put('perbaharui/{id}','CustomerController@perbaharui');
    Route::put('batalkan/{id}','CustomerController@cancelPemesanan');
    Route::put('upload/{id}','CustomerController@upload');
    Route::get('customerHistory','CustomerController@history');
    Route::post('book','CustomerController@booking');
    Route::get('buktipembayaran/{id}','CustomerController@bukti');
    Route::get('editProfileCustomer/{id}','CustomerController@editProfile');
    Route::put('editProfileCustomer/{id}','CustomerController@updateProfile');
    Route::get('customerProfile','CustomerController@profile');
    Route::get('rincianHistory/{id}','CustomerController@rincianHistory');
    Route::get('rincianHistoryPrint/{id}','CustomerController@rincianHistoryPrint');
});


Route::group(['middleware' => 'dinaspariwisata'], function () {
    Route::get('caripesanan','AdminController@cariPesanan');
    Route::resource('admin', 'AdminController');
    Route::put('updateOwner/{id}','AdminController@updateOwner');
    Route::get('ownerr/{id}','AdminController@owner');
    Route::get('rincianpemilik/{id}','AdminController@rincian');
    Route::get('listowner','AdminController@listOwner');
    Route::get('listPemesanan','AdminController@listPesanan');
    Route::get('requestHomestay','AdminController@RequestHomestay');
    Route::get('requestFasilitas','AdminController@RequestFasilitas');
    Route::put('requestFasilitas/{id}','AdminController@UpdateRequestFasilitas');
    Route::put('requestFasilitass/{id}','AdminController@UpdateRequestFasilitass');
    Route::put('PengajuanHomestay','AdminController@PengajuanHomestay');
    Route::put('listPengajuanHmsty/{id}','AdminController@RejectPengajuanHomestay');
    Route::get('ownerprofil/{id}','AdminController@profileowner');
    Route::get('Allfeedback','AdminController@Allfeedback');
    Route::get('feedback/{id}','AdminController@feedback');
    Route::get('home','AdminController@Home');
    Route::get('detailreqFasilitas/{id}','AdminController@detailreqFasilitas');
    Route::get('listhomestay','AdminController@listhomestay');
    Route::get('resultlistpesanan','AdminController@listhomestay');
    Route::get('printFasilitas/{id}','AdminController@printFasilitas');
    Route::post('/cancelrequest', 'AdminController@cancelrequest');
    Route::get('admin/create','AdminController@create');
});
