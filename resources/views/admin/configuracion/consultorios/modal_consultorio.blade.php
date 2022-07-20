<div id="modal_consultorio" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-consulta="{{ action('Admin\configuracion\ConsultorioController@edit') }}">
    <div class="modal-dialog modal-lg">
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
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">{{'Local'}}</label>
                            <input type="text" name="local" class="form-control" id="local" placeholder="Local" required autofocus="true">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">{{'Teléfono'}}</label>
                            <input type="text" name="telefono" class="form-control" id="telefono" placeholder="Teléfono" required maxlength="20" onkeypress="return SoloNumeros(event)">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">{{'Celular'}}</label>
                            <input type="text" name="celular" class="form-control" id="celular" placeholder="Celular" required maxlength="20" onkeypress="return SoloNumeros(event)">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">{{'Correo'}}</label>
                            <input type="email" name="correo" class="form-control" id="correo" placeholder="Correo" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            {!! Form::label('especialidad', 'Especialidad Medica:') !!}
                            {!! Form::select('especialidad',$especialidad, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'pickerSelectClass otro',
                                'id' => 'especialidad',
                                'required'=>'required'
                                ])
                            !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            {!! Form::label('estado', 'Estado:') !!}
                            {!! Form::select('estado',$estado, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'pickerSelectClass',
                                'id' => 'estado',
                                'required'=>'required'
                                ])
                            !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            {!! Form::label('municipio', 'Municipio:') !!}
                            {!! Form::select('municipio',$municipio, null, [
                                'placeholder' => 'Seleccione',
                                'class' => 'pickerSelectClass',
                                'id' => 'municipio',
                                'required'=>'required'
                                ])
                            !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            {!! Form::label('ciudad', 'Ciudad:') !!}
                            {!! Form::select('ciudad',$ciudad, null, [
                                'placeholder' => 'Seleccione',
                                'class' => 'pickerSelectClass',
                                'id' => 'ciudad',
                                'required'=>'required'
                                ])
                            !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            {!! Form::label('parroquia', 'Parroquia:') !!}
                            {!! Form::select('parroquia',$parroquia, null, [
                                'placeholder' => 'Seleccione',
                                'class' => 'pickerSelectClass',
                                'id' => 'parroquia',
                                'required'=>'required'
                                ])
                            !!}
                        </div>
                        <div class="col-md-4 mb-3">
                            {!! Form::label('status', 'Status:') !!}
                            {!! Form::select('status',$status, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'pickerSelectClass otro',
                                'id' => 'status',
                                'required'=>'required'
                                ])
                            !!}
                        </div>
                        <div class="col-md-8 mb-3">
                            <label>{{'Direccion'}}</label>
                            <textarea name="direccion" id="direccion" class="form-control" rows="2" required></textarea>
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
