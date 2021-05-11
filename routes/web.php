<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminUsersController;
use App\Http\Controllers\PacientesController;
use App\Models\Paciente;
use App\Models\Medico;
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

//Route::resource('/pacientes', PacientesController::class);
Route::resource('/admin/users', AdminUsersController::class);
Route::resource('/pacientes', PacientesController::class);

Route::get('/medico/{id}/paciente', function($id) {
   
    $medico=Medico::find($id);
   
    foreach($medico->pacientes as $paciente) {
        return $paciente->nombre;
    }
});
;
Route::middleware("auth")
->get("/pacientes2",  [App\Http\Controllers\PacientesCotroller::class, 'pacientesMedico'])
->name("pacientes_medico");