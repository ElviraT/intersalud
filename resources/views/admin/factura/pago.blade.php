@extends('layouts.base')
@section('css')
<!-- Select2 -->
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" type="text/css" />
{{--datepicker --}}
 <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-datepicker.min.css')}}">
<style type="text/css">
  .fa-calendar{
    font-size: 20px !important;
    padding: 3px;
  }
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
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Facturación'}}</h5>
      <p class="m-b-0">{{'...'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('factura')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Facturación'}}</a>
      </li>
  </ul>
</div>
@endsection
@section('content')
<div class="container">
  <div class="row justify-content-center">
    @include('flash::message')
      <div class="col-md-12">
        <div class="card">
          <div class="col-md-12">
            {!! Form::open(['route' => ['factura'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
            <div class="row">
                <div class="col-md-4 mt-3 mb-3">
                  {!! Form::label('paciente', 'Usuario:') !!}
                  {!! Form::select('paciente',$pacientes,  $paciente, [
                      'placeholder' => 'Seleccione', 
                      'class' => 'select2 form-control',
                      'id' => 'paciente',
                      'required'=>'required'
                      ])
                  !!}
                </div>
                 <div class="col-md-3 mt-3 mb-3">
                    <label>{{ 'Fecha' }}</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="fa fa-calendar"></i>
                            </span>
                        </div>
                         {!!
                            Form::text('fecha', $fecha, [
                             'id' => 'fecha',
                             'placeholder'=>'Y-M-D',
                             'class' => 'form-control pull-right datepicker',
                             'required'=>'required'
                            ] )
                          !!}
                     </div>
                </div>
                <div class="col-md-4 mt-4">
                  <button type="submit" class="mt-3 btn btn-outline-primary">{{'Buscar'}}</button>
                </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
      @if(isset($dataf))
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
              @php($tsa = 0)
              <tbody>
                @if($servicios)
                  @foreach($servicios as $servicio)
                <tr>
                    <td>{{'01'}}</td>
                    <td>{{$servicio->Servicio}}</td>
                    <td>{{$servicio->Costos}}&nbsp;{{$servicio->simbolo}}</td>
                    <td>{{$servicio->Costos}}&nbsp;{{$servicio->simbolo}}</td>
                    @php($tsa += $servicio->Costos)                  
                </tr>
                <tr>
                  @endforeach
                @endif
                  <td colspan="3">{{'Subtotal'}}</td>
                  <td>{{($tsa)}}&nbsp;{{$servicio->simbolo}}</td>
                </tr>
                <tr>
                  <td colspan="3">{{'IVA 12%'}}</td>
                  <td>{{ $iva }}</td>
                </tr>
                <tr>
                  <td colspan="3">{{'Total a Pagar'}}</td>
                  <td>{{($tsa + $iva)}}&nbsp;{{$servicio->simbolo}}</td>
                </tr>
              </tbody>
            </table>
          {{--FIN DE DETALLE--}}
          {{--DETALLE FACTURA ENVIAR--}}
          <input type="hidden" name="Servicio_id[0]" value="{{$dataf->Servicio->id_Servicio}}">
          <input type="hidden" name="Cantidad" value="1">
          <input type="hidden" name="Costo_Servicio[0]" value="{{$dataf->Servicio->Costos}}">
          <input type="hidden" name="moneda" value="{{$dataf->Servicio->simbolo}}">
          <input type="hidden" name="iva" value="{{$iva}}">
          {{--<input type="hidden" name="impuesto" value="{{$impuesto}}">--}}
          <input type="hidden" name="Status_Factura_id" value="">
          @if($servicios)
            @foreach($servicios as $key => $servicio)
              <input type="hidden" name="Servicio_id[$key+1]" value="{{$servicio->id_Servicio}}">
              <input type="hidden" name="Costo_Servicio[$key+1]" value="{{$servicio->Costos}}">
            @endforeach
          @endif
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
      @endif
  </div>
</div>
@endsection
@section('js')
<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>
{{--datepicker--}}
<script src="{{ asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{ asset('js/bootstrap-datepicker.es.js')}}"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
        closeOnSelect: true,
         });
    //Date picker
    var dtn = new Date();
    $('#fecha').datepicker({
        autoclose: true,
        format: 'yyyy-mm-dd',
        viewMode: "years",
        todayHighlight: true,
        language: 'es',
        endDate : dtn
    });
   
  });
</script>
@endsection