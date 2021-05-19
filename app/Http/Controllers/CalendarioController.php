<?php

namespace App\Http\Controllers;
use App\Models\Calendario;
use App\Models\User;
use App\Models\Visita;
use App\Models\TipoVisita;
use App\Models\MotivoVisita;
use App\Models\Paciente;
use App\Models\Medico;
use Illuminate\Http\Request;
use App\Http\Resources\CalendarioResource;

class CalendarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    } 

    
    public function index()

    {    
        $calendario=User::find(auth()->id())->calendario; 
        return response()->json(CalendarioResource::collection($calendario));
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
        
        $entrada=$request->all();
        //Creamos un nuevo objeto calendario    
        $nuevoEvento=new Calendario;
        $paciente=Paciente::find($entrada['paciente_id']);
        $nuevoEvento->nombre_evento=$paciente->apellidos.', '.$paciente->nombre;
        $nuevoEvento->inicio=$entrada['inicio'];
        $nuevoEvento->fin=$entrada['fin'];
        $nuevoEvento->duracion=$entrada['duracion'];
        $nuevoEvento->user_id=auth()->user()->id;   
        //Creamos el evento en el calendario y obtenemos el id creado
        $nuevoEvento->save();  

        $calendarioId = $nuevoEvento->id;
        //Creamos un nuevo objeto visita
        $nuevaVisita=new Visita;        
        $nuevaVisita->paciente_id=$entrada['paciente_id'];
       // $nuevaVisita->fechahora=$entrada['inicio'];
        $nuevaVisita->calendario_id=$calendarioId;
        $nuevaVisita->tipo_visita_id=$entrada['tipo_visita_id'];
        $nuevaVisita->motivo_visita_id=$entrada['motivo_visita_id'];
      //  $nuevaVisita->fecha=$entrada['inicio'];
        //Creamos la nueva visita en base de datos
        $nuevaVisita->save();
 

        return $entrada;
  

    
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
    public function update($id,Request $request)
    {
        //Realizamos update
        $calendario=Calendario::findOrFail($id);  
        $entrada=$request->all();
        //Creamos un nuevo objeto calendario   
        $paciente=Paciente::find($entrada['paciente_id']);
        $calendario->nombre_evento=$paciente->apellidos.', '.$paciente->nombre;
        $calendario->inicio=$entrada['inicio'];
        $calendario->fin=$entrada['fin'];
        $calendario->duracion=$entrada['duracion'];
        $calendario->user_id=auth()->user()->id;   
        //Actualizamos
        $calendario->save();     
        //$calendario->update($calendario->all());
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
        Calendario::destroy($id);
    }

    public function datosModalEvento(){
        //echo 'Some message here.';
        $medico=User::find(auth()->id())->medico;   
        $pacientes=$medico->pacientes;  
        $tiposVisita=TipoVisita::All();
        $motivosVisita=MotivoVisita::All();

        $array = [
            "pacientes" => $pacientes,
            "tipos" => $tiposVisita,
            "motivos" => $motivosVisita
        ];
        return response()->json($array,200);
    }
}

