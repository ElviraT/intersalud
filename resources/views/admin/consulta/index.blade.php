@extends('layouts.Base')
@section('css')
@include('admin.consulta.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Consulta'}}</h5>
      <p class="m-b-0">{{'...'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('consulta')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'consulta'}}</a>
      </li>
  </ul>
</div>
@endsection

@section('content')
<div class="col-md-12">
  @include('flash::message')
  @if(auth()->user()->id_usuario > 0)
   <div class="card" style="background: #cdcdcd; padding: 10px;">
      <div class="col-md-12 mb-2">
        <div class="row">
          <input type="hidden" name="id_medico" id="id_medico" value="{{ isset($medico) ? $medico->id_Medico : null }}">
          <div class="col-md-3">
            <label>{{'Nombre'}}</label><br>
            <label><strong>{{$medico->Nombres_Medico.' '.$medico->Apellidos_Medicos}}</strong></label>
          </div>
          <div class="col-md-3">
            <label>{{'Especialidad'}}</label><br>
            @if($especialidad->name)
            <label><strong>{{$especialidad->name}}</strong></label>
            @else
            <label><strong>{{'No tiene'}}</strong></label>
            @endif
          </div>
          <div class="col-md-4">
            <label>{{'Número Colegio de Medicos'}}</label><br>
            <label><strong>{{$medico->Numero_Colegio_de_Medico}}</strong></label>
          </div>
          <div class="col-md-2">
            <img @if(isset($medico->Foto_Medico) &&$medico->Foto_Medico  == '')src="{{ ("avatars/".str_replace('\\','/', $medico->Foto_Medico)) }}"  @else src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" @endif alt="foto perfil" width="35%">
          </div>
        </div>
      </div>
    </div>
  @endif
    <div class="card">
      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4 mb-3 mt-3">
                {!! Form::label('paciente', 'Paciente:') !!}
                {!! Form::select('Paciente_id',$pacientes, null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'pickerSelectClass',
                    'id' => 'paciente',
                    'required'=>'required'
                ]) !!}
            </div>
            <div class="col-md-4 mb-3 mt-3">
                {!! Form::label('pacienteE', 'Paciente Especial:') !!}
                {!! Form::select('Paciente_Especial_id',$pacientesE, null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'pickerSelectClass',
                    'id' => 'pacienteE',
                    'disabled'=>'disabled'
                ]) !!}
            </div>
            <div class="col-md-4 mb-3 mt-4">
             <button type="button" class="mt-3 btn-transition btn btn-outline-primary btn-block" onclick="buscar()" id="btn_buscar"><i class="ti-search"></i>{{'Buscar'}}</button> 
            </div>

            <div class="col-md-12" style="background: #cdcdcd;">
              <label><strong>{{'Nombre:'}}</strong></label>&nbsp;<span id="nombre"></span><br>
              <label><strong>{{'Sexo:'}}</strong></label>&nbsp;<span id="sexo"></span><br>
              <label><strong>{{'Edad:'}}</strong></label>&nbsp;<span id="edad"></span><br>
              <label><strong>{{'Servicio:'}}</strong></label>&nbsp;<span id="Servicio"></span><br>
            </div>
        </div>
        <div class="row">
          <div class="col-md-12 p-2">
            @include('admin.consulta.fields')
          </div>
        </div>
      </div>
    </div>
</div>
@endsection
@section('js')
  @include('admin.consulta.js.js')
@endsection