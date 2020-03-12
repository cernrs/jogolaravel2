@extends('admin.layout.index')


@section('content')
         
<div class="row">
  
    <!-- left column -->
    <div class="col-md-12">
     <!-- general form elements -->
     <div class="card card-primary">
        <div class="card-header">
          <h3 class="card-title">Atualização de Usuários</h3>
        </div>
          <!-- /.card-header -->
          
          <!-- Mensagens -->
          @if (session('success'))
            <div class="alert alert-success">
              {{ session('success') }}
            </div>
          @endif    
          @if (session('error'))
            <div class="alert alert-danger">
              {{ session('error') }}
            </div>
          @endif    
         
          @if ($errors->any())

            <div class="alert alert-danger">

                Problemas encontrados<br><br>
  
                <ul>
                  @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                  @endforeach
                </ul>
            </div>

          @endif 
          <!-- form start -->                                                            
          <form role="form" action="{{ route( 'admin.usuarios.update', $oUsuario->id) }}" method="post"  enctype="multipart/form-data">
            {!! csrf_field() !!}
            <div class="card-body">
              <div class="form-group">
                <label for="name">Nome</label>
                <input type="text"  class="form-control" name="name" value="{{ $oUsuario->name }}" id="name" placeholder="Digite seu nome">
              </div>
              <div class="form-group">
                <label for="cel">Celular</label>
                <input type="text"  class="form-control"  name="cel" id="cel" value="{{ $oUsuario->cel }}" pattern="\([0-9]{2}\)[\s][0-9]{4,5}-[0-9]{4}" placeholder="Digite o número do seu celular">
              </div>
              <div class="form-group">
                <label for="email">Email</label>
                <input type="email"  class="form-control" name="email" id="email" value="{{ $oUsuario->email }}" placeholder="Digite seu email">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Senha</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Somente se for atualizar a senha">
              </div>
              <div class="form-group">
                <div style = "text-align: center!important; width: 110px; margin-bottom: 2px;">
                  @if($oUsuario->image != null)
                    <img id="img" class="profile-user-img img-fluid img-circle" src="{{ asset('storage/users/'.$oUsuario->image) }}" alt="Imagem do Usuário">
                  @else
                    <img id="img" class="profile-user-img img-fluid img-circle" src="{{ asset('img/noPhoto.png') }}" alt="Imagem do Usuário">
                  @endif
                  <br>
                  <label for="image">Foto</label>
                </div>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="form-control"  height="auto" name="image" id="image">
                  </div>
                </div>
              </div>
              <!-- perfils -->
              @can('Root')
              <div class="form-group">
                <table class="table table-bordered">
                  <thead>                  
                    <tr>
                      <th style="width: 10px"><input type="checkbox" id="checkTodos" name="checkTodos"></th>
                      <th>Perfil</th>
                      <th>Descrição</th>
                    </tr>
                  </thead>
                  <tbody>
                  @foreach($aRoles as $aRole) 
                    <tr>
                      <td><input type="checkbox"  
                         <?php 
                            if(!empty($aRolesUser)){
                              if (in_array($aRole->id, $aRolesUser)){
                                      echo "checked";
                              }
                            }  
                         ?> name="role_id[]" value="{{ $aRole->id }}"/>
                      </td>
                      <td>{{ $aRole->name }}</td>
                      <td>{{ $aRole->label }}</td>
                    </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              @endcan              
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