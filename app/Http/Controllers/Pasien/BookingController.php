<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Dokter;
use App\Models\Jadwal;
use App\Models\Pasien;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Throwable;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pasien = Pasien::firstWhere('user_id', Auth::id());
        $bookings = Booking::with(['service', 'slot.jadwal'])
            ->where('pasien_id', $pasien->id)
            ->orderBy('id', 'DESC')
            ->get();
        $jadwals = Jadwal::with('dokter.user')->get();
        foreach ($jadwals as $jadwal) {
            $jadwal['slotKosong'] = 0;
            foreach ($jadwal->slot as $slot) {
                if (!$slot->booking) {
                    $jadwal['slotKosong'] += 1;
                }
            }
        }

        return view('pasien.booking.index', ['bookings' => $bookings, 'jadwals' => $jadwals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $dokter = Dokter::with('service')->find(request('dokter'));

        return view('pasien.booking.create', ['services' => $dokter->service]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = User::find(Auth::id());
            $pasien = Pasien::firstWhere('user_id', $user->id);
            $pasien->booking()->create([
                'slot_id' => $request->slot,
                'service_id' => $request->service,
                'tanggal' => Carbon::now()->format('Y-m-d H:i:s')
            ]);

            return 'ok';
        } catch (Throwable $e) {
            return 'gagal';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booking = Booking::with(['pasien.user', 'slot.jadwal.dokter.service'])->find($id);
        $tanggal = Carbon::create($booking->slot->jadwal->start)->toDateString();
        $start = Carbon::create($booking->slot->jadwal->start)->toTimeString();
        $end = Carbon::create($booking->slot->jadwal->end)->toTimeString();

        return view('pasien.booking.show', [
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

        return redirect()->route('pasien.booking.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Booking::destroy($id);

        return redirect()->route('pasien.booking.index');
    }
}
