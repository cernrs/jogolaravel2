<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaPartidas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partidas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dupla1_id')->unsigned();
            $table->integer('dupla2_id')->unsigned();
            $table->integer('grupo_id')->unsigned();
            $table->char('tipo', 1);
            
            $table->foreign('grupo_id')->references('id')->on('grupos')->onDelete('cascade'); 
            $table->foreign('dupla2_id')->references('id')->on('duplas')->onDelete('cascade');  
            $table->foreign('dupla1_id')->references('id')->on('duplas')->onDelete('cascade');  

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('partidas');
    }
}
