@extends('layouts.Base')
@section('css')
@include('admin.configuracion.status.statusF.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Status'}}</h5>
      <p class="m-b-0">{{'Factura'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('status_f')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Status Factura'}}</a>
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
                @can('status_f')
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
              @if(count($statusfs) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_statusfs" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Nombre'}}</th>
                            <th>{{'Color'}}</th>                            
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($statusfs as $resultado)
                        <tr>
                            <td>{{ $resultado->Status_Factura }}</td>
                            <td style="background-color:{{ $resultado->color }}; color:#FFF;">{{ $resultado->color }}</td>
                            <td width="20">
                              @can('status_f.edit')
                                <a href="#" type="button" data-toggle="modal" data-target="#modal_statusf" class="btn-transition btn btn-outline-success" data-record-id="{{ $resultado['id_Status_Factura'] }}" onclick="loading_show();">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                              @endcan
                              @can('status_f.destroy')
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete12" data-record-id="{{$resultado->id_Status_Factura}}" data-record-title="{{$resultado->Status_Factura}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
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
    @include('admin.configuracion.status.statusF.modal_statusf')
    @include('admin.modales.elimina_statusf')
@endsection

@section('js')
  @include('admin.configuracion.status.statusF.js.js')
@endsection