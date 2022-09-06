@extends('layouts.Base')
@section('css')
@include('admin.configuracion.agendas.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Agenda'}}</h5>
      <p class="m-b-0">{{'Agenda Disponibles'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('agendas')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Agenda'}}</a>
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
              <div class="col-md-4 mt-2 mb-2">
               @can('agendas')
                <button type="button" class="btn-transition btn btn-outline-primary" data-toggle="modal" data-target=".bd-example-modal-sm" onclick="loading_show();">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                    {{'Agregar'}}
                </button>
               @endcan
              </div>
            </div>
            <div class="card">
              @if(count($agendas) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_agendas" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Medico'}}</th>
                            <th>{{'Especialidad'}}</th>
                            <th>{{'Consultorio'}}</th>
                            <th>{{'Maximo'}}<br>{{ 'de pacientes' }}</th>
                            <th>{{'Status'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($agendas as $resultado)
                        <tr>
                            <td>{{ $resultado->UsuarioM->Nombres_Medico.' '.$resultado->UsuarioM->Apellidos_Medicos }}</td>
                            <td>{{ $resultado->Especialidad->Espacialiadad_Medica }}</td>
                            @if(isset($resultado->Consultorio->Local))
                              <td>{{ $resultado->Consultorio->Local }}</td>
                            @else
                              <td>{{'sin consultorio'}}</td>
                            @endif
                            <td>{{ $resultado->Max_pacientes }}</td>
                            <td style="background-color: {{$resultado->Status->color}}; color: #fff">{{ $resultado->Status->Status }}</td>
                            <td width="20">
                              @can('agendas.edit')
                                <a href="#" type="button" data-toggle="modal" data-target="#modal_agenda" class="btn-transition btn btn-outline-success" data-record-id="{{ $resultado['id_Agenda'] }}" onclick="loading_show();">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                              @endcan
                              @can('agendas.destroy')
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete33" data-record-id="{{$resultado->id_Agenda}}" data-record-title="{{ $resultado->UsuarioM->Nombres_Medico.' '.$resultado->UsuarioM->Apellidos_Medicos }}-{{ $resultado->Especialidad->Espacialiadad_Medica }}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="ti-eraser"></i>
                                        </span>{{'Eliminar'}}
                                </a>
                              @endcan
                            </td>
                        </tr>
                      @endforeach

                    </tbody>                   
                </table>
              </div>
               @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
  @include('admin.configuracion.agendas.modal_agenda')
  @include('admin.modales.elimina_agenda')
@endsection

@section('js')
  @include('admin.configuracion.agendas.js.js')
@endsection