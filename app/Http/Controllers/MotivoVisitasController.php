<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MotivoVisita;

class MotivoVisitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     //comprobamos que se este autenticado
    public function __construct()
    {
        $this->middleware('auth');
    } 

    
    public function index()
    {
        $motivos=MotivoVisita::all();
        return $motivos;
    }
    public function obtenermotivos(){
        $motivos=MotivoVisita::all();
        return $motivos;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        MotivoVisita::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $motivo = MotivoVisita::findOrFail($id);
       return $motivo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update( $id,Request $request)
    {
         //Realizamos update
         $motivo=MotivoVisita::findOrFail($id);     
         $motivo->update($request->all()); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            $motivo=MotivoVisita::findOrFail($id);
            $motivo->delete();
        
        }catch (\Illuminate\Database\QueryException $e){          
            // return response($e,500);
             return response()->json([
                 'status' => 'Ocurrio un error!',
                 'msg' => 'Hay visitas con este motivo de visita.',
             ],400);
         }
        
    }
}
