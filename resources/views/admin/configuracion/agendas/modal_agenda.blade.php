<div id="modal_agenda" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Agenda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        {{ Form::hidden('id', 0, ['class'=>'modal_registro_agenda_id'] ) }}
                        <div class="col-md-4 mb-3">
                            {!! Form::label('paciente', 'Paciente:') !!}
                            {!! Form::select('paciente',$pacientes, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control',
                                'id' => 'paciente',
                                'required'=>'required'
                            ]) !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            {!! Form::label('pacienteE', 'Paciente Especial:') !!}
                            {!! Form::select('pacienteE',$pacientesE, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control',
                                'id' => 'pacienteE',
                                'disabled'=>'disabled'
                            ]) !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">{{'Maximo de Pacientes'}}</label>
                            <input type="number" name="mpaciente" class="form-control" id="mpaciente" placeholder="Maximo de Pacientes" required>
                        </div>
                        <div class='col-md-4 mb-3'>
                            <label>{{'Hora Inicio'}}</label>
                          <div class="form-group">
                             <div class='input-group date' id='hora_inicio'>
                                <input type='text' class="form-control" name="hora_inicio" placeholder="Hora inicio"/>
                                <span class="input-group-addon">
                                <span class="ti-timer"></span>
                                </span>
                             </div>
                          </div>
                        </div>
                        <div class='col-md-4 mb-3'>
                            <label>{{'Hora Fin'}}</label>
                          <div class="form-group">
                             <div class='input-group date' id='Hora_Fin'>
                                <input type='text' class="form-control" name="Hora_Fin" placeholder="Hora fin"/>
                                <span class="input-group-addon">
                                <span class="ti-timer"></span>
                                </span>
                             </div>
                          </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">{{'Costo'}}</label>
                            <input type="number" name="costo" class="form-control" id="costo" placeholder="Costo" required>
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
        </div>
    </div>
</div>
