{!! Form::open(['method' => 'post', 'autocomplete' =>'off', 'id'=>"facturaAdd"]) !!}
    {{--ENCABEZADO DE FACTURA ENVIAR--}}
      <input type="hidden" name="Cita_Consulta_id" value="{{ $dataf->Cita_Consulta_id }}">
      <input type="hidden" name="Fecha" value="{{ date('Y-m-d') }}">
      <input type="hidden" name="Datos_SENIAT_id" value="{{ $dataf->UsuarioM->Seniat->id_Datos_SENIAT }}">
      <input type="hidden" name="Pacientes_id" value="{{ $dataf->UsuarioP->id_Paciente }}">
      <input type="hidden" name="Status_Factura_id" value="1">
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
      <input type="hidden" name="statusFf" id="statusFf">
      @if($servicios)
        @foreach($servicios as $servicio)
          <input type="hidden" name="Servicio[{{$servicio->id_servicio}}]" value="{{$servicio->Costos}}">
        @endforeach
      @endif
      {{--FIN DETALLE FACTURA ENVIAR--}}

      {{--FACTURA MONEDA--}}
        <input type="hidden" name="tpagof" id="tpagof">
        <input type="hidden" name="monedaf" id="monedaf">
        <input type="hidden" name="statusPf" id="statusPf">
        <input type="hidden" name="cbsf" id="cbsf">
        <input type="hidden" name="cusdf" id="cusdf">
        <input type="hidden" name="billeteraf" id="billeteraf">
        <input type="hidden" name="reff" id="reff">
        <input type="hidden" name="totalf" id="totalf">
        <input type="hidden" name="impuestof" id="impuestof">
      {{--FIN FACTURA MONEDA--}}
      @can('factura.add')
      @if($dataf['factura_generada'] == 0)
      <div class="modal-footer" align="center">
        <button type="submit" class="mt-1 btn-transition btn btn-outline-primary" id="guardar" style="pointer-events: none;">
            <span class="btn-icon-wrapper opacity-7">
             <i class="ti-save"></i>
            </span>{{'Guardar y Generar factura'}}
        </button>
      </div>
      @endif
      @endcan
{!! Form::close() !!}