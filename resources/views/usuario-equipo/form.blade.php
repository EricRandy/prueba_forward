<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('usuario_id') }}
            {{ Form::select('usuario_id',$usuarios, $usuarioEquipo->usuario_id, ['class' => 'form-control' . ($errors->has('usuario_id') ? ' is-invalid' : ''),(is_null($usuarioEquipo->usuario_id) ?'':'readonly'), 'placeholder' => 'Usuario Id']) }}
            {!! $errors->first('usuario_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('equipo_id') }}
            {{ Form::select('equipo_id',$equipos, $usuarioEquipo->equipo_id, ['class' => 'form-control' . ($errors->has('equipo_id') ? ' is-invalid' : ''), 'placeholder' => 'Equipo Id']) }}
            {!! $errors->first('equipo_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('lider 1 es lider o 0 no es lider') }}
            {{ Form::text('lider', $usuarioEquipo->lider, ['class' => 'form-control' . ($errors->has('lider') ? ' is-invalid' : ''), 'placeholder' => 'Lider']) }}
            {!! $errors->first('lider', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>