<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoVisita;
class TipoVisitasController extends Controller
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
        $tipos=TipoVisita::all();
        return $tipos;
    }
    public function obtenertipos(){
        $tipos=TipoVisita::all();
        return $tipos;
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
        TipoVisita::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tipo = TipoVisita::findOrFail($id);
       return $tipo;
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
        $tipo=TipoVisita::findOrFail($id);     
         $tipo->update($request->all()); 
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
            $tipo=TipoVisita::findOrFail($id);
            $tipo->delete();
        
        }catch (\Illuminate\Database\QueryException $e){          
           // return response($e,500);
            return response()->json([
                'status' => 'Ocurrio un error!',
                'msg' => 'Hay visitas con este tipo de visita.',
            ],400);
        }
    }
}

