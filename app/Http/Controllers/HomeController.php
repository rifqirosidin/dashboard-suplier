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
use function PHPSTORM_META\map;

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

        $kriterias = Pembeli::with('suplier.kriteria')->whereHas('suplier')
            ->orderBy('created_at', 'desc')
            ->groupBy('suplier_id')
            ->get();


        return view('dashboard.index', compact('datas', 'kriterias'));
    }

    public function dashboard()
    {
        $kriterias = Pembeli::with('suplier.kriteria')->whereHas('suplier')
            ->orderBy('created_at', 'desc')
            ->groupBy('suplier_id')
            ->get();

        return response()->json($kriterias);
    }
}
