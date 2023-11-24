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
        Schema::create('contas_poupanca', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ID_Conta');
            $table->decimal('TaxaJuros', 5, 2)->default(0.00);
            $table->date('DataVencimento');
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
        Schema::dropIfExists('contas_poupanca');
    }
};
