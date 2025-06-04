<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DaftarController;
use App\Http\Controllers\umumController;
use App\Http\Controllers\adminController;
use App\Http\Controllers\penggunaController;
use App\Http\Controllers\barangController;
use App\Http\Controllers\carouselController;

Route::get('/produk/{id_barang}', [barangController::class, 'review'])->middleware('TrackProductVisit');;

Route::get('/', [umumController::class, 'index']);



Route::middleware('guest')->group(function(){
    Route::get('/Admin', [adminController::class, 'login']);
    Route::post('/Admin', [adminController::class, 'logins']);

    });
    
Route::middleware('admin')->group(function(){
    Route::get('/toko/ubah', [adminController::class, 'editToko']);
    Route::post('/toko/ubah', [adminController::class, 'ubahToko']);
    Route::get('/tampilan', [adminController::class, 'tampilan']);
    Route::post('/tampilan', [adminController::class, 'ubah_tampilan']);

    Route::get('/logout', [adminController::class, 'logout']);

    Route::get('/toko/gantiFoto/', [adminController::class, 'gantiFotoToko']);
    Route::post('/toko/gantiFoto/', [adminController::class, 'gantiFotoTokos']);

    Route::get('/produk/', [barangController::class, 'index']);
    Route::get('/Produk/tambah', [barangController::class, 'tambah']);
    Route::post('/Produk/tambah', [barangController::class, 'plus']);
    
    Route::get('/produk/ubah/{id_barang}', [barangController::class, 'edit']);
    Route::post('/produk/ubah/{id_barang}', [barangController::class, 'ubah']);
    Route::delete('/barang/{id}', [BarangController::class, 'destroy'])->name('barang.destroy');
    
    Route::get('/kategori', [barangController::class, 'kategori']);
    Route::get('/kategori/Tambah', [barangController::class, 'tambah_kategori']);
    Route::post('/kategori/Tambah', [barangController::class, 'plus_kategori']);
    Route::delete('/kategori/hapus/{id}', [barangController::Class, 'hapus_kategori'])->name('kategori.destroy');
    Route::get('/kategori/edit/{id}', [barangController::Class, 'edit_kategori']);
    Route::post('/kategori/edit/{id}', [barangController::Class, 'ubah_kategori']);
    
    Route::get('activity/', [adminController::class, 'activity']);
    Route::delete('activity/hapus/{id}', [adminController::class, 'hapus_activity'])->name('activity.destroy');

    Route::get('/Users', [adminController::class, 'users']);
    Route::get('/Users/Tambah', [adminController::Class, 'tambah_user']);
    Route::post('/Users/Tambah', [adminController::Class, 'store_user']);
    Route::delete('/Users/hapus/{id}', [adminController::Class, 'hapus_user'])->name('users.destroy');
    Route::get('/Users/edit/{id}', [adminController::Class, 'ubah_user']);
    Route::post('/Users/edit/{id}', [adminController::Class, 'edit_user']);

    Route::get('/carousel', [carouselController::class, 'index']);
    Route::post('/carousel', [carouselController::class, 'updateCarousel'])->name('carousel.update');
});
// Route::get('/admin+', [LoginController::class, 'admins']);
Route::get('/search-suggestions', [barangController::class, 'searchSuggestions']);
Route::get('/toko', [umumController::class, 'toko']);






Route::get('/error', function(){
    return view('error');
});
// Route::post('/send-verification-code', [VerificationController::class, 'sendCode']);
// Route::post('/verify-code', [VerificationController::class, 'verifyCode']);



