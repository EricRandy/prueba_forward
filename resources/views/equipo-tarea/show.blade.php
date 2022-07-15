@extends('layouts.app')

@section('template_title')
    {{ $equipoTarea->name ?? 'Show Equipo Tarea' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Equipo Tarea</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('equipo-tarea.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Equipo Id:</strong>
                            {{ $equipoTarea->equipo_id }}
                        </div>
                        <div class="form-group">
                            <strong>Tarea Id:</strong>
                            {{ $equipoTarea->tarea_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
