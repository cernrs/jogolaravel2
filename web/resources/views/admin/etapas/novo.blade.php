@extends('admin.layout.index')


@section('content')
         
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
     <!-- general form elements -->
     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Cadastro de Nova Etapa</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->                                                            
          <form role="form" action="{{ route('admin.etapas.gravar') }}" method="post"  enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="card-body">
                <div class="form-group">
                  <label for="data">Data</label>
                  <input type="text"  class="form-control datepicker" name="data" id="data">
                </div>
                <div class="form-group">
                  <label for="etapa">Etapa</label>
                  <input type="text"  class="form-control" name="etapaCadastro" id="etapaCadastro" maxlength="2" pattern="[0-9]+" >
                </div>
               
                <div class="form-group">
                  <label for="name">Inscrições Abertas</label>
                 </div>
                <div class="form-group">
                  <input type="checkbox" class="form-control"  checked value="true" name="inscricoes_abertas" id="inscricoes_abertas" >
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
    <!-- /.content -->
</div>
@endsection