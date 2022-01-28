<div id="modal_citas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Cita</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                        <div class="col-md-4 mb-3">
                            {!! Form::label('paciente', 'Paciente:') !!}
                            {!! Form::select('Paciente_id',$pacientes, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control',
                                'id' => 'paciente',
                                'required'=>'required'
                            ]) !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            {!! Form::label('pacienteE', 'Paciente Especial:') !!}
                            {!! Form::select('Paciente_Especial_id',$pacientesE, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control',
                                'id' => 'pacienteE',
                                'disabled'=>'disabled'
                            ]) !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">{{'Maximo de Pacientes'}}</label>
                            <input type="number" name="Max_paciente" class="form-control" id="mpaciente" placeholder="Maximo de Pacientes" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">{{'Costo'}}</label>
                            <input type="number" name="Costo" class="form-control" id="costo" placeholder="Costo" required>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>{{'Nota'}}</label>
                            <textarea name="Nota" id="nota" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">{{'Titulo'}}</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Titulo del evento" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">{{'start'}}</label>
                            <input type="text" name="start" class="form-control" id="start" placeholder="start" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">{{'end'}}</label>
                            <input type="text" name="end" class="form-control" id="end" placeholder="end" required>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="mt-1 btn-transition btn btn-outline-secondary" data-dismiss="modal">
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
