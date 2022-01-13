<div class="form-group col-md-12">
    {!! Form::open(['route' => ['usuario_a.login'],  'method' => 'post',  'autocomplete'=> 'off', 'id'=>'registra_usuarioA' ]) !!}

    <input type="hidden" name="nombre_usuario" value="{{ isset($asistente) ? $asistente->Nombre_Asistente .' '. $asistente->Apellidos_Asistente : null }}">

    <input type="hidden" name="idM" value="{{ isset($asistente) ? $asistente->id_Medico : null }}">
    <input type="hidden" name="id" value="{{ isset($asistente) ? $asistente->id_asistente : null }}">

    <input type="hidden" name="idL" value="{{ isset($login) ? $login->id_Login_Trabajador : null }}">

    <input type="hidden" name="status" value="{{ isset($asistente) ? $asistente->Status_id : null }}">

    <div class="row">
        <div class="col-md-6 mb-3">
            <label>{{ 'Correo' }}</label>
            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo" value="{{ isset($login) ? $login->Correo : null }}" required>
        </div> 
        <div class="col-md-6 mb-3">
            <label>{{ 'Contraseña' }}</label>
            <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Contraseña" required>
        </div>
        <div class="col-md-6 mb-3">
            <label>{{ 'Confirma Contraseña' }}</label>
            <input type="password" class="form-control" name="contrasena2" id="contrasena2" placeholder="Confirma Contraseña" required>
        </div>
        @can('rol')
        <div class="col-md-6 mb-3">
            {!! Form::label('rol', 'Rol:') !!}
            {!! Form::select('rol',$roles, isset($rol[0]) ? $rol[0]->role_id : null, [
                'placeholder' => 'Seleccione', 
                'class' => 'select2 form-control',
                'id' => 'rol',
                'required'=>'required'
                ]) !!}
        </div>
        @endcan
    </div>

    <div class="modal-footer">
        <a href="{{ route('usuario_a')}}" class="mt-1 btn btn-outline-secondary">
            <span class="btn-icon-wrapper pr-2 opacity-7">
             <i class="fa fa-reply-all" aria-hidden="true"></i>
            </span>{{'Volver'}}
        </a>
        <button type="submit" class="mt-1 btn btn-outline-success" id="btnusuario">
            <span class="btn-icon-wrapper pr-2 opacity-7">
             <i class="fa fa-floppy-o" aria-hidden="true"></i>
            </span>{{'Guardar'}}
        </button>
    </div> 
        {!! Form::close() !!}
</div>