<div id="modal_consultorio" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-consulta="{{ action('Admin\configuracion\ConsultorioController@edit') }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Consultorio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => ['consultorio.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        {{ Form::hidden('id', 0, ['class'=>'modal_registro_consultorio_id'] ) }}
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">{{'Local'}}</label>
                            <input type="text" name="local" class="form-control" id="local" placeholder="Local" required autofocus="true">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">{{'Teléfono'}}</label>
                            <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">{{'Celular'}}</label>
                            <input type="text" name="celular" class="form-control" id="celular" placeholder="Celular" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">{{'Correo'}}</label>
                            <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            {!! Form::label('especialidad', 'Especialidad Medica:') !!}
                            {!! Form::select('especialidad',$especialidad, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control required',
                                'id' => 'especialidad'
                                ])
                            !!}
                        </div>
                        <div class="col-md-6 mb-3">
                            {!! Form::label('estado', 'Estado:') !!}
                            {!! Form::select('estado',$estado, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control required',
                                'id' => 'estado'
                                ])
                            !!}
                        </div>
                        <div class="col-md-6 mb-3">
                            {!! Form::label('ciudad', 'Ciudad:') !!}
                            {!! Form::select('ciudad',$ciudad, null, [
                                'placeholder' => 'Seleccione', 
                                'disabled' => 'disabled',
                                'class' => 'select2 form-control required',
                                'id' => 'ciudad'
                                ])
                            !!}
                        </div>
                        <div class="col-md-6 mb-3">
                            {!! Form::label('municipio', 'Municipio:') !!}
                            {!! Form::select('municipio',$municipio, null, [
                                'placeholder' => 'Seleccione',
                                'disabled' => 'disabled', 
                                'class' => 'select2 form-control required',
                                'id' => 'municipio'
                                ])
                            !!}
                        </div>
                        <div class="col-md-6 mb-3">
                            {!! Form::label('parroquia', 'Parroquia:') !!}
                            {!! Form::select('parroquia',$parroquia, null, [
                                'placeholder' => 'Seleccione', 
                                'disabled' => 'disabled',
                                'class' => 'select2 form-control required',
                                'id' => 'parroquia'
                                ])
                            !!}
                        </div>
                        <div class="col-md-6 mb-3">
                            {!! Form::label('status', 'Status:') !!}
                            {!! Form::select('status',$status, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control required',
                                'id' => 'status'
                                ])
                            !!}
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>{{'Direccion'}}</label>
                            <textarea name="direccion" id="direccion" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="mt-1 btn-transition btn btn-outline-secondary" data-dismiss="modal">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                     <i class="ti-back-left"></i>
                    </span>{{'Cancelar'}}
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
