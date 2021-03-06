<div id="modal_billetera" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-consulta="{{ action('Admin\configuracion\BilleteraCriptosController@edit') }}">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Billetera Cripto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => ['billetera.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="row">
                        {{ Form::hidden('id', 0, ['class'=>'modal_registro_billetera_id'] ) }}
                        
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">{{'Nombre'}}</label>
                            <input type="text" name="nombre" class="form-control" id="nombre" placeholder="Nombre" required autofocus="true">
                        </div>
                        <div class="col-md-6 mb-3">
                        {!! Form::label('medico', 'Medico:') !!}
                        {!! Form::select('medico',$medico, null, [
                            'placeholder' => 'Seleccione', 
                            'class' => 'pickerSelectClass',
                            'id' => 'medico',
                            'required'=>'required'
                            ]) !!}
                        </div>
                        <div class="col-md-6 mb-3">
                        {!! Form::label('cripto', 'Criptos:') !!}
                        {!! Form::select('cripto',$cripto, null, [
                            'placeholder' => 'Seleccione', 
                            'class' => 'pickerSelectClass',
                            'id' => 'cripto',
                            'required'=>'required'
                            ]) !!}
                        </div>
                        <div class="col-md-6 mb-3">
                        {!! Form::label('status', 'Status:') !!}
                        {!! Form::select('status',$status, null, [
                            'placeholder' => 'Seleccione', 
                            'class' => 'pickerSelectClass',
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
