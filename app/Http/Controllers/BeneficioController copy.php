<?php

namespace App\Http\Controllers;

use App\Models\Beneficio;
use App\Models\Beneficiario;
use Illuminate\Http\Request;

class BeneficioController extends Controller
{
    public function index()
    {
        $beneficios = Beneficio::with('beneficiario')->paginate(10);
        return view('beneficios.index', compact('beneficios'));
    }

    public function create()
    {
        $beneficiarios = Beneficiario::all();
        return view('beneficios.create', compact('beneficiarios'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'beneficiario_id' => 'required|exists:beneficiarios,id',
            'tipo' => 'required|string|max:255',
            'data_concessao' => 'required|date',
            'data_revisao' => 'required|date|after:data_concessao',
            'status' => 'required|in:ativo,suspenso,cancelado',
            'observacoes' => 'nullable|string'
        ]);

        Beneficio::create($validated);

        return redirect()->route('beneficios.index')
            ->with('success', 'Benefício cadastrado com sucesso.');
    }

    public function show(Beneficio $beneficio)
    {
        return view('beneficios.show', compact('beneficio'));
    }

    public function edit(Beneficio $beneficio)
    {
        $beneficiarios = Beneficiario::all();
        return view('beneficios.edit', compact('beneficio', 'beneficiarios'));
    }

    public function update(Request $request, Beneficio $beneficio)
    {
        $validated = $request->validate([
            'beneficiario_id' => 'required|exists:beneficiarios,id',
            'tipo' => 'required|string|max:255',
            'data_concessao' => 'required|date',
            'data_revisao' => 'required|date|after:data_concessao',
            'status' => 'required|in:ativo,suspenso,cancelado',
            'observacoes' => 'nullable|string'
        ]);

        $beneficio->update($validated);

        return redirect()->route('beneficios.index')
            ->with('success', 'Benefício atualizado com sucesso.');
    }

    public function destroy(Beneficio $beneficio)
    {
        $beneficio->delete();

        return redirect()->route('beneficios.index')
            ->with('success', 'Benefício removido com sucesso.');
    }
}

