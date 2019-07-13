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
                           SUM(k.metode_pembayaran) + SUM(k.kualitas) +
                           SUM(k.waktu_pengiriman) + SUM(k.harga_barang) as nilai FROM kriterias k
                           JOIN supliers s ON s.id = k.suplier_id
                           GROUP BY suplier_id ORDER BY nilai desc ");

       return $nilai;
    }

    public function test()
    {
        $datas = DB::table('kriterias')
            ->join('supliers', 'suplier.id', '=', 'kriterias.suplier_id')
            ->select('SELECT SUM(kriterias.metode_pembayaran) + SUM(kriterias.kualitas) +
                           SUM(kriterias.waktu_pengiriman) + SUM(kriterias.harga_barang) as nilai, supliers.nama')
            ->get();
    }
}
