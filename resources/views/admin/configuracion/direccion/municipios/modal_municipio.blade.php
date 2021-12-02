<div id="modal_municipio" class="modal fade bd-example-modal-sm" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-consulta="{{ action('Admin\configuracion\direccion\MunicipioController@edit') }}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar Municipio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => ['municipio.add'],  'method' => 'post', 'autocomplete' =>'off', 'id'=>'registra_municipioForm']) !!}
            <div class="modal-body">
                {{ Form::hidden('id', 0, ['class'=>'modal_registro_municipio_id'] ) }}
                <div class="form-group col-md-12">
                    <label>{{'Estados'}}</label>
                    {!! Form::select('estado', $estados, null, ['id'=>"estado",'class'=>'select2 form-control','placeholder' => 'Seleccione', 'required' => 'required']) !!}                    
                </div>
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">{{'Nombre'}}</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre" required onkeypress = 'return soloLetras(event)'>
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
