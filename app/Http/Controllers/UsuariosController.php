<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
        return view('usuarios.index');
    }
    public function obtenerUsuarios(){
        $usuarios=User::all();
        $usuarios =User::with('role')->get();
       // $url = Storage::url('file.jpg');
       foreach ($usuarios as $usuario) {
     
        $usuario->avatar != null ? Storage::url($usuario->avatar) :"";
    }

        return $usuarios;
    }
    
    public function obtenerRoles(){
        $roles=Role::all();
        return $roles;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*User::create($request->all());
        return redirect('/admin/users');*/
        $entrada=$request->all();
        if($file=$request->file('avatar')){            
            $filename = $file->getClientOriginalName();
            $filename= str_replace(' ', '', $filename);                
            $path=$file->storeAs('', $filename);
            $entrada['avatar']=$path;
        }
        $entrada['password']=bcrypt($request->passord);
        User::create($entrada);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Esta función devolverá los datos de un usuario que hayamos seleccionado para cargar el formulario con sus dstos
       $usuario = User::findOrFail($id);
       //$usuario = Auth::user();
       $usuario->avatar =
            $usuario->avatar != null ? "/storage/" . $usuario->avatar : "";

    
       //$usuario->avatar="caca";
       return $usuario;
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
        $user=User::findOrFail($id);
        //return view ('admin/users/edit',compact('user'));
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
        $usuario=User::findOrFail($id);
        $entrada=$request->all();        
        info($entrada);
        if($file=$request->file('avatar')){            
            $filename = $file->getClientOriginalName();
            $filename= str_replace(' ', '', $filename); 
            $file->move('images',$filename);               
            $path=$file->storeAs('', $filename);
            $entrada['avatar']=$path;
        }
        $entrada['password']=bcrypt($request->password);
        $usuario->update($entrada);

        return $usuario;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        return redirect('/admin/users');
    }

    public function updateAvatar(Request $request,$id)
    {
        $user = User::find($id);
        //$user=$request->user_id;
        //info($request->all());
        // almacena el avatar en la carpeta /storage/app/avatars
        // y almacena en la BBD en nombre asignado
        if ($request->file("avatar")) {
            $userPhoto = $request->file("avatar")->store("avatars");
            $profile = User::findOrFail($user->id);
            $profile->avatar = $userPhoto;
            $type = strrchr($profile->avatar, ".");
            $profile->avatar_type = empty($type) ? null : substr($type, 1);

            $profile->save();

            return response()->json([
                "path" => asset("/storage/" . $userPhoto),
            ]);
        }
    }
    public function removeAvatar(Request $request)
    {
        $user = Auth::user();
        $profile = User::findOrFail($user->id);

        $file = $profile->avatar;

        $profile->avatar = null;
        $profile->avatar_type = null;
        $profile->save();

        if (\Storage::disk("local")->exists($file)) {
            \Storage::disk("local")->delete($file);
        } else {
            return response("File does not exists", 409);
        }

        return response("Avatar removed", 200);
    }

}
