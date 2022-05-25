{!! Form::open(['method' => 'post', 'autocomplete' =>'off', 'id'=>"confirmarAdd"]) !!}
    {{--ENCABEZADO DE FACTURA ENVIAR--}}
      <input type="hidden" name="id_pago" value="{{ $pago->id_pago}}">
      <input type="hidden" name="Cita_Consulta_id" value="{{ $dataf->Cita_Consulta_id }}">
      <input type="hidden" name="Fecha" value="{{ date('Y-m-d') }}">
      <input type="hidden" name="Datos_SENIAT_id" value="{{ $dataf->UsuarioM->Seniat->id_Datos_SENIAT }}">
      <input type="hidden" name="Pacientes_id" value="{{ $dataf->UsuarioP->id_Paciente }}">
      <input type="hidden" name="Relacion_Medico" value="">
      <input type="hidden" name="Medico_id" value="{{ $dataf->UsuarioM->id_Medico }}">
      <input type="hidden" name="Asistente_id" value="{{$dataf->UsuarioM->MxA->id_Asistente}}">
      <input type="hidden" name="Nombre" value="{{ $dataf->UsuarioP->Nombres_Paciente }}">
      <input type="hidden" name="Apellido" value="{{ $dataf->UsuarioP->Apellidos_Paciente }}">
      <input type="hidden" name="CIDNI" value="{{ $dataf->UsuarioP->PrefijoDNI->Prefijo_CIDNI }}&nbsp;{{$dataf->UsuarioP->CIDNI }}">
      <input type="hidden" name="Status_no_paciente" value="1">
      {{--FIN DE ENCABEZADO ENVIAR--}}
      {{--DETALLE FACTURA ENVIAR--}}
      <input type="hidden" name="Cantidad" value="1">
      <input type="hidden" name="moneda" value="{{$dataf->Servicio->simbolo}}">
      <input type="hidden" name="iva" value="{{$iva}}">
      @if($servicios)
        @foreach($servicios as $servicio)
          <input type="hidden" name="Servicio[{{$servicio->id_servicio}}]" value="{{$servicio->Costos}}">
        @endforeach
      @endif
      {{--FIN DETALLE FACTURA ENVIAR--}}

      {{--FACTURA MONEDA--}}
        <input type="hidden" name="tpagof" id="tpagof" value="{{$pago->tipo_pago}}">
        <input type="hidden" name="monedaf" id="monedaf" value="{{$pago->moneda_id}}">
        <input type="hidden" name="cbsf" id="cbsf" value="{{isset($pago->CuentaBanco) ? $pago->CuentaBanco->id_Cuenta_Bancaria_BS : null}}">
        <input type="hidden" name="cusdf" id="cusdf" value="{{isset($pago->CuentaUSD) ? $pago->CuentaUSD->id_Entidad_USD : null }}">
        <input type="hidden" name="billeteraf" id="billeteraf" value="{{''}}">
        <input type="hidden" name="reff" id="reff" value="{{$pago->referencia}}">
        <input type="hidden" name="totalf" id="totalf" value="{{$pago->monto}}">
        <input type="hidden" name="impuestof" id="impuestof" value="{{''}}">
      {{--FIN FACTURA MONEDA--}}
      @can('factura.add')
      @if($pago)
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-3 mt-3 mb-3">
            {!! Form::label('status', 'Estatus Factura:') !!}
              {!! Form::select('statusF',$statusf, null, [
                  'placeholder' => 'Seleccione', 
                  'class' => 'select2 form-control',
                  'id' => 'statusF',
                  'required'=>'required'
                  ])
              !!}
          </div>
          <div class="col-md-3 mt-3 mb-3">
            {!! Form::label('statusP', 'Estatus Pago:') !!}
              {!! Form::select('statusP',$status, null, [
                  'placeholder' => 'Seleccione', 
                  'class' => 'select2 form-control',
                  'id' => 'statusP',
                  'required'=>'required'
                  ])
              !!}
          </div>
        </div>
      </div>
      <div class="modal-footer" align="center">
        <button type="submit" class="mt-1 btn-transition btn btn-outline-primary" id="guardar">
            <span class="btn-icon-wrapper opacity-7">
             <i class="ti-save"></i>
            </span>{{'Confirmar y Generar factura'}}
        </button>
      </div>
      @endif
      @endcan
{!! Form::close() !!}