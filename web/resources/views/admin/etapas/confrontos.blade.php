@extends('admin.layout.index')

@section('content')

  <div class="row">
    <div class="col-md-12">
     
     <div class="card card-primary">
       <form role="form" action="{{ route('admin.etapas.confrontosUpdate', $oEtapa->id ) }}" method="POST">
       {!! csrf_field() !!}
        <div class="card-header">
           <span class="card-title" style="display: block ruby;"><h2>{{ $oEtapa->etapa }}ª Etapa.</h2><h5>  &nbsp;{{ date('d', strtotime($oEtapa->data)) }} e {{ date('d', strtotime($oEtapa->data. ' + 1 days'))}} de {{ mesExtenso(date('m', strtotime($oEtapa->data))) }}  / {{ date('Y', strtotime($oEtapa->data)) }}</h5></span>
           <div style="margin-bottom: 10px; margin-right: 10px;">
                <button type="submit" class="btn-sm btn-success" style="margin-bottom: 10px; margin-right: 10px;"><span class="fa fa-editq"></span> Atualizar</button>
           </div>
        </div>
        <div class="card-body">
        @php 
          $sChave = '';
          $iClassificacao = 1; 
          $aCores = array('success', 'warning', 'primary', 'danger');
          $i = 0;
        @endphp
       
        @foreach ($oPartidas as $oPartida)

          @if ($sChave != '' && $oPartida->chave != $sChave)
                  </tbody>
                </table>
              </div>
            </div>
          @php 
            $iClassificacao = 1;
            $i++; 
          @endphp
          @endif 

          @if ($oPartida->chave != $sChave )
            <div class="card card-<?php echo $aCores[$i];?>">
              <div class="card-header">
                <span class="card-title" style="display: block ruby;">CHAVE {{$oPartida->chave}}</span>
              </div>
              <div class="card-body">
              <table id="example2"  orderBy= "2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
                <thead>
                  <tr role="row">
                    <th style="text-align: -moz-right;">Dupla 1</th>
                  
                    <th style="text-align: -moz-center;">X</th>
                  
                    <th style="text-align: -moz-left;">Dupla 2</th>
                  </tr>
                </thead>
                <tbody>
          @endif        
                 @if (empty($oPartida->partida_id))
                  <tr role="row" class="odd">
                    <td class="sorting_1" style="text-align: -moz-right;">
                        <input type="hidden" id="partida_id[]" value="{{ $oPartida->id }}" name="partida_id[]" >
                        <input type="hidden" id="dupla1_id[]" value="{{ $oPartida->dupla1_id }}" name="dupla1_id[]" >
                        {{ $oPartida->dupla1 }}<input class="form-control col-3" id="pontosDupla1[]" name="pontosDupla1[]" type="text">
                    </td>
                    <?php 
                    
                    
                   ?>
                    <td style="text-align: -moz-center;"> {{ $oPartida->partida_id }}</td>
                    <td style="text-align: -moz-left;">
                        <input type="hidden" id="dupla2_id[]" value="{{ $oPartida->dupla2_id }}" name="dupla2_id[]" >
                        {{ $oPartida->dupla2 }}<input class="form-control col-3" id="pontosDupla2[]" name="pontosDupla2[]" type="text">
                    </td>
                  </tr>
                 @endif 
          <!-- @php 
            $sChave = $oPartida->chave;
            $iClassificacao++;
          @endphp  -->
          @endforeach
                  </tbody>
                </table>
              </div>
            </div>
        </div>
          
      </div><!-- /.card-body -->
      </form>   
     </div><!-- /.card -->
    </div>
  </div>






@endsection

<!-- 
update partidas set pontos1 = 3585, pontos2=5955 where id = 1;
    update partidas set pontos1 = 4885, pontos2=5170 where id = 2;
    update partidas set pontos1 = 4785, pontos2=5125 where id = 3;
    update partidas set pontos1 = 3985, pontos2=5450 where id = 4;
    update partidas set pontos1 = 3485, pontos2=5075 where id = 5;
    update partidas set pontos1 = 6005, pontos2=5860 where id = 6;
    update partidas set pontos1 = 5385, pontos2=5240 where id = 7;
    update partidas set pontos1 = 3985, pontos2=5580 where id = 8;
    update partidas set pontos1 = 4585, pontos2=5280 where id = 9;
    update partidas set pontos1 = 5585, pontos2=4585 where id = 10;
    update partidas set pontos1 = 5535, pontos2=4250 where id = 11;
    update partidas set pontos1 = 5085, pontos2=5045 where id = 12;
    update partidas set pontos1 = 4985, pontos2=5035 where id = 13;
    update partidas set pontos1 = 5585, pontos2=5005 where id = 14;
    update partidas set pontos1 = 5985, pontos2=5540 where id = 15;
    update partidas set pontos1 = 4875, pontos2=5020 where id = 16;
    update partidas set pontos1 = 5210, pontos2=3180 where id = 17;
    update partidas set pontos1 = 5685, pontos2=2800 where id = 18;
    update partidas set pontos1 = 5325, pontos2=4950 where id = 19;
    update partidas set pontos1 = 5145, pontos2=4875 where id = 20;
    update partidas set pontos1 = 3780, pontos2=5080 where id = 21;
    update partidas set pontos1 = 4550, pontos2=5480 where id = 22;
    update partidas set pontos1 = 5435, pontos2=5245 where id = 23;
    update partidas set pontos1 = 5005, pontos2=5285 where id = 24;
    

    jogo=# select * from partidas;
 id | chave | dupla1_id | pontos1 | dupla2_id | pontos2 | etapa_id | created_at | updated_at
