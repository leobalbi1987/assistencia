<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Beneficio extends Model
{
    protected $fillable = [
        'beneficiario_id',
        'tipo',
        'data_concessao',
        'data_revisao',
        'status',
        'observacoes'
    ];

    public function beneficiario(): BelongsTo
    {
        return $this->belongsTo(Beneficiario::class);
    }
}