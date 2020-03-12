<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\EtapasFormRequest;
use App\Http\Requests\EtapasInscricoesFormRequest;
use Illuminate\Http\Request;
use App\Etapa;
use App\User;
use App\Dupla;
use App\Partida;
use App\PartidaResultado;
use App\Grupo;


class EtapasController extends Controller
{
    public $request;
    public $etapas;

    public function __construct(Request $request,  Etapa $etapas)
    {
        //$this->middleware('auth');
        $this->request = $request;
        $this->etapas = $etapas;
        
    }
    public function index()
    {
        $oUser = Auth()->User();
        $sUri = $this->request->route()->uri;
        $sExplode = explode("/", $sUri);
        $sUriAtual = $sExplode[1];
        
        $aEtapas = DB::select('select * from etapas order by data desc');
        
        return view('admin.etapas.index', compact('oUser', 'sUriAtual', 'aEtapas'));
    }

    public function novo()
    {
        $oUser = Auth()->User();
        $sUri = $this->request->route()->uri;
        $sExplode = explode("/", $sUri);
        $sUriAtual = $sExplode[1];
        
        return view('admin.etapas.novo', compact('oUser', 'sUriAtual'));
    }
    
    public function gravar(EtapasFormRequest $request)
    {
        $aDados = $request->all();
        
        if(empty($aDados['inscricoes_abertas'])){
           $aDados['inscricoes_abertas'] = FALSE;
        }
        $aDados['etapa'] = $aDados['etapaCadastro']; 
        
        $bJaExiste = self::verificaMesJaExiste($aDados['data']);
        
        if($bJaExiste){
          return redirect()->route('admin.etapas.novo')->with(notification('error','Já existe uma etapa cadastrada neste mês !!!'));
        } 

        $bGravar = Etapa::create($aDados);
        
        if($bGravar){
            return redirect()->route('admin.etapas.index')->with(notification('success','Etapa cadastrada com sucesso !!!'));
        }

        return redirect()->route('admin.etapas.index')->with(notification('error', 'Falha ao gravar no banco de dados...'));
    }

    public function atualizar(Request $request, $id)
    {
        $oEtapa = Etapa::find($id);
        return view('admin.etapas.atualizar', compact('oEtapa'));
    }
    
    public function update(EtapasFormRequest $request, $id)
    {
        
        $oEtapa = Etapa::find($id);
        $aDados = $request->all();
        
        if(empty($aDados['inscricoes_abertas'])){
            $aDados['inscricoes_abertas'] = FALSE;
        }

        $aDados['etapa'] = $aDados['etapaCadastro']; 

        $bGravar = $oEtapa->update($aDados);
        
        if($bGravar){
            return redirect()->route('admin.etapas.index')->with(notification('success','Dados atualizado com sucesso !!!'));
        }

        return redirect()->back()->with(notification('error', 'Falha ao gravar no banco de dados...'));

    }

    public function destroy($id)
    {
        
        $oEtapa = Etapa::find($id);
        $delete = $oEtapa->delete();

        if($delete)
        {
            return redirect()->route('admin.etapas.index')->with(notification('success', 'Excluido com sucesso!'));
        }

        return redirect()->back()->with(notification('error', 'Falha ao excluir no banco de dados...'));
    }

    public function abreFechaInscricoes(Request $request)
    {
        $oEtapa = Etapa::find($request->etapa_id);
        $oEtapa->inscricoes_abertas = $request->inscricoes_abertas;
        $oEtapa->save();

        return redirect()->route('admin.etapas.index')->with(notification('success', 'Alterado com sucesso!'));
        //return response()->json(['success'=>'Status change successfully.']);

    }

    public function verificaMesJaExiste($sData)
    {
        $aExplodeData = explode("/",$sData);

        $existe = DB::table('etapas')
                    ->whereMonth('data', $aExplodeData[1])
                    ->whereYear('data', $aExplodeData[2])
                    ->get();
                
        if(count($existe) > 0){
            return true;
        }
        return false;
    }

