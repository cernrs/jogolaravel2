@extends('admin.layout.index')


@section('content')
         
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
     <!-- general form elements -->
     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Cadastro de Permissões</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->                                                            
          <form role="form" action="{{ route( 'admin.permissions.gravar') }}" method="post"  enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="card-body">
            <div class="form-group">
                <label for="name">Nome</label>
                <input type="text"  class="form-control" value ="{{old('name')}}" name="name" id="name" placeholder="Digite o nome">
              </div>
              <div class="form-group">
                <label for="label">Descrição</label>
                <input type="text"  class="form-control" value ="{{old('label')}}" name="label" id="label" placeholder="Digite a descrição">
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
</div>
@endsection