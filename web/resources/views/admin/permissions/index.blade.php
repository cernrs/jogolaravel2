@extends('admin.layout.index')

@section('content')

  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
     <!-- general form elements -->
     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Permissões Cadastradas</h3>
        </div>
          <!-- /.card-header -->
          <div class="card-body">
          <form role="form" action="{{ route('admin.permissions.novo') }}" method="GET">
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
                @foreach($aPermissions as $aPermission)
                    <tr>
                    <td>{{ $aPermission->id }}</td>
                    <td>{{ $aPermission->name }}</td>
                    <td>{{ $aPermission->label }}</td>
                    <td>
                        <?php if(Auth()->User()->id == $aPermission->id || Auth()->User()->can('Root')) { ?>
                        <a class="btn btn-sm btn-warning" href="{{ route('admin.permissions.atualizar', $aPermission->id) }}"><i class="fas fa-edit" style="color:white"></i></a>
                        <a class="btn btn-sm btn-danger"  href="{{ route('admin.permissions.deleta', $aPermission->id) }}" data-confirm="teste"><i class="fas fa-trash" style="color:white"></i></a>
                          
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