    public function inscricao($idEtapa)
    {
        $oUser = Auth()->User();
        
        // Buscar no banco apenas usuarios que ainda nao estão inscritos pra carregar no combo da view
        $oJogadores1Inscritos = DB::table('duplas')
                            ->select('jogador1_id as id')
                            ->where('etapa_id', '=', $idEtapa);
        $oJogadores2Inscritos = DB::table('duplas')
                            ->select('jogador2_id as id')
                            ->where('etapa_id', '=', $idEtapa)
                            ->union($oJogadores1Inscritos)
                            ->get();

        $aUserInscritos = array();

        if(count($oJogadores2Inscritos) > 0){
            foreach ($oJogadores2Inscritos as $aJogadoresInscritos) {
                $aUserInscritos[] = $aJogadoresInscritos->id;
            }
        }
        
        $aUserInscritos[] = $oUser->id;

        $oJogadoresDisponiveis = DB::table('users')->whereNotIn('id', $aUserInscritos)->orderBy('name', 'asc')->pluck("name","id");
        // FIM Buscar no banco ... 
        
        
        return view('admin.etapas.inscricao', compact('oUser', 'oJogadoresDisponiveis', 'idEtapa'));
    }

    public function gravarInscricao(EtapasInscricoesFormRequest $request)
    {
        $aDados = $request->all();

        // verifica se já está inscrito
        $jogadorInscrito = self::verificaJogadorJaInscrito(Auth()->User()->id, $aDados['etapa_id'] );
        
        if($jogadorInscrito){
            return redirect()->route('admin.etapas.controle',$aDados['etapa_id'])->with(notification('error','Você já está inscrito para esta etapa. Sua DUPLA é: '.$jogadorInscrito[0]->jogadores));
        } 

        // ordena pelo nome pra ficar jogador1 e jogador2 ordem crescente pelo nome 
        $aDadosOrdenados = self::ordemAlfabetica($aDados);
        
        $aDados['jogador1_id'] = $aDadosOrdenados[array_key_first($aDadosOrdenados)]->id;
        $aDados['jogador2_id'] = $aDadosOrdenados[array_key_last($aDadosOrdenados)]->id;

        $bGravar = Dupla::create($aDados);
        
        if($bGravar){
            return redirect()->route('admin.etapas.index')->with(notification('success','Inscrição realizada com sucesso !!!'));
        }

        return redirect()->route('admin.etapas.index')->with(notification('error', 'Falha ao gravar no banco de dados...'));
    }

    public function controle($sIdEtapa)
    {
        
        $oUser = Auth()->User();
        $oInscritos = DB::table('duplas')
                    ->join('users AS u1', 'u1.id', '=', 'duplas.jogador1_id')
                    ->join('users AS u2', 'u2.id', '=', 'duplas.jogador2_id')
                    ->select("duplas.id","u1.name as jogador1","u1.image as imagem1","u2.name as jogador2","u2.image as imagem2")
                    ->where('duplas.etapa_id', '=', $sIdEtapa)
                    ->get();
        $oEtapa = Etapa::find($sIdEtapa);

        return view('admin.etapas.controle', compact('oUser', 'oInscritos', 'oEtapa'));
    }


    
    public function ordemAlfabetica($aDados)
    {
        
        // Recebe os dois jogadores
        $aJogadores = array();
        $aJogadores[] = $aDados['jogador2'];
        $aJogadores[] = Auth()->User()->id;
        
        // busca o nome no banco ordenado por ordem alfabetica crescente
        $oUsers = DB::table('users')
                    ->select('id','name')
                    ->whereIn('id', $aJogadores)
                    ->orderBy('name', 'asc')
                    ->get();
     
        $aJogadores = $oUsers->toArray();

        return $aJogadores;
                
    }


