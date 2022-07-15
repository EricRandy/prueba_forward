<?php

namespace App\Http\Controllers;

use App\Models\EquipoTarea;
use App\Models\Equipo;
use App\Models\Tarea;
use Countable;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;
use function PHPUnit\Framework\isNull;

/**
 * Class EquipoTareaController
 * @package App\Http\Controllers
 */
class EquipoTareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $equipoTareas = EquipoTarea::paginate();

        return view('equipo-tarea.index', compact('equipoTareas'))
            ->with('i', (request()->input('page', 1) - 1) * $equipoTareas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $equipoTarea = new EquipoTarea();

        $equipos = Equipo::pluck('nombre', 'id');
        $tareas = Tarea::pluck('nombre', 'id');

        return view('equipo-tarea.create', compact('equipoTarea', 'equipos', 'tareas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate(EquipoTarea::$rules);

        $equipoTarea = EquipoTarea::firstWhere(
            [
                'equipo_id' => $request->input('equipo_id'),
                'tarea_id' => $request->input('tarea_id')
            ]
        );

        if (is_null($equipoTarea)) {
            $equipoTarea = EquipoTarea::create($request->all());

            return redirect()->route('equipo-tarea.index')
                ->with('success', 'EquipoTarea created successfully.');
        } else {
            return redirect()->route('equipo-tarea.create')->with('error', 'this task is already assigned to the selected team');
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
        $equipoTarea = EquipoTarea::find($id);

        return view('equipo-tarea.show', compact('equipoTarea'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $equipoTarea = EquipoTarea::find($id);

        $equipos = Equipo::pluck('nombre', 'id');
        $tareas = Tarea::pluck('nombre', 'id');

        return view('equipo-tarea.edit', compact('equipoTarea', 'equipos', 'tareas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  EquipoTarea $equipoTarea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EquipoTarea $equipoTarea)
    {
        request()->validate(EquipoTarea::$rules);

        $exists = EquipoTarea::firstWhere(
            [
                'equipo_id' => $request->input('equipo_id'),
                'tarea_id' => $request->input('tarea_id')
            ]
        );

        if (is_null($exists)) {
            $equipoTarea->update($request->all());

            return redirect()->route('equipo-tarea.index')
                ->with('success', 'EquipoTarea updated successfully');
        } else {
            return redirect()->route('equipo-tarea.edit', [$equipoTarea->id])->with('error', 'this task is already assigned to the selected team');
        }
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $equipoTarea = EquipoTarea::find($id)->delete();

        return redirect()->route('equipo-tarea.index')
            ->with('success', 'EquipoTarea deleted successfully');
    }
}
