 {!! Form::open(['route' => ['usuario_a.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
    <div class="form-group col-md-12">
        <div class="row">
            {{ Form::hidden('id', isset($asistente) ? $asistente->id_asistente : null, ['class'=>'modal_registro_usuarioa_id'] ) }}
            <div class="col-md-4 mb-3">
                <label for="validationCustom01">{{'Nombre'}}</label>
                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required autofocus="true" value="{{ isset($asistente) ? $asistente->Nombre_Asistente : null }}" maxlength="150">
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom01">{{'Apellido'}}</label>
                <input type="text" name="apellido" class="form-control" id="apellido" placeholder="Apellido" required value="{{ isset($asistente) ? $asistente->Apellidos_Asistente : null }}" maxlength="150">
            </div>
             <div class="col-md-4 form-group mb-3">
                <label>{{ 'Cedula' }}</label>
                <div class="row">
                    <div class="col-md-3">
                        {!! Form::select('prefijo',$prefijo, isset($asistente) ? $asistente->Prefijo_CIDNI_id : null, [
                            'placeholder' => '...', 
                            'class' => 'select2 form-control',
                            'id' => 'prefijo',
                            'required'=>'required'
                            ]) !!}
                    </div>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cedula" onkeypress = 'return SoloNumeros(event)' value="{{ isset($asistente) ? $asistente->CIDNI : null }}" required maxlength="20">
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                {!! Form::label('sexo', 'Sexo:') !!}
                {!! Form::select('sexo',$sexo, isset($asistente) ? $asistente->Sexo_id : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control required',
                    'id' => 'sexo',
                    'required'=>'required'
                    ]) !!}
            </div>
            <div class="col-md-4 mb-3">
                <label>{{ 'Fecha de nacimiento' }}</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                     {!!
                         Form::text('fechNacA', isset($asistente) ? $asistente->Fecha_Nacimiento_Asistente : null, [
                             'id' => 'fechNacA',
                             'placeholder'=>'Y-M-D',
                             'class' => 'form-control pull-right datepicker',
                             'required'=>'required'] )
                      !!}
                 </div>
            </div>
            <div class="col-md-4 mb-3">
                <label>{{ 'Lugar de Nacimiento' }}</label>
                {!! Form::select('nacionalidad',$nacionalidad, isset($asistente) ? $asistente->Pais_id : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control',
                    'id' => 'nacionalidad',
                    'required'=>'required'
                    ]) !!}
            </div>
            <div class="col-md-4 mb-3">
                <label>{{ 'Estado Civil' }}</label>
                {!! Form::select('civil',$estadoC, isset($asistente) ? $asistente->Civil_id : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control',
                    'id' => 'civil',
                    'required'=>'required'
                    ]) !!}
            </div>
            <div class="col-md-4 mb-3">
                {!! Form::label('status', 'Status:') !!}
                {!! Form::select('status',$status, isset($asistente) ? $asistente->Status_id : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control',
                    'id' => 'status',
                    'required'=>'required'
                    ]) !!}
            </div>
        </div>
    </div>
<div class="modal-footer">
    <a href="{{ route('usuario_a')}}" class="mt-1 btn btn-outline-secondary">
        <span class="btn-icon-wrapper pr-2 opacity-7">
         <i class="fa fa-reply-all" aria-hidden="true"></i>
        </span>{{'Volver'}}
    </a>
    <button type="submit" class="mt-1 btn btn-outline-success" id="btnusuarioI">
        <span class="btn-icon-wrapper pr-2 opacity-7">
         <i class="fa fa-floppy-o" aria-hidden="true"></i>
        </span>{{'Guardar'}}
    </button>
    {!! Form::close() !!}
</div>