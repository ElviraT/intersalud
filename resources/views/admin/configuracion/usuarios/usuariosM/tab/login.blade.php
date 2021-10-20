<div class="form-group col-md-12">
	{!! Form::open(['route' => ['usuario_m.login'],  'method' => 'post',  'autocomplete'=> 'off', 'id'=>'registra_usuarioM' ]) !!}

    <input type="hidden" name="nombre_usuario" value="{{ isset(Session::get('medico')->Nombres_Medico) ? Session::get('medico')->Nombres_Medico .' '. Session::get('medico')->Apellidos_Medicos : null }}">
    <input type="hidden" name="id" value="{{ isset(Session::get('medico')->Nombres_Medico) ? Session::get('medico')->id_Medico : null }}">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label>{{ 'Correo' }}</label>
            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo">
        </div> 
        <div class="col-md-6 mb-3">
            <label>{{ 'Contraseña' }}</label>
            <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Contraseña">
        </div>
        <div class="col-md-6 mb-3">
            <label>{{ 'Confirma Contraseña' }}</label>
            <input type="password" class="form-control" name="contrasena2" id="contrasena2" placeholder="Confirma Contraseña">
        </div>
        <div class="col-md-6 mb-3">
            <label>{{ 'Nivel' }}</label>
            <input type="text" class="form-control" name="nivel" id="nivel" placeholder="Nivel">
        </div>
    </div>

    <div class="modal-footer">
        <a href="{{ route('usuario_m')}}" class="mt-1 btn btn-outline-secondary">
            <span class="btn-icon-wrapper pr-2 opacity-7">
             <i class="fa fa-reply-all" aria-hidden="true"></i>
            </span>{{'Cancelar'}}
        </a>
        <button type="submit" class="mt-1 btn btn-outline-success" id="btnusuario">
            <span class="btn-icon-wrapper pr-2 opacity-7">
             <i class="fa fa-floppy-o" aria-hidden="true"></i>
            </span>{{'Guardar'}}
        </button>
    </div> 
        {!! Form::close() !!}
</div>