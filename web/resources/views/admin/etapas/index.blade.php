@extends('admin.layout.index')

@section('content')

  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
     <!-- general form elements -->
     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Estapas até o momento</h3>
        </div>
          <!-- /.card-header -->
          <div class="card-body">
          <form role="form" action="{{ route('admin.etapas.novo') }}" method="GET">
            <button type="submit" class="btn-sm btn-primary" style="margin-bottom: 10px;"><span class="fa fa-plus"></span> Nova etapa</button>
         </form>
              <table id="dataTable"  orderBy= "2"  class="table table-bordered table-striped table-sm">
                <thead>
                <tr>
                  <th>Etapa / Ano</th>
                  <th>Inscrições</th>
                  <th>Campeões</th>
                  <th>Vices Campeões</th>
                  <th>Ação</th>
                </tr>
                </thead>
                <tbody> 
                @foreach($aEtapas as $etapa)
                    <tr>
                    <td>{{ $etapa->etapa }}ª Etapa - {{ mesExtenso(date('m', strtotime($etapa->data))) }} / {{ date('Y', strtotime($etapa->data)) }}</td>
                    <td><input data-id="{{$etapa->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Aberta" data-size="small" data-off="Encerrada a" {{ $etapa->inscricoes_abertas ? 'checked' : '' }}></td>
                    <td>xxxxxxx</td>
                    <td>xxxxxxxx</td>
                    <td>
                        <a class="btn btn-sm btn-success" href="{{ route('admin.etapas.controle', $etapa->id) }}"><i class="fas fa-sign-in-alt" style="color:white"></i></a>
                        <a class="btn btn-sm btn-warning" href="{{ route('admin.etapas.atualizar', $etapa->id) }}"><i class="fas fa-edit" style="color:white"></i></a>
                        <a class="btn btn-sm btn-danger"  href="{{ route('admin.etapas.deleta', $etapa->id) }}" data-confirm="teste"><i class="fas fa-trash" style="color:white"></i></a>
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


</div>

@endsection