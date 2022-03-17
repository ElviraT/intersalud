@extends('layouts.Base')
@section('css')
@include('admin.consultaO.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Consulta Online'}}</h5>
      <p class="m-b-0">{{'...'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('consultao')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'consulta Online'}}</a>
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
                    <label><strong>{{$especialidad->name}}</strong></label>
                  </div>
                  <div class="col-md-4">
                    <label>{{'Número Colegio de Medicos'}}</label><br>
                    <label><strong>{{$medico->Numero_Colegio_de_Medico}}</strong></label>
                  </div>
                  <div class="col-md-2">
                    <img src="{{ ("avatars/".str_replace('\\','/',$medico->Foto_Medico))}}" alt="foto perfil" width="35%">
                  </div>
                </div>
              </div>
            </div>
          @endif
            <div class="card">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-12 col-lg-5">
                    <div class="row">
                      <div class="col-md-6 mt-3">
                            {!! Form::label('paciente', 'Paciente:') !!}
                            {!! Form::select('Paciente_id',$pacientes, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control',
                                'id' => 'paciente',
                                'required'=>'required'
                            ]) !!}
                        </div>
                        <div class="col-md-6 mt-3">
                            {!! Form::label('pacienteE', 'Paciente Especial:') !!}
                            {!! Form::select('Paciente_Especial_id',$pacientesE, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control',
                                'id' => 'pacienteE',
                                'disabled'=>'disabled'
                            ]) !!}
                        </div>
                        <div class="col-md-12 mt-3">
                         <button type="button" class="mt-1 btn-transition btn btn-outline-primary btn-block" onclick="buscar()"><i class="ti-search"></i>{{'Buscar'}}</button> 
                        </div>

                        <div class="col-md-11 m-3 mr-3" style="background: #cdcdcd; padding: 5px;">
                          <label><strong>{{'Nombre: '}}</strong></label><span id="nombre"></span><br>
                          <label><strong>{{'Sexo: '}}</strong></label><span id="sexo"></span><br>
                          <label><strong>{{'Edad: '}}</strong></label><span id="edad"></span><br>
                        </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-lg-7">
                    <div class="row">
                      <div class="col-md-12 p-2">
                        <iframe src="https://intersalud.iaelaonline.com/intersalud-master/public/" width="100%" id="iFrame1" allowfullscreen></iframe>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12 p-2">
                    @include('admin.consultaO.fields')
                  </div>
                </div>
              </div>
            </div>
        </div>
@endsection
@section('js')
  @include('admin.consultaO.js.js')
@endsection