@extends('layouts.Base')
@section('css')
@include('admin.tcambios.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Tipo de Cambios'}}</h5>
      <p class="m-b-0">{{'Listado de Tipo de Cambios Disponibles'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('tcambio')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Tipo de Cambios'}}</a>
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
                @can('tcambio')
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
              @if(count($tcambios) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_tcambios" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Bolívar'}}</th>
                            <th>{{'USD'}}</th>
                            <th>{{'BitCoins'}}</th>
                            <th>{{'Ethereum'}}</th>
                            <th>{{'Fecha'}}</th>
                            <th>{{'Status'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($tcambios as $resultado)
                        <tr>
                            <td>{{ $resultado->BS }}</td>
                            <td>{{ $resultado->USD }}</td>
                            <td>{{ $resultado->BitCoins }}</td>
                            <td>{{ $resultado->Ethereum }}</td>
                            <td>{{ $resultado->Fecha }}</td>
                            <td style="background-color: {{$resultado->StatusT->color}}; color: #fff">{{ $resultado->StatusT->Tasa }}</td>
                            <td width="20">
                              @can('tcambio.edit')
                                <a href="#" type="button" data-toggle="modal" data-target="#modal_tcambio" class="btn-transition btn btn-outline-success" data-record-id="{{ $resultado['id_Tasa_Cambio'] }}" onclick="loading_show();">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                              @endcan
                              @can('tcambio.destroy')
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete30" data-record-id="{{$resultado->id_Tasa_Cambio}}" data-record-title="{{$resultado->Fecha}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
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
    @include('admin.tcambios.modal_tcambio')
    @include('admin.modales.elimina_tcambio')
@endsection
@section('js')
  @include('admin.tcambios.js.js')
@endsection