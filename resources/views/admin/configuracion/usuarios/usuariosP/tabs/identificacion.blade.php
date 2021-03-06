 {!! Form::open(['route' => ['usuario_p.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
    <div class="form-group col-md-12">
        <div class="row">
            {{ Form::hidden('id', isset($paciente) ? $paciente->id_Paciente : null, ['class'=>'modal_registro_usuariop_id'] ) }}
            <div class="col-md-3 mb-3">
                <label for="validationCustom01">{{'Nombre'}}</label>
                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required autofocus="true" value="{{ isset($paciente) ? $paciente->Nombres_Paciente : null }}" maxlength="200" onkeypress="soloLetras(event)">
            </div>
            <div class="col-md-3 mb-3">
                <label for="validationCustom01">{{'Apellido'}}</label>
                <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido" required value="{{ isset($paciente) ? $paciente->Apellidos_Paciente : null }}" maxlength="100" onkeypress="soloLetras(event)">
            </div>
             <div class="col-md-3 form-group mb-3">
                <label>{{ 'Cedula' }}</label>
                <div class="row">
                    <div class="col-md-3" style="padding-right: 0.5px !important">
                        {!! Form::select('prefijo',$prefijo, isset($paciente) ? $paciente->Prefijo_CIDNI_id : null, [
                            'placeholder' => '...', 
                            'class' => 'pickerSelectClass otro',
                            'id' => 'prefijo',
                            'required'=>'required'
                            ]) !!}
                    </div>
                    <div class="col-md-9" style="padding-left: 0.5px !important">
                        <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cedula" onkeypress = 'return SoloNumeros(event)' value="{{ isset($paciente) ? $paciente->CIDNI : null }}" required maxlength="20">
                    </div>
                </div>
            </div>
            <div class="col-md-3 mb-3">
                {!! Form::label('sexo', 'Sexo:') !!}
                {!! Form::select('sexo',$sexo, isset($paciente) ? $paciente->Sexo_id : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'pickerSelectClass otro',
                    'id' => 'sexo',
                    'required'=>'required'
                    ]) !!}
            </div>
            <div class="col-md-3 mb-3">
                <label>{{ 'Fecha de nacimiento' }}</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                     {!!
                         Form::text('fechNacP', isset($paciente) ? $paciente->Fecha_Nacimiento_Paciente : null, [
                             'id' => 'fechNacP',
                             'placeholder'=>'Y-M-D',
                             'class' => 'form-control pull-right datepicker',
                            'required'=>'required'] )
                      !!}
                 </div>
            </div>
            <div class="col-md-3 mb-3">
                <label>{{ 'Lugar de Nacimiento' }}</label>
                {!! Form::select('nacionalidad',$nacionalidad, isset($paciente) ? $paciente->Pais_id : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'pickerSelectClass otro',
                    'id' => 'nacionalidad',
                    'required'=>'required'
                    ]) !!}
            </div>
            <div class="col-md-3 mb-3">
                <label>{{ 'Estado Civil' }}</label>
                {!! Form::select('civil',$estadoC, isset($paciente) ? $paciente->Civil_id : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'pickerSelectClass otro',
                    'id' => 'civil',
                    'required'=>'required'
                    ]) !!}
            </div>
            @if(isset(auth()->user()->name) && auth()->user()->name == 'Admin')
            <div class="col-md-3 mb-3">
                {!! Form::label('status', 'Status:') !!}
                {!! Form::select('status',$status, isset($paciente) ? $paciente->Status_id : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'pickerSelectClass otro',
                    'id' => 'status',
                    'required'=>'required'
                    ]) !!}
            </div>
            @endif
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
    {!! Form::close() !!}
</div>