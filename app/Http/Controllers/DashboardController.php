<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use App\Models\Servico;
use App\Models\Beneficio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Estatísticas gerais
        $totalBeneficiarios = Beneficiario::count();
        $novosBeneficiariosMes = Beneficiario::whereMonth('created_at', now()->month)->count();
        
        $servicosAtivos = Servico::where('status', 'agendado')->count();
        $servicosHoje = Servico::whereDate('data_hora', today())->count();
        
        $beneficiosAtivos = Beneficio::where('status', 'ativo')->count();
        $beneficiosRevisaoMes = Beneficio::whereMonth('data_revisao', now()->month)->count();
        
        $atendimentosMes = Servico::whereMonth('data_hora', now()->month)
            ->where('status', 'concluido')
            ->count();
            
        // Cálculo do crescimento de atendimentos
        $atendimentosMesAnterior = Servico::whereMonth('data_hora', now()->subMonth()->month)
            ->where('status', 'concluido')
            ->count();
            
        $crescimentoAtendimentos = $atendimentosMesAnterior > 0
            ? round((($atendimentosMes - $atendimentosMesAnterior) / $atendimentosMesAnterior) * 100)
            : 0;

        // Dados para o gráfico de atendimentos
        $atendimentosUltimos6Meses = Servico::select(
            DB::raw('MONTH(data_hora) as mes'),
            DB::raw('COUNT(*) as total')
        )
            ->where('data_hora', '>=', now()->subMonths(6))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        $atendimentosLabels = $atendimentosUltimos6Meses->map(function ($item) {
            return Carbon::create()->month($item->mes)->format('F');
        });
        
        $atendimentosDados = $atendimentosUltimos6Meses->pluck('total');

        // Dados para o gráfico de benefícios
        $beneficiosPorTipo = Beneficio::select('tipo', DB::raw('COUNT(*) as total'))
            ->groupBy('tipo')
            ->get();

        $beneficiosLabels = $beneficiosPorTipo->pluck('tipo');
        $beneficiosDados = $beneficiosPorTipo->pluck('total');

        // Próximos atendimentos
        $proximosAtendimentos = Servico::with('beneficiario')
            ->where('data_hora', '>=', now())
            ->where('status', 'agendado')
            ->orderBy('data_hora')
            ->limit(5)
            ->get();

        return view('dashboard.index', compact(
            'totalBeneficiarios',
            'novosBeneficiariosMes',
            'servicosAtivos',
            'servicosHoje',
            'beneficiosAtivos',
            'beneficiosRevisaoMes',
            'atendimentosMes',
            'crescimentoAtendimentos',
            'atendimentosLabels',
            'atendimentosDados',
            'beneficiosLabels',
            'beneficiosDados',
            'proximosAtendimentos'
        ));
    }
}