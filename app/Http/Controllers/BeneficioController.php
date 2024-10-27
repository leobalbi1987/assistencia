<?php

// app/Http/Controllers/BeneficioController.php
namespace App\Http\Controllers;

use App\Models\Beneficio;
use App\Models\Beneficiario;
use Illuminate\Http\Request;

class BeneficioController extends Controller
{
    // Exibe a página de listagem
    public function index()
    {
        $beneficios = Beneficio::with('beneficiario')->paginate(10); // Paginação
        return view('beneficios.index', compact('beneficios'));
    }

    // Exibe o formulário de criação
    public function create()
    {
        $beneficiarios = Beneficiario::all(); // Assumindo que você já tem os beneficiários
        return view('beneficios.create', compact('beneficiarios'));
    }

    // Processa o formulário de criação e grava no banco
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'beneficiario_id' => 'required|exists:beneficiarios,id',
            'tipo' => 'required|string',
            'data_concessao' => 'required|date',
            'data_revisao' => 'nullable|date',
            'status' => 'required|string',
            'observacoes' => 'nullable|string',
        ]);

        Beneficio::create($validatedData); // Cria um novo benefício

        return redirect()->route('beneficios.index')->with('success', 'Benefício criado com sucesso!');
    }

    // Exibe o formulário de edição
    public function edit(Beneficio $beneficio)
    {
        $beneficiarios = Beneficiario::all();
        return view('beneficios.edit', compact('beneficio', 'beneficiarios'));
    }

    // Processa a edição e salva no banco
    public function update(Request $request, Beneficio $beneficio)
    {
        $validatedData = $request->validate([
            'beneficiario_id' => 'required|exists:beneficiarios,id',
            'tipo' => 'required|string',
            'data_concessao' => 'required|date',
            'data_revisao' => 'nullable|date',
            'status' => 'required|string',
            'observacoes' => 'nullable|string',
        ]);

        $beneficio->update($validatedData); // Atualiza o benefício

        return redirect()->route('beneficios.index')->with('success', 'Benefício atualizado com sucesso!');
    }

    // Exclui um benefício
    public function destroy(Beneficio $beneficio)
    {
        $beneficio->delete();

        return redirect()->route('beneficios.index')->with('success', 'Benefício excluído com sucesso!');
    }
}
