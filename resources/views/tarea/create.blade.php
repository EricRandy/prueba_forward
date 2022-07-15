@extends('layouts.app')

@section('template_title')
Create Tarea
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">

        <div class="col-md-12">

            @includeif('partials.errors')

            <div class="card card-default">
                <div class="card-header">
                    <span class="card-title">Create Tarea</span>
                </div>
                @if(Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error</strong> {{ Session::get('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <div class="card-body">
                    <form method="POST" action="{{ route('tareas.store') }}" role="form" enctype="multipart/form-data">
                        @csrf

                        @include('tarea.form')

                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection