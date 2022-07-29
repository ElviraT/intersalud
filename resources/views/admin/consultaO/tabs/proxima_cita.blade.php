<div class="col-md-12">
	<div class="card">
		<div class="col-md-12">
                <div class="row">
                  <div class="col-md-4 mt-3">
                    {!! Form::label('agenda', 'Agenda:') !!}
                    {!! Form::select('agenda',$agenda, null, [
                        'placeholder' => 'Seleccione', 
                        'class' => 'pickerSelectClass otro',
                        'id' => 'agenda',
                        'required'=>'required'
                        ])
                    !!}
                  </div>
                  <div class="col-md-4 mt-4">
                    <a href="#" class="btn-transition btn btn-outline-success mt-3" onclick="horario2();">{{ 'Consultar Horario' }}</a>
                  </div>                  
                </div>
              </div>
              
			 <div class="col-md-12 mt-4" id='calendar_cita'></div>
	</div>
</div>