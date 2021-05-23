<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Visita;
use App\Models\Documento;

use DataTables;
class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
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
        return view ('pacientes.index');    
    }


    public function obtenerPacientesMedico(){
        //Obtenemos primero el medico autenticado como usuario
       $medico=User::find(auth()->id())->medico;     
       //Llenamos el array de pacientes que le pasamos a la vista y paginamos de 20 en 20    
        $pacientes=$medico->pacientes()->paginate(20);   
        return $pacientes;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ("pacientes.create");
        
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
        $ultPaciente=Paciente::latest('NHC')->first();
        if(is_null($ultPaciente)){  //Comprobamos si la variable es null, sera null si no existen pacientes en la base de datos          
            $entrada['NHC']=1;
        }else{
            $entrada['NHC']=($ultPaciente->NHC)+1;    
        }
        $p=Paciente::create($entrada);
        $pacienteId=Paciente::findOrFail($p->id);
        $medicoId=User::find(auth()->id())->medico; 
        $pacienteId->medicos()->attach($medicoId);    
   
            return redirect('/pacientes');
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
        $paciente=Paciente::findOrFail($id);
        $visitas=Paciente::find($paciente->id)->visitas;
        $visitas=Visita::with('calendario','tipoVisita','motivoVisita')->get()->whereIn('paciente_id', $paciente->id);
        $documentos=Paciente::find($paciente->id)->documentos;
       return view ('pacientes/edit',['paciente'=>$paciente,'visitas'=>$visitas,'documentos'=>$documentos]);
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
        $paciente=Paciente::findOrFail($id);
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required'
        ]);       
        $paciente->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paciente=Paciente::findOrFail($id);
        $paciente->delete();
       // return redirect('/pacientes');
    }
   
}
