<?php
namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionsFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Role;
use App\PermissionRole;
use App\Permission;

class PermissionsController extends Controller
{
    public $request;
    public $permissions;

    public function __construct(Request $request,  Permission $permissions)
    {
     
        $this->request = $request;
        $this->permissions = $permissions;
        
    }
    public function index()
    {
        $aPermissions = $this->permissions->all();

        return view('admin.permissions.index', compact('aPermissions'));
    }

    public function novo()
    {
        //$aPermissions = $this->permissions->all();
        return view('admin.permissions.novo');
    }
    
    public function gravar(PermissionsFormRequest $request)
    {
    
        $aDados = $request->all();

        $bGravarPermission = Permission::create($aDados);
 
        if($bGravarPermission){
            return redirect()->route('admin.permissions.index')->with(notification('success','Permissão cadastrada com sucesso !!!'));
        }
        
        return redirect()->route('admin.permissions.index')->with('error', 'Falha ao gravar no banco de dados...');
    }

    public function atualizar(Request $request, $id)
    {
        $oPermission = Permission::find($id);
        return view('admin.permissions.atualizar', compact('oPermission'));
    }
    
    public function update(PermissionsFormRequest $request, $id)
    {
        
        $oPermission = Permission::find($id);
        $aDados = $request->all();

        $bGravarPermission = $oPermission->update($aDados);

        if($bGravarPermission){
            return redirect()->route('admin.permissions.index')->with(notification('success','Dados atualizado com sucesso !!!'));
        }

        return redirect()->back()->with(notification('error', 'Falha ao gravar no banco de dados...'));

    }

    public function show($id)
    {
        //
    }
    

    
    public function destroy($id)
    {
        
        $oPermission = Permission::find($id);
        $delete = $oPermission->delete();

        if($delete)
        {
            return redirect()->route('admin.permissions.index')->with(notification('success', 'Excluido com sucesso!'));
        }

        return redirect()->back()->with(notification('error', 'Falha ao excluir no banco de dados...'));
    }


}