<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $dates = ['tanggal'];
    protected $fillable = ['booking_id', 'total', 'catatan', 'tanggal'];
    public $timestamps = false;

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function service()
    {
        return $this->belongsToThrough(Service::class, Booking::class);
    }

    public function pasien()
    {
        return $this->belongsToThrough(Pasien::class, Booking::class);
    }

    public function dokter()
    {
        return $this->belongsToThrough(Dokter::class, [Jadwal::class, Slot::class, Booking::class]);
    }
}
