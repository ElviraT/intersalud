<div id="modal_banco" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-consulta="{{ action('Admin\configuracion\BancosController@edit') }}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Banco</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => ['banco.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
            <div class="modal-body">
                {{ Form::hidden('id', 0, ['class'=>'modal_registro_banco_id'] ) }}
                
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">{{'Nombre'}}</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required autofocus="true">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">{{'Código'}}</label>
                    <input type="text" name="codigo" class="form-control" id="codigo" placeholder="Código" required maxlength="11" onkeypress="return SoloNumeros(event)">
                </div>
                 <div class="col-md-12 mb-3">
                    {!! Form::label('status', 'Status:') !!}
                    {!! Form::select('status',$status, null, [
                        'placeholder' => 'Seleccione', 
                        'class' => 'pickerSelectClass',
                        'id' => 'status',
                        'required'=>'required'
                        ]) !!}
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
