<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvaluasi;
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
//        $pembelians = Pembeli::with('suplier.kriteria')->where('suplier_id', $id)
////            ->get();
         $pembelians = Pembeli::with('suplier.kriteria')->where('suplier_id', $id)->get();

//        return $pembelians;

        $suplier = Suplier::where('id', $id)->first();

        return view('dashboard.evaluasi.create', compact('pembelians', 'suplier'));
    }

    public function store(StoreEvaluasi $request)
    {
        $id =  request()->suplier_id;
        Kriteria::where('suplier_id', $id)->delete();

        $validate = $request->validated();
        $datas = $request->get('harga_barang');
        $input = Input::all();


        foreach ($datas as $key => $value){

            $validate['metode_pembayaran'] = $input['metode_pembayaran'][$key];
            $validate['kualitas'] = $input['kualitas'][$key];
            $validate['waktu_pengiriman'] = $input['waktu_pengiriman'][$key];
            $validate['harga_barang'] = $input['harga_barang'][$key];
            $validate['total_nilai'] = $request->total_nilai;
            $validate['suplier_id'] = $input['suplier_id'][$key];

            Kriteria::updateOrCreate($validate);

//            Kriteria::create($validate);
        }

        session()->flash('success', 'Penilaian Berhasil Dibuat');

        return redirect()->route('evaluasi.index');

    }

}
