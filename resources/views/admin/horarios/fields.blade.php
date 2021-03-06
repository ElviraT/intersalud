{!! Form::open(['route' => ['horario.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
<div class="col-md-12 p-4">
  {{ Form::hidden('id', isset($horarios) ? $horarios->id_Horario_Cita : 0, ['id'=>'id'] ) }}
    <div class="col-md-12" style="border-bottom: 1px solid red">
	  	<div class="row">
			<div class="col-md-4 mt-3">
	            {!! Form::label('medico', 'Medico:') !!}
	            {!! Form::select('medico',$medico, isset($horarios) ? $horarios->Medico_id : null, [
	                'placeholder' => 'Seleccione', 
	                'class' => 'pickerSelectClass',
	                'id' => 'medico',
	                'required'=>'required'
	                ])
	            !!}
            </div>
            <div class="col-md-4 mt-3">
                {!! Form::label('especialidad', 'Especialidad Medica:') !!}
                {!! Form::select('especialidad',$especialidad, isset($horarios) ? $horarios->Especialidad_id : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'pickerSelectClass',
                    'id' => 'especialidad',
                    'required'=>'required'
                    ]) !!}
              <span id="negacion" class="negacion" hidden><small>{{'El médico no tiene especialidad registrada'}}</small></span>
            </div>
		  	<div class="col-md-4 mt-3">
                {!! Form::label('turno', 'Turno:') !!}
                {!! Form::select('turno_id',$turnos, isset($horarios) ? $horarios->turno_id : null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'pickerSelectClass otro',
                    'id' => 'turno_id',
                    'required'=>'required'
                    ]) !!}
            </div>
			<div class="col-md-4 mb-3 mt-3">
		  		<label>{{'Domicilio'}}</label>
				<input type="checkbox" name="domicilio" id="domicilio" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs" @if(isset($horarios) && $horarios->Domicilio == 1) checked @endif>
			</div>
		</div>
	</div>
    {{--LUNES--}}
  	<div class="col-md-12">
	  	<div class="row">
		  	<div class="col-md-3 mt-3">
		  		<label>{{'Lunes'}}</label>
				<input type="checkbox" name="lunes" id="lunes" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs" @if(isset($horarios) && $horarios->Lunes == 1) checked @endif>
			</div>
			<div id="div_lunes" class="col-md-9 mt-2" style="display:@if(isset($horarios) && $horarios->Lunes == 1) block @else none @endif">
		    	<div class="row">
	        		<div class='col-md-6'>
				      <div class="form-group">
				         <div class='input-group date' id='fecha_lunes1'>
				            <input type='text' class="form-control" name="hora_lunes1" placeholder="Hora inicio" value="{{isset($horarios) ? $horarios->Hora_Inicio_Lunes : null}}" id="hlui" />
				            <span class="input-group-addon">
				            <span class="ti-timer"></span>
				            </span>
				         </div>
				      </div>
				   </div>
				   <div class='col-md-6'>
				      <div class="form-group">
				         <div class='input-group date' id='fecha_lunes2'>
				            <input type='text' class="form-control" name="hora_lunes2" placeholder="Hora fin" value="{{isset($horarios) ? $horarios->Hora_Fin_Lunes : null}}" id="hluf"/>
				            <span class="input-group-addon">
				            <span class="ti-timer"></span>
				            </span>
				         </div>
				      </div>
				   </div>
		    	</div>
			</div>
		</div>
	</div>
	{{--FIN DE LUNES--}}
	{{--MARTES--}}
	<div class="col-md-12">
	  	<div class="row">
		  	<div class="col-md-3 mt-3">
		  		<label>{{'Martes'}}</label>
				<input type="checkbox" name="martes" id="martes" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs" @if(isset($horarios) && $horarios->Martes == 1) checked @endif>
			</div>
			<div id="div_martes" class="col-md-9 mt-2" style="display:@if(isset($horarios) && $horarios->Martes == 1) block @else none @endif">
		    	<div class="row">
		    		<div class='col-md-6'>
				      <div class="form-group">
				         <div class='input-group date' id='fecha_martes1'>
				            <input type='text' class="form-control" name="hora_martes1" placeholder="Hora inicio" value="{{isset($horarios) ? $horarios->Hora_Inicio_Martes : null}}" id='hmai'/>
				            <span class="input-group-addon">
				            <span class="ti-timer"></span>
				            </span>
				         </div>
				      </div>
				   </div>
				   <div class='col-md-6'>
				      <div class="form-group">
				         <div class='input-group date' id='fecha_martes2'>
				            <input type='text' class="form-control" name="hora_martes2" placeholder="Hora fin" value="{{isset($horarios) ? $horarios->Hora_Fin_Martes : null}}" id='hmaf'/>
				            <span class="input-group-addon">
				            <span class="ti-timer"></span>
				            </span>
				         </div>
				      </div>
				   </div>
		    	</div>
			</div>
		</div>
	</div>
	{{--FIN DE MARTES--}}
	{{--MIERCOLES--}}
	<div class="col-md-12">
	  	<div class="row">
		  	<div class="col-md-3 mt-3">
		  		<label>{{'Miércoles'}}</label>
				<input type="checkbox" name="miercoles" id="miercoles" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs" @if(isset($horarios) && $horarios->Miercoles == 1) checked @endif>
			</div>
			<div id="div_miercoles" class="col-md-9 mt-2" style="display:@if(isset($horarios) && $horarios->Miercoles == 1) block @else none @endif">
		    	<div class="row">
		    		<div class='col-md-6'>
				      <div class="form-group">
				         <div class='input-group date' id='fecha_miercoles1'>
				            <input type='text' class="form-control" name="hora_miercoles1" placeholder="Hora inicio" value="{{isset($horarios) ? $horarios->Horario_Inicio_Miercoles : null}}" id="hmii" />
				            <span class="input-group-addon">
				            <span class="ti-timer"></span>
				            </span>
				         </div>
				      </div>
				   </div>
				   <div class='col-md-6'>
				      <div class="form-group">
				         <div class='input-group date' id='fecha_miercoles2'>
				            <input type='text' class="form-control" name="hora_miercoles2" placeholder="Hora fin" value="{{isset($horarios) ? $horarios->Horario_Fin_Miercoles : null}}" id="hmif" />
				            <span class="input-group-addon">
				            <span class="ti-timer"></span>
				            </span>
				         </div>
				      </div>
				   </div>
		    	</div>
			</div>
		</div>
	</div>
	{{--FIN DE MIERCOLES--}}
	{{--JUEVES--}}
	<div class="col-md-12">
	  	<div class="row">
		  	<div class="col-md-3 mt-3">
		  		<label>{{'Jueves'}}</label>
				<input type="checkbox" name="jueves" id="jueves" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs" @if(isset($horarios) && $horarios->Jueves == 1) checked @endif>
			</div>
			<div id="div_jueves" class="col-md-9 mt-2" style="display:@if(isset($horarios) && $horarios->Jueves == 1) block @else none @endif">
		    	<div class="row">
		    		<div class='col-md-6'>
				      <div class="form-group">
				         <div class='input-group date' id='fecha_jueves1'>
				            <input type='text' class="form-control" name="hora_jueves1" placeholder="Hora inicio" value="{{isset($horarios) ? $horarios->Horario_Inicio_Jueves : null}}" id="hjui" />
				            <span class="input-group-addon">
				            <span class="ti-timer"></span>
				            </span>
				         </div>
				      </div>
				   </div>
				   <div class='col-md-6'>
				      <div class="form-group">
				         <div class='input-group date' id='fecha_jueves2'>
				            <input type='text' class="form-control" name="hora_jueves2" placeholder="Hora fin" value="{{isset($horarios) ? $horarios->Horario_Fin_Jueves : null}}" id="hjuf" />
				            <span class="input-group-addon">
				            <span class="ti-timer"></span>
				            </span>
				         </div>
				      </div>
				   </div>
		    	</div>
			</div>
		</div>
	</div>
	{{--FIN DE JUEVES--}}
	{{--VIERNES--}}
	<div class="col-md-12">
	  	<div class="row">
		  	<div class="col-md-3 mt-3">
		  		<label>{{'Viernes'}}</label>
				<input type="checkbox" name="viernes" id="viernes" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs" @if(isset($horarios) && $horarios->Viernes == 1) checked @endif>
			</div>
			<div id="div_viernes" class="col-md-9 mt-2" style="display:@if(isset($horarios) && $horarios->Viernes == 1) block @else none @endif">
		    	<div class="row">
		    		<div class='col-md-6'>
				      <div class="form-group">
				         <div class='input-group date' id='fecha_viernes1'>
				            <input type='text' class="form-control" name="hora_viernes1" placeholder="Hora inicio" value="{{isset($horarios) ? $horarios->Horario_Inicio_Viernes : null}}" id="hvii" />
				            <span class="input-group-addon">
				            <span class="ti-timer"></span>
				            </span>
				         </div>
				      </div>
				   </div>
				   <div class='col-md-6'>
				      <div class="form-group">
				         <div class='input-group date' id='fecha_viernes2'>
				            <input type='text' class="form-control" name="hora_viernes2" placeholder="Hora fin" value="{{isset($horarios) ? $horarios->Horario_Fin_Viernes : null}}" id="hvif" />
				            <span class="input-group-addon">
				            <span class="ti-timer"></span>
				            </span>
				         </div>
				      </div>
				   </div>
		    	</div>
			</div>
		</div>
	</div>
	{{--FIN DE VIERNES--}}
	{{--SABADO--}}
	<div class="col-md-12">
	  	<div class="row">
		  	<div class="col-md-3 mt-3">
		  		<label>{{'Sábado'}}</label>
				<input type="checkbox" name="sabado" id="sabado" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs" @if(isset($horarios) && $horarios->Sabado == 1) checked @endif>
			</div>
			<div id="div_sabado" class="col-md-9 mt-2" style="display:@if(isset($horarios) && $horarios->Sabado == 1) block @else none @endif">
		    	<div class="row">
		    		<div class='col-md-6'>
				      <div class="form-group">
				         <div class='input-group date' id='fecha_sabado1'>
				            <input type='text' class="form-control" name="hora_sabado1" placeholder="Hora inicio" value="{{isset($horarios) ? $horarios->Horario_Inicio_Sabado : null}}" id="hsai" />
				            <span class="input-group-addon">
				            <span class="ti-timer"></span>
				            </span>
				         </div>
				      </div>
				   </div>
				   <div class='col-md-6'>
				      <div class="form-group">
				         <div class='input-group date' id='fecha_sabado2'>
				            <input type='text' class="form-control" name="hora_sabado2" placeholder="Hora fin" value="{{isset($horarios) ? $horarios->Horario_Fin_Sabado : null}}" id="hsaf" />
				            <span class="input-group-addon">
				            <span class="ti-timer"></span>
				            </span>
				         </div>
				      </div>
				   </div>
		    	</div>
			</div>
		</div>
	</div>
	{{--FIN DE SABADO--}}
	{{--DOMINGO--}}
	<div class="col-md-12">
	  	<div class="row">
		  	<div class="col-md-3 mt-3">
		  		<label>{{'Domingo'}}</label>
				<input type="checkbox" name="domingo" id="domingo" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs" @if(isset($horarios) && $horarios->Domingo == 1) checked @endif>
			</div>
			<div id="div_domingo" class="col-md-9 mt-2" style="display:@if(isset($horarios) && $horarios->Domingo == 1) block @else none @endif">
		    	<div class="row">
		    		<div class='col-md-6'>
				      <div class="form-group">
				         <div class='input-group date' id='fecha_domingo1'>
				            <input type='text' class="form-control" name="hora_domingo1" placeholder="Hora inicio" value="{{isset($horarios) ? $horarios->Horario_Inicio_Domingo : null}}" id="hdoi" />
				            <span class="input-group-addon">
				            <span class="ti-timer"></span>
				            </span>
				         </div>
				      </div>
				   </div>
				   <div class='col-md-6'>
				      <div class="form-group">
				         <div class='input-group date' id='fecha_domingo2'>
				            <input type='text' class="form-control" name="hora_domingo2" placeholder="Hora fin" value="{{isset($horarios) ? $horarios->Horario_Fin_Domingo : null}}" id="hdof" />
				            <span class="input-group-addon">
				            <span class="ti-timer"></span>
				            </span>
				         </div>
				      </div>
				   </div>
		    	</div>
			</div>
		</div>
	</div>
	{{--FIN DE DOMINGO--}}
</div>
<div class="modal-footer">
    <a href="{{ route('horario')}}" class="mt-1 btn btn-outline-secondary">
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