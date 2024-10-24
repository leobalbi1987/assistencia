<?php

namespace App\Http\Controllers;

use App\Models\Beneficiario;
use Illuminate\Http\Request;

class BeneficiarioController extends Controller
{
    public function index()
    {
        $beneficiarios = Beneficiario::paginate(10);
        return view('beneficiarios.index', compact('beneficiarios'));
    }

    public function create()
    {
        return view('beneficiarios.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|unique:beneficiarios|size:11',
            'data_nascimento' => 'required|date',
            'endereco' => 'required|string',
            'telefone' => 'required|string',
            'dados_familiares' => 'nullable|string'
        ]);

        Beneficiario::create($validated);

        return redirect()->route('beneficiarios.index')
            ->with('success', 'Beneficiário cadastrado com sucesso.');
    }

    public function edit(Beneficiario $beneficiario)
    {
        return view('beneficiarios.edit', compact('beneficiario'));
    }

    public function update(Request $request, Beneficiario $beneficiario)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'cpf' => 'required|string|size:11|unique:beneficiarios,cpf,'.$beneficiario->id,
            'data_nascimento' => 'required|date',
            'endereco' => 'required|string',
            'telefone' => 'required|string',
            'dados_familiares' => 'nullable|string'
        ]);

        $beneficiario->update($validated);

        return redirect()->route('beneficiarios.index')
            ->with('success', 'Beneficiário atualizado com sucesso.');
    }

    public function destroy(Beneficiario $beneficiario)
    {
        $beneficiario->delete();

        return redirect()->route('beneficiarios.index')
            ->with('success', 'Beneficiário removido com sucesso.');
    }
}