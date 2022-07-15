<?php

namespace App\Http\Controllers;

use App\Models\UsuarioEquipo;
use App\Models\Usuario;
use App\Models\Equipo;
use Illuminate\Http\Request;

/**
 * Class UsuarioEquipoController
 * @package App\Http\Controllers
 */
class UsuarioEquipoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarioEquipos = UsuarioEquipo::paginate();

        return view('usuario-equipo.index', compact('usuarioEquipos'))
            ->with('i', (request()->input('page', 1) - 1) * $usuarioEquipos->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $usuarioEquipo = new UsuarioEquipo();

        $usuarios = Usuario::pluck('nombre', 'id');
        $equipos = Equipo::pluck('nombre', 'id');

        return view('usuario-equipo.create', compact('usuarioEquipo', 'usuarios', 'equipos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(UsuarioEquipo::$rules);

        $user = UsuarioEquipo::firstWhere(
            [
                'usuario_id' => $request->input('usuario_id'),
                'equipo_id' => $request->input('equipo_id')
            ]
        );

        $lider = UsuarioEquipo::firstWhere(
            [
                'lider' => '1',
                'equipo_id' => $request->input('equipo_id')
            ]
        );

        if ((is_null($user) && is_null($lider)) ||
            (is_null($user) && (is_null($lider) || $request->input('lider') == '0'))
        ) {
            $usuarioEquipo = UsuarioEquipo::create($request->all());

            return redirect()->route('usuario-equipo.index')
                ->with('success', 'UsuarioEquipo created successfully.');
        } else {
            return redirect()->route('usuario-equipo.create')->with(
                'error',
                !is_null($user) ? 'this user is already assigned to selected team' : 'this team already has a leader assigned'
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $usuarioEquipo = UsuarioEquipo::find($id);



        return view('usuario-equipo.show', compact('usuarioEquipo'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuarioEquipo = UsuarioEquipo::find($id);

        $usuarios = Usuario::pluck('nombre', 'id');
        $equipos = Equipo::pluck('nombre', 'id');

        return view('usuario-equipo.edit', compact('usuarioEquipo', 'usuarios', 'equipos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  UsuarioEquipo $usuarioEquipo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsuarioEquipo $usuarioEquipo)
    {
        request()->validate(UsuarioEquipo::$rules);

        $user = UsuarioEquipo::firstWhere(
            [
                'usuario_id' => $request->input('usuario_id'),
                'equipo_id' => $request->input('equipo_id')
            ]
        );
        $user = is_null($user)  ? true : ($user->equipo_id == $usuarioEquipo->equipo_id ? true : false);
        if ($user) {

            if ($request->input('lider') == 1) {
                $lider = UsuarioEquipo::firstWhere(
                    [
                        'lider' => '1',
                        'equipo_id' => $request->input('equipo_id')
                    ]
                );
                if (!is_null($lider)) {
                    $lider->lider = 0;
                    $lider->update();
                }
            }

            $usuarioEquipo->update($request->all());

            return redirect()->route('usuario-equipo.index')
                ->with('success', 'UsuarioEquipo updated successfully');
        } else {
            return redirect()->route('usuario-equipo.edit', [$usuarioEquipo->id])->with('error', 'this user is already assigned to selected team');
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $usuarioEquipo = UsuarioEquipo::find($id)->delete();

        return redirect()->route('usuario-equipo.index')
            ->with('success', 'UsuarioEquipo deleted successfully');
    }
}
