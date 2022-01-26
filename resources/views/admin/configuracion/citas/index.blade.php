@extends('layouts.Base')
@section('css')
@include('admin.configuracion.citas.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Citas Consultas'}}</h5>
      <p class="m-b-0">{{'Citas Consultas Disponibles'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('agenda')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Citas Consultas'}}</a>
      </li>
  </ul>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
          @include('flash::message')
           
            <div class="card">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-4 mt-3">
                    {!! Form::label('medico', 'Medico:') !!}
                    {!! Form::select('medico',$medico, isset($horarios) ? $horarios->Medico_id : null, [
                        'placeholder' => 'Seleccione', 
                        'class' => 'select2 form-control',
                        'id' => 'medico',
                        'required'=>'required'
                        ])
                    !!}
                  </div>
                  <div class="col-md-4 mt-3">
                      {!! Form::label('especialidad', 'Especialidad Medica:') !!}
                      {!! Form::select('especialidad',$especialidad, isset($horarios) ? $horarios->Especialidad_id : null, [
                          'placeholder' => 'Seleccione', 
                          'class' => 'select2 form-control',
                          'disabled' => 'disabled',
                          'id' => 'especialidad',
                          'required'=>'required'
                          ]) !!}
                  </div>
                  <div class="col-md-4 mt-4">
                    <a href="#" class="btn-transition btn btn-outline-success mt-3" onclick="horario();">{{ 'Consultar Horario' }}</a>
                  </div>                  
                </div>
              </div>
              <div id='hora_seleccionada'></div>
             <div class="col-md-12 mt-5" id='calendar'></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
   @include('admin.configuracion.citas.modal_citas')
@endsection

@section('js')
  @include('admin.configuracion.citas.js.js')
@endsection