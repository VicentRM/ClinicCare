<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Paciente;
use App\Models\Visita;
use Illuminate\Support\Facades\Storage;

class DocumentosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    } 
    public function subirdocumentos(Request $request){      
        if($request->file('file')){     
           // Subida multiple de archivos
            $files = $request->file('file');
            if(!is_array($files)){
                $files = [$files];
            }
            //REcorremos el array de archivos
            for($i=0; $i<count($files); $i++){
                $file = $files[$i];
                $filename = $file->getClientOriginalName();
                $filename= str_replace(' ', '', $filename);                
                $path=$file->storeAs('', $filename);
                //Por cada archivo que subimos creamos un registro en la tabla documentos de la base de datos y lo asociamos al paciente
                $nuevo_documento=new Documento;
                $nuevo_documento->url=$filename;
                $nuevo_documento->descripcion=$filename;
                $nuevo_documento->{$request->vinculo_doc}=$request->id;
                $nuevo_documento->save();
            }
            return response()->json(['message'=>'arhivo subido'], 200);
        }
        else{
            return response()->json(['message'=>'error subiendo archivo'], 503);
        }
    }
    
    
    public function obtenerdocumentos(Request $request){ 
        switch ($request->vinculo_doc) {
            case 'paciente_id':
                $documentos=Paciente::find($request->id)->documentos; 
                break;
            case 'visita_id':
                $documentos=Visita::find($request->id)->documentos; 
                break;
        }
           
        return $documentos;
    }
    public function abrirdocumento($id){
        
        $documento=Documento::find($id);    
        return Storage::download($documento->url);
          // Storage::disk('local')->put('example.txt', 'Contents');          
                
              
             //  $local_path = config('filesystems.disks.local.root') . DIRECTORY_SEPARATOR . $documento->url;
            //    return response()->file($local_path);          
        

    }
    public function eliminardocumento($id){
        $documento=Documento::find($id);    
        $documento->delete();
        Storage::delete($documento->url);
    }
    
}
