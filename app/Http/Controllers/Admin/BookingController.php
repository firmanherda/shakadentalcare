<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Pasien;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::with(['slot.jadwal.dokter', 'pasien.user', 'service'])->get();

        return view('admin.booking.index', ['bookings' => $bookings]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dokters = Dokter::with('service')->get();
        $pasiens = Pasien::with('user')->get();

        return view('admin.booking.create', ['dokters' => $dokters, 'pasiens' => $pasiens]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pasien = Pasien::find($request->pasien);
        $pasien->booking()->create([
            'slot_id' => $request->slot,
            'service_id' => $request->service,
            'tanggal' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        return redirect()->route('admin.booking.index')->with('status', 'Sukses menambah booking');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::with(['pasien.user', 'slot.jadwal.dokter.service', 'transaksi'])->find($id);
        $tanggal = Carbon::create($booking->slot->jadwal->start)->toDateString();
        $start = Carbon::create($booking->slot->jadwal->start)->toTimeString();
        $end = Carbon::create($booking->slot->jadwal->end)->toTimeString();

        return view('admin.booking.show', [
            'booking' => $booking,
            'dokter' => $booking->slot->jadwal->dokter,
            'pasien' => $booking->pasien,
            'jadwal' => $booking->slot->jadwal,
            'tanggal' => $tanggal,
            'start' => $start,
            'end' => $end,
            'slot' => $booking->slot->jadwal->jumlah_slot,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = Booking::with('service')->find($id);

        return view('pasien.booking.show', ['booking' => $booking]);
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
        $service = Service::find($request->service);
        $booking = Booking::find($id);
        $booking->service()->associate($service);

        return redirect()->route('admin.booking.index')->with('status', 'Sukses mengubah booking');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = Booking::find($id);
        $booking->destroy();

        return redirect()->route('admin.booking.index')->with('status', 'Sukses menghapus booking');
    }

    public function dokterServiceJadwal($id)
    {
        $services = User::with(['service', 'jadwal'])->find($id);
        return $services->toJson();
    }
    public function slotJadwal($id)
    {
        $slots = Jadwal::with(['slot.booking'])->find($id);
        return $slots->toJson();
    }
}
