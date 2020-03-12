<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\User;
use App\Etapa;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public $request;
    public $usuarios;
    
    public function __construct(Request $request,  User $usuarios)
    {
        //$this->middleware('auth');
        $this->request = $request;
        $this->usuarios = $usuarios;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $oUser = Auth()->User();
        $aEtapa = DB::select('select * from etapas order by data desc limit 1');

        return view('admin.index', compact('oUser','aEtapa'));

    }

}
