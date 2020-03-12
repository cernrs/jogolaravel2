@extends('admin.layout.index')

@section('content')

  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
     <!-- general form elements -->
     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Perfis Cadastrados</h3>
        </div>
          <!-- /.card-header -->
          <div class="card-body">
          <form role="form" action="{{ route('admin.roles.novo') }}" method="GET">
            <button type="submit" class="btn-sm btn-primary" style="margin-bottom: 10px;"><span class="fa fa-plus"></span> Novo</button>
         </form>
              <table id="dataTable"  orderBy= "0" class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>Nome</th>
                  <th>Descrição</th>
                  <th>Ação</th>
                </tr>
                </thead>
                <tbody> 
                @foreach($aRoles as $aRole)
                    <tr>
                    <td>{{ $aRole->id }}</td>
                    <td>{{ $aRole->name }}</td>
                    <td>{{ $aRole->label }}</td>
                    <td>
                        <?php if(Auth()->User()->id == $aRole->id || Auth()->User()->can('Root')) { ?>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.roles.controle', $aRole->id) }}"><i class="fas fa-sign-in-alt" style="color:white"></i></a>
                        <a class="btn btn-sm btn-warning" href="{{ route('admin.roles.atualizar', $aRole->id) }}"><i class="fas fa-edit" style="color:white"></i></a>
                        <a class="btn btn-sm btn-danger"  href="{{ route('admin.roles.deleta', $aRole->id) }}" data-confirm="teste"><i class="fas fa-trash" style="color:white"></i></a>
                          
                        <?php } ?>
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