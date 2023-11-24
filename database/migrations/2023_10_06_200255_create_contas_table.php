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
        Schema::create('contas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_Cliente');
            $table->string('TipoConta', 50);
            $table->decimal('Saldo', 10, 2)->default(0.00);
            $table->timestamps();
            $table-> primary('id');
            $table->foreign('ID_Cliente')->references('id')->on('clientes'); 
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contas');
    }
};
