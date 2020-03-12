<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => ['auth'], 'namespace' => 'Admin', 'prefix' => 'admin'], function(){
    Route::get('/', 'AdminController@index')->name('admin.index');
    Route::get('/usuarios', 'UsuariosController@index')->name('admin.usuarios.index');
    Route::get('/usuarios/novo', 'UsuariosController@novo')->name('admin.usuarios.novo');
    Route::post('/usuarios/gravar', 'UsuariosController@gravar')->name('admin.usuarios.gravar');
    Route::get('/usuarios/{id}', 'UsuariosController@atualizar')->name('admin.usuarios.atualizar');
    Route::post('/usuarios/{id}', 'UsuariosController@update')->name('admin.usuarios.update');
    Route::get('/usuarios/deleta/{id}', 'UsuariosController@destroy')->name('admin.usuarios.deleta');
    
    Route::get('/roles', 'RolesController@index')->name('admin.roles.index');
    Route::get('/roles/novo', 'RolesController@novo')->name('admin.roles.novo');
    Route::post('/roles/gravar', 'RolesController@gravar')->name('admin.roles.gravar');
    Route::get('/roles/{id}', 'RolesController@atualizar')->name('admin.roles.atualizar');
    Route::post('/roles/{id}', 'RolesController@update')->name('admin.roles.update');
    Route::get('/roles/deleta/{id}', 'RolesController@destroy')->name('admin.roles.deleta');
    Route::get('/roles/controle/{id}', 'RolesController@controle')->name('admin.roles.controle');
    Route::post('/roles/gravaPermissoes/{id}', 'RolesController@gravaPermissoes')->name('admin.roles.gravaPermissoes');

    Route::get('/permissions', 'PermissionsController@index')->name('admin.permissions.index');
    Route::get('/permissions/novo', 'PermissionsController@novo')->name('admin.permissions.novo');
    Route::post('/permissions/gravar', 'PermissionsController@gravar')->name('admin.permissions.gravar');
    Route::get('/permissions/{id}', 'PermissionsController@atualizar')->name('admin.permissions.atualizar');
    Route::post('/permissions/{id}', 'PermissionsController@update')->name('admin.permissions.update');
    Route::get('/permissions/deleta/{id}', 'PermissionsController@destroy')->name('admin.permissions.deleta');
    Route::get('/permissions/controle/{id}', 'PermissionsController@controle')->name('admin.permissions.controle');
    Route::post('/permissions/gravaPermissoes/{id}', 'PermissionsController@gravaPermissoes')->name('admin.permissions.gravaPermissoes');

    Route::get('/etapas/inscricao/{id}', 'EtapasController@inscricao')->name('admin.etapas.inscricao');
    Route::get('/etapas/excluiInscricao/{id}', 'EtapasController@excluiInscricao')->name('admin.etapas.excluiInscricao');
    Route::get('/etapas/controle/{id}', 'EtapasController@controle')->name('admin.etapas.controle');
    Route::post('/etapas/gravarinscricao', 'EtapasController@gravarInscricao')->name('admin.etapas.gravarInscricao');
    Route::get('/etapas/geraPartidas/{id}', 'EtapasController@geraPartidas')->name('admin.etapas.geraPartidas');
    Route::get('/etapas/confrontos/{id}', 'EtapasController@confrontos')->name('admin.etapas.confrontos');
    Route::post('/etapas/confrontosUpdate/{id}', 'EtapasController@confrontosUpdate')->name('admin.etapas.confrontosUpdate');
  
    Route::get('/etapas', 'EtapasController@index')->name('admin.etapas.index');
    Route::get('/etapas/abreFechaInscricoes', 'EtapasController@abreFechaInscricoes')->name('admin.etapas.abreFechaInscricoes');
    Route::get('/etapas/novo', 'EtapasController@novo')->name('admin.etapas.novo');
    Route::post('/etapas/gravar', 'EtapasController@gravar')->name('admin.etapas.gravar');
    Route::get('/etapas/{id}', 'EtapasController@atualizar')->name('admin.etapas.atualizar');
    Route::post('/etapas/{id}', 'EtapasController@update')->name('admin.etapas.update');
    Route::get('/etapas/deleta/{id}', 'EtapasController@destroy')->name('admin.etapas.deleta');
  //Route::resource('etapas', 'EtapasController')->middleware('auth');

   
});

Route::get('/rolesPermission', 'HomeController@rolesPermissions');


Route::get('/auth/redirect/{provider}', 'SocialController@redirect');
Route::get('/callback/{provider}', 'SocialController@callback');
Route::get('/', 'Site\SiteController@index');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



