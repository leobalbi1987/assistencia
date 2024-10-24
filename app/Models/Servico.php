<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servico extends Model
{
    protected $fillable = [
        'nome',
        'descricao',
        'vagas',
        'data_hora',
        'status'
    ];
    protected $casts = [
        'data_hora' => 'datetime',  // Isto garante que o campo será tratado como uma instância de Carbon
    ];

    public function agendamentos(): HasMany
    {
        return $this->hasMany(ServicoAgendamento::class);
    }
}