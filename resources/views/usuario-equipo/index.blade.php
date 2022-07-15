@extends('layouts.app')

@section('template_title')
Usuario Equipo
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div style="display: flex; justify-content: space-between; align-items: center;">

                        <span id="card_title">
                            {{ __('Usuario Equipo') }}
                        </span>

                        <div class="float-right">
                            <a href="{{ route('usuario-equipo.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                {{ __('Create New') }}
                            </a>
                        </div>
                    </div>
                </div>
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
                @endif

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead class="thead">
                                <tr>
                                    <th>No</th>

                                    <th>Usuario</th>
                                    <th>Equipo</th>
                                    <th>Lider</th>

                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarioEquipos as $usuarioEquipo)
                                <tr>
                                    <td>{{ ++$i }}</td>

                                    <td>{{ $usuarioEquipo->usuario->nombre . ' ' . $usuarioEquipo->usuario->primer_apellido . ' ' . $usuarioEquipo->usuario->segundo_apellido}}</td>
                                    <td>{{ $usuarioEquipo->equipo->nombre }}</td>
                                    <td>{{ $usuarioEquipo->lider == 0 ? 'No es lider' : 'Es lider' }}</td>

                                    <td>
                                        <form action="{{ route('usuario-equipo.destroy',$usuarioEquipo->id) }}" method="POST">
                                            <a class="btn btn-sm btn-primary " href="{{ route('usuario-equipo.show',$usuarioEquipo->id) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                            <a class="btn btn-sm btn-success" href="{{ route('usuario-equipo.edit',$usuarioEquipo->id) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {!! $usuarioEquipos->links() !!}
        </div>
    </div>
</div>
@endsection