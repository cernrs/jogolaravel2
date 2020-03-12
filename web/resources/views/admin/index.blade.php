@extends('admin.layout.index')

@section('content')
<div class="row">
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        @inject('usuarios', 'App\User')
        <h3>{{ $usuarios->count()}}</h3>
        <p>Usuário</p>
      </div>
      <div class="icon">
        <i class="fa fa-users"></i>
      </div>
      <a href="{{ route('admin.usuarios.index') }}" class="small-box-footer">Admnistrar <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        @inject('usuarios', 'App\User')
        <h3>{{ $usuarios->count()}}</h3>
        <p>Usuário</p>
      </div>
      <div class="icon">
        <i class="fa fa-users"></i>
      </div>
      <a href="{{ route('admin.usuarios.index') }}" class="small-box-footer">Admnistrar <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  <div class="col-lg-3 col-6">
    <!-- small box -->
    <div class="small-box bg-info">
      <div class="inner">
        @inject('usuarios', 'App\User')
        <h3>{{ $usuarios->count()}}</h3>
        <p>Usuário</p>
      </div>
      <div class="icon">
        <i class="fa fa-users"></i>
      </div>
      <a href="{{ route('admin.usuarios.index') }}" class="small-box-footer">Admnistrar <i class="fas fa-arrow-circle-right"></i></a>
    </div>
  </div>
  
  
  @if($aEtapa)
  <div class="col-lg-3 col-6">
    <!-- small box -->
    @if( $aEtapa[0]->inscricoes_abertas )
    <div class="small-box bg-success">
    @else
    <div class="small-box bg-danger">
    @endif
      <div class="inner">
        <h3>{{ $aEtapa[0]->etapa }}ª Etapa</h3>
        <p>{{ date('d', strtotime($aEtapa[0]->data)) }} e {{ date('d', strtotime($aEtapa[0]->data. ' + 1 days'))}} de {{ mesExtenso(date('m', strtotime($aEtapa[0]->data))) }}  / {{ date('Y', strtotime($aEtapa[0]->data)) }}</p>
      </div>
      <div class="icon">  
        <i class="fa fa-trophy">
      </i>
      </div>
      @if( $aEtapa[0]->inscricoes_abertas )
        <a href="{{ route('admin.etapas.inscricao', $aEtapa[0]->id) }}" class="small-box-footer">Inscrições Abertas <i class="fas fa-arrow-circle-right"></i></a>
      @else
        <a href="#" class="small-box-footer">Inscrições Encerradas <i class="fas fa-arrow-circle-right"></i></a>
      @endif
    </div>
  </div>
  @endif 

</div> 
@endsection