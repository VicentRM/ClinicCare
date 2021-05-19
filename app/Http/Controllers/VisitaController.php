<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visita;
use App\Models\TipoVisita;
use App\Models\MotivoVisita;
use App\Models\Paciente;
use App\Models\Calendario;
class VisitaController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $entrada=$request->all();
        $visita=Visita::create($entrada); 
        $pId=$entrada['paciente_id'];
        $visitas=Paciente::find($pId)->visitas;  
        $paciente=Paciente::find($entrada['paciente_id']);
        //Rederigimos a la pagina del paciente mediante el motodo edit paciente.
        return redirect()->action([PacientesController::class, 'edit'],$pId);
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
        $tiposvisita=TipoVisita::All();
        $motivosvisita=MotivoVisita::All();
        $visita =Visita::with('paciente','calendario')->where('paciente_id','=',$visita->paciente->id)->where('id','=',$id)->get();

        return view ('visitas/edit',['visita'=>$visita,'tiposvisita'=>$tiposvisita,'motivosvisita'=>$motivosvisita]);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        //Realizamos update
        $visita=Visita::findOrFail($id);     
        $visita->update($request->all()); 
        //Rellenamos variables paciente y visitas para abrir vista de edicion paciente
        $paciente=$visita->paciente;
        $visitas=Paciente::find($paciente->id)->visitas;   
        //Nos quedamos en la misma vista con redirect back
       // return  redirect()->back();
       return view ('pacientes.index');    
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

    public function obtenerVisitasPaciente($idPaciente){
       // $paciente=Paciente::find($idPaciente);
        //$visitas=Paciente::find($paciente->id)->visitas;
        $visitas =Visita::with('calendario','tipoVisita','motivoVisita')->get()->whereIn('paciente_id', $idPaciente);

        return response()->json([
            'visitas' => $visitas,            
            ], 200);
    }
    public function crearVisitaPaciente($idPaciente){
        $paciente=Paciente::find($idPaciente);
        $tiposVisita=TipoVisita::All();
        $motivosVisita=MotivoVisita::All();
        return view ("visitas.create",compact('paciente','tiposVisita','motivosVisita'));
       // return view ("visitas.create",compact('$paciente'));
    }
  

    public function visitaCalendario($calendarioId){

        $visita =Visita::with('calendario','paciente')->where('calendario_id','=',$calendarioId)->get();
      
        return response()->json([
            'visita' => $visita,            
            ], 200);
       
    }
}
