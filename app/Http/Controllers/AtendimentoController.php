<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Beneficiario; // Certifique-se de importar o modelo de Beneficiário
use Illuminate\Http\Request;

class AtendimentoController extends Controller
{
    // Exibir a lista de atendimentos
    public function index()
    {
        $atendimentos = Atendimento::with('beneficiario')->get(); // Carregar os dados relacionados
        $totalAtendimentos = Atendimento::count();
        $atendimentosPorStatus = Atendimento::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('atendimentos.index', compact('totalAtendimentos', 'atendimentosPorStatus', 'atendimentos'));
    }

    // Gerar relatório de atendimentos
    public function gerarRelatorio()
    {
        $atendimentos = Atendimento::with('beneficiario')->get(); // Carregar os dados
        return view('relatorios.atendimentos', compact('atendimentos'));
    }

    // Mostrar o formulário para criar um novo atendimento
    public function create()
    {
        $beneficiarios = Beneficiario::all(); // Obter todos os beneficiários
        return view('atendimentos.create', compact('beneficiarios'));
    }

    // Armazenar um novo atendimento
    public function store(Request $request)
    {
        $request->validate([
            'beneficiario_id' => 'required|exists:beneficiarios,id',
            'tipo' => 'required|string|max:255',
            'data_concessao' => 'nullable|date',
            'data_revisao' => 'nullable|date',
            'status' => 'required|string|max:255',
            'observacoes' => 'nullable|string',
        ]);

        Atendimento::create($request->all()); // Criar o atendimento

        return redirect()->route('atendimentos.index')->with('success', 'Atendimento criado com sucesso.');
    }

    // Exibir um atendimento específico
    public function show(Atendimento $atendimento)
    {
        return view('atendimentos.show', compact('atendimento'));
    }

    // Mostrar o formulário para editar um atendimento
    public function edit(Atendimento $atendimento)
    {
        $beneficiarios = Beneficiario::all(); // Obter todos os beneficiários
        return view('atendimentos.edit', compact('atendimento', 'beneficiarios'));
    }

    // Atualizar um atendimento existente
    public function update(Request $request, Atendimento $atendimento)
    {
        $request->validate([
            'beneficiario_id' => 'required|exists:beneficiarios,id',
            'tipo' => 'required|string|max:255',
            'data_concessao' => 'nullable|date',
            'data_revisao' => 'nullable|date',
            'status' => 'required|string|max:255',
            'observacoes' => 'nullable|string',
        ]);

        $atendimento->update($request->all()); // Atualiza o atendimento

        return redirect()->route('atendimentos.index')->with('success', 'Atendimento atualizado com sucesso.');
    }

    // Remover um atendimento
    public function destroy(Atendimento $atendimento)
    {
        $atendimento->delete(); // Exclui o atendimento

        return redirect()->route('atendimentos.index')->with('success', 'Atendimento excluído com sucesso.');
    }
}
