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
        $prueba = PruebaMedica::findOrFail($id);
       return $prueba;
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
        try {
            //Buscamos la prueba medica a partir del id y la eliminamos
            $tipo=PruebaMedica::findOrFail($id);
            $tipo->delete();
        
        }catch (\Illuminate\Database\QueryException $e){
          
            return response($e,500);
        }
    }
    public function obtenerPruebasMedicasVisita($idVisita){
         
        //Otemenos las pruebas relacionadas con la visita junto con el array de tipo pruebas para mostrar
        $pruebas =PruebaMedica::with('tipoPrueba')->where('visita_id','=',$idVisita)->get();
        //devolvemos json con el array de pruebas
        return $pruebas;
     }

   
   






}
