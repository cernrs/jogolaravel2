@extends('admin.layout.index')

@section('content')

  <div class="row">
    <!-- left column -->
    <div class="col-md-12">
     <!-- general form elements -->
     <div class="card card-primary">
        <div class="card-header">
         <span class="card-title" style="display: block ruby;"><h2>Perfil</h2>  
        </h5></span>
        </div>
          <!-- /.card-header -->
          <div class="card-body">

          <form role="form" action="{{ route('admin.roles.gravaPermissoes', $oRole->id ) }}" method="post">              
          {!! csrf_field() !!}     
          <div class="card card-default">
              <div class="card-header">
                <h2 class="card-title">{{ $oRole->name }}</h2>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-remove"></i></button>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-12">
                    <div class="form-group">

                    <select name ="permissions[]" class="duallistbox" multiple="multiple">
                      @foreach($aAllPermissions as $aAllPermission)
                        <option <?php 
                                   if(!empty($aPermissionsRole)){
                                    if (in_array($aAllPermission->id, $aPermissionsRole)){
                                          echo "selected";
                                    }
                                   }

                                ?> 
                            value="{{ $aAllPermission->id }}"
                       >{{ $aAllPermission->name }}
                        </option>
                      @endforeach
                      </select>
                    </div>
                    <!-- /.form-group -->
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              
                    <button type="submit" class="btn-sm btn-success" style="margin-bottom: 10px; margin-right: 10px;"> Salvar</button>
                  
              </div>
            </div>
      </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>



@endsection