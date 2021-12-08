<div class="row">
  <div class="col-md-12">
       {!! Form::open(['route' => ['usuario_pe.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
    <div class="form-group col-md-12">
        <div class="row">
            {{ Form::hidden('id', isset($paciente) ? $paciente->id_Pacientes_Especiales : null, ['class'=>'modal_registro_usuariop_id'] ) }}
            <input type="hidden" name="idP" value="{{$idp}}">
            <div class="col-md-6 mb-3">
                <label for="validationCustom01">{{'Parentesco'}}</label>
                <input type="text" name="parentesco" class="form-control" id="Parentesco" placeholder="parentesco" required value="{{ isset($paciente) ? $paciente->Parentesco_Familiar : null }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom01">{{'Nombre'}}</label>
                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required autofocus="true" value="{{ isset($paciente) ? $paciente->Nombre_Paciente_Especial : null }}">
            </div>
            <div class="col-md-6 mb-3">
                <label for="validationCustom01">{{'Apellido'}}</label>
                <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido" required value="{{ isset($paciente) ? $paciente->Apellido_Paciente_Especial : null }}">
            </div>
             <div class="col-md-6 form-group mb-3">
                <label>{{ 'Cedula' }}</label>
                <div class="row">
                    <div class="col-md-5">
                        {!! Form::select('prefijo',$prefijo, isset($paciente) ? $paciente->Prefijo_CIDNI_id : null, [
                            'placeholder' => '...', 
                            'class' => 'select2 form-control',
                            'id' => 'prefijo'
                            ]) !!}
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cedula" onkeypress = 'return SoloNumeros(event)' value="{{ isset($paciente) ? $paciente->CIDNI : null }}">
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                {!! Form::label('sexo', 'Sexo:') !!}
                {!! Form::select('sexo',$sexo, isset($paciente) ? $paciente->Sexo_id : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control required',
                    'id' => 'sexo'
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
                         Form::text('fechNacPE', isset($paciente) ? $paciente->Fecha_Nacimiento_Paciente_Especial : null, [
                             'id' => 'fechNacPE',
                             'placeholder'=>'Y-M-D',
                             'class' => 'form-control pull-right datepicker'] )
                      !!}
                 </div>
            </div>
            <div class="col-md-6 mb-3">
                <label>{{ 'Lugar de Nacimiento' }}</label>
                {!! Form::select('nacionalidad',$nacionalidad, isset($paciente) ? $paciente->Pais_id : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control required',
                    'id' => 'nacionalidad'
                    ]) !!}
            </div>
            <div class="col-md-6 mb-3">
                <label>{{'Paciente Infantil'}}</label>
                <input type="checkbox" name="pi" id="pi" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs" class="form-control checkbox" @if($paciente->Paciente_Infantil == 1) checked @endif> 
            </div>
            <div class="col-md-6 mb-3">
                <label>{{'Paciente Mayor'}}</label>
                <input type="checkbox" name="pm" id="pm" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs" class="form-control checkbox" @if($paciente->Paciente_Mayor == 1) checked @endif> 
            </div>
            <div class="col-md-6 mb-3">
                <label>{{'Tiene Discapacidad'}}</label>
                <input type="checkbox" name="pd" id="pd" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs" class="form-control checkbox" @if($paciente->Paciente_Discapacidad == 1) checked @endif> 
            </div>
            <div class="col-md-6 mb-3">
                <label>{{'Nota'}}</label>
                <textarea class="form-control" id="nota" name="nota" rows="3">{{isset($paciente) ? $paciente->Nota : null}}</textarea>                
            </div>
            <div class="col-md-6 mb-3">
                <label>{{ 'Estado Civil' }}</label>
                {!! Form::select('civil',$estadoC, isset($paciente) ? $paciente->Civil_id : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control required',
                    'id' => 'civil'
                    ]) !!}
            </div>
            <div class="col-md-6 mb-3">
                {!! Form::label('status', 'Status:') !!}
                {!! Form::select('status',$status, isset($paciente) ? $paciente->Status_id : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control required',
                    'id' => 'status'
                    ]) !!}
            </div>
        </div>
    </div>
<div class="modal-footer">
    <a href="{{ route('usuario_pe', $idp)}}" class="mt-1 btn btn-outline-secondary">
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
  </div>
</div>    