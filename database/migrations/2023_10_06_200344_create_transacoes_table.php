<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_Conta');
            $table->string('TipoTransacao', 50);
            $table->decimal('Valor', 10, 2);
            $table->datetime('DataTransacao');
            $table->timestamps();
    
            $table->foreign('ID_Conta')->references('id')->on('contas');
            $table-> primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacoes');
    }
};
