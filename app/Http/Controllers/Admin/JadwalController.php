<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jadwals = Jadwal::with(['dokter.user', 'slot.booking'])->get();
        foreach ($jadwals as $jadwal) {
            $jadwal['slotKosong'] = 0;
            foreach ($jadwal->slot as $slot) {
                if (!$slot->booking) {
                    $jadwal['slotKosong'] += 1;
                }
            }
        }
        return view('admin.jadwal.index', ['jadwals' => $jadwals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dokters = Dokter::with(['user', 'service'])->get();
        $start = Carbon::parse(request('start'))->format('Y-m-d\TH:i');
        $end = Carbon::parse(request('end'))->format('Y-m-d\TH:i');
        $waktu = [$start, $end];

        return view('admin.jadwal.create', ['dokters' => $dokters, 'waktu' => $waktu, 'tanggal' => request('tanggal')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dokter = Dokter::find($request->dokter);
        $slots = [];

        $jadwal = $dokter->jadwal()->create([
            'start' => date('Y-m-d H:i:s', strtotime($request->start)),
            'end' => date('Y-m-d H:i:s', strtotime($request->end)),
            'tanggal' => $request->tanggal,
            'jumlah_slot' => $request->slot,
        ]);

        for ($i = 0; $i < $request->slot; $i++) {
            $slots[$i] = ['jadwal_id' => $jadwal->id, 'nomor' => $i + 1];
        }

        Slot::insert($slots);

        return redirect()->route('admin.jadwal.index');
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
        return view('admin.jadwal.show', ['jadwal' => $jadwal]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::find($id);
        $jadwal->update([
            'start' => $request->start,
            'end' => $request->end,
            'tanggal' => $request->tanggal,
        ]);

        return $jadwal;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!Jadwal::find($id)->delete()) {
            return 'gagal';
        }

        return redirect()->route('admin.jadwal.index');
    }
}
