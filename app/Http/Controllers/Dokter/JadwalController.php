<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwals = Jadwal::with('dokter.user')->where('dokter_id', Auth::user()->dokter->id)->get();
        return view('dokter.jadwal.index', ['jadwals' => $jadwals]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jadwal = Jadwal::with(['dokter', 'slot.booking.pasien.booking'])->find($id);
        return view('dokter.jadwal.show', ['jadwal' => $jadwal]);
    }
}
