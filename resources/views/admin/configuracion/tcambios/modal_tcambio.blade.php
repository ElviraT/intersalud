<div id="modal_tcambio" class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" data-consulta="{{ action('Admin\configuracion\TasaCambioController@edit') }}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header danger">
                <h5 class="modal-title" id="exampleModalLongTitle">{{'Agregar Tasa de Cambio'}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {!! Form::open(['route' => ['tcambio.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
            <div class="modal-body">
                {{ Form::hidden('id', 0, ['class'=>'modal_registro_tcambio_id'] ) }}
                
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">{{'Bolívares'}}</label>
                            <input type="text" name="bs" class="form-control" id="bs" placeholder="Bs" required autofocus="true" onkeypress = 'return SoloNumeros(event)'>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">{{'Dolares'}}</label>
                            <input type="text" name="usd" class="form-control" id="usd" placeholder="USD" required onkeypress = 'return SoloNumeros(event)'>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">{{'BitCoins'}}</label>
                            <input type="text" name="btc" class="form-control" id="btc" placeholder="Btc" required onkeypress = 'return SoloNumeros(event)'>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="validationCustom01">{{'Ethereum'}}</label>
                            <input type="text" name="eth" class="form-control" id="eth" placeholder="Eth" required onkeypress = 'return SoloNumeros(event)'>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label>{{ 'Fecha' }}</label>
                              <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                    <i class="fa fa-calendar"></i>
                                    </span>
                                </div>
                                 {!!
                                     Form::text('fecha', null, [
                                         'id' => 'fecha',
                                         'placeholder'=>'Y-M-D',
                                         'class' => 'form-control pull-right datepicker'] )
                                  !!}
                               </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            {!! Form::label('status', 'Status:') !!}
                            {!! Form::select('status',$status, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control required',
                                'id' => 'status'
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
