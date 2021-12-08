<div class="form-group col-md-12">
    {!! Form::open(['route' => ['usuario_p.direccion'],  'method' => 'post',  'autocomplete'=> 'off', 'id'=>'registra_usuarioP' ]) !!}

    
    <input type="hidden" name="idP" value="{{ isset($paciente) ? $paciente->id_Paciente : null }}" readonly>
    <input type="hidden" name="id" id="id" value="{{ isset($direccion) ? $direccion->id_Direccion_Paciente : 0 }}" readonly>

    <div class="row">
        <div class="col-md-6 mb-3">
            {!! Form::label('estado', 'Estado:') !!}
            {!! Form::select('estado',$estado, isset($direccion) ? $direccion->Estado_id : null, [
                'placeholder' => 'Seleccione', 
                'class' => 'select2 form-control required',
                'id' => 'estado'
                ])
            !!}
        </div>
        <div class="col-md-6 mb-3">
            {!! Form::label('ciudad', 'Ciudad:') !!}
            {!! Form::select('ciudad',$ciudad, isset($direccion) ? $direccion->Cuidad_id : null, [
                'placeholder' => 'Seleccione', 
                'disabled' => 'disabled',
                'class' => 'select2 form-control required',
                'id' => 'ciudad'
                ])
            !!}
        </div>
        <div class="col-md-6 mb-3">
            {!! Form::label('municipio', 'Municipio:') !!}
            {!! Form::select('municipio',$municipio, isset($direccion) ? $direccion->Municipio_id : null, [
                'placeholder' => 'Seleccione',
                'disabled' => 'disabled', 
                'class' => 'select2 form-control required',
                'id' => 'municipio'
                ])
            !!}
        </div>
        <div class="col-md-6 mb-3">
            {!! Form::label('parroquia', 'Parroquia:') !!}
            {!! Form::select('parroquia',$parroquia, isset($direccion) ? $direccion->Parroquia_id : null, [
                'placeholder' => 'Seleccione', 
                'disabled' => 'disabled',
                'class' => 'select2 form-control required',
                'id' => 'parroquia'
                ])
            !!}
        </div> 
    	<div class="col-md-12 mb-3">
            <label>{{ 'Dirección' }}</label>
            <textarea name="direccion" id="direccion" class="form-control" rows="3">{{ isset($direccion) ? $direccion->Direccion : null }}</textarea>
        </div> 
        <div class="col-md-6 mb-3">
            <label>{{ 'Número de casa' }}</label>
            <input type="text" class="form-control" name="ncasa" id="ncasa" placeholder="Número de casa" maxlength="50" value="{{ isset($direccion) ? $direccion->Numero_Casa : null }}">
        </div> 
        <div class="col-md-6 mb-3">
            <label>{{ 'Teléfono' }}</label>
            <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Teléfono" maxlength="50" value="{{ isset($direccion) ? $direccion->Telefono : null }}">
        </div>
        <div class="col-md-6 mb-3">
            <label>{{ 'Celular' }}</label>
            <input type="text" class="form-control" name="celular" id="celular" placeholder="Celular" maxlength="50" value="{{ isset($direccion) ? $direccion->Celular : null }}">
        </div>
        <div class="col-md-6 mb-3">
            <label>{{ 'Correo' }}</label>
            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo" maxlength="50" value="{{ isset($direccion) ? $direccion->Correo : null }}">
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