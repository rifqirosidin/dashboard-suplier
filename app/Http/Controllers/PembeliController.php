<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePembelian;
use App\Models\Pembeli;
use App\Models\Suplier;
use Illuminate\Http\Request;

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

        Pembeli::create($validated);

        session()->flash('success', 'Pembelian Sukses Dibuat');

        return redirect()->back();

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
        //
    }
}
