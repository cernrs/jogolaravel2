@extends('admin.layout.index')


@section('content')
         
  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
     <!-- general form elements -->
     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Atualização de Etapa</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->                                                            
          <form role="form" action="{{ route('admin.etapas.update',  $oEtapa->id) }}" method="post"  enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="card-body">
                <div class="form-group">
                  <label for="data">Data</label>
                  <input type="text"  class="form-control datepicker" value="{{ date('d/m/Y', strtotime($oEtapa->data)) }}" name="data" id="data">
                </div>
                <div class="form-group">
                  <label for="etapa">Etapa</label>
                  <input type="text"  class="form-control" name="etapaCadastro" id="etapaCadastro" value="{{ $oEtapa->etapa }}" maxlength="2" pattern="[0-9]+" >
                </div>
                
                <div class="form-group">
                  <label for="name">Inscrições Abertas</label>
                 </div>
                <div class="form-group">
                    <input type="checkbox" class="form-control" name="inscricoes_abertas" id="inscricoes_abertas"   {{ $oEtapa->inscricoes_abertas ? 'checked' : '' }}>
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