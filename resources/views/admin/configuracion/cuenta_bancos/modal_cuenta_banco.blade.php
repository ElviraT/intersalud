<div id="modal_cuenta_banco" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-consulta="{{ action('Admin\configuracion\CuentaBancoController@edit') }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Cuenta de Banco</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => ['cuenta_banco.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
            <div class="modal-body">
                {{ Form::hidden('id', 0, ['class'=>'modal_registro_cuenta_banco_id'] ) }}
                <div class="col-md-12">
                    <div class="row">                        
                        <div class="col-md-6 mb-3">
                            {!! Form::label('banco', 'Banco:') !!}
                            {!! Form::select('banco',$banco, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control',
                                'id' => 'banco',
                                'required'=>'required'
                                ]) !!}
                        </div>
                        <div class="col-md-6 mb-3">
                            {!! Form::label('medico', 'Medico:') !!}
                            {!! Form::select('medico',$medico, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control',
                                'id' => 'medico',
                                'required'=>'required'
                                ]) !!}
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">{{'Número de cuenta'}}</label>
                            <input type="text" name="numero" class="form-control" id="numero" placeholder="Número de cuenta" required autofocus="true" maxlength="30" onkeypress="return SoloNumeros(event)">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">{{'Tipo'}}</label>
                            {!! Form::select('tipo',$tipo, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control',
                                'id' => 'tipo',
                                'required'=>'required'
                                ]) !!}
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{ 'Fecha' }}</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="ti-calendar"></i>
                                    </span>
                                </div>
                                 {!!
                                     Form::text('fecha', null, [
                                         'id' => 'fecha',
                                         'placeholder'=>'Y-M-D',
                                         'class' => 'form-control pull-right datepicker',
                                         'required'=>'required'] )
                                  !!}
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
