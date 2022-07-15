<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('equipo_id') }}
            {{ Form::select('equipo_id',$equipos, $equipoTarea->equipo_id, ['class' => 'form-control' . ($errors->has('equipo_id') ? ' is-invalid' : ''), 'placeholder' => 'Equipo Id']) }}
            {!! $errors->first('equipo_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('tarea_id') }}
            {{ Form::select('tarea_id',$tareas, $equipoTarea->tarea_id, ['class' => 'form-control' . ($errors->has('tarea_id') ? ' is-invalid' : ''), 'placeholder' => 'Tarea Id']) }}
            {!! $errors->first('tarea_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>