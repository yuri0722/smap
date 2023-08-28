<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();

/**
 * Rotas da parte genérica do sistema, onde todos tem acesso
 */
Route::group(['prefix' => 'smap','middleware'=>['auth'],'where'=>['id','[1-9]+']], function() {
    Route::get('/', ['as' => 'smap','uses'=>'SmapController@index']);
    Route::get('/perfil', ['as' => 'smap.perfil','uses'=>'UserController@perfil']);
    Route::put('/perfil/update/{id}', ['as' => 'smap.perfil.update','uses'=>'UserController@perfil_update']);

});

/**
 * Rotas do módulo agropecuário
 */
Route::group(['prefix' => 'agro','middleware'=>['auth'],'where'=>['id','[1-9]+']], function() {
    Route::get('/', ['as' => 'agro','uses'=>'AgroController@index']);
    //CRUD Agricultor
    Route::get('/agricultor', ['as' => 'agro.agricultor','uses'=>'AgricultorController@index']);
    Route::get('/agricultor/edit/{id?}', ['as' => 'agro.agricultor.edit','uses'=>'AgricultorController@edit']);
    Route::post('/agricultor/store',['as' => 'agro.agricultor.store','uses'=> 'AgricultorController@store']);
    Route::put('/agricultor/update/{id}', ['as' => 'agro.agricultor.update','uses'=>'AgricultorController@update']);
    Route::get('/agricultor/pesquisa', ['as' => 'agro.agricultor.pesquisa','uses'=>'AgricultorController@pesquisa']);

    Route::get('/pessoas/', ['as' => 'agro.pessoas','uses'=>'PessoaController@pessoas']);
    Route::get('/pessoa/edit/{id?}', ['as' => 'agro.pessoa.edit','uses'=>'PessoaController@edit']);

    Route::get('/os_tipos', ['as' => 'agro.os_tipos','uses'=>'OrdemServicoController@tipos']);
    Route::get('/os_tipos/edit/{id?}', ['as' => 'agro.os_tipos.edit','uses'=>'OrdemServicoController@tipo_edit']);
    Route::post('/os_tipos/store',['as' => 'agro.os_tipos.store','uses'=> 'OrdemServicoController@tipo_store']);
    Route::put('/os_tipos/update/{id}', ['as' => 'agro.os_tipos.update','uses'=>'OrdemServicoController@tipo_update']);
    Route::get('/os_tipos/pesquisa', ['as' => 'agro.os_tipos.pesquisa','uses'=>'OrdemServicoController@tipo_pesquisa']);
    Route::get('/os_tipos/subtipo/{id?}', ['as' => 'agro.os_subtipo','uses'=>'OrdemServicoController@subtipo']);
    Route::post('subtipo/store/{id}',['as' => 'agro.os_subtipo.store','uses'=> 'OrdemServicoController@subtipo_store']);
    Route::get('/subtipo/edit/{id?}', ['as' => 'agro.os_subtipos.edit','uses'=>'OrdemServicoController@subtipo_edit']);
    Route::put('/subtipo/update/{id}', ['as' => 'agro.os_subtipos.update','uses'=>'OrdemServicoController@subtipo_update']);

    //CRUD Veiculo
    Route::get('/veiculo', ['as' => 'agro.veiculo','uses'=>'VeiculoController@index']);
    Route::get('/veiculo/edit/{id?}', ['as' => 'agro.veiculo.edit','uses'=>'VeiculoController@edit']);
    Route::post('/veiculo/store',['as' => 'agro.veiculo.store','uses'=> 'VeiculoController@store']);
    Route::put('/veiculo/update/{id}', ['as' => 'agro.veiculo.update','uses'=>'VeiculoController@update']);
    Route::get('/veiculo/pesquisa', ['as' => 'agro.veiculo.pesquisa','uses'=>'VeiculoController@pesquisa']);
    Route::get('/veiculo/deletar_imagem/{id?}/{foto?}', ['as' => 'agro.veiculo.deletar_imagem','uses'=>'VeiculoController@deletarImagem']);

});

/**
 * Rotas do módulo Bem estar Animal
 */
