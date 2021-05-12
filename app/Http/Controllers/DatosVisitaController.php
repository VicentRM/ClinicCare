<?php

namespace App\Http\Controllers;
use App\Models\Visita;
use Illuminate\Http\Request;
use App\Models\DatosVisita;

class DatosVisitaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        //Realizamos update
        $datosvisita=DatosVisita::findOrFail($id);     
        $datosvisita->update($request->all()); 
        //Rellenamos variables paciente y visitas para abrir vista de edicion paciente
       // $paciente=$visita->paciente;
      //  $visitas=Paciente::find($paciente->id)->visitas;   

      return redirect('/pacientes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function datosVisita($visitaId){
        
        $visita=Visita::findOrFail($visitaId);  
        $datosVisita=$visita->datosVisita;   
        return response()->json($datosVisita,200);
    }
}
