 {!! Form::open(['route' => ['usuario_g.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
    <div class="form-group col-md-12">
        <div class="row">
            {{ Form::hidden('id', isset($general) ? $general->id : null, ['class'=>'modal_registro_usuarioG_id'] ) }}
            <div class="col-md-4 mb-3">
                <label for="validationCustom01">{{'Nombre y Apellido'}}</label>
                <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre y Apellido" required autofocus="true" value="{{ isset($general) ? $general->nombre : null }}" maxlength="200">
            </div>
             <div class="col-md-4 form-group mb-3">
                <label>{{ 'Cedula' }}</label>
                <div class="row">
                    <div class="col-md-3" style="padding-right: 0.5px !important">
                        {!! Form::select('id_prefijo_dni',$prefijo, isset($general) ? $general->id_prefijo_dni : null, [
                            'placeholder' => '...', 
                            'class' => 'pickerSelectClass',
                            'id' => 'id_prefijo_dni',
                            'required'=>'required'
                            ]) !!}
                    </div>
                    <div class="col-md-9" style="padding-left: 0.5px !important">
                        <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cedula" onkeypress = 'return SoloNumeros(event)' value="{{ isset($general) ? $general->cedula : null }}" required maxlength="20">
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                {!! Form::label('sexo', 'Sexo:') !!}
                {!! Form::select('id_sexo',$sexo, isset($general) ? $general->id_sexo : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'pickerSelectClass',
                    'id' => 'id_sexo',
                    'required'=>'required'
                    ]) !!}
            </div>
            <div class="col-md-4 mb-3">
                <label>{{ 'Fecha de Nacimiento' }}</label>
                  <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                        </span>
                    </div>
                     {!!
                         Form::text('fecha_nac', isset($general) ? $general->fecha_nac : null, [
                             'id' => 'fecha_nac',
                             'placeholder'=>'Y-M-D',
                             'class' => 'form-control pull-right datepicker',
                            'required'=>'required'] )
                      !!}
                 </div>
            </div>
            <div class="col-md-4 mb-3">
                <label for="validationCustom01">{{'Teléfono'}}</label>
                <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Telefono" value="{{ isset($general) ? $general->telefono : null }}" maxlength="20">
            </div>
            @if(isset(auth()->user()->name) && auth()->user()->name == 'Admin')
            <div class="col-md-4 mb-3">
                {!! Form::label('id_status', 'Status:') !!}
                {!! Form::select('id_status',$status, isset($general) ? $general->id_status : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'pickerSelectClass',
                    'id' => 'id_status',
                    'required'=>'required'
                    ]) !!}
            </div>
            @endif
            <div class="col-md-12 mb-3">
                <label for="validationCustom01">{{'Dirección'}}</label>
                <textarea name="direccion" class="form-control" id="direccion" placeholder="Telefono" rows="3">{{ isset($general) ? $general->direccion : null }}</textarea>
            </div>
        </div>
    </div>
<div class="modal-footer">
    <a href="{{ route('usuario_g')}}" class="mt-1 btn btn-outline-secondary">
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