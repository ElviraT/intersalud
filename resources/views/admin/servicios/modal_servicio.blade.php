<div id="modal_servicio" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-consulta="{{ action('Admin\ServiciosController@edit') }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header danger">
                <h5 class="modal-title" id="exampleModalLongTitle">{{'Agregar Servicio'}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => ['servicio.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
            <div class="modal-body">
                {{ Form::hidden('id', 0, ['class'=>'modal_registro_servicio_id'] ) }}
                
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label>{{'Servicio'}}</label>
                            <input type="text" name="servicio" class="form-control" id="servicio" placeholder="Servicio" required autofocus="true" maxlength="200">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{'Costo'}}</label>
                            <input type="text" name="costo" class="form-control" id="costo" placeholder="Costo" required onkeypress = 'return SoloNumeros(event)'>
                        </div>
                        <div class="col-md-6 mb-3">
                            {!! Form::label('medico_id', 'Medico:') !!}
                            {!! Form::select('medico_id',$medico, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control',
                                'id' => 'medico_id',
                                'required'=>'required'
                                ]) !!}
                        </div>
                        <div class="col-md-6 mb-3">
                            {!! Form::label('especialidad', 'Especialidad Medica:') !!}
                            {!! Form::select('especialidad',$especialidad, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control',
                                'id' => 'especialidad',
                                'readonly' => 'readonly',
                                'required'=>'required'
                                ]) !!}
                        </div>
                        <div class='col-md-6 mb-3'>
                            <label>{{'Duración'}}</label>
                            <div class="form-group">
                                 <div class='input-group date' id='duracion'>
                                    <input type='text' class="form-control" name="duracion" placeholder="Duración" id="duracion_input" />
                                    <span class="input-group-addon">
                                    <span class="ti-timer"></span>
                                    </span>
                                 </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            {!! Form::label('status', 'Status:') !!}
                            {!! Form::select('status',$status, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control',
                                'id' => 'status',
                                'required'=>'required'
                                ]) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="mt-1 btn-transition btn btn-outline-secondary" data-dismiss="modal">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                     <i class="ti-back-left"></i>
                    </span>{{'Volver'}}
                </button>
                <button type="submit" class="mt-1 btn-transition btn btn-outline-primary">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                     <i class="ti-save"></i>
                    </span>{{'Guardar'}}
                </button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