    public function verificaJogadorJaInscrito($sUsuarioLogado, $sIdEtapa)
    {
        
        $oExiste = DB::table('duplas')
                    ->join('users AS u1', 'u1.id', '=', 'duplas.jogador1_id')
                    ->join('users AS u2', 'u2.id', '=', 'duplas.jogador2_id')
                    ->select(DB::raw("u1.name||'/'||u2.name as jogadores"))
                    ->where('duplas.jogador1_id', '=', $sUsuarioLogado)
                    ->orWhere('duplas.jogador2_id', '=', $sUsuarioLogado)
                    ->where('duplas.etapa_id', '=', $sIdEtapa)
                    ->get();

        
        // Se existe retorna a consulta pra mostrar com quem já está inscrito
        if(count($oExiste) > 0){
            return $oExiste;
        }
        return false;
    }


    public function excluiInscricao($id)
    {
        
        $oDupla = Dupla::find($id);
        $delete = $oDupla->delete();

        if($delete)
        {
            return redirect()->route('admin.etapas.index')->with(notification('success', 'Excluido com sucesso!'));
        }

        return redirect()->back()->with(notification('error', 'Falha ao excluir no banco de dados...'));
    }


    public function geraPartidas($sIdEtapa){
        // -- verificar se tem alguem inscrito na etapa pra liberar o botao gerar

        $iGruposQnt = 4;
        $sIdEtapa = 1;
         
        // verifica se ja existe alguma etapa no ano 
        $bExisteEtapa = self::verificaEtapaAno();
        
        DB::beginTransaction();

        // se já existe faz os grupos conforme a soma da pontuação
        // senao existe, faz um sorteio para os grupos

        // das duplas
        if($bExisteEtapa){
            echo "Ja existe etapa";
        }else{
            
            // busca duplas aleatoriamente    
            $oDuplasInscritas = DB::table('duplas')
                                ->select('id')
                                ->where('etapa_id', '=', $sIdEtapa)
                                ->inRandomOrder()
                                ->get();
            
            // transforma pra array
            $aDuplasInscritas = $oDuplasInscritas->toArray();
            
            $chaves = array();
            $nome_grupos = array("A","B","C","D","E","F","G","H","I","J");
            $i = 0;    
            $iPosicao = 1;
            //define quem são os integrantes de cada grupo
            foreach ($aDuplasInscritas as $aDuplaGrupo) {

                $aDados['chave']    = $nome_grupos[$i];
                $aDados['posicao']  = $iPosicao;
                $aDados['dupla_id'] = $aDuplaGrupo->id;
                $aDados['etapa_id'] = $sIdEtapa;
                
                $bGravar = Grupo::create($aDados);

                $chaves[$nome_grupos[$i]][] = $aDuplaGrupo->id."/".$bGravar->id;    
        
                if(!$bGravar){
                    DB::rollBack();
                    return redirect()->route('admin.etapas.index')->with(notification('error', 'Falha ao gravar no banco de dados...'));
                }     
        
                if($i < $iGruposQnt-1 ){
                    $i++;
                }else{
                    $i=0;
                    $iPosicao++;
                }

            }
           
            //Grava as partidas (os confrontos)
            $aDados = array();  
            foreach ($chaves as $key => $duplas) {
                
                foreach($duplas as $indice => $dupla) {

                    for($i = $indice + 1; $i < count($duplas) ; $i++ )  { 
                        
                        $aDados['dupla1_id'] = substr($duplas[$indice],0,strrpos($duplas[$indice],"/"));
                        $aDados['dupla2_id'] = substr($duplas[$i],0,strrpos($duplas[$i],"/"));
                        $aDados['tipo'] = "C";
                        $aDados['grupo_id'] = substr($duplas[$indice],strrpos($duplas[$indice],"/")+1);
                        
                        $bGravar = Partida::create($aDados);
                        if(!$bGravar){
                            DB::rollBack();
                            return redirect()->route('admin.etapas.index')->with(notification('error', 'Falha ao gravar no banco de dados...'));
                        }                        
                    } 
                }    
            }
        }
        
        DB::commit();
        return redirect()->route('admin.etapas.confrontos', $sIdEtapa)->with(notification('success','confrontos criados com sucesso !!!'));
        
    }

