<?php

use Illuminate\Support\Facades\Auth;
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
    return view('layouts.profile');
});

Route::get('profile', function () {
    return view('layouts.profile');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'middleware' => ['web', 'admin']], function () {
    Route::redirect('/', 'admin/home', 302);

    Route::view('home', 'admin.home.index')->name('admin.home');

    Route::prefix('booking')->group(function () {
        Route::get('dokter-service/{id}', 'Admin\BookingController@dokterServiceJadwal')->name('admin.booking.serviceJadwal');
        Route::get('slot-jadwal/{id}', 'Admin\BookingController@slotJadwal')->name('admin.booking.slotJadwal');
    });

    Route::prefix('dokter')->group(function() {
        Route::get('{id}/riwayat', 'Admin\DokterController@showRiwayat')->name('admin.dokter.riwayat');
    });

    Route::resource('dokter', 'Admin\DokterController', ['as' => 'admin']);
    Route::resource('service', 'Admin\ServiceController', ['as' => 'admin']);
    Route::resource('pasien', 'Admin\PasienController', ['as' => 'admin']);
    Route::resource('jadwal', 'Admin\JadwalController', ['as' => 'admin']);
    Route::resource('booking', 'Admin\BookingController', ['as' => 'admin']);
});

Route::group(['prefix' => 'dokter', 'middleware' => ['web', 'dokter']], function () {
    Route::redirect('/', 'dokter/home', 302);
//menggunakan prefix agar kita bisa menyederhanakan kodingan kita dan lebih teratur
    Route::prefix('home')->group(function () {
        Route::get('/', 'Dokter\HomeController@index')->name('dokter.home.index');
        Route::get('{id}', 'Dokter\HomeController@createTransaksi')->name('dokter.home.createTransaksi');
        Route::patch('{id}/handle', 'Dokter\HomeController@handleBooking')->name('dokter.home.handleBooking');
    });

    Route::resource('jadwal', 'Dokter\JadwalController', [
        'only' => ['index', 'show'],
        'as' => 'dokter'
    ]);

    Route::resource('pasien', 'Dokter\PasienController', [
        'only' => ['index', 'show'],
        'as' => 'dokter'
    ]);

    Route::resource('riwayat', 'Dokter\RiwayatController', [
        'only' => ['index', 'show'],
        'as' => 'dokter'
    ]);
});

Route::group(['prefix' => 'pasien', 'middleware' => 'web'], function () {
    Route::redirect('/', 'pasien/home', 302);

    Route::resource('home', 'Pasien\HomeController', [
        'only' => ['index', 'show'],
        'as' => 'pasien'
    ]);

    Route::resource('jadwal', 'Pasien\JadwalController', [
        'only' => ['index', 'show'],
        'as' => 'pasien'
    ]);
    Route::resource('booking', 'Pasien\BookingController', ['as' => 'pasien']);
    Route::resource('dokter', 'Pasien\DokterController', [
        'only' => ['index', 'show'],
        'as' => 'pasien'
    ]);
});
