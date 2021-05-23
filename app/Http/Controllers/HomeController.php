<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Documento;
use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $usuario = Auth::user();

        $usuario->avatar =
            $usuario->avatar != null ? Storage::url($usuario->avatar) :"";

        $usuario->medico=
            $usuario->medico != null ? User::find($usuario->id)->medico   :"";

        return view('home',[
            "user" => $usuario]);
    }
    public function config(){
        return view ('config');
    }
   
 
}
