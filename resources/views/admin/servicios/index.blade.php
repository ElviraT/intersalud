@extends('layouts.Base')
@section('css')
@include('admin.servicios.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Servicios'}}</h5>
      <p class="m-b-0">{{'Listado de Servicios Disponibles'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('servicio')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Servicios'}}</a>
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
                @can('servicio')
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
              @if(count($servicios) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_servicios" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Servicio'}}</th>
                            <th>{{'Costo'}}</th>
                            <th>{{'Especialidad'}}<br>{{'Medica'}}</th>
                            <th>{{'Medico'}}</th>
                            <th>{{'Status'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($servicios as $resultado)
                        <tr>
                            <td>{{ $resultado->Servicio }}</td>
                            <td>{{ $resultado->Costos.' '.$resultado->simbolo}}</td>
                            @if(isset($resultado->Especialidad->Espacialiadad_Medica))
                            <td>{{ $resultado->Especialidad->Espacialiadad_Medica }}</td>
                            @else
                            <td>{{'No tiene especialidad'}}</td>
                            @endif
                            <td>{{ $resultado->UsuarioM->Nombres_Medico.' '.$resultado->UsuarioM->Apellidos_Medicos }}</td>
                            <td style="background-color: {{$resultado->Status->color}}; color: #fff">{{ $resultado->Status->Status }}</td>
                            <td width="20">
                              @can('servicio.edit')
                                <a href="#" type="button" data-toggle="modal" data-target="#modal_servicio" class="btn-transition btn btn-outline-success" data-record-id="{{ $resultado['id_Servicio'] }}" onclick="loading_show();">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                              @endcan
                              @can('servicio.destroy')
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete31" data-record-id="{{$resultado->id_Servicio}}" data-record-title="{{$resultado->Servicio}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
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
    @include('admin.servicios.modal_servicio')
    @include('admin.modales.elimina_servicio')
@endsection
@section('js')
  @include('admin.servicios.js.js')
@endsection