<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEvaluasi;
use App\Models\Kriteria;
use App\Models\Pembeli;
use App\Models\Suplier;
use App\Repositories\DashboardRepository;
use App\Repositories\EvaluasiRepository;
use function foo\func;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class EvaluasiController extends Controller
{
    public function index()
    {

        $evaluasis = Pembeli::with('suplier.kriteria')->whereHas('suplier')
            ->orderBy('created_at', 'desc')
            ->groupBy('suplier_id')
            ->get();


        return view('dashboard.evaluasi.index', compact('evaluasis'));
    }

    public function create($id)
    {

        $pembelians = Pembeli::with('suplier.kriteria')->where('suplier_id', $id)->get();


        $suplier = Suplier::where('id', $id)->first();

        return view('dashboard.evaluasi.create', compact('pembelians', 'suplier'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $id = request()->suplier_id;
            Kriteria::where('suplier_id', $id)->delete();

            for ($key = 0; $key < count($request->suplier_id); $key++) {
                $kriteria = new Kriteria();

                $kriteria->metode_pembayaran = $request['metode_pembayaran'][$key] ?: 0;
                $kriteria->kualitas = $request['kualitas'][$key] ?: 0;
                $kriteria->waktu_pengiriman = $request['waktu_pengiriman'][$key] ?: 0;
                $kriteria->harga_barang = $request['harga_barang'][$key] ?: 0;
                $kriteria->total_nilai = $request->total_nilai;
                $kriteria->suplier_id = $request['suplier_id'][$key] ?: 0;

                $kriteria->save();
                DB::commit();
            }

            session()->flash('success', 'Penilaian Berhasil Dibuat');
            return redirect()->route('evaluasi.index');
        } catch (\Exception $exception){
            DB::rollBack();
            session()->flash('failed', 'Penilaian gagal Dibuat');
            return redirect()->route('evaluasi.index');
        }

    }

    public function edit(Kriteria $kriteria, $id)
    {
        $jumlah = EvaluasiRepository::getJumlah($id);


        $pembelians = Pembeli::with('suplier.kriteria')->where('suplier_id', $id)->get();

        $suplier = Suplier::where('id', $id)->first();

        return view('dashboard.evaluasi.edit', compact('kriteria', 'pembelians', 'suplier', 'jumlah'));
    }

    public function update(Request $request)
    {
        return $request->id_kriteria;

        DB::beginTransaction();
        try {

            for ($key = 0; $key < count(request('suplier_id')); $key++) {
                $id = $request->id_kriteria[$key];
              $kriteria = Kriteria::where('id', $id);
                $kriteria->updateOrCreate(
                    [
                        'id' => $request->id_kriteria[$key]
                    ],
                    [
                        'suplier_id' => $request->suplier_id,
                        'metode_pembayaran' => $request->metode_pembayaran[$key],
                        'kualitas' => $request->kualitas[$key],
                        'waktu_pengiriman' => $request->waktu_pengiriman[$key],
                        'harga_barang' => $request->harga_barang[$key],
                        'total_nilai' => $request->total_nilai
                    ]);

            }
            DB::commit();
            session()->flash('success', 'Penilaian berhasil di update');
        } catch (\Exception $exception) {
            DB::rollBack();
            session()->flash('failed', 'Penilaian gagal di update');
        }

        return redirect()->route('evaluasi.index');

    }

    public function evaluasiNilai(Request $request)
    {

        DB::beginTransaction();
        try {
            for ($key = 0; $key < count(request('suplier_id')); $key++) {
                $kriteria = Kriteria::where('id', $request->id_kriteria[$key]);
                $kriteria->updateOrCreate(
                    [   'id' => $request->id_kriteria[$key] ?: 1,
                    ],
                    [
                        'metode_pembayaran' => $request->metode_pembayaran[$key],
                        'kualitas' => $request->kualitas[$key],
                        'suplier_id' =>$request->suplier_id[$key],
                        'waktu_pengiriman' => $request->waktu_pengiriman[$key],
                        'harga_barang' => $request->harga_barang[$key],
                        'total_nilai' => $request->total_nilai
                    ]);

            }
            DB::commit();
            session()->flash('success', 'Penilaian berhasil di update');
        } catch (\Exception $exception) {
            DB::rollBack();
            session()->flash('failed', 'Penilaian gagal di update');
        }

        return redirect()->route('evaluasi.index');
    }

}
