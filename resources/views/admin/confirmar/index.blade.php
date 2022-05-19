@extends('layouts.Base')
@section('css')
  @include('admin.confirmar.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Confirmar'}}</h5>
      <p class="m-b-0">{{'Pagos'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('confirmar_pago')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Confirmar Pagos'}}</a>
      </li>
  </ul>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
	   <div class="col-md-12">
        <div class="card">
          <div class="col-md-12">
            {!! Form::open(['route' => ['confirmar_pago'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
            <div class="row">
                <div class="col-md-3 mt-3 mb-3">
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
                    <label>{{ 'Fecha de la cita' }}</label>
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
                <div class="col-md-3 mt-4">
                  <button type="submit" class="mt-3 btn btn-outline-primary">{{'Buscar'}}</button>
                </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
         @if(isset($dataf) && isset($servicios))
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
	          <input type="hidden" name="total_pagar" id="total_pagar" value="{{($tsa + $iva)}}">
	          <input type="hidden" name="simbolo" id="simbolo" value="{{$servicio->simbolo}}">        
	          </div>
	      </div>
	      @endif
       </div>
      @if($pago)
      <div class="col-md-12">
      	<div class="card">
      		<div class="col-md-12">
      			<div class="row">
      				<div class="col-md-3 mt-3">
      					<h5>{{'Monto transferido:'}}</h5>&nbsp;<label>{{$pago->monto}}&nbsp;{{$pago->moneda_id}}</label>  					
      				</div>
      				<div class="col-md-3 mt-3">
      					<h5>{{'Referencia:'}}</h5>&nbsp;<label>{{$pago->referencia}}</label> 
      				</div>
      				<div class="col-md-3 mt-3">  				
      					<h5>{{'Fecha del pago:'}}</h5>&nbsp;<label>{{$pago->fecha_pago}}</label>
      				</div>
      				@if($pago->banco_emisor != null)
      				<div class="col-md-3 mt-3">		
      					<h5>{{'Banco Emisor:'}}</h5>&nbsp;<label>{{$pago->Banco->Bancos}}</label>
      				</div>
      				@endif
      				@if($pago->entidad_emisora != null)
      				<div class="col-md-3 mt-3">
      					<h5>{{'Entidad Emisora:'}}</h5>&nbsp;<label>{{$pago->EntidadesUSD->Entidad_USD}}</label>
      				</div>
      				@endif
      				@if($pago->billetera_emisora != null)
      				<div class="col-md-3 mt-3">
      					<h5>{{'Billetera Emisora:'}}</h5>&nbsp;<label>{{$pago->Billetera->Billetera}}</label>
      				</div>
      				@endif
      				<div class="col-md-12 mt-3" align="center">
      					<h5>{{'Comprobante:'}}</h5>
      					<img src="{{ asset("avatars/".str_replace('\\','/', $pago->comprobante)) }}" width="40%">
      				</div>      			
      			</div>      			
      		</div>
      	</div>
      </div>
      @endif
    </div>
</div>
@endsection
@section('js')
 @include('admin.confirmar.js.js')
@endsection