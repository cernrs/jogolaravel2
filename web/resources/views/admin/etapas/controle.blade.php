@extends('admin.layout.index')

@section('content')

  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
     <!-- general form elements -->
     <div class="card card-primary">
        <div class="card-header">
         <span class="card-title" style="display: block ruby;"><h2>{{ $oEtapa->etapa }}ª Etapa.</h2><h5>  &nbsp;{{ date('d', strtotime($oEtapa->data)) }} e {{ date('d', strtotime($oEtapa->data. ' + 1 days'))}} de {{ mesExtenso(date('m', strtotime($oEtapa->data))) }}  / {{ date('Y', strtotime($oEtapa->data)) }}
        </h5></span>
        </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div style="display: flex;"> 
              <form role="form" action="{{ route('admin.etapas.inscricao', $oEtapa->id ) }}" method="GET">
                <button type="submit" class="btn-sm btn-primary" style="margin-bottom: 10px; margin-right: 10px;"><span class="fa fa-plus"></span> Nova Inscrição</button>
              </form>
             @can('edit_etapa')
              <form role="form" action="{{ route('admin.etapas.geraPartidas', $oEtapa->id ) }}" method="GET">
                <button type="submit" class="btn-sm btn-info" style="margin-bottom: 10px;">Gerar Grupos</button>
              </form>
            @endcan
            </div>
              <table id="dataTable" class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                  <th>Dupla</th>
                  <th>Nomes</th>
                  <th>Ação</th>
                </tr>
                </thead>
                <tbody> 
                
                @foreach($oInscritos as $dupla)
                    <tr>
                    <td>
                      <div class="user-panel">
                        <div class="image">
                            @if($dupla->imagem1)
                                <img src="{{ asset('storage/users/'.$dupla->imagem1) }}" class="img-circle elevation-2">
                            @else
                                <img src="{{ asset('img/noPhoto.png') }}" class="img-circle elevation-2">
                            @endif
                            @if($dupla->imagem2)
                                <img src="{{ asset('storage/users/'.$dupla->imagem2) }}" class="img-circle elevation-2">
                            @else
                                <img src="{{ asset('img/noPhoto.png') }}" class="img-circle elevation-2">
                            @endif
                        </div>
                      </div>
                     
                    </td>
                    <td>{{ $dupla->jogador1 }} /  {{ $dupla->jogador2 }}</td>
                    <td>
                    @can('delete_etapa')
                            <a class="btn btn-sm btn-danger"  href="{{ route('admin.etapas.excluiInscricao', $dupla->id) }}" data-confirm="teste"><i class="fas fa-trash" style="color:white"></i></a>
                    @endcan        
                    </td>
                    </tr>
                @endforeach
                </tbody>
                
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>



@endsection