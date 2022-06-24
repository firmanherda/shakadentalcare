<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pasien;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasiens = Pasien::with('user')
            ->whereHas('booking', function ($q) {
                return $q->where('status', 'Selesai');
            })
            ->whereHas('booking.dokter', function ($q) {
                return $q->where('user_id', Auth::id());
            })->get();

        return view('dokter.pasien.index', ['pasiens' => $pasiens]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksis = Transaksi::with([
            'booking.pasien.user',
            'booking' => function ($q) {
                return $q->where('status', 'Selesai');
            },
            'booking.service',
            'booking.transaksi'
        ])->whereHas('booking.dokter', function ($q) {
            return $q->where('user_id', Auth::id());
        })->whereHas('booking.pasien', function ($q) use ($id) {
            return $q->where('id', $id);
        })->get();

        return view('dokter.pasien.show', ['transaksis' => $transaksis]);
    }
}
