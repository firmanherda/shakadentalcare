<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    protected $fillable = ['user_id', 'tanggal_lahir', 'alamat'];
    protected $dates = ['tanggal_lahir'];
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
