<div id="modal_citas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ 'Agregar Cita' }}</h5>
                <button type="button" class="close cierra" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="col-md-12">
            <form action="" id="Myform">
                 @csrf
                 
                    <div class="row">
                        {{ Form::hidden('id', 0, ['id'=>'id'] ) }}
                        {{ Form::hidden('Agenda_id', 0, ['id'=>'Agenda_id'] ) }}
                        {{ Form::hidden('titleP', null, ['id'=>'titleP'] ) }}
                        <div class="col-md-4 mb-3">
                            {!! Form::label('paciente', 'Paciente:') !!}
                            {!! Form::select('Paciente_id',$pacientes, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'pickerSelectClass',
                                'id' => 'paciente',
                                'required'=>'required'
                            ]) !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            {!! Form::label('pacienteE', 'Paciente Especial:') !!}
                            {!! Form::select('Paciente_Especial_id',$pacientesE, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'pickerSelectClass',
                                'id' => 'pacienteE',
                                'disabled'=>'disabled'
                            ]) !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            {!! Form::label('servicio', 'Servicio:') !!}
                            {!! Form::select('id_servicio',[], null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'pickerSelectClass',
                                'id' => 'id_servicio',
                                'required'=>'required'
                            ]) !!}
                        </div>
                     <div class="col-md-3 mb-3" style="pointer-events: none">
                            <label for="validationCustom01">{{'Maximo de Pacientes'}}</label>
                            <input type="number" name="Max_paciente" class="form-control" id="mpaciente" placeholder="Maximo de Pacientes" required>
                        </div>
                        <div class="col-md-3 mb-3" style="pointer-events: none">
                            <label for="validationCustom01">{{'Disponibilidad'}}</label>
                            <input type="number" name="disponibilidad" class="form-control" id="disponibilidad">
                            <small id="texto" style="color: red;" hidden>{{'No hay cupos disponibles'}}</small>
                        </div>
                        <div class="col-md-3 mb-3" style="pointer-events: none">
                            <label for="validationCustom01">{{'Costo'}}</label>
                            <input type="number" name="Costo" class="form-control" id="costo" step="0.01" required>
                        </div>
                        <div class="col-md-3 mt-4">
                            <input type="checkbox" name="online" id="online">
                            <label>{{'Online'}}</label>
                        </div>
                        <div class="col-md-4 mt-4" hidden>
                            <label>{{'Confirmar Cita'}}</label>
                            <input type="checkbox" name="confirmado" id="confirmado" checked>
                        </div>
                        <div class="col-md-12 mb-3" style="pointer-events: none;">
                            <label>{{'Notas del Medico'}}</label>
                            <textarea name="NotaM" id="notaM" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>{{'Nota'}}</label>
                            <textarea name="Nota" id="nota" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">{{'Titulo'}}</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Titulo del evento" required>
                        </div>
                        <div class="row">
                            <div class='col-md-6 mb-3'>
                              <div class="form-group">
                                <label>{{ 'Inicio' }}</label>
                                 <div class='input-group date' id="date-start">
                                    <input type='text' class="form-control" name="start" id="start" readonly/>
                                    <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                    </span> 
                                 </div>
                              </div>
                           </div>
                           <div class='col-md-6 mb-3' style="pointer-events: none;">
                              <div class="form-group date">
                                <label>{{ 'Fin' }}</label>
                                 <div class='input-group' id="date-end">
                                    <input type='text' class="form-control" name="end" id="end" />
                                    <span class="input-group-addon">
                                    <span class="fa fa-calendar"></span>
                                    </span>
                                 </div>
                              </div>
                           </div>
                        </div>
                    </div>
                </form>
                </div>
                
                 <span style="background-color: red; color: white; display: none; padding: 10px;" id="validaciones"><strong>{{'Los campos: Paciente, Servicio, Nota y Titulo no pueden estar vacíos, verifique por favor'}}</strong></span> 
                
            </div>
            <div class="modal-footer">
                <button type="button" class="mt-1 btn-transition btn btn-outline-secondary cierra" data-dismiss="modal">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                    </span>{{'Volver'}}
                </button>
                <button type="button" class="mt-1 btn-transition btn btn-outline-success" id="btnGuardar">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                    </span>{{'Guardar'}}
                </button>
                <button type="button" class="mt-1 btn-transition btn btn-outline-warning" id="btnModificar">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                    </span>{{'Modificar'}}
                </button>
                <button type="button" class="mt-1 btn-transition btn btn-outline-danger" id="btnEliminar">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                    </span>{{'Eliminar'}}
                </button>
            </div>
        </div>
    </div>
</div>
