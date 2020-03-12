@extends('admin.layout.index')


@section('content')
         
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
     <!-- general form elements -->
     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Inscrição</h3>
        </div>
          <!-- /.card-header -->
          <!-- form start -->                                                            
          <form role="form" action="{{ route('admin.etapas.gravarInscricao') }}" method="post"  >
          <input name="etapa_id" type="hidden" value="{{ $idEtapa }}">
            {!! csrf_field() !!}
            <div class="card-body">
              <div class="form-group">
                 <label for="data">Informe a sua dupla</label>
                 <select name="jogador2" class="form-control">
                    <option value="">--Selecione--</option>
                    @foreach ($oJogadoresDisponiveis as $id => $nome)
                      <option value="{{ $id }}"> {{ $nome }}</option>   
                    @endforeach
                  </select>
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