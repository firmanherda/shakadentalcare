<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksis = Transaksi::with(['booking.service', 'booking.pasien.user'])->whereHas('booking.dokter', function ($q) {
            return $q->where('user_id', Auth::id());
        })->orderBy('tanggal', 'DESC')->get();

        return view('dokter.riwayat.index', ['transaksis' => $transaksis]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transaksi = Transaksi::with(['booking.pasien.user', 'booking.service'])->find($id);

        return view('dokter.riwayat.show', ['transaksi' => $transaksi]);
    }
}