Route::group(['prefix' => 'bemestar','middleware'=>['auth'],'where'=>['id','[1-9]+']], function() {
    Route::get('/', ['as' => 'bemestar','uses'=>'BemEstarAnimalController@index']);

    //CRUD Animais
    Route::get('/animal/', ['as' => 'bemestar.animal','uses'=>'AnimalController@index']);
    Route::get('/animal/castrado/{castrado}', ['as' => 'bemestar.animal.castrado','uses'=>'AnimalController@castrado']);
    Route::get('/animal/especie/{especie_id}', ['as' => 'bemestar.animal.por_especie','uses'=>'AnimalController@por_especie']);
    Route::get('/animal/edit/{id?}', ['as' => 'bemestar.animal.edit','uses'=>'AnimalController@edit']);
    Route::get('/animal/castracao/{id}', ['as' => 'bemestar.animal.castracao','uses'=>'AnimalController@castracao']);
    Route::get('/animal/castracao_print/{id}', ['as' => 'bemestar.animal.castracao_print','uses'=>'AnimalController@castracao_print']);
    Route::post('/animal/store',['as' => 'bemestar.animal.store','uses'=> 'AnimalController@store']);
    Route::post('/animal/castrar/',['as' => 'bemestar.animal.castrar','uses'=> 'AnimalController@castrar']);
    Route::put('/animal/castrar/update/{id}', ['as' => 'bemestar.animal.castrar.update','uses'=>'AnimalController@castrar_update']);
	Route::get('/animal/pesquisa', ['as' => 'bemestar.animal.pesquisa','uses'=>'AnimalController@pesquisa']);
    Route::put('/animal/update/{id}', ['as' => 'bemestar.animal.update','uses'=>'AnimalController@update']);
    Route::get('/animal/deletar_imagem/{id?}/{foto?}', ['as' => 'bemestar.animal.deletar_imagem','uses'=>'AnimalController@deletarImagem']);
	// rotas acrescentadas - Yuri
	Route::get('/animal/{id}', ['as' => 'bemestar.animal.show','uses'=>'AnimalController@show']);
	Route::delete('/animal/{id}', ['as' => 'bemestar.animal.destroy','uses'=>'AnimalController@destroy']);
	
	

    //CRUD pessoas
    Route::get('/pessoas/', ['as' => 'bemestar.pessoas','uses'=>'PessoaController@pessoas']);
    Route::get('/empresas', ['as' => 'bemestar.empresas','uses'=>'PessoaController@empresas']);
    Route::get('/pessoa/edit/{id?}', ['as' => 'bemestar.pessoa.edit','uses'=>'PessoaController@edit']);
    Route::get('/pessoa/edit_empresa/{id?}', ['as' => 'bemestar.pessoa.edit.empresa','uses'=>'PessoaController@edit_empresa']);
    Route::post('/pessoa/store',['as' => 'bemestar.pessoa.store','uses'=> 'PessoaController@store']);
    Route::get('/pessoa/pesquisa', ['as' => 'bemestar.pessoa.pesquisa','uses'=>'PessoaController@pesquisa']);
    Route::put('/pessoa/update/{id}', ['as' => 'bemestar.pessoa.update','uses'=>'PessoaController@update']);
    Route::get('/pessoa/deletar_imagem/{id?}/{foto?}', ['as' => 'bemestar.pessoa.deletar_imagem','uses'=>'PessoaController@deletarImagem']);

    //CRUD agenda
    Route::get('/agenda/', ['as' => 'bemestar.agenda','uses'=>'AgendaController@agenda']);

});

/**
 * Rotas do módulo de pesca
 */
Route::group(['prefix' => 'pesca','middleware'=>['auth'],'where'=>['id','[1-9]+']], function() {
    Route::get('/', ['as' => 'pesca','uses'=>'PescaController@index']);

});

/**
 * Rotas do Serviço de Inspeção Municipal (S.I.M)
 */
Route::group(['prefix' => 'sim','middleware'=>['auth'],'where'=>['id','[1-9]+']], function() {
    Route::get('/', ['as' => 'pesca','uses'=>'SimController@index']);

});

/**
 * Rotas do ADMIN
 */
Route::group(['prefix' => 'admin','middleware'=>['auth','admin'],'where'=>['id','[1-9]+']], function() {
    Route::get('/', ['as' => 'admin','uses'=>'AdminController@index']);
    //CRUD pessoas
    Route::get('/users/', ['as' => 'admin.users','uses'=>'UserController@index']);
    Route::get('/user/edit/{id?}', ['as' => 'admin.user.edit','uses'=>'UserController@edit']);
    Route::post('/user/store',['as' => 'admin.user.store','uses'=> 'UserController@store']);
    Route::put('/user/update/{id}', ['as' => 'admin.user.update','uses'=>'UserController@update']);
    Route::get('/user/pesquisa', ['as' => 'admin.user.pesquisa','uses'=>'UserController@pesquisa']);


});

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'ajax','middleware'=>['auth'],'where'=>['id','[1-9]+']], function() {
    Route::get('/cidade/filtro/{nome}/{campoId}/{campoNome}/{campoSelect}', ['as' => 'ajax.cidade.filtro','uses'=>'CidadeController@filtro']);
    Route::get('/pessoa/filtro/{nome}/{campoId}/{campoNome}/{campoSelect}', ['as' => 'ajax.pessoa.filtro','uses'=>'PessoaController@filtro']);
    Route::get('/user/filtro/{nome}/{campoId}/{campoNome}/{campoSelect}', ['as' => 'ajax.user.filtro','uses'=>'UserController@filtro']);
});
