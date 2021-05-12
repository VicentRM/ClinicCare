<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\VisitaController;
use App\Http\Controllers\DatosVisitaController;
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

Route::resource('/pacientes', PacientesController::class)->middleware('auth');;
Route::get ('/pacientes2', [PacientesController::class,'pacientesMedico']);



Route::get('/medico/{id}/paciente', function($id) {   
    $medico=Medico::find($id);   
    foreach($medico->pacientes as $paciente) {
        return $paciente->nombre;
    }
});

Route::resource('/visitas', VisitaController::class)->middleware('auth');
Route::resource('/datosvisita', DatosVisitaController::class)->middleware('auth');
Route::get ('/datosvisitavue/{visitaId}', [DatosVisitaController::class,'datosVisita']);

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