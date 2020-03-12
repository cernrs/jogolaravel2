@extends('admin.layout.index')


@section('content')
         
<div class="row">
  
    <!-- left column -->
    <div class="col-md-12">
     <!-- general form elements -->
     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Atualização de Permissões</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->                                                            
          <form role="form" action="{{ route( 'admin.permissions.update', $oPermission->id) }}" method="post" >
            {!! csrf_field() !!}
            <div class="card-body">
              <div class="form-group">
                <label for="name">Perfil</label>
                <input type="text"  class="form-control" name="name" value="{{ $oPermission->name }}" id="name" placeholder="Digite seu nome">
              </div>
              <div class="form-group">
                <label for="label">Descrição</label>
                <input type="label"  class="form-control" name="label" id="label" value="{{ $oPermission->label }}" placeholder="Digite a descrição">
              </div>
            
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Enviar</button>
            </div>
          </form>
        </div>
        <!-- /.card -->

        </div>
        </div>


    
    </section>
    <!-- /.content -->
</div
@endsection