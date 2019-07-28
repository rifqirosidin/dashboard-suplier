<?php

namespace App\Repositories;

use App\Models\Kriteria;
use App\Models\Suplier;
use Illuminate\Support\Facades\DB;

class EvaluasiRepository {



    public static function getJumlah($suplier_id)
    {
        $datas = DB::select("SELECT AVG(k.metode_pembayaran) as rataKP, AVG(k.kualitas) as rataKB, 
                                AVG(k.waktu_pengiriman) as rataWP, AVG(k.harga_barang) as rataHB,
                                AVG(k.metode_pembayaran) * 0.15 as nilaiKP,  AVG(k.kualitas) * 0.35 as nilaiKB
                                 , AVG(k.waktu_pengiriman) * 0.3 as nilaiWP, AVG(k.harga_barang) * 0.2 as nilaiHB,
                                k.total_nilai from supliers s 
                                JOIN pembelis p ON p.suplier_id = s.id 
                                JOIN kriterias k ON k.suplier_id = s.id WHERE k.suplier_id = $suplier_id GROUP BY k.suplier_id 
                                ");

        return $datas;
    }



}
