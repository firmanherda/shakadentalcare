<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    // protected $appends = ['slotKosong'];
    protected $fillable = ['start', 'end', 'tanggal', 'jumlah_slot'];
    public $timestamps = false;

    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }

    public function slot()
    {
        return $this->hasMany(Slot::class);
    }
}
