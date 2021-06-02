<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
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
use App\Http\Controllers\MedicosController;

use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Visita;
use App\Models\TipoVisita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

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


//Rutas usuarios
Route::get('/usuarios',[UsuariosController::class,'index'])->name('usuarios.index');
Route::post('/usuarios',[UsuariosController::class,'store'])->name('usuarios.store');
Route::put('/usuarios/{id}',[UsuariosController::class,'update'])->name('usuarios.update');
Route::get('/usuarios/buscar/{id}',[UsuariosController::class,'show'])->name('usuarios.show');
Route::get('/usuarios/obtenerusuarios', [UsuariosController::class,'obtenerUsuarios']);
Route::get('/usuarios/obtenerroles', [UsuariosController::class,'obtenerRoles']);
Route::middleware("auth")
->post("/usuarios/upload/avatar/{id}", [UsuariosController::class,'updateAvatar'])->name("avatar");


//Rutas medico
Route::get('/medicos',[MedicosController::class,'index'])->name('medicos.index');
Route::post('/medicos',[MedicosController::class,'store'])->name('medicos.store');
Route::put('/medicos/{id}',[MedicosController::class,'update'])->name('medicos.update');
Route::get('/medicos/buscar/{id}',[MedicosController::class,'show'])->name('medicos.show');
Route::get('/medicos/obtenermedicos',[MedicosController::class,'obtenerMedicos'])->name('obtenermedicos');
Route::get('/medicos/usuariossinasignar', [MedicosController::class,'usuariossinasignar']);
Route::get('/medicos/obtenerusuarios', [MedicosController::class,'obtenerUsuarios']);



//Rutas paciente
Route::resource('/pacientes', PacientesController::class);
Route::get('/obtenerPacientesMedico',[PacientesController::class,'obtenerPacientesMedico']);
Route::get('/nif/{nif}',[PacientesController::class,'buscarNIF']);



Route::get('/datosModalEvento',[CalendarioController::class,'datosModalEvento']);
Route::resource('/calendario', CalendarioController::class);
Route::resource('/visitas', VisitaController::class);

//Para crear una visita necesitamos pasarle el paciente para cuando generamos el insert le pasemos el mismo paciente
Route::get('/visitas/crearVisitaPaciente/{id}',[VisitaController::class,'crearVisitaPaciente']);
Route::get('/visitas/visitaCalendario/{id}',[VisitaController::class,'visitaCalendario']);
Route::get('/visitas/obtenervisitas/{id}',[VisitaController::class,'obtenerVisitasPaciente']);


//Ruta motivos visita
Route::post('/motivovisitas',[MotivoVisitasController::class,'store'])->name('motivovisitas.store');
Route::put('/motivovisitas/{id}',[MotivoVisitasController::class,'update'])->name('motivovisitas.update');
Route::get('/motivovisitas/buscar/{id}',[MotivoVisitasController::class,'show'])->name('motivovisitas.show');
Route::get('/motivovisitas/obtenermotivos',[MotivoVisitasController::class,'obtenermotivos']);
Route::delete('/motivovisitas/{id}',[MotivoVisitasController::class,'destroy'])->name('motivovisitas.destroy');


//rutas tipo visitas
Route::post('/tipovisitas',[TipoVisitasController::class,'store'])->name('tipovisita.store');
Route::put('/tipovisitas/{id}',[TipoVisitasController::class,'update'])->name('tipovisita.update');
Route::get('/tipovisitas/buscar/{id}',[TipoVisitasController::class,'show'])->name('tipovisita.show');
Route::get('/tipovisitas/obtenertipos',[TipoVisitasController::class,'obtenertipos']);
Route::delete('/tipovisitas/{id}',[TipoVisitasController::class,'destroy'])->name('tipovisita.destroy');


//rutas tipo pruebas
Route::post('/tipopruebas',[TipoPruebasController::class,'store'])->name('tipoprueba.store');
Route::put('/tipopruebas/{id}',[TipoPruebasController::class,'update'])->name('tipoprueba.update');
Route::get('/tipopruebas/buscar/{id}',[TipoPruebasController::class,'show'])->name('tipoprueba.show');
Route::get('/tipopruebas/obtenertipos',[TipoPruebasController::class,'obtenertipos']);
Route::delete('/tipopruebas/{id}',[TipoPruebasController::class,'destroy'])->name('tipoprueba.destroy');





Route::get('/config', [HomeController::class, 'config'])->name('config');

//Rutas para pruebas medicas
//Route::resource('/pruebasmedicas', PruebasMedicasController::class);
Route::post('/pruebasmedicas',[PruebasMedicasController::class,'store'])->name('pruebasmedicas.store');
Route::put('/pruebasmedicas/{id}',[PruebasMedicasController::class,'update'])->name('pruebasmedicas.update');
Route::get('/pruebasmedicas/buscar/{id}',[PruebasMedicasController::class,'show'])->name('pruebasmedicas.show');
Route::get('/pruebasmedicas/obtenerpruebasmedicasvisita/{id}',[PruebasMedicasController::class,'obtenerpruebasmedicasvisita']);
Route::delete('/pruebasmedicas/{id}',[PruebasMedicasController::class,'destroy'])->name('pruebasmedicas.destroy');
//Rutas para tipo de pruebas medicas
Route::resource('/tipopruebas', TipoPruebasController::class);

Route::post('/forgot-password', function (Request $request) {

    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->name('password.email');

//Rutas para paginas de error, recibimos el error como parametro y mostramos la pagina correspondiente
Route::get("/errors/{error}", function ($error) {
    if ($error=='401'){
        return abort(404);
    }
    if ($error=='403'){
        return abort(403);
    }
    if ($error=='404'){
        return abort(500);
    }
    if ($error=='419'){
        return abort(404);
    }
    if ($error=='429'){
        return abort(403);
    }
    if ($error=='500'){
        return abort(500);
    }
    if ($error=='503'){
        return abort(503);
    }
});

