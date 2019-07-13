<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Pembeli;
use App\Models\Suplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Collection;
use PhpParser\Builder;
use App\Repositories\DashboardRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $datas = DashboardRepository::getDataKriteriaSuplier();

        $supliers = Suplier::with('kriteria')->get();

//        return $supliers;

        return view('dashboard.index', compact('datas', 'supliers'));
    }

    public function dashboard()
    {
        $supliers = DashboardRepository::getDataKriteriaSuplier();;

        return response()->json($supliers);
    }
}
