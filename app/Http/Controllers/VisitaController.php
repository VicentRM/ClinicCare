<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visita;
use App\Models\TipoVisita;
use App\Models\MotivoVisita;
use App\Models\Paciente;
class VisitaController extends Controller
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
        $visita=Visita::findOrFail($id);       
        $tiposVisita=TipoVisita::All();
        $motivosVisita=MotivoVisita::All();

        $datosVisita=$visita->datosVisita;
        return view ('visitas/edit',compact('visita','tiposVisita','motivosVisita','datosVisita'));
        
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
        //Realizamos update
        $visita=Visita::findOrFail($id);     
        $visita->update($request->all()); 
        //Rellenamos variables paciente y visitas para abrir vista de edicion paciente
        $paciente=$visita->paciente;
        $visitas=Paciente::find($paciente->id)->visitas;   

        return view ('pacientes/edit',compact('paciente','visitas'));
       
        
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
}
