<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        return view('home');
    }

    public function cards()
    {
        return view('cards');
    }

    public function getCardsUser()
    {
        $email = Auth::user()->email;
        /* $users = Tarea::select('tareas.nombre', 'tareas.descripcion', 'tareas.archivo')
            ->join('usuarios', 'usuarios.id', '=', 'usuarios.id')
            ->join('usuario_equipos', 'usuario_equipos.usuario_id', '=', 'usuarios.id')
            ->join('equipo_tareas', 'equipo_tareas.equipo_id', '=', 'usuario_equipos.equipo_id')
            ->where('usuarios.email', $email)
            ->get(); */

        $users =  DB::table('usuarios')
            ->select('tareas.nombre', 'tareas.descripcion', 'tareas.archivo')
            ->join('usuario_equipos', 'usuario_equipos.usuario_id', '=', 'usuarios.id')
            ->join('equipo_tareas', 'equipo_tareas.equipo_id', '=', 'usuario_equipos.equipo_id')
            ->join('tareas', 'tareas.id', '=', 'equipo_tareas.tarea_id')
            ->where('usuarios.email', $email)
            ->get();
       
        return response()->json($users);
    }
}
