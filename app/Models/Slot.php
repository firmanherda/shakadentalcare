<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    protected $fillable = ['nomor', 'jadwal_id', 'pasien_id'];
    public $timestamps = false;

    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class);
    }

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }
}
