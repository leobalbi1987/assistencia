<?php

// app/Http/Controllers/RelatorioController.php
namespace App\Http\Controllers;

use App\Models\Servico; // Ou Atendimento, dependendo do seu modelo
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function atendimentos()
    {
        // Agrupa os serviços por mês e conta o total
        $servicosPorMes = Servico::selectRaw('MONTH(data_concessao) as mes, COUNT(*) as total')
            ->groupBy('mes')
            ->get();

        // Agrupa os serviços por status e conta o total
        $servicosPorStatus = Servico::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        return view('relatorios.atendimentos', compact('servicosPorMes', 'servicosPorStatus'));
    }
}
