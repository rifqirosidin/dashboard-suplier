<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembeli extends Model
{
    protected $fillable = [
        'tgl_pembelian', 'no_sop', 'suplier_id','nama_barang', 'jumlah', 'satuan', 'harga'
    ];


    public function suplier()
    {
        return $this->belongsTo('App\Models\Suplier');
    }

    public function getNilaiAtribute($nilai)
    {
        return array_sum($nilai);
    }
}
