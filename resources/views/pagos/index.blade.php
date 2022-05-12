@extends('layouts.Base')
@section('css')
  @include('pagos.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Pagos'}}</h5>
      <p class="m-b-0">{{'Listado de Pagos'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('pago')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Pagos'}}</a>
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
			    	<div class="row">
			        	<div class="col-md-3 mt-3 mb-3">
			              {!! Form::label('paciente', 'Usuario:') !!}
			              {!! Form::select('paciente',$pacientes,  null, [
			                  'placeholder' => 'Seleccione', 
			                  'class' => 'select2 form-control',
			                  'id' => 'paciente',
			                  'required'=>'required'
			                  ])
			              !!}
			            </div>
			            <div class="col-md-3 mt-3 mb-3">
			            	{!! Form::label('telefono', 'Teléfono:') !!}
			            	<input type="text" name="telefono" id="tel" class="form-control" readonly>
			            </div>
			            <div class="col-md-3 mt-3 mb-3">
			            	{!! Form::label('celular', 'Celular:') !!}
			            	<input type="text" name="celular" id="cel" class="form-control" readonly>
			            </div>
			            <div class="col-md-3 mt-3 mb-3">
			            	{!! Form::label('correo', 'Correo:') !!}
			            	<input type="text" name="correo" id="correo" class="form-control" readonly>
			            </div>
			 		</div>
		    	</div>
	    	</div>
	    </div>
    </div>
</div>
@endsection
@section('js')
 @include('pagos.js.js')
@endsection