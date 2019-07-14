<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    protected $fillable = [
        'metode_pembayaran', 'kualitas', 'waktu_pengiriman', 'harga_barang', 'suplier_id','total_nilai'
    ];


    public function suplier()
    {
        return $this->belongsTo(Suplier::class, 'suplier_id');
    }
}
