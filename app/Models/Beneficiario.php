<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Beneficiario extends Model
{
    protected $fillable = [
        'nome',
        'cpf',
        'data_nascimento',
        'endereco',
        'telefone',
        'dados_familiares'
    ];

    public function beneficios(): HasMany
    {
        return $this->hasMany(Beneficio::class);
    }

    public function servicos(): HasMany
    {
        return $this->hasMany(ServicoAgendamento::class);
    }
}