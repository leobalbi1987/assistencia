<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beneficios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('beneficiario_id')->constrained()->onDelete('cascade');
            $table->string('tipo');
            $table->date('data_concessao');
            $table->date('data_revisao');
            $table->string('status');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beneficios');
    }
};