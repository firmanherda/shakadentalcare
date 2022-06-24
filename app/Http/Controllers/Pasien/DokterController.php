<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use Illuminate\Http\Request;

class DokterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dokters = Dokter::with(['user', 'service'])->get();

        return view('pasien.dokter.index', ['dokters' => $dokters]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dokter = Dokter::with(['user', 'service', 'jadwal'])->find($id);

        return view('pasien.dokter.show', ['dokter' => $dokter]);
    }
}
