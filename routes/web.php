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

Route::get('/', function () { return view('inicio'); })->middleware(['auth']);
Route::get('/inicio', function () { return view('inicio'); })->name('inicio')->middleware(['auth']);

// Pestaña INICIO
Route::get('/inicio/actas_de_reunion','ActaDeReunionController@index')->middleware(['auth']);
Route::post('/inicio/actas_de_reunion_guardar','ActaDeReunionController@store')->middleware(['auth']);
Route::get('/inicio/actas_de_reunion/{acta_de_reunion}','ActaDeReunionController@show')->middleware(['auth']);
Route::get('/inicio/actas_de_reunion_delete/{acta_de_reunion}','ActaDeReunionController@destroy')->middleware(['auth']);
Route::get('/inicio/actas_de_reunion_view/{acta_de_reunion}','ActaDeReunionController@viewActaDeReunion')->middleware(['auth']);
Route::get('/inicio/nosotros','NosotrosController@index')->middleware(['auth']);

// Pestaña USUARIOS
Route::get('/usuarios/perfiles_de_usuario','UsersController@index')->middleware(['auth']);
Route::post('/usuarios/perfiles_de_usuario_guardar','UsersController@store')->middleware(['auth']);
Route::get('/usuarios/perfiles_de_usuario/{user}','UsersController@show')->middleware(['auth']);
Route::get('/usuarios/perfiles_de_usuario_delete/{user}','UsersController@destroy')->middleware(['auth']);
Route::get('/prohibido','UsersController@prohibido')->middleware(['auth']);

// Pestaña DOCUMENTOS
Route::get('/documentos/documentos','DocumentoController@index')->middleware(['auth']);
Route::post('/documentos/registrar','DocumentoController@store')->middleware(['auth']);
Route::post('/documentos/documentos_guardar','RegisterDocumentController@store')->middleware(['auth']);
Route::post('/documentos/documentos_editar','RegisterDocumentController@update')->middleware(['auth']);
Route::get('/documentos/documentos/{documento}','RegisterDocumentController@show')->middleware(['auth']);
Route::get('/documentos/documentos/edit/{idSelec}','RegisterDocumentController@editdocu')->middleware(['auth']);
Route::get('/documentos/documentos_delete/{documento}','DocumentoController@destroy')->middleware(['auth','allow.only:Administrador']);
Route::get('/documentos/documentos_view/{documento}','RegisterDocumentController@viewDocumento')->middleware(['auth','allow.only:Responsable']);
Route::get('/documentos/documentos_view_mod/{documento}','DocumentoController@viewDocumentoMod')->middleware(['auth','allow.only:Responsable']);
Route::get('/documentos/documentos_view_wmk/{documento}','DocumentoController@viewDocumentoWMA')->middleware(['auth','allow.only:Regular']);
Route::get('/documentos/activo/{codigo}','DocumentoController@getDocumentoActivo')->middleware(['auth','allow.only:Regular']);

Route::get('/documentos/formatos_llenos','FormatoLlenoController@index')->middleware(['auth']);
Route::get('/documentos/formatos_llenos/config/{codigo}','FormatoLlenoController@configcodigo')->middleware(['auth']);
Route::post('/documentos/formatos_llenos/config/saveperiodo','FormatoLlenoController@periodocodigo')->middleware(['auth']);
Route::get('/documentos/formatos_llenos/config/saveuser/{iduser}','FormatoLlenoController@saveuser')->middleware(['auth']);
Route::post('/documentos/formatos_llenos_guardar','FormatoLlenoController@store')->middleware(['auth']);
Route::get('/documentos/formatos_llenos/{formato}','RegistroFormatosLlenosController@show')->middleware(['auth']);
Route::get('/documentos/formatos_llenos/nuevoreg/{formato}','RegistroFormatosLlenosController@nuevoregistro')->middleware(['auth']);
Route::post('/documentos/formatos_llenos/nuevoreg/guardar','RegistroFormatosLlenosController@store')->middleware(['auth']);
Route::get('/documentos/formatos_llenos_delete/{formato}','FormatoLlenoController@destroy')->middleware(['auth']);
Route::get('/documentos/formatos_llenos_view/{formato}','RegistroFormatosLlenosController@viewFormatoLleno')->middleware(['auth']);
Route::get('/documentos/formatos_llenos_anexos/view/{idanexo}','RegistroFormatosLlenosController@viewanexos')->middleware(['auth']);
Route::get('/documentos/formatos_llenos_anexos/veranexo/{idanexo}','RegistroFormatosLlenosController@viewidanexo')->middleware(['auth']);

// Pestaña LIDERAZGO
Route::get('/liderazgo/perfiles_de_puesto','PerfilDePuestoController@index')->middleware(['auth']);
Route::post('/liderazgo/perfiles_de_puesto_guardar','PerfilDePuestoController@store')->middleware(['auth']);
Route::get('/liderazgo/perfiles_de_puesto/{perfil}','PerfilDePuestoController@show')->middleware(['auth']);
Route::get('/liderazgo/perfiles_de_puesto_delete/{perfil}','PerfilDePuestoController@destroy')->middleware(['auth']);
Route::get('/liderazgo/perfiles_de_puesto_view/{perfil}','PerfilDePuestoController@viewPerfilDePuesto')->middleware(['auth']);

// Pestaña NOTIFICACIONES
Route::get('/notificaciones/notificaciones','NotificationController@index')->middleware(['auth']);
Route::post('/notificaciones/notificaciones_guardar','NotificationController@store')->middleware(['auth']);
Route::get('/notificaciones/notificaciones_delete/{notificacion}','NotificationController@destroy')->middleware(['auth']);
Route::get('/notificaciones/getUsuariosPorPerfil/{perfil}','NotificationController@getUsuariosPorPerfil')->middleware(['auth']);

Route::get('/notificaciones/sendEmail/{notificacion}','NotificationController@sendNotification')->middleware(['auth']);

//Carpeta compartida
Route::get('/folders/{archivo}','SharedDirectoryController@abrirArchivoCompartido')->middleware(['auth']);


require __DIR__.'/auth.php';
