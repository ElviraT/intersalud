<div id="modal_agenda" class="modal fade bd-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-consulta="{{ action('Admin\configuracion\AgendaController@edit') }}">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Agenda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            {!! Form::open(['route' => ['agendas.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        {{ Form::hidden('id', 0, ['class'=>'modal_registro_agenda_id'] ) }}
                        <div class="col-md-4 mb-3">
                            {!! Form::label('medico', 'Medico:') !!}
                            {!! Form::select('medico',$medico, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control',
                                'id' => 'medico',
                                'required'=>'required'
                            ]) !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            {!! Form::label('especialidad', 'Especialidad Medica:') !!}
                            {!! Form::select('especialidad',$especialidad, null, [
                                  'placeholder' => 'Seleccione', 
                                  'class' => 'select2 form-control',
                                  'disabled' => 'disabled',
                                  'id' => 'especialidad',
                                  'required'=>'required'
                            ]) !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            {!! Form::label('consultorio', 'Consultorios:') !!}
                            {!! Form::select('consultorio',$consultorios, null, [
                                  'placeholder' => 'Seleccione', 
                                  'class' => 'select2 form-control',
                                  'disabled' => 'disabled',
                                  'id' => 'consultorio',
                                  'required'=>'required'
                            ]) !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            {!! Form::label('horario', 'Horario:') !!}
                            {!! Form::select('horario',$horarios, null, [
                                  'placeholder' => 'Seleccione', 
                                  'class' => 'select2 form-control',
                                  'id' => 'horario',
                                  'required'=>'required'
                            ]) !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">{{'Costo'}}</label>
                            <input type="number" name="costo" class="form-control" id="costo" placeholder="Costo" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">{{'Maximo de Pacientes'}}</label>
                            <input type="number" name="mpaciente" class="form-control" id="mpaciente" placeholder="Maximo de Pacientes" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            {!! Form::label('status', 'Status:') !!}
                            {!! Form::select('status',$status, null, [
                                  'placeholder' => 'Seleccione', 
                                  'class' => 'select2 form-control',
                                  'id' => 'status',
                                  'required'=>'required'
                            ]) !!}
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>{{'Nota'}}</label>
                            <textarea name="nota" id="nota" class="form-control" rows="3" required></textarea>
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
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
