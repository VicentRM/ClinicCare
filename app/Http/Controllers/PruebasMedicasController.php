<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PruebaMedica;
use App\Models\Visita;


class PruebasMedicasController extends Controller
{
    //Controlamos que se este autenticado
    public function __construct()
    {
        $this->middleware('auth');
    } 

    public function index()
    {
 
    }


    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        $entrada=$request->all();
        $prueba=PruebaMedica::create($entrada); 

        return response()->json([
            'prueba' => $prueba,            
            ], 200);
    }
   
    public function show($id)
    {
        //
    }
   
    public function edit($id)
    {
        //
    }
   
    public function update($id,Request $request){
        $prueba=PruebaMedica::findOrFail($id);
             
        $prueba->update($request->all());

     }

    
    public function destroy($id)
    {
        //
    }
    public function obtenerPruebasMedicasVisita($idVisita){
         
        //Otemenos las pruebas relacionadas con la visita junto con el array de tipo pruebas para mostrar
        $pruebas =PruebaMedica::with('tipoPrueba')->where('visita_id','=',$idVisita)->get();
        //devolvemos json con el array de pruebas
        return response()->json([
             'pruebas' => $pruebas,            
             ], 200);
     }

   
   






}
