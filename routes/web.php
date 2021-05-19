<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\DatosVisitaController;
use App\Http\Controllers\CalendarioController;
use App\Http\Controllers\MotivoVisitasController;
use App\Http\Controllers\TipoVisitasController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentosController;
use App\Http\Controllers\PruebasMedicasController;
use App\Http\Controllers\TipoPruebasController;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Visita;
use App\Models\TipoVisita;
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

/*Route::get('/', function () {
    return view('welcome');
});*/

$user=Auth::user();
Auth::routes();

//Usamos homecontroller como contrlodor general para funciones 'globales'
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::post('/subirdocumentos',[DocumentosController::class,'subirdocumentos']);
Route::post('/obtenerdocumentos',[DocumentosController::class,'obtenerdocumentos']);
Route::get('/abrirdocumento/{id}',[DocumentosController::class,'abrirdocumento']);
Route::delete('/eliminardocumento/{id}',[DocumentosController::class,'eliminardocumento']);

Route::resource('/admin/users', AdminUsersController::class);



Route::resource('/pacientes', PacientesController::class);
Route::get('/obtenerPacientesMedico',[PacientesController::class,'obtenerPacientesMedico']);




Route::get('/datosModalEvento',[CalendarioController::class,'datosModalEvento']);

Route::resource('/calendario', CalendarioController::class);
Route::resource('/visitas', VisitaController::class);
//Para crear una visita necesitamos pasarle el paciente para cuando generamos el insert le pasemos el mismo paciente
Route::get('/visitas/crearVisitaPaciente/{id}',[VisitaController::class,'crearVisitaPaciente']);
Route::get('/visitas/visitaCalendario/{id}',[VisitaController::class,'visitaCalendario']);
Route::get('/visitas/obtenervisitas/{id}',[VisitaController::class,'obtenerVisitasPaciente']);


//Ruta motivos visita
Route::resource('/motivovisitas', MotivoVisitasController::class);
Route::resource('/tipovisitas', TipoVisitasController::class);

Route::get('/config', [HomeController::class, 'config'])->name('config');

//Rutas para pruebas medicas
Route::resource('/pruebasmedicas', PruebasMedicasController::class);
Route::get('/pruebasmedicas/obtenerpruebasmedicasvisita/{id}',[PruebasMedicasController::class,'obtenerpruebasmedicasvisita']);

//Rutas para tipo de pruebas medicas
Route::resource('/tipopruebas', TipoPruebasController::class);