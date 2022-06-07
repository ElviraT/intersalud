@extends('layouts.Base')
@section('css')
<style type="text/css">
  .bg-green{
    background-color: green !important;
  }
  .bg-red{
    background-color: red !important;
  }
</style>
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
                    <img @if(isset($medico->Foto_Medico) &&$medico->Foto_Medico  == '')src="{{ ("avatars/".str_replace('\\','/', $medico->Foto_Medico)) }}"  @else src="{{ Avatar::create(auth()->user()->name)->toBase64() }}" @endif alt="foto perfil" width="35%">
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
                         <button type="button" class="mt-1 btn-transition btn btn-outline-primary btn-block" onclick="buscar(); horario();"><i class="ti-search"></i>{{'Buscar'}}</button> 
                        </div>

                        <div class="col-md-11 m-3 mr-3" style="background: #cdcdcd; padding: 5px;">
                          <label><strong>{{'Nombre:'}}</strong></label>&nbsp;<span id="nombre"></span><br>
                          <label><strong>{{'Sexo:'}}</strong></label>&nbsp;<span id="sexo"></span><br>
                          <label><strong>{{'Edad:'}}</strong></label>&nbsp;<span id="edad"></span><br>
                          <label><strong>{{'Servicio:'}}</strong></label>&nbsp;<span id="Servicio"></span><br>
                        </div>
                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-6">
                              <a href="#" class="btn btn-outline-success" target="_blank" id="enlace"> {{'Mensaje de WhatsApp'}} </a>
                            </div>
                          </div>                          
                        </div>
                    </div>
                  </div>
                  <div class="col-md-12 col-lg-7">
                    <div class="row">
                      <div class="col-md-12 mt-3 mb-2" id="consulta" hidden>
                        <button class="btn btn-outline-info" onclick="iniciar_reunion()">{{'Iniciar Consulta'}}</button>
                      </div>
                      
                      <div class="col-md-12" id="meet" hidden></div>

                      <div class="col-md-10 mt-2" align="center">
                        <form name="form" class="clok">
                          <div class="row">
                             <div class="col-md-4">
                                <span>
                                  <input type="number" class="text" name="hour" id="hour" value="0">
                                </span>
                            </div>
                            <div class="col-md-4">
                                <span>
                                  <input type="number" class="text" name="minute" id="minute" value="0">
                                </span>
                            </div>
                            <div class="col-md-4">
                                <span>
                                  <input type="number" class="text" id="second" name="second" value="0">
                                </span>
                            </div>
                          </div>
                        </form>
                        <button onclick="countDown()" class="btn mt-3 btn-outline-primary" hidden="true" id="inicio"> 
                          <i class="fa fa-play" aria-hidden="true"></i>
                          {{'Iniciar'}}
                        </button>
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
@section('modal')
{{--modal citas--}}
<div id="modal_citas" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">{{ 'Agregar Cita' }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <div class="modal-body">
                <div class="col-md-12">
            <form action="" id="Myform">
                 @csrf
                 
                    <div class="row">
                        {{ Form::hidden('id', 0, ['id'=>'id'] ) }}
                        
                        {{ Form::hidden('titleP', null, ['id'=>'titleP'] ) }}
                        <div class="col-md-4 mb-3">
                            {!! Form::label('servicio', 'Servicio:') !!}
                            {!! Form::select('serviciom',$servicios, null, [
                                'placeholder' => 'Seleccione', 
                                'class' => 'select2 form-control',
                                'id' => 'serviciom',
                                'required'=>'required'
                            ]) !!}
                        </div>
                        <div class="col-md-4 mb-3" style="pointer-events: none">
                            <label for="validationCustom01">{{'Maximo de Pacientes'}}</label>
                            <input type="number" name="Max_paciente" class="form-control" id="mpaciente" placeholder="Maximo de Pacientes" required>
                        </div>
                        <div class="col-md-4 mb-3" style="pointer-events: none">
                            <label for="validationCustom01">{{'Disponibilidad'}}</label>
                            <input type="number" name="disponibilidad" class="form-control" id="disponibilidad">
                            <small id="texto" style="color: red;" hidden>{{'No hay cupos disponibles'}}</small>
                        </div>
                        <div class="col-md-4 mb-3" style="pointer-events: none">
                            <label for="validationCustom01">{{'Costo'}}</label>
                            <input type="number" name="Costo" class="form-control" id="costo" step="0.01" required>
                        </div>
                        <div class="col-md-4 mt-4" hidden>
                            <label>{{'Confirmar Cita'}}</label>
                            <input type="checkbox" name="confirmado" id="confirmado" checked>
                        </div>
                        <div class="col-md-12 mb-3" style="pointer-events: none;">
                            <label>{{'Notas del Medico'}}</label>
                            <textarea name="NotaM" id="notaM" class="form-control"></textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>{{'Nota'}}</label>
                            <textarea name="Nota" id="nota" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="validationCustom01">{{'Titulo'}}</label>
                            <input type="text" name="title" class="form-control" id="title" placeholder="Titulo del evento" required>
                        </div>
                        <div class="row">
                            <div class='col-md-6 mb-3'>
                              <div class="form-group">
                                <label>{{ 'Inicio' }}</label>
                                 <div class='input-group date' id="date-start">
                                    <input type='text' class="form-control" name="start" id="start" readonly/>
                                    <span class="input-group-addon">
                                    <span class="ti-timer"></span>
                                    </span> 
                                 </div>
                              </div>
                           </div>
                           <div class='col-md-6 mb-3' style="pointer-events: none;">
                              <div class="form-group date">
                                <label>{{ 'Fin' }}</label>
                                 <div class='input-group' id="date-end">
                                    <input type='text' class="form-control" name="end" id="end" />
                                    <span class="input-group-addon">
                                    <span class="ti-timer"></span>
                                    </span>
                                 </div>
                              </div>
                           </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="mt-1 btn-transition btn btn-outline-secondary" data-dismiss="modal">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                    </span>{{'Volver'}}
                </button>
                <button type="button" class="mt-1 btn-transition btn btn-outline-success" id="btnGuardar">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                    </span>{{'Guardar'}}
                </button>
            </div>
        </div>
    </div>
</div>
{{--fin modal citas--}}

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ 'Agregar Servicio' }}</h5>
        <label class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </label>
      </div>
      <div class="modal-body">
        <div class="col-md-12">
            <div class="mb-3">
                {!! Form::label('servicio', 'Servicio:') !!}
                {!! Form::select('id_servicio',$servicios, null, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control',
                    'id' => 'id_servicio',
                    'required'=>'required'
                ]) !!}
                <input type="hidden" class="form-control" name="Cita_Consulta_id" id="Cita_Consulta_id">
            </div>
        </div>
        <p id="status_servicio"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" onclick="return add_servicio();">{{ 'Agregar' }}</button>
        <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">{{ 'Cerrar' }}</button>
      </div>
    </div>
  </div>
</div>
@endsection
@section('js')
  @include('admin.consultaO.js.js')
@endsection