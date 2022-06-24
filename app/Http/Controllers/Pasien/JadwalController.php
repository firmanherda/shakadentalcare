<?php

namespace App\Http\Controllers\Pasien;

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
        $jadwals = Jadwal::with('dokter.user')->get();
        return view('pasien.jadwal.index', ['jadwals' => $jadwals]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user()->pasien->id;
        $booked = false;
        $jadwal = Jadwal::with(['dokter', 'slot.booking.pasien.user'])->find($id);

        foreach ($jadwal->slot as $slot) {
            if (isset($slot->booking) && $slot->booking->pasien_id == $user) $booked = true;
        }

        return view('pasien.booking.show', ['jadwal' => $jadwal, 'booked' => $booked]);
    }
}
