<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaGrupos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grupos', function (Blueprint $table) {
            $table->increments('id');
            $table->char('chave', 1);
            $table->integer('posicao')->unsigned();
            $table->integer('dupla_id')->unsigned();
            $table->integer('etapa_id')->unsigned();
            
            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete('cascade'); 
            $table->foreign('dupla_id')->references('id')->on('duplas')->onDelete('cascade');  
            
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grupos');
    }
}
