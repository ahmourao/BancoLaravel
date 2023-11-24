<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableClientesForConta extends Migration
{
    public function up()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->unsignedBigInteger('ID_Conta')->nullable();
            $table->foreign('ID_Conta')->references('id')->on('contas');
        });
    }

    public function down()
    {
        Schema::table('clientes', function (Blueprint $table) {
            $table->dropForeign(['ID_Conta']);
            $table->dropColumn('ID_Conta');
        });
    }
}