----+-------+-----------+---------+-----------+---------+----------+------------+------------
  1 | A     |        15 |    3585 |         4 |    5955 |        1 |            |
  2 | A     |        15 |    4885 |         9 |    5170 |        1 |            |
  3 | A     |        15 |    4785 |         3 |    5125 |        1 |            |
  4 | A     |         4 |    3985 |         9 |    5450 |        1 |            |
  5 | A     |         4 |    3485 |         3 |    5075 |        1 |            |
  6 | A     |         9 |    6005 |         3 |    5860 |        1 |            |
  7 | B     |        12 |    5385 |         1 |    5240 |        1 |            |
  8 | B     |        12 |    3985 |         5 |    5580 |        1 |            |
  9 | B     |        12 |    4585 |        14 |    5280 |        1 |            |
 10 | B     |         1 |    5585 |         5 |    4585 |        1 |            |
 11 | B     |         1 |    5535 |        14 |    4250 |        1 |            |
 12 | B     |         5 |    5085 |        14 |    5045 |        1 |            |
 13 | C     |         8 |    4985 |         7 |    5035 |        1 |            |
 14 | C     |         8 |    5585 |        10 |    5005 |        1 |            |
 15 | C     |         8 |    5985 |         6 |    5540 |        1 |            |
 16 | C     |         7 |    4875 |        10 |    5020 |        1 |            |
 17 | C     |         7 |    5210 |         6 |    3180 |        1 |            |
 18 | C     |        10 |    5685 |         6 |    2800 |        1 |            |
 19 | D     |        16 |    5325 |        13 |    4950 |        1 |            |
 20 | D     |        16 |    5145 |        11 |    4875 |        1 |            |
 21 | D     |        16 |    3780 |         2 |    5080 |        1 |            |
 22 | D     |        13 |    4550 |        11 |    5480 |        1 |            |
 23 | D     |        13 |    5435 |         2 |    5245 |        1 |            |
 24 | D     |        11 |    5005 |         2 |    5285 |        1 |            |
(24 registros)


SELECT      chave, 
            dupla,  
            count(dupla) as jogos,  
            sum(vitoria)as vitorias, 
            sum(pontos) as pontos         
        FROM (            
              (SELECT chave, 
                      CONCAT(j1.name,'/',j2.name) as dupla, 
                      pontos1 as pontos, 
                      CASE 
                        WHEN  pontos1 > pontos2 THEN 
                            1 
                        ELSE
                            0 
                        END as vitoria 
                    FROM partidas p 
                        INNER JOIN duplas d ON
                        p.dupla1_id = d.id 
                        
                        INNER JOIN users j1 ON
                        d.jogador1_id = j1.id 
                        
                        INNER JOIN users j2 ON
                        d.jogador2_id = j2.id
                    WHERE p.etapa_id = 1) 
               UNION 
               (SELECT chave, 
                      CONCAT(j1.name,'/',j2.name) as dupla, 
                      pontos2 as pontos, 
                      CASE 
                        WHEN  pontos1 > pontos2 THEN 
                            1 
                        ELSE
                            0 
                        END as vitoria 
                    FROM partidas p 
                        INNER JOIN duplas d ON
                        p.dupla2_id = d.id 
                        
                        INNER JOIN users j1 ON
                        d.jogador1_id = j1.id 
                        
                        INNER JOIN users j2 ON
                        d.jogador2_id = j2.id
                    WHERE p.etapa_id = 1)
        ) as apuracao
    GROUP BY dupla, chave 
    ORDER BY chave, vitorias DESC

  chave |          dupla          | jogos | vitorias | pontos
