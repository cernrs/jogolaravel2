@extends('admin.layout.index')

@section('content')

  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
     <!-- general form elements -->
     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Usuários Cadastrados</h3>
        </div>
          <!-- /.card-header -->
          <div class="card-body">
         @can("jogador_add")
          <form role="form" action="{{ route('admin.usuarios.novo') }}" method="GET">
            <button type="submit" class="btn-sm btn-primary" style="margin-bottom: 10px;"><span class="fa fa-plus"></span> Novo</button>
          </form>
          @endcan    
            <table id="dataTable" orderBy= "2" class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Foto</th>
                  <th>Nome</th>
                  <th>Celular</th>
                  <th>Email</th>
                  <th>Ação</th>
                </tr>
                </thead>
                <tbody> 
                @canany(['jogador_view'])
                @foreach($usuarios as $usuario)
                
                    <tr>
                    <td>{{ $usuario->id }}</td>
                    <td>
                      <div class="user-panel">
                        <div class="image">
                          @if($usuario->image)
                             <img src="{{ asset('storage/users/'.$usuario->image) }}" class="img-circle elevation-2">
                          @else
                             <img src="{{ asset('img/noPhoto.png') }}" class="img-circle elevation-2">
                          @endif
                        </div>  
                      </div>
                    </td>
                    <td>{{ $usuario->name }}</td>
                    <td>{{ $usuario->cel }}</td>
                    <td>{{ $usuario->email }}</td>
                    <td>
                        <?php if(Auth()->User()->id == $usuario->id || Auth()->User()->can('Root')) { ?>
                        @can('jogador_edit')
                          <a class="btn btn-sm btn-warning" href="{{ route('admin.usuarios.atualizar', $usuario->id) }}"><i class="fas fa-edit" style="color:white"></i></a>
                        @endcan
                        @can('jogador_delete')
                        <a class="btn btn-sm btn-danger"  href="{{ route('admin.usuarios.deleta', $usuario->id) }}" data-confirm="teste"><i class="fas fa-trash" style="color:white"></i></a>
                        @endcan  
                        <?php } ?>
                    </td>
                    </tr>
                    
                @endforeach
                @endcan 
                </tbody>
                
              </table>
              
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

@endsection