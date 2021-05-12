<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Paciente;
use App\Models\Medico;
use App\Models\Visita;

class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
       //Obtenemos primero el medico autenticado como usuario
       $medico=User::find(auth()->id())->medico;     
       //Llenamos el array de pacientes que le pasamos a la vista y paginamos de 20 en 20    
        $pacientes=$medico->pacientes()->paginate(20);        
        return view ("pacientes.index",compact("pacientes"));
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
        $entrada['NHC']=($ultPaciente->NHC)+1;    
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
        return view ('pacientes/edit',compact('paciente','visitas'));
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

        $paciente=Paciente::findOrFail($id);
        $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required'
        ]);       
        $paciente->update($request->all());
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
        $paciente=Paciente::findOrFail($id);
        $paciente->delete();
        return redirect('/pacientes');
    }
    public function pacientesMedico(){
        //echo 'Some message here.';
        $medico=User::find(auth()->id())->medico;   
        $pacientes=$medico->pacientes;
        $visitas=Paciente::find(10)->visitas()->paginate(1);
        return response()->json($visitas,200);
    }
}
