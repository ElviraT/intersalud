<div class="modal fade" id="confirm-delete29" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Confirmación de Eliminado</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                {!! Form::open(['action' => ['Admin\configuracion\TipoPagoController@destroy'], 'id'=>'form_tpago_eliminar']) !!}
                {{ Form::hidden('id', null, ['id'=>'modal_registo_tpago_id'] ) }}

                    <p>Vas a eliminar el tipo de pago <b><i class="title"></i></b>, este proceso es irreversible.</p>
                    <p>¿Deseas continuar?</p>
                      
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-transition btn btn-outline-secondary" data-dismiss="modal">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                     <i class="ti-back-left"></i>
                    </span>{{'Volver'}}
                </button>
                <button type="submit" class="btn-transition btn btn-outline-danger">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="ti-save"></i>
                        </span>{{'Eliminar'}}</a>
                    </button>
            </div>
                {!! Form::close() !!}
        </div>
    </div>
</div>
