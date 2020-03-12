<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaDuplas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('duplas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('jogador1_id')->unsigned();
            $table->integer('jogador2_id')->unsigned();
            $table->integer('etapa_id')->unsigned();
            
            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete('cascade'); 
            $table->foreign('jogador2_id')->references('id')->on('users')->onDelete('cascade');  
            $table->foreign('jogador1_id')->references('id')->on('users')->onDelete('cascade');  

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('duplas');
    }
}
