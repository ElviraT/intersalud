<div class="form-group col-md-12">
    {!! Form::open(['route' => ['usuario_p.login'],  'method' => 'post',  'autocomplete'=> 'off', 'id'=>'registra_usuarioP' ]) !!}

    <input type="hidden" name="nombre_usuario" value="{{ isset($paciente) ? $paciente->Nombres_Paciente .' '. $paciente->Apellidos_Paciente : null }}">
    <input type="hidden" name="id" value="{{ isset($paciente) ? $paciente->id_Paciente : null }}">
    <input type="hidden" name="idL" value="{{ isset($login) ? $login->id_login_Pacientes : null }}">

    <input type="hidden" name="status" value="{{ isset($paciente) ? $paciente->Status_id : null }}">

    <div class="row">
        <div class="col-md-4 mb-3">
            <label>{{ 'Correo' }}</label>
            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo" value="{{ isset($login) ? $login->Correo : null }}" required>
        </div> 
        <div class="col-md-4 mb-3">
            <label>{{ 'Contraseña' }}</label>
            <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Contraseña">
        </div>
        <div class="col-md-4 mb-3">
            <label>{{ 'Confirma Contraseña' }}</label>
            <input type="password" class="form-control" name="contrasena2" id="contrasena2" placeholder="Confirma Contraseña">
        </div>
    </div>

    <div class="modal-footer">
        <a href="{{ route('usuario_p')}}" class="mt-1 btn btn-outline-secondary">
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