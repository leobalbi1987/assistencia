<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index()
{
    $servicos = Servico::paginate(10);

    // Definindo $servicosPorMes
    $servicosPorMes = Servico::selectRaw('DATE_FORMAT(data_hora, "%Y-%m") as mes, COUNT(*) as total')
        ->groupBy('mes')
        ->get();

    // Definindo $servicosPorStatus
    $servicosPorStatus = Servico::selectRaw('status, COUNT(*) as total')
        ->groupBy('status')
        ->get();

    // Passando todas as variáveis para a view
    return view('servicos.index', compact('servicos', 'servicosPorMes', 'servicosPorStatus'));
}

    public function create()
    {
        return view('servicos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'vagas' => 'required|integer|min:1',
            'data_hora' => 'required|date_format:Y-m-d\TH:i',
            'status' => 'required|in:agendado,em_andamento,concluido,cancelado'
        ]);

        Servico::create($validated);

        return redirect()->route('servicos.index')
            ->with('success', 'Serviço cadastrado com sucesso.');
    }

    public function show(Servico $servico)
    {
        return view('servicos.show', compact('servico'));
    }

    public function edit(Servico $servico)
    {
        return view('servicos.edit', compact('servico'));
    }

    public function update(Request $request, Servico $servico)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'vagas' => 'required|integer|min:1',
            'data_hora' => 'required|date_format:Y-m-d\TH:i',
            'status' => 'required|in:agendado,em_andamento,concluido,cancelado'
        ]);

        $servico->update($validated);

        return redirect()->route('servicos.index')
            ->with('success', 'Serviço atualizado com sucesso.');
    }

    public function destroy(Servico $servico)
    {
        $servico->delete();

        return redirect()->route('servicos.index')
            ->with('success', 'Serviço removido com sucesso.');
    }
}