    public function verificaEtapaAno()
    {
        $existe = DB::table('etapas')
                    ->join('grupos', 'etapas.id', '=', 'grupos.etapa_id')
                    ->whereYear('data', date('Y'))
                    ->get();
                
        if(count($existe) > 0){
            return true;
        }
        return false;
    }

    public function confrontos($sIdEtapa) 
    {
        
        $oUser = Auth()->User();
        $oPartidas = DB::select("  SELECT   p.id, g.chave, 
                                            g.posicao, 
                                            p.dupla1_id, 
                                            p.dupla2_id, 
                                            CONCAT(j1_d1.name,'/',j2_d1.name) as dupla1, 
                                            CONCAT(j1_d2.name,'/',j2_d2.name) as dupla2,
                                            pr.partida_id, 
                                            pr.dupla_id, 
                                            pr.pontos, 
                                            pr.vitoria


                                    FROM partidas p 

                                    INNER JOIN grupos g ON p.grupo_id = g.id 

                                    LEFT JOIN partidas_resultados pr ON p.id = pr.partida_id    

                                    INNER JOIN duplas d1 ON p.dupla1_id = d1.id 
                                    INNER JOIN users j1_d1 ON d1.jogador1_id = j1_d1.id 
                                    INNER JOIN users j2_d1 ON d1.jogador2_id = j2_d1.id

                                    INNER JOIN duplas d2 ON p.dupla2_id = d2.id 
                                    INNER JOIN users j1_d2 ON d2.jogador1_id = j1_d2.id 
                                    INNER JOIN users j2_d2 ON d2.jogador2_id = j2_d2.id

                                    WHERE g.etapa_id = {$sIdEtapa}

                                    ORDER BY g.chave ASC, g.posicao ASC  ");

        $oEtapa = Etapa::find($sIdEtapa);

        //$oPartidas = Partida::with('resultados')->get();
                    
        //dd($oPartidas);   
        return view('admin.etapas.confrontos', compact('oUser', 'oPartidas', 'oEtapa'));
    }


    public function confrontosUpdate(Request $request, $sIdEtapa)
    {
        $aDados = $request->all();
        for($i = 0 ; $i <= count($aDados['partida_id'])-1; $i++) {
            
            if(!empty($aDados['pontosDupla1'][$i]) && !empty($aDados['pontosDupla2'][$i])){

                $aResultadoPartidaDupla1['partida_id'] =  $aDados['partida_id'][$i];
                $aResultadoPartidaDupla1['dupla_id']   =  $aDados['dupla1_id'][$i];
                $aResultadoPartidaDupla1['pontos']     =  $aDados['pontosDupla1'][$i];

                $aResultadoPartidaDupla2['partida_id'] =  $aDados['partida_id'][$i];
                $aResultadoPartidaDupla2['dupla_id']   =  $aDados['dupla2_id'][$i];
                $aResultadoPartidaDupla2['pontos']     =  $aDados['pontosDupla2'][$i];

                if($aDados['pontosDupla1'][$i] > $aDados['pontosDupla2'][$i]){

                    $aResultadoPartidaDupla1['vitoria']    =  1;
                    $aResultadoPartidaDupla1['derrota']    =  0;
                    $aResultadoPartidaDupla2['vitoria']    =  0;
                    $aResultadoPartidaDupla2['derrota']    =  1;

                } else if($aDados['pontosDupla2'][$i] > $aDados['pontosDupla1'][$i]){

                    $aResultadoPartidaDupla1['vitoria']    =  0;
                    $aResultadoPartidaDupla1['derrota']    =  1;
                    $aResultadoPartidaDupla2['vitoria']    =  1;
                    $aResultadoPartidaDupla2['derrota']    =  0;

                } else {
                    continue;
                }

                //grava nno banco
                $bGravarResultadoDupla1 = PartidaResultado::create($aResultadoPartidaDupla1);
                $bGravarResultadoDupla2 = PartidaResultado::create($aResultadoPartidaDupla2);

            }
            
        }    
    
        return redirect()->route('admin.etapas.confrontos', $sIdEtapa)->with(notification('success','Resultados gravados com sucesso !!!'));

    }

}


