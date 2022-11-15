<?php

use App\Http\Controllers\ItemNoteController;
use App\Http\Controllers\ItemTransaksiController;
use App\Http\Controllers\JenisItemController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ParfumController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\PickupDeliveryController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Transaksi\PickupDelivery;
use Illuminate\Support\Facades\Route;

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
    return redirect()->route('login');
})->name('welcome');

Route::get('/login', [PageController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [UserController::class, 'authenticate']);
Route::get('/logout', [UserController::class, 'logout']);

Route::middleware(['auth'])->group(function () {
    Route::get('/reset-password', [PageController::class, 'resetPassword'])->name('reset_password');

    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::get('/data/rewash', [PageController::class, 'rewash'])->name('menu-rewash')->middleware('permission:menu_rewash');

    //Setting
    Route::get('/setting/karyawan', [PageController::class, 'karyawan'])->name('menu-karyawan')->middleware('permission:menu_karyawan');
    Route::get('/setting/paket', [PageController::class, 'paket'])->name('menu-paket')->middleware('permission:menu_paket');

    //outlet
    Route::get('/setting/outlet', [PageController::class, 'outlet'])->name('menu-outlet')->middleware('permission:menu_outlet');
    Route::get('/setting/outlet/{id}', [OutletController::class, 'show'])->middleware('permission:show_outlet');
    Route::post('/setting/outlet', [OutletController::class, 'insert'])->middleware('permission:insert_outlet');
    Route::post('/setting/outlet/{id}', [OutletController::class, 'update'])->middleware('permission:update_outlet');
    Route::get('/setting/outlet/delete/{id}', [OutletController::class, 'delete'])->middleware('permission:delete_outlet');

    //item
    Route::get('/data/jenis-item', [PageController::class, 'jenisItem'])->name('menu-jenis-item')->middleware('permission:menu_jenis_item');
    Route::get('/data/jenis-item/find', [JenisItemController::class, 'find']);
    Route::get('/data/jenis-item/{id}', [JenisItemController::class, 'show'])->middleware('permission:show_jenis_item');
    Route::post('/data/jenis-item', [JenisItemController::class, 'insert'])->middleware('permission:insert_jenis_item');
    Route::post('/data/jenis-item/{id}', [JenisItemController::class, 'update'])->middleware('permission:update_jenis_item');
    Route::get('/data/jenis-item/delete/{id}', [JenisItemController::class, 'delete'])->middleware('permission:delete_jenis_item');

    //kategori
    Route::get('/data/kategori', [PageController::class, 'kategori'])->name('menu-kategori')->middleware('permission:menu_kategori');
    Route::get('/data/kategori/{id}', [KategoriController::class, 'show'])->middleware('permission:show_kategori');
    Route::post('/data/kategori', [KategoriController::class, 'insert'])->middleware('permission:insert_kategori');
    Route::post('/data/kategori/{id}', [KategoriController::class, 'update'])->middleware('permission:update_kategori');
    Route::get('/data/kategori/delete/{id}', [KategoriController::class, 'delete'])->middleware('permission:delete_kategori');

    //pengeluaran
    Route::get('/data/pengeluaran', [PageController::class, 'pengeluaran'])->name('menu-pengeluaran')->middleware('permission:menu_pengeluaran');
    Route::get('/data/pengeluaran/{id}', [PengeluaranController::class, 'show'])->middleware('permission:show_pengeluaran');
    Route::post('/data/pengeluaran', [PengeluaranController::class, 'insert'])->middleware('permission:insert_pengeluaran');
    Route::post('/data/pengeluaran/{id}', [PengeluaranController::class, 'update'])->middleware('permission:insert_pengeluaran');
    Route::get('/data/pengeluaran/delete/{id}', [PengeluaranController::class, 'delete'])->middleware('permission:delete_pengeluaran');

    //parfum
    Route::get('/data/parfum', [PageController::class, 'parfum'])->name('menu-parfum')->middleware('permission:menu_parfum');
    Route::get('/data/parfum/{id}', [ParfumController::class, 'show'])->middleware('permission:show_parfum');
    Route::post('/data/parfum', [ParfumController::class, 'insert'])->middleware('permission:insert_parfum');
    Route::post('/data/parfum/{id}', [ParfumController::class, 'update'])->middleware('permission:update_parfum');
    Route::get('data/parfum/delete/{id}', [ParfumController::class, 'delete'])->middleware('permission:delete_parfum');

    //Pelanggan
    Route::get('/data/pelanggan', [PageController::class, 'pelanggan'])->name('menu-pelanggan')->middleware('permission:menu_pelanggan');
    Route::get('/data/pelanggan/{id}', [PelangganController::class, 'show'])->middleware('permission:show_pelanggan');
    Route::post('/data/pelanggan', [PelangganController::class, 'insert'])->middleware('permission:insert_pelanggan');
    Route::post('/data/pelanggan/{id}', [PelangganController::class, 'update'])->middleware('permission:update_pelanggan');
    Route::get('/data/pelanggan/delete/{id}', [PelangganController::class, 'delete'])->middleware('permission:delete_pelanggan');

    //Pickup & Delivery
    Route::get('/transaksi/pickup-delivery', [PageController::class, 'pickupDelivery'])->name('pickup-delivery')->middleware('permission:menu_pickup_delivery');
    Route::get('/transaksi/pickup-delivery/{id}', [PickupDeliveryController::class, 'show'])->middleware('permission:show_pickup_delivery');
    Route::post('/transaksi/pickup-delivery', [PickupDeliveryController::class, 'insert'])->middleware('permission:insert_pickup_delivery');
    Route::post('/transaksi/pickup-delivery/{id}', [PickupDeliveryController::class, 'update'])->middleware('permission:update_pickup_delivery');
    Route::get('/transaksi/pickup-delivery/delete/{id}', [PickupDeliveryController::class, 'delete'])->middleware('permission:delete_pickup_delivery');

    //ItemTransaksi
    Route::get('/transaksi/item-transaksi/{id}', [ItemTransaksiController::class, 'show'])->middleware('permission:show_item_transaksi');
    Route::post('/transaksi/item-transaksi', [ItemTransaksiController::class, 'insert'])->middleware('permission:insert_item_transaksi');
    Route::post('/transaksi/item-transaksi/{id}', [ItemTransaksiController::class, 'update'])->middleware('permission:update_item_transaksi');
    Route::get('/transaksi/item-transaksi/delete/{id}', [ItemTransaksiController::class, 'delete'])->middleware('permission:delete_item_transaksi');

    //ItemNote
    Route::get('/transaksi/item/note/list/{item_transaksi_id}', [ItemNoteController::class, 'list']);
    Route::get('/transaksi/item/note/{id}', [ItemNoteController::class, 'show']);
    Route::post('/transaksi/item/note/add', [ItemNoteController::class, 'insert']);

    //Transaksi
    Route::get('/transaksi/bucket', [PageController::class, 'bucket'])->name('transaksi-bucket')->middleware('permission:menu_transaksi_bucket');
    Route::get('/transaksi/create', [TransaksiController::class, 'insert']);
    Route::get('/transaksi/detail/{id}', [TransaksiController::class, 'show']);
    Route::get('/transaksi/search/{key}', [TransaksiController::class, 'search']);
    Route::get('/transaksi/addItem', [ItemTransaksiController::class, 'addItemToTransaksi']);
    Route::post('/transaksi/update/{id}', [TransaksiController::class, 'update']);
    Route::post('/transaksi/penerima', [PenerimaController::class, 'insert']);

    //Catatan Item Transaksi

});
