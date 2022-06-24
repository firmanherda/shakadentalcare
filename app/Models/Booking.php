<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = ['slot_id', 'pasien_id', 'service_id', 'status', 'tanggal'];
    protected $dates = ['tanggal'];
    public $timestamps = false;

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class);
    }

    public function slot()
    {
        return $this->belongsTo(Slot::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function dokter()
    {
        return $this->belongsToThrough(Dokter::class, [Jadwal::class, Slot::class]);
    }
}
