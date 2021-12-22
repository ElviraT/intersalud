<div class="col-md-12">
    <div class="row">
    	{!! Form::open(['route' => ['usuario_a.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
      {{ Form::hidden('id', isset($horarios) ? $horarios->id_Horario_Cita : null, ['id'=>'id'] ) }}
	  	<div class="col-md-3">
	  		<label>{{'Lunes'}}</label>
			<input type="checkbox" id="mconfirmar" data-toggle="toggle"  data-on="Si" data-off="No" data-size="xs">
		</div>
		<div id="div_mnota1" class="col-md-9" style="display: block;">
	    	<div class="row">
        		<div class='col-md-5'>
			      <div class="form-group">
			         <div class='input-group date' id='fecha_lunes1'>
			            <input type='text' class="form-control" />
			            <span class="input-group-addon">
			            <span class="ti-timer"></span>
			            </span>
			         </div>
			      </div>
			   </div>
			   <div class='col-md-5'>
			      <div class="form-group">
			         <div class='input-group date' id='fecha_lunes2'>
			            <input type='text' class="form-control" />
			            <span class="input-group-addon">
			            <span class="ti-timer"></span>
			            </span>
			         </div>
			      </div>
			   </div>
	    	</div>
		</div>
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
	    {!! Form::close() !!}
	</div>
</div>