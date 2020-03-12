<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaPartidasResultados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas_resultados', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('partida_id')->unsigned();
            $table->integer('dupla_id')->unsigned();
            $table->integer('pontos')->unsigned();
            $table->integer('vitoria')->unsigned();
            $table->integer('derrota')->unsigned();
            $table->timestamps();
            
            $table->foreign('dupla_id')->references('id')->on('duplas')->onDelete('cascade');  
            $table->foreign('partida_id')->references('id')->on('partidas')->onDelete('cascade');  

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partidas_resultados');
    }
}