-------+-------------------------+-------+----------+--------
 A     | Carlos Eduardo/PatrÝcia |     3 |        3 |  16625
 A     | Giza/Rita               |     3 |        2 |  16060
 A     | Airton/Regina           |     3 |        1 |  13425
 A     | Jussarinha/Marilene     |     3 |        0 |  13255
 B     | Ana Alice/Tininha       |     3 |        2 |  15250
 B     | Wilda/Rose              |     3 |        2 |  16360
 B     | Lenir/Maria do Carmo    |     3 |        1 |  13955
 B     | TÔnia/Varlete           |     3 |        1 |  14575
 C     | Juracy/Roseane          |     3 |        2 |  15120
 C     | Ana Maria G./Maria Ines |     3 |        2 |  16555
 C     | Helaine/Marlene         |     3 |        2 |  15710
 C     | Genecy/Lena             |     3 |        0 |  11520
 D     | Paula/Roberta           |     3 |        2 |  14250
 D     | HeloÝsa/Paulo           |     3 |        2 |  15610
 D     | Diva/Loka               |     3 |        1 |  15360
 D     | Chuca/Danilo            |     3 |        1 |  14935
(16 registros)



grupos

id chave numero iddupla id etapa
1    A     1      17      1
2    A     2      20      1
3    A     3      05      1
4    A     4      15      1
5    B     1      17      1
6    B     2      20      1
7    B     3      05      1
8    B     4      15      1


partidas
id  dupla1 dupla2    
1    17     20
2    05     15


partidas resultados
id  dupla  pontos  vitoria derrota
1     17    5000      1	
2     20    4500              1




insert into partidas_resultados (partida_id, dupla_id, pontos, vitoria, derrota) values(25 , 1, 5050, 1, 0 );
insert into partidas_resultados (partida_id, dupla_id, pontos, vitoria, derrota) values(25 , 6, 4300, 0, 1 );

insert into partidas_resultados (partida_id, dupla_id, pontos, vitoria, derrota) values(26 , 1, 5050, 1, 0 );
insert into partidas_resultados (partida_id, dupla_id, pontos, vitoria, derrota) values(26 , 13, 2800, 0, 1 );

insert into partidas_resultados (partida_id, dupla_id, pontos, vitoria, derrota) values(27 , 1, 4300, 0, 1 );
insert into partidas_resultados (partida_id, dupla_id, pontos, vitoria, derrota) values(27 , 12, 5320, 1, 0 );

insert into partidas_resultados (partida_id, dupla_id, pontos, vitoria, derrota) values(28 , 6, 5340, 1, 0 );
insert into partidas_resultados (partida_id, dupla_id, pontos, vitoria, derrota) values(28 , 13, 2500, 0, 1 );

insert into partidas_resultados (partida_id, dupla_id, pontos, vitoria, derrota) values(29 , 6, 4200, 0, 1 );
insert into partidas_resultados (partida_id, dupla_id, pontos, vitoria, derrota) values(29 , 12, 5600, 1, 0 );

insert into partidas_resultados (partida_id, dupla_id, pontos, vitoria, derrota) values(30 , 13, 5550, 1, 0 );
insert into partidas_resultados (partida_id, dupla_id, pontos, vitoria, derrota) values(30 , 12, 4800, 0, 1 );

insert into partidas_resultados (partida_id, dupla_id, pontos, vitoria, derrota) values(31 , 9, 5550, 1, 0 );
insert into partidas_resultados (partida_id, dupla_id, pontos, vitoria, derrota) values(31 , 8, 4800, 0, 1 );

 25 |         1 |         6 |       17 | C    |            |
 26 |         1 |        13 |       17 | C    |            |
 27 |         1 |        12 |       17 | C    |            |
 28 |         6 |        13 |       21 | C    |            |
 29 |         6 |        12 |       21 | C    |            |
 30 |        13 |        12 |       25 | C    |            |
 31 |         9 |         8 |       18 | C    |            |
 32 |         9 |         2 |       18 | C    |            |
 33 |         9 |        10 |       18 | C    |            |
 34 |         8 |         2 |       22 | C    |            |
 35 |         8 |        10 |       22 | C    |            |
 36 |         2 |        10 |       26 | C    |            |
 37 |         4 |        11 |       19 | C    |            |
 38 |         4 |         5 |       19 | C    |            |
 39 |         4 |        16 |       19 | C    |            |
 40 |        11 |         5 |       23 | C    |            |
 41 |        11 |        16 |       23 | C    |            |
 42 |         5 |        16 |       27 | C    |            |
 43 |        14 |         3 |       20 | C    |            |
 44 |        14 |         7 |       20 | C    |            |
 45 |        14 |        15 |       20 | C    |            |
 46 |         3 |         7 |       24 | C    |            |
 47 |         3 |        15 |       24 | C    |            |
 48 |         7 |        15 |       28 | C    |            |         -->