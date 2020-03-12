<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaEtapas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('etapas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('data');
            $table->boolean('inscricoes_abertas');
            $table->integer('etapa')->nullable();;
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('etapas');
    }
}
