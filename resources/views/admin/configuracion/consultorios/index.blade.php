@extends('layouts.Base')
@section('css')
@include('admin.configuracion.consultorios.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Consultorios'}}</h5>
      <p class="m-b-0">{{'Listado de Consultorios Disponibles'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('consultorio')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Consultorios'}}</a>
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
                @can('consultorio')
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
              @if(count($consultorios) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else
                  <div class="col-md-12 mt-3">
                    <table id="table_consultorios" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>{{'Local'}}</th>
                                <th>{{'Teléfono'}}</th>
                                <th>{{'Celular'}}</th>
                                <th>{{'Correo'}}</th>
                                <th>{{'Especialidad Medica'}}</th>
                                <th>{{'Status'}}</th>
                                <th>{{'Acción'}}</th>
                            </tr>
                        </thead>
                        <tbody>
                          @foreach($consultorios as $resultado)
                            <tr>
                                <td>{{ $resultado->Local }}</td>
                                <td>{{ $resultado->Telefono }}</td>
                                <td>{{ $resultado->Celular }}</td>
                                <td>{{ $resultado->Correo }}</td>
                                <td>{{ $resultado->Especialidad->Espacialiadad_Medica }}</td>
                                <td style="background-color: {{$resultado->Status->color}}; color: #fff">{{ $resultado->Status->Status }}</td>
                                <td>
                                  @can('consultorio.edit')
                                    <a href="#" type="button" data-toggle="modal" data-target="#modal_consultorio" class="btn-transition btn btn-outline-success" data-record-id="{{ $resultado['id_Consultorio'] }}" onclick="loading_show();">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="ti-pencil"></i>
                                        </span>
                                        {{'Editar'}}
                                    </a>
                                  @endcan
                                  @can('consultorio.destroy')
                                    <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete23" data-record-id="{{$resultado->id_Consultorio}}" data-record-title="{{$resultado->Local}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
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
    @include('admin.configuracion.consultorios.modal_consultorio')
    @include('admin.modales.elimina_consultorio')
@endsection

@section('js')
  @include('admin.configuracion.consultorios.js.js')
@endsection