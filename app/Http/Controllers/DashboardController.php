<?php

namespace App\Http\Controllers;

use App\Models\Astronauta;
use App\Models\Corpo;
use App\Models\Missao;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Painel administrativo — visão geral do sistema.
     */
    public function index()
    {
        $admin = Auth::user();

        $totalAstronautas = Astronauta::count();
        $totalCorpos      = Corpo::count();
        $totalMissoes     = Missao::count();
        $totalUsuarios    = User::count();

        $missoesPorStatus = Missao::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $astronautasPorStatus = Astronauta::selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $corposPorTipo = Corpo::selectRaw('tipo, count(*) as total')
            ->groupBy('tipo')
            ->pluck('total', 'tipo');

        $missoesRecentes = Missao::with('corpo')
            ->latest('data_lancamento')
            ->take(5)
            ->get();

        $astronautasRecentes = Astronauta::latest()
            ->take(5)
            ->get();

        $usuariosRecentes = User::latest()
            ->take(5)
            ->get();

        return view('dashboard', [
            'admin'                => $admin,
            'totalAstronautas'     => $totalAstronautas,
            'totalCorpos'          => $totalCorpos,
            'totalMissoes'         => $totalMissoes,
            'totalUsuarios'        => $totalUsuarios,
            'missoesPorStatus'     => $missoesPorStatus,
            'astronautasPorStatus' => $astronautasPorStatus,
            'corposPorTipo'        => $corposPorTipo,
            'missoesRecentes'      => $missoesRecentes,
            'astronautasRecentes'  => $astronautasRecentes,
            'usuariosRecentes'     => $usuariosRecentes,
        ]);
    }
}
