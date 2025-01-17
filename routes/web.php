<?php

use App\Http\Controllers\BeneficiarioController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\BeneficioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RelatorioController;
use App\Http\Controllers\AtendimentoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
    
    // Rotas para Beneficiários
    Route::resource('beneficiarios', BeneficiarioController::class);
    Route::get('/beneficiarios', [BeneficiarioController::class, 'index'])->name('beneficiarios.index');
    
    // Rotas para Serviços
    Route::resource('servicos', ServicoController::class);
    Route::get('/servicos', [ServicoController::class, 'index'])->name('servicos.index');
    Route::get('/atendimentos', [AtendimentoController::class, 'index'])->name('relatorios.atencimentos');
    
    // Rotas para Benefícios
    Route::resource('beneficios', BeneficioController::class);
    Route::get('/beneficios', [BeneficioController::class, 'index'])->name('beneficios.index');
    
    // Rotas para Relatórios
    Route::get('/relatorios/atendimentos', [RelatorioController::class, 'atendimentos'])
        ->name('relatorios.atendimentos');
    Route::get('/relatorios/beneficios', [RelatorioController::class, 'beneficios'])
        ->name('relatorios.beneficios');
});


require __DIR__.'/auth.php';