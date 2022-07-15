@extends('layouts.app')

@section('template_title')
    {{ $usuarioEquipo->name ?? 'Show Usuario Equipo' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Usuario Equipo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('usuario-equipo.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Usuario Id:</strong>
                            {{ $usuarioEquipo->usuario_id }}
                        </div>
                        <div class="form-group">
                            <strong>Equipo Id:</strong>
                            {{ $usuarioEquipo->equipo_id }}
                        </div>
                        <div class="form-group">
                            <strong>Lider:</strong>
                            {{ $usuarioEquipo->lider }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
