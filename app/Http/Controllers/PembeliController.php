<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePembelian;
use App\Models\Kriteria;
use App\Models\Pembeli;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class PembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pembelis = Pembeli::all();

        return view('dashboard.divisi.pembeli.index', compact('pembelis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $supliers = Suplier::all();

        return view('dashboard.divisi.pembeli.create', compact('supliers'));
    }


    public function store(StorePembelian $request)
    {

        $validated = $request->validated();
        $datas = $request->get('nama_barang');

        $input = Input::all();
        foreach ($datas as $key => $value){
            $validated['tgl_pembelian'] = $input['tgl_pembelian'];
            $validated['no_sop'] = $input['no_sop'];
            $validated['suplier_id'] = $input['suplier_id'];
            $validated['nama_barang'] = $input['nama_barang'][$key];
            $validated['jumlah'] = $input['jumlah'][$key];
            $validated['satuan'] = $input['satuan'][$key];
            $validated['harga'] = $input['harga'][$key];
            Pembeli::create($validated);
        }



        session()->flash('success', 'Pembelian Sukses Dibuat');

        return redirect()->route('pembeli.index');

    }


    public function show($id)
    {

    }

    public function edit(Pembeli $pembeli)
    {
        $supliers = Suplier::all();
        return view('dashboard.divisi.pembeli.edit', compact('pembeli', 'supliers'));
    }

    public function update(StorePembelian $request, Pembeli $pembeli)
    {
        $validate = $request->validated();
        $pembeli->update($validate);

        session()->flash('success', 'Update Barang pembelian sukses');
        return redirect()->route('pembeli.index');
    }


    public function destroy($id)
    {
        try {
             Pembeli::where('id', $id)->delete();
            session()->flash('success', 'Hapus User sukses');
            return redirect()->route('pembeli.index');
        } catch (\Exception $exception){

            session()->flash('failed', 'Hapus User Gagal');
            return redirect()->route('pembeli.index');
        }
    }
}
