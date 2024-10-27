<?php

namespace App\Models;
use Carbon\Carbon;

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

    public function getDataNascimentoAttribute($value)
    {
        return Carbon::parse($value);
    }
    public function parent()
    {
        return $this->belongsTo(Beneficiario::class, 'parent_id'); // Alterar para o nome do campo correto se existir
    }

}