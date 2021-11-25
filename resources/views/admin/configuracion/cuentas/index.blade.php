@extends('layouts.Base')
@section('css')
@include('admin.configuracion.cuentas.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Cuentas USD'}}</h5>
      <p class="m-b-0">{{'Listado de Cuentas USD Disponibles'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('cuentaUSD')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Cuenta USD'}}</a>
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
                @can('cuentaUSD')
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
              @if(count($cuentas) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_cuentas" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Entidad'}}</th>
                            <th>{{'Medico'}}</th>
                            <th>{{'Número de cuenta'}}</th>
                            <th>{{'Tipo'}}</th>
                            <th>{{'Fecha'}}</th>
                            <th>{{'Status'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($cuentas as $resultado)
                        <tr>
                            <td>{{ $resultado->EntidadesUSD->Entidad_USD }}</td>
                            <td>{{ $resultado->UsuarioM->Nombres_Medico.' '.$resultado->UsuarioM->Apellidos_Medicos }}</td>
                            <td>{{ $resultado->Numero_Cuenta }}</td>
                            <td>{{ $resultado->TipoCuenta->descripcion }}</td>
                            <td>{{ date('Y-m-d', strtotime($resultado->Fecha)) }}</td>
                            <td style="background-color: {{$resultado->Status->color}}; color: #fff">{{ $resultado->Status->Status }}</td>
                            <td width="20">
                              @can('cuentaUSD.edit')
                                <a href="#" type="button" data-toggle="modal" data-target="#modal_cuentaUSD" class="btn-transition btn btn-outline-success" data-record-id="{{ $resultado['id_Cuenta_USD'] }}" onclick="loading_show();">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                              @endcan
                              @can('cuentaUSD.destroy')
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete26" data-record-id="{{$resultado->id_Cuenta_USD}}" data-record-title="{{$resultado->Numero_Cuenta}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
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
    @include('admin.configuracion.cuentas.modal_cuentaUSD')
    @include('admin.modales.elimina_cuentaUSD')
@endsection

@section('js')
  @include('admin.configuracion.cuentas.js.js')
@endsection