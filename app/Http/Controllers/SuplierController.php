<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSuplier;
use App\Models\Suplier;
use Illuminate\Http\Request;

class SuplierController extends Controller
{

    public function index()
    {
        $supliers = Suplier::all();

        return view('dashboard.suplier.index', compact('supliers'));
    }


    public function create()
    {
        return view('dashboard.suplier.create');
    }


    public function store(StoreSuplier $request)
    {
        $validate = $request->validated();

        Suplier::create($validate);

        session()->flash('success', 'Suplier Berhasil dibuat');

        return redirect()->route('suplier.index');
    }


    public function show(Suplier $suplier)
    {
        //
    }


    public function edit(Suplier $suplier)
    {

        return view('dashboard.suplier.edit', compact('suplier'));
    }

    public function update(StoreSuplier $request, Suplier $suplier)
    {
        $validate = $request->validated();

        $suplier->update($validate);

        session()->flash('success', 'Suplier Sukses diperbaruhi');

        return redirect()->route('suplier.index');
    }


    public function destroy(Suplier $suplier)
    {
        $suplier->delete();
        session()->flash('success', 'Suplier berhasil dihapus');

        return redirect()->route('suplier.index');
    }
}
