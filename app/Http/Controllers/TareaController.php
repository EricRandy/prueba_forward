<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * Class TareaController
 * @package App\Http\Controllers
 */
class TareaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tareas = Tarea::paginate();

        return view('tarea.index', compact('tareas'))
            ->with('i', (request()->input('page', 1) - 1) * $tareas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tarea = new Tarea();
        return view('tarea.create', compact('tarea'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->session()->flash('error', "only pdf files");
        request()->validate(Tarea::$rules);

        $file = $request->file('archivo');
        $location = 'files';
        $fileName = time() . '.' . $file->getClientOriginalName();
        $file->move($location, $fileName);

        $tarea = Tarea::create([
            'nombre' => $request->input('nombre'),
            'descripcion' => $request->input('descripcion'),
            'archivo' => $fileName
        ]);

        //$tarea = Tarea::create($request->all());

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tarea = Tarea::find($id);

        return view('tarea.show', compact('tarea'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarea = Tarea::find($id);

        return view('tarea.edit', compact('tarea'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Tarea $tarea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tarea $tarea)
    {
        request()->validate(Tarea::$rules);

        $tarea->update($request->all());

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $tarea = Tarea::find($id)->delete();

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea deleted successfully');
    }
}
