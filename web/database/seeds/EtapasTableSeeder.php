<?php

use Illuminate\Database\Seeder;
use App\Etapa;

class EtapasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        // Etapa::create(['data' => '2019-04-08', 'inscricoes_abertas' => 'f', 'etapa' => '1']);
        // Etapa::create(['data' => '2019-05-06', 'inscricoes_abertas' => 'f', 'etapa' => '2']);
        // Etapa::create(['data' => '2019-06-03', 'inscricoes_abertas' => 'f', 'etapa' => '3']);
        // Etapa::create(['data' => '2019-07-08', 'inscricoes_abertas' => 'f', 'etapa' => '4']);
        // Etapa::create(['data' => '2019-08-05', 'inscricoes_abertas' => 'f', 'etapa' => '5']);      
        // Etapa::create(['data' => '2019-09-02', 'inscricoes_abertas' => 'f', 'etapa' => '6']);
        // Etapa::create(['data' => '2019-10-07', 'inscricoes_abertas' => 'f', 'etapa' => '7']);
        Etapa::create(['data' => '2019-11-04', 'inscricoes_abertas' => 't', 'etapa' => '1']);
        
    }
}
