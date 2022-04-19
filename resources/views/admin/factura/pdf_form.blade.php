@extends('layouts.base_login')
@section('css')
<!-- Select2 -->
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<style type="text/css">
  #tabla{
    margin-top: 20px; 
    border-collapse: collapse;
    width: 100%;
  }

#tabla td, #tabla th {
  border: 1px solid #ddd;
  padding: 8px;
}

#tabla tr:nth-child(even){background-color: #f2f2f2;}

#tabla tr:hover {background-color: #ddd;}

#tabla th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #88D939;
  color: #0852B5;
}
</style>
@endsection
@section('content')
<div class="card">
  <div class="col-md-12 p-3">
    <div class="row">
      <div class="col-md-3">
        {!! Form::label('tipoP', 'Tipo de pago:') !!}
        {!! Form::select('tipoP',$tipoP,  null, [
            'placeholder' => 'Seleccione', 
            'class' => 'select2 form-control',
            'id' => 'tipoP',
            'required'=>'required'
            ])
        !!}
      </div>
      <div class="col-md-3">
          {!! Form::label('simbolo', 'Moneda:') !!}
          {!! Form::select('simbolo',$simbol, null, [
              'placeholder' => 'Seleccione', 
              'class' => 'select2 form-control',
              'id' => 'simbolo',
              'required'=>'required'
              ]) !!}
      </div>
    </div>
  </div>
</div>
  <div class="card">
    {!! Form::open(['route' => ['factura.add'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
    <div class="col-md-12">
      <div class="row p-2" style="border: 2px solid #dd0000;">
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
      {{--ENCABEZADO DE FACTURA MOSTRAR--}}
        <div class="col-md-12">
          <div class="row">
            <div class="col-md-3 p-3 m-1">
                <img src="{{ asset('img/Logo.png')}}" width="100%">          
            </div>
            <div class="col-md-5 p-3 m-1" style="border: 1px solid grey; border-radius: 20px;">
              <label><strong>{{$dataf->UsuarioM->Nombres_Medico}}{{' '}}{{$dataf->UsuarioM->Apellidos_Medicos}}</strong></label><br>
              <label>{{$dataf->UsuarioM->User->email}}</label><br>
              <label>{{$dataf->UsuarioM->Seniat->Direccion}}</label><br>
              <label>{{$dataf->UsuarioM->ControlEspecialidades->Especialidad->Consultorio->Telefono}}</label><br>
              <label>{{$dataf->UsuarioM->Seniat->RIF}}</label>
            </div>
            <div class="col-md-3 p-3 m-1" style="border: 1px solid grey; border-radius: 20px;">
              <h5><strong>{{'N Factura: '}}</strong></h5>
            </div>
          </div>
        </div>
        <div class="col-md-12 m-1" style="border: 1px solid grey; border-radius: 20px;">
          <div class="row">
            <div class="col-md-12 mt-2" align="center">
            <h5>{{'Datos del cliente'}}</h5>
            </div>
            <div class="col-md-6 p-3">
              <label>{{'Fecha de emisión:'}}</label> &nbsp;{{ date('Y-m-d') }}<br>
              <label>{{'Nombre o razón social:'}}</label> &nbsp;{{ $dataf->UsuarioP->Nombres_Paciente}}&nbsp;{{$dataf->UsuarioP->Apellidos_Paciente }}<br>
              <label>{{'DNI:'}}</label> &nbsp;{{ $dataf->UsuarioP->PrefijoDNI->Prefijo_CIDNI }}&nbsp;{{$dataf->UsuarioP->CIDNI }}<br>
              <label>{{'Sexo:'}}</label> &nbsp;{{ $dataf->UsuarioP->Sexo->Sexo}}                
            </div>
            <div class="col-md-6 p-3">
              <label>{{'Dirección:'}}</label> &nbsp;{{ $dataf->UsuarioP->DireccionPaciente->Direccion}}<br>
              <label>{{'Edad:'}}</label> &nbsp;<span id="edad"></span>&nbsp; {{'Años'}}<br>                
              <label>{{'Teléfono:'}}</label> &nbsp;{{ $dataf->UsuarioP->DireccionPaciente->Telefono}}<br>                
              <label>{{'Correo:'}}</label> &nbsp;{{ $dataf->UsuarioP->DireccionPaciente->Correo}}                
            </div>
          </div>
        </div>
      {{--FIN DE ENCABEZADO MOSTRAR--}}
      {{--DETALLE DE FACTURA MOSTRAR--}}
        <table id="tabla">
          <thead>
            <tr>
              <th>{{'Cant'}}</th>
              <th>{{'Descripción'}}</th>
              <th>{{'Precio uni.'}}</th>
              <th>{{'Total'}}</th>
            </tr>
          </thead>
          @php($iva= ($dataf->Servicio->Costos * 12 / 100)) 
          @php($total = ($dataf->Servicio->Costos+$iva))
          <tbody>
            {{dd($dataf->Servicio)}}
            <tr>
              <td>{{'01'}}</td>
              <td>{{$dataf->Servicio->Servicio}}</td>
              <td>{{$dataf->Servicio->Costos}}&nbsp;{{$dataf->Servicio->simbolo}}</td>
              <td>{{$dataf->Servicio->Costos}}&nbsp;{{$dataf->Servicio->simbolo}}</td>
            </tr>
            <tr>
              <td colspan="3">{{'Subtotal'}}</td>
              <td>{{$dataf->Servicio->Costos}}&nbsp;{{$dataf->Servicio->simbolo}}</td>
            </tr>
            <tr>
              <td colspan="3">{{'IVA 12%'}}</td>
              <td>{{ $iva }}</td>
            </tr>
            <tr>
              <td colspan="3">{{'Total a Pagar'}}</td>
              <td>{{$total}}&nbsp;{{$dataf->Servicio->simbolo}}</td>
            </tr>
          </tbody>
        </table>
      {{--FIN DE DETALLE--}}
      {{--DETALLE FACTURA ENVIAR--}}
      <input type="hidden" name="Servicio_id" value="{{$dataf->Servicio->id_Servicio}}">
      <input type="hidden" name="Cantidad" value="1">
      <input type="hidden" name="Costo_Servicio" value="{{$dataf->Servicio->Costos}}">
      <input type="hidden" name="moneda" value="{{$dataf->Servicio->simbolo}}">
      <input type="hidden" name="iva" value="{{$iva}}">
      <input type="hidden" name="impuesto" value="{{$impuesto}}">
      <input type="hidden" name="Status_Factura_id" value="">
      {{--FIN DETALLE FACTURA ENVIAR--}}
      </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="mt-1 btn-transition btn btn-outline-primary">
            <span class="btn-icon-wrapper pr-2 opacity-7">
             <i class="ti-save"></i>
            </span>{{'Guardar'}}
        </button>
    </div>
    {!! Form::close() !!}
  </div>
@endsection
@section('js')
<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
        closeOnSelect: true,
         });
    
    var hoy = new Date();
    var cumpleanos = new Date('{{$dataf->UsuarioP->Fecha_Nacimiento_Paciente}}');
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    };
    $('#edad').html(edad);
})
</script>
@endsection