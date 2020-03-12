<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\RolesFormRequest;
use App\Http\Requests\PermissionsRolesFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\PermissionRole;
use App\Permission;
class RolesController extends Controller
{
    public $request;
    public $roles;

    public function __construct(Request $request,  Role $roles)
    {
     
        $this->request = $request;
        $this->roles = $roles;
        
    }
    public function index()
    {
        $aRoles = $this->roles->all();

        return view('admin.roles.index', compact('aRoles'));
    }

    public function novo()
    {
        $aRoles = $this->roles->all();
        return view('admin.roles.novo', compact('aRoles'));
    }
    
    public function gravar(RolesFormRequest $request)
    {
    
        $aDados = $request->all();

        $bGravarRole = Role::create($aDados);
 
        if($bGravarRole){
            return redirect()->route('admin.roles.index')->with(notification('success','Perfil cadastrado com sucesso !!!'));
        }
        
        return redirect()->route('admin.roles.index')->with('error', 'Falha ao gravar no banco de dados...');
    }

    public function atualizar(Request $request, $id)
    {
        $oRole = Role::find($id);
        return view('admin.roles.atualizar', compact('oRole'));
    }
    
    public function update(RolesFormRequest $request, $id)
    {
        
        $oRole = Role::find($id);
        $aDados = $request->all();

        $bGravarRole = $oRole->update($aDados);

        if($bGravarRole){
            return redirect()->route('admin.roles.index')->with(notification('success','Dados atualizado com sucesso !!!'));
        }

        return redirect()->back()->with(notification('error', 'Falha ao gravar no banco de dados...'));

    }

    public function show($id)
    {
        //
    }
    
    public function controle($iRoleId)
    {
        
        $oUser = Auth()->User();
        $oRole = Role::find($iRoleId);

        // Busca todas permissões cadastradas
        $aAllPermissions = Permission::all();

        // Prepara array com permissões do perfil selecionado
        $aPermissionsRole = null;
        foreach ($oRole->permissions as $aRolePermission) {
            $aPermissionsRole[] = $aRolePermission->pivot->permission_id;
        }

        return view('admin.roles.controle', compact('oRole', 'aPermissionsRole', 'aAllPermissions' ));
    }

    public function gravaPermissoes(PermissionsRolesFormRequest $request, $iRoleId)
    {
        
        $aDados = $request->all();
        
        DB::beginTransaction(); 
        
        // Atualiza permissoes (exclui tudo e inseri novamente)
         $deleta = DB::table('permission_role')->where('role_id', $iRoleId)->delete();
        
         $bErro = false;
         foreach ($aDados['permissions'] as $permission_id) {
             $bGravarPermission = PermissionRole::create(['permission_id' => $permission_id, 'role_id' => $iRoleId]);
             if(!$bGravarPermission){
                 $bErro = true;
                 exit;
             }
         }

        
         if(!$bErro){
            DB::commit();
            return redirect()->route('admin.roles.index')->with(notification('success','Dados atualizado com sucesso !!!'));
        }

        DB::rollBack();
        return redirect()->back()->with(notification('error', 'Falha ao gravar no banco de dados...'));

    }




    
    public function destroy($id)
    {
        
        $oRole = Role::find($id);
        $delete = $oRole->delete();

        if($delete)
        {
            return redirect()->route('admin.roles.index')->with(notification('success', 'Excluido com sucesso!'));
        }

        return redirect()->back()->with(notification('error', 'Falha ao excluir no banco de dados...'));
    }


}