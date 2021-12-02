<div class="form-group col-md-12">
	{!! Form::open(['route' => ['urologia.add'],  'method' => 'post',  'autocomplete'=> 'off', 'id'=>'registra_identificacion' ]) !!}

    <div class="row">
        <div class="col-md-6 mb-3">
            <label>{{ 'Apellidos' }}</label>
            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellidos" onkeypress = 'return soloLetras(event)'>
        </div>  
        <div class="col-md-6 mb-3">
            <label>{{ 'Nombres' }}</label>
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres" onkeypress = 'return soloLetras(event)'>
        </div> 
        <div class="col-md-6 mb-3">
            <label>{{ 'Cedula' }}</label>
            <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Cedula" onkeypress = 'return soloLetras(event)'>
        </div>
        <div class="col-md-6 mb-3">
            {!! Form::label('sexo', 'Sexo:') !!}
            {!! Form::select('sexo',$sexo, null, [
                'placeholder' => 'Seleccione', 
                'class' => 'select2 form-control required',
                'id' => 'sexo'
                ]) !!}
        </div>
        <div class="col-md-6 mb-3">
            <label>{{ 'Edad' }}</label>
            <input type="text" class="form-control" name="edad" id="edad" placeholder="Edad" onkeypress = 'return soloLetras(event)'>
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
                     Form::text('fechNac', null, [
                         'id' => 'fechNac',
                         'placeholder'=>'Y-M-D',
                         'class' => 'form-control pull-right datepicker'] )
                  !!}
             </div>
        </div>
        <div class="col-md-6 mb-3">
            <label>{{ 'Teléfono' }}</label>
            <input type="text" class="form-control" name="tel" id="tel" placeholder="Teléfono" onkeypress = 'return soloLetras(event)'>
        </div>
        <div class="col-md-6 mb-3">
            <label>{{ 'Profesión' }}</label>
            <input type="text" class="form-control" name="profesion" id="profesion" placeholder="Profesión" onkeypress = 'return soloLetras(event)'>
        </div>

        <div class="col-md-12 mb-3">
            <label>{{ 'Dirección' }}</label>
            <textarea class="form-control" rows="5" name="direccion" id="direccion" placeholder="Dirección"></textarea>
        </div>
        <div class="col-md-12 mb-3">
            <label>{{ 'Motivo de la consulta y enfermedad actual' }}</label>
            <textarea class="form-control" rows="5" name="motivo" id="motivo" placeholder="Motivo de la consulta y enfermedad actual"></textarea>
        </div>
    </div>

    <div class="modal-footer">
        <a href="{{ route('urologia')}}" class="mt-1 btn btn-outline-secondary">
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