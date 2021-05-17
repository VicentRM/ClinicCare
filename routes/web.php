<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\DatosVisitaController;
use App\Http\Controllers\CalendarioController;
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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('/admin/users', AdminUsersController::class);



Route::resource('/pacientes', PacientesController::class)->middleware('auth');
Route::get('/obtenerPacientesMedico',[PacientesController::class,'obtenerPacientesMedico']);

/*
Route::group(['prefix' => 'pacientes'], function () {
    Route::post('add', [PacientesController::class,'add']);
    Route::get('/', [PacientesController::class,'index'])->name('pacientes.index');
    Route::get('edit/{id}', [PacientesController::class,'edit'])->name('pacientes.edit');
    Route::post('update/{id}', [PacientesController::class,'update'])->name('pacientes.update');
    Route::delete('delete/{id}', [PacientesController::class,'delete'])->name('pacientes.delete');
});*/



Route::get('/datosModalEvento',[CalendarioController::class,'datosModalEvento']);

Route::resource('/calendario', CalendarioController::class)->middleware('auth');
Route::resource('/visitas', VisitaController::class)->middleware('auth');
//Para crear una visita necesitamos pasarle el paciente para cuando generamos el insert le pasemos el mismo paciente
Route::get('/visitas/crearVisitaPaciente/{id}',[VisitaController::class,'crearVisitaPaciente']);

//Route::get('/nuevavisita',[VisitaController::class,'nuevaVisita'])->name('nuevavisita');
Route::post('/nuevavisita',[VisitaController::class,'nuevaVisita'])->name('nuevavisita');

Route::get('/visitas',function(){
   // $visitas=Paciente::find(10)->visitas;
   $visitas=TipoVisita::find(1)->visitas;
    foreach($visitas as $visita) {
        echo $visita->fecha;
        echo '1';
    }  
    $tipovisitas=TipoVisita::All();
    foreach($tipovisitas as $tipo) {
        echo $tipo->descripcion;
       
    } 

    //obtener la descripcion del tipo visita de una
    $v=Visita::All();
    foreach($v as $p){
        echo $p->tipoVisita->descripcion;
    }
});