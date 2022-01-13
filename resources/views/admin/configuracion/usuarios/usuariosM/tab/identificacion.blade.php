<div class="form-group col-md-12">
	{!! Form::open(['route' => ['usuario_m.add'],  'method' => 'post',  'autocomplete'=> 'off','files' => true, 'id'=>'registra_usuarioM' ]) !!}
<input type="hidden" name="id" value="{{ isset($medico) ? $medico->id_Medico : null }}">
    <div class="row">
        <div class="col-md-12 col-lg-7">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>{{ 'Nombres' }}</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres" autofocus onkeypress = 'return soloLetras(event)' value="{{ isset($medico) ? $medico->Nombres_Medico : null }}" required>
                </div> 
                <div class="col-md-6 mb-3">
                    <label>{{ 'Apellidos' }}</label>
                    <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellidos" onkeypress = 'return soloLetras(event)' value="{{ isset($medico) ? $medico->Apellidos_Medicos : null }}" required>
                </div>  
                <div class="col-md-6 form-group mb-3">
                    <label>{{ 'Cedula' }}</label>
                    <div class="row">
                        <div class="col-md-5">
                            {!! Form::select('prefijo',$prefijo, isset($medico) ? $medico->Prefijo_CIDNI_id : null, [
                                'placeholder' => '...', 
                                'class' => 'select2 form-control',
                                'id' => 'prefijo',
                                'required'=> 'required'
                                ]) !!}
                        </div>
                        <div class="col-md-7">
                            <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cedula" onkeypress = 'return SoloNumeros(event)' value="{{ isset($medico) ? $medico->CIDNI : null }}" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    {!! Form::label('sexo', 'Sexo:') !!}
                    {!! Form::select('sexo',$sexo, isset($medico) ? $medico->Sexo_id : null, [
                        'placeholder' => 'Seleccione', 
                        'class' => 'select2 form-control',
                        'id' => 'sexo',
                        'required' => 'required'
                        ]) !!}
                </div>
                <div class="col-md-6 mb-3">
                    <label>{{ 'Fecha de nacimiento' }}</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                         {!!
                             Form::text('fechNac', isset($medico) ? $medico->Fecha_Nacimiento_Medico : null, [
                                 'id' => 'fechNac',
                                 'placeholder'=>'Y-M-D',
                                 'class' => 'form-control pull-right datepicker',
                                 'required' =>'required'] )
                          !!}
                     </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label>{{ 'Lugar de Nacimiento' }}</label>
                    {!! Form::select('nacionalidad',$nacionalidad, isset($medico) ? $medico->Pais_id : null, [
                        'placeholder' => 'Seleccione', 
                        'class' => 'select2 form-control',
                        'id' => 'nacionalidad',
                         'required' =>'required'
                        ]) !!}
                </div>
                <div class="col-md-6 mb-3">
            {!! Form::label('estado', 'Estado:') !!}
            {!! Form::select('estado',$estado, isset($medico) ? $medico->id_Estado : null, [
                'placeholder' => 'Seleccione', 
                'class' => 'select2 form-control',
                'id' => 'estado',
                 'required' =>'required'
                ])
            !!}
        </div>
        <div class="col-md-6 mb-3">
            {!! Form::label('ciudad', 'Ciudad:') !!}
            {!! Form::select('ciudad',$ciudad, isset($medico) ? $medico->id_Ciudad : null, [
                'placeholder' => 'Seleccione', 
                'disabled' => 'disabled',
                'class' => 'select2 form-control',
                'id' => 'ciudad',
                 'required' =>'required'
                ])
            !!}
        </div>
        <div class="col-md-6 mb-3">
            {!! Form::label('municipio', 'Municipio:') !!}
            {!! Form::select('municipio',$municipio, isset($medico) ? $medico->id_Municipio : null, [
                'placeholder' => 'Seleccione',
                'disabled' => 'disabled', 
                'class' => 'select2 form-control ',
                'id' => 'municipio',
                 'required' =>'required'
                ])
            !!}
        </div>
        <div class="col-md-6 mb-3">
            {!! Form::label('parroquia', 'Parroquia:') !!}
            {!! Form::select('parroquia',$parroquia, isset($medico) ? $medico->id_Parroquia : null, [
                'placeholder' => 'Seleccione', 
                'disabled' => 'disabled',
                'class' => 'select2 form-control',
                'id' => 'parroquia',
                 'required' =>'required'
                ])
            !!}
        </div> 
                <div class="col-md-6 mb-3">
                    <label>{{ 'Estado Civil' }}</label>
                    {!! Form::select('civil',$estadoC, isset($medico) ? $medico->Civil_id : null, [
                        'placeholder' => 'Seleccione', 
                        'class' => 'select2 form-control',
                        'id' => 'civil',
                        'required' =>'required'
                        ]) !!}
                </div>
                <div class="col-md-6 mb-3">
                    <label>{{ 'Registro MPPS' }}</label>
                    <input type="text" class="form-control" name="registro" id="registro" placeholder="Registro MPPS" value="{{ isset($medico) ? $medico->Registro_MPPS : null }}"required>
                </div>
                <div class="col-md-6 mb-3">
                    <label>{{ 'Número del colegio de medicos' }}</label>
                    <input type="text" class="form-control" name="ncm" id="ncm" placeholder="Número del colegio de medicos" value="{{ isset($medico) ? $medico->Numero_Colegio_de_Medico : null }}" required>
                </div>
                <div class="col-md-6 mb-3">
                    {!! Form::label('statusm', 'Status:') !!}
                    {!! Form::select('statusm',$statusM, isset($medico) ? $medico->Status_Medico_id : null, [
                        'placeholder' => 'Seleccione', 
                        'class' => 'select2 form-control required',
                        'id' => 'statusm'
                        ]) !!}
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-5">
            <div class="row">
                <div class="col-md-12">
                    <label>{{ 'Imagen de Perfil' }}</label>
                    <input type="file" name="avatar" id="avatar">
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <a href="{{ route('usuario_m')}}" class="mt-1 btn btn-outline-secondary">
            <span class="btn-icon-wrapper pr-2 opacity-7">
             <i class="fa fa-reply-all" aria-hidden="true"></i>
            </span>{{'Volver'}}
        </a>
        <button type="submit" class="mt-1 btn btn-outline-success">
            <span class="btn-icon-wrapper pr-2 opacity-7">
             <i class="fa fa-floppy-o" aria-hidden="true"></i>
            </span>{{'Guardar'}}
        </button>
    </div> 
        {!! Form::close() !!}
</div>