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
       $nilai = DB::select("SELECT s.id, s.nama, s.alamat, s.telepon, s.fax, s.up, s.jenis_produk,
                          total_nilai FROM kriterias k
                           JOIN supliers s ON s.id = k.suplier_id
                           GROUP BY k.suplier_id ORDER BY k.created_at desc ");

//        $nilai = DB::table('supliers')
//            ->join('kriterias', 'supliers.id', '=', 'kriterias.suplier_id')
//            ->select(DB::raw('supliers.id, supliers.nama, supliers.alamat, supliers.telepon,
//                            supliers.fax, supliers.up, supliers.jenis_produk,
//                           kriterias.total_nilai'))
////
//            ->groupBy('kriterias.suplier_id')
//            ->orderBy('kriterias.created_at', 'desc')
//            ->get();

       return $nilai;
    }

    public function getSuplierDiTerima()
    {
//        $data = DB::table('pembelis')
//            ->join('supliers', 'pembelis.suplier_id','=','supliers.id')
//            ->select(DB::raw(''))
    }

}
