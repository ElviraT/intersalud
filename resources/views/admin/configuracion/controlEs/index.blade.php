@extends('layouts.Base')
@section('css')
@include('admin.configuracion.controlEs.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Control Especialidad'}}</h5>
      <p class="m-b-0">{{'Listado de Control Especialidad Disponibles'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('controlE')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Control Especialidad'}}</a>
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
                @can('controlE')
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
              @if(count($controlEs) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else
                  <div class="col-md-12 mt-3">
                    <table id="table_controlEs" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>{{'Medico'}}</th>
                                <th>{{'Especialidad Medica'}}</th>
                                <th>{{'Status'}}</th>
                                <th>{{'Acción'}}</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($controlEs as $resultado)
                            <tr>
                                <td>{{ $resultado->UsuarioM->Nombres_Medico.' '.$resultado->UsuarioM->Apellidos_Medicos }}</td>
                                <td>{{ $resultado->Especialidad->Espacialiadad_Medica }}</td>
                                <td style="background-color: {{$resultado->StatusM->color}}; color: #fff">{{ $resultado->StatusM->Status_Medico }}</td>
                                <td width="20">
                                  @can('controlE.edit')
                                    <a href="#" type="button" data-toggle="modal" data-target="#modal_controlE" class="btn-transition btn btn-outline-success" data-record-id="{{ $resultado['id_Control_Especialidad'] }}" onclick="loading_show();">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="ti-pencil"></i>
                                        </span>
                                        {{'Editar'}}
                                    </a>
                                  @endcan
                                  @can('controlE.destroy')
                                    <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete27" data-record-id="{{$resultado->id_Control_Especialidad}}" data-record-title="{{ $resultado->UsuarioM->Nombres_Medico.' '.$resultado->UsuarioM->Apellidos_Medicos }} - {{$resultado->Especialidad->Espacialiadad_Medica}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
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
    @include('admin.configuracion.controlEs.modal_controlE')
    @include('admin.modales.elimina_controlE')
@endsection

@section('js')
  @include('admin.configuracion.controlEs.js.js')
@endsection