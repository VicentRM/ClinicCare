<?php

namespace App\Http\Controllers;
use App\Models\Medico;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
class MedicosController extends Controller
{
      //comprobamos que se este autenticado
      public function __construct()
      {
          $this->middleware('auth');
      } 
  
    public function index()
    {
         //Esta función nos devolverá la vista index de medicos
         return view ('medicos.index');
       
    }
    public function obtenerMedicos() {
        //Este funcion nos devolvera los medicos
       // $medicos=Medico::all()->user;

        $medicos =Medico::with('user')->get();
        foreach ($medicos as $medico) {     
         
           info( $medico->user->avatar);
          
            if($medico->user->avatar != null){
                $medico->user->avatar = "/storage/" . $medico->user->avatar;
            }      
            info( $medico->user->avatar);
        }
    
        return $medicos;
    }
    public function usuariossinasignar (){
        $usuarios=DB::table('users')
        ->whereNotIn('id', DB::table('medicos')->select('user_id'))->get();
       // $usuarios=User::all();
        return $usuarios;
    }
    public function obtenerUsuarios(){
        $usuarios=User::all();
        return $usuarios;
    }



    public function create()
    {
        //
    }

 
    public function store(Request $request)
    {
        //Esta función guardará los medicos que enviemos mediante vuejs
        $entrada=$request->all();
        $validated = $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'NIF' => 'required',
            'num_colegiado' => 'required',            
        ]);
        $medico=Medico::create($entrada);
        return $medico;
    }

    public function show($id)
    {
       //Esta función devolverá los datos de un medico que hayamos seleccionado para cargar el formulario con sus dstos
       $medico = medico::findOrFail($id);
       return $medico;
    }


    public function edit($id)
    {
        //
    }

  
    public function update(Request $request,$id)
    {
          //Esta función actualizará el medico que hayamos seleccionado
        $validated = $request->validate([
            'nombre' => 'required',
            'apellidos' => 'required',
            'NIF' => 'required',
            'num_colegiado' => 'required',            
        ]);
        $medico = Medico::findOrFail($request->id);   
        $medico->update($request->all());
        return $medico;    


    }


    public function destroy($id)
    {
          //Esta función obtendra el id del medico que hayamos seleccionado y la borrará de nuestra BD
        $medico = Medico::destroy($request->id);
        return $medico;
    }
}
