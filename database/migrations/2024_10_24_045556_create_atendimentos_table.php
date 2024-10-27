<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAtendimentosTable extends Migration
{
    public function up()
    {
        Schema::create('atendimentos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('beneficiario_id');
            $table->string('tipo');
            $table->date('data_concessao')->nullable();
            $table->date('data_revisao')->nullable();
            $table->string('status');
            $table->text('observacoes')->nullable();
            $table->timestamps();

            // Chave estrangeira
            $table->foreign('beneficiario_id')->references('id')->on('beneficiarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('atendimentos');
    }
}
