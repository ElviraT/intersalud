@extends('layouts.base')
@section('css')
@include('admin.factura.css.css')
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
      <div class="col-md-12">          
          <div class="card p-3">          
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
          <input type="text" name="total_pagar" id="total_pagar" value="{{($tsa + $iva)}}">
          <input type="text" name="simbolo" id="simbolo" value="{{$servicio->simbolo}}">        
          </div>
      </div>
      @endif
      <div class="col-md-12">
        <h3>{{'Datos del pago'}}</h3>
        <div class="card p-3">
            <div class="row">
              <div class="col-md-2">
                {!! Form::label('tpago', 'Tipo de Pago:') !!}
                {!! Form::select('tpago',$tpago, null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control',
                    'id' => 'tpago',
                    'required'=>'required'
                    ])
                !!}
              </div>
              <div class="col-md-2">
                {!! Form::label('moneda', 'Moneda:') !!}
                {!! Form::select('moneda',$monedas, null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control',
                    'id' => 'moneda',
                    'required'=>'required'
                    ])
                !!}
              </div>
              <div class="col-md-2">
                {!! Form::label('statusP', 'Estatus Pago:') !!}
                {!! Form::select('statusP',$status, null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control',
                    'id' => 'statusP',
                    'required'=>'required'
                    ])
                !!}
              </div>
              <div class="col-md-2" id="bs" hidden>
                {!! Form::label('cbs', 'Cuenta BS:') !!}
                {!! Form::select('cbs',$cbs, null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control',
                    'id' => 'cbs'
                    ])
                !!}
              </div>
              <div class="col-md-2" id="usd" hidden>
                {!! Form::label('cusd', 'Cuenta USD:') !!}
                {!! Form::select('cusd',$cusd, null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control',
                    'id' => 'cusd'
                    ])
                !!}
              </div>
              <div class="col-md-2" id="billetera" hidden>
                {!! Form::label('billetera', 'Billetera:') !!}
                {!! Form::select('billetera',$cbilletera, null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control',
                    'id' => 'billetera'
                    ])
                !!}
              </div>
              <div class="col-md-4" hidden id="referencia">
                 {!! Form::label('ref', 'Referencia:') !!}
                <input type="number" name="ref" id="ref" class="form-control">
              </div>
              <div class="col-md-12 mt-3">
                <button type="button" class="btn btn-outline-info" onclick="calcular()">{{'Calcular'}}</button>
              </div>
            </div>
        </div>
      </div>
  </div>
</div>
@endsection
@section('js')
@include('admin.factura.js.js')
@endsection