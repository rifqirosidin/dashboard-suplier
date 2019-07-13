<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    protected $fillable = ['nama', 'alamat', 'telepon', 'fax', 'up', 'jenis_produk'];


    public function kriteria()
    {
        return $this->hasMany(Kriteria::class, 'suplier_id', 'id');
    }

    public function pembeli()
    {
        $this->hasMany('App\Models\Pembeli');
    }

    public function getNilaiAttribute()
    {

    }
}
