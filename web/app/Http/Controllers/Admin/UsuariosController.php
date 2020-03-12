<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsuariosFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Role;
use App\RoleUser;

class UsuariosController extends Controller
{
    public $request;
    public $usuarios;

    public function __construct(Request $request,  User $usuarios, Role $roles)
    {
     
        $this->request = $request;
        $this->usuarios = $usuarios;
        $this->roles = $roles;
        
    }
    public function index()
    {
        $oUser = Auth()->User();
        $sUri = $this->request->route()->uri;
        $sExplode = explode("/", $sUri);
        $sUriAtual = $sExplode[1];
        
        $aEtapas = DB::select('select * from etapas order by data desc');

        $usuarios = $this->usuarios->all();
        return view('admin.usuarios.index', compact('oUser', 'sUriAtual', 'usuarios'));
    }

    public function novo()
    {
        $oUser = Auth()->User();
        $sUri = $this->request->route()->uri;
        $sExplode = explode("/", $sUri);
        $sUriAtual = $sExplode[1];
        
        $aRoles = $this->roles->all();
        return view('admin.usuarios.novo', compact('oUser', 'sUriAtual', 'aRoles' ));
    }
    
    public function gravar(UsuariosFormRequest $request)
    {
    
        $aDados = $request->all();
        $aDados['password'] = bcrypt($aDados['password']);

        DB::beginTransaction();

        // verifica se veio imagem pra cadastrar
        if($request->hasFile('image') && $request->file('image')->isValid()){
           
            $sNomeImagem = "ft_".Str::kebab($aDados['name']);
            $sExtensao = $request->image->extension();
            $sArquivo = "{$sNomeImagem}.{$sExtensao}";
            $aDados['image'] = $sArquivo;

            $bUpload = $request->image->storeAs('users', $sArquivo);

            if(!$bUpload){
                return redirect()->back()->with(notification('error', 'Falha ao gerar a imagem !'));
            }
        }

        $bGravarUsuario = User::create($aDados);
        
        // Grava perfil
        $bErro = false;
        foreach ($aDados['role_id'] as $role_id) {
            $bGravarRole = RoleUser::create(['user_id' => $bGravarUsuario->id, 'role_id' => $role_id]);
            if(!$bGravarRole){
                $bErro = true;
                exit;
            }
        }
        
        if($bGravarUsuario && !$bErro){
            DB::commit();
            return redirect()->route('admin.usuarios.index')->with(notification('success','Usuário cadastrado com sucesso !!!'));
        }
        
        DB::rollBack();
        return redirect()->route('admin.usuarios.index')->with('error', 'Falha ao gravar no banco de dados...');
    }

    public function atualizar(Request $request, $id)
    {
        $oUsuario = User::find($id);
        
        // Busca perfil cadastrados
        $aRoles = $this->roles->all();

        // Prepara array com perfils do usuario
        $aRolesUser = null;
        foreach ($oUsuario->roles as $aRoleUser) {
            $aRolesUser[] = $aRoleUser->pivot->role_id;
        }

        return view('admin.usuarios.atualizar', compact('oUsuario','aRoles','aRolesUser'));
    }
    
    public function update(Request $request, $id)
    {
        
        $oUser = User::find($id);
        $aDados = $request->all();
        
        if($aDados['password'] != null){
           $aDados['password'] = bcrypt($aDados['password']);
        }else{
           unset($aDados['password']);
        }

        $aDados['image'] = $oUser->image;
        
        DB::beginTransaction();
          
         if($request->hasFile('image') && $request->file('image')->isValid()){

            $sNomeImagem = "ft_".$aDados['name'];
            $sExtensao = $request->image->extension();
            $sArquivo = "{$sNomeImagem}.{$sExtensao}";
            $aDados['image'] = $sArquivo;

            $bUpload = $request->image->storeAs('users', $sArquivo);

            if(!$bUpload){
                return redirect()->back()->with(notification('error', 'Falha ao gerar a imagem !'));
            }
    
         }
        
         $bGravarUsuario = $oUser->update($aDados);

        // Atualiza perfils (exclui tudo e inseri novamente)
        $deleta = DB::table('role_user')->where('user_id', $oUser->id)->delete();
        
        $bErro = false;
        foreach ($aDados['role_id'] as $role_id) {
            $bGravarRole = RoleUser::create(['user_id' => $oUser->id, 'role_id' => $role_id]);
            if(!$bGravarRole){
                $bErro = true;
                exit;
            }
        }

        if($bGravarUsuario && !$bErro){
            DB::commit();
            return redirect()->route('admin.usuarios.index')->with(notification('success','Dados atualizado com sucesso !!!'));
        }

        DB::rollBack();
        return redirect()->back()->with(notification('error', 'Falha ao gravar no banco de dados...'));

    }

    public function show($id)
    {
        //
    }
    
    
    public function destroy($id)
    {
        
        $oUser = User::find($id);
        $delete = $oUser->delete();

        if($delete)
        {
            Storage::delete("users/{$oUser->image}"); 
            return redirect()->route('admin.usuarios.index')->with(notification('success', 'Excluido com sucesso!'));
        }

        return redirect()->back()->with(notification('error', 'Falha ao excluir no banco de dados...'));
    }


}