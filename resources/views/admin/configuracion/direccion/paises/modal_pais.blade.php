<div id="modal_pais" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-consulta="{{ action('Admin\configuracion\direccion\PaisController@edit') }}">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Agregar País</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => ['pais.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
            <div class="modal-body">
                {{ Form::hidden('id', 0, ['class'=>'modal_registro_pais_id'] ) }}
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">{{'Código'}}</label>
                    <input type="text" name="codigo" class="form-control" id="codigo" placeholder="Código" required autofocus onkeypress = 'return SoloNumeros(event)' maxlength="11">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">{{'Nombre Corto'}}</label>
                    <input type="text" name="nombre" class="form-control" id="nombre" placeholder="iso3166a1" required onkeypress = 'return soloLetras(event)' maxlength="2">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">{{'Nombre Corto2'}}</label>
                    <input type="text" name="nombre2" class="form-control" id="nombre2" placeholder="iso3166a2" required onkeypress = 'return soloLetras(event)' maxlength="5">
                </div>
                <div class="col-md-12 mb-3">
                    <label for="validationCustom01">{{'Nombre Completo'}}</label>
                    <input type="text" name="pais" class="form-control" id="pais" placeholder="Nombre" required onkeypress = 'return soloLetras(event)' maxlength="128">
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
