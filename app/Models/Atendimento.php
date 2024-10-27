<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    protected $fillable = ['beneficiario_id', 'tipo', 'data_concessao', 'data_revisao', 'status', 'observacoes'];
}
