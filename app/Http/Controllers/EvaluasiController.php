<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pembeli;
use App\Models\Suplier;
use App\Repositories\DashboardRepository;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class EvaluasiController extends Controller
{
    public function index()
    {
        $evaluasis = Pembeli::with('suplier.kriteria')->whereHas('suplier')
            ->groupBy('suplier_id')
            ->orderBy('created_at', 'desc')
            ->get();

//        $test = Suplier::all();

//        $collection = collect($evaluasis);

        return view('dashboard.evaluasi.index', compact('evaluasis'));
    }

    public function create($id)
    {
        $pembelians = Pembeli::with('suplier')->where('suplier_id', $id)->get();

        $suplier = Suplier::where('id', $id)->first();

        return view('dashboard.evaluasi.create', compact('pembelians', 'suplier'));
    }

    public function store(Request $request)
    {

        $datas = $request->get('harga_barang');
        $input = Input::all();

        foreach ($datas as $key => $value){
            $kriteria = new Kriteria();
            $kriteria->metode_pembayaran = $input['metode_pembayaran'][$key];
            $kriteria->kualitas = $input['kualitas'][$key];
            $kriteria->waktu_pengiriman = $input['waktu_pengiriman'][$key];
            $kriteria->harga_barang = $input['harga_barang'][$key];
            $kriteria->total_nilai = $request->total_nilai;
            $kriteria->suplier_id = $input['suplier_id'][$key];

            $kriteria->save();
        }

        session()->flash('success', 'Penilaian Berhasil Dibuat');

        return redirect()->route('evaluasi.index');


    }

}
