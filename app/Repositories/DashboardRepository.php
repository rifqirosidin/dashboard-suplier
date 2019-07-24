<?php

namespace App\Repositories;

use App\Models\Kriteria;
use App\Models\Suplier;
use Illuminate\Support\Facades\DB;

class DashboardRepository {

    protected $kriteria;

    public function __construct(Kriteria $kriteria)
    {
        $this->$kriteria = $kriteria;
    }

    public static function getDataKriteriaSuplier()
    {
       $datas = DB::select("SELECT s.id, s.nama, s.alamat, s.fax, s.telepon, s.up, s.jenis_produk, 
                                k.total_nilai from supliers s 
                                JOIN pembelis p ON p.suplier_id = s.id 
                                JOIN kriterias k ON k.suplier_id = s.id GROUP BY p.suplier_id 
                                ORDER BY total_nilai DESC ");

       return $datas;
    }



}
