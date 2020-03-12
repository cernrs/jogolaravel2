<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CriarTabelaUsersPontuacao extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_pontuacao', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('pontos');
            $table->integer('etapa_id')->unsigned();
            
            $table->foreign('etapa_id')->references('id')->on('etapas')->onDelete('cascade'); 
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  

        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_pontuacao');
    }
}
