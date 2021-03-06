@extends('layouts.Base')
@section('css')
@include('admin.configuracion.status.statusT.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Status'}}</h5>
      <p class="m-b-0">{{'Tasas'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('status_t')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Status Tasas'}}</a>
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
                @can('status_t')
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
              @if(count($statusts) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_statusts" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Nombre'}}</th>
                            <th>{{'Color'}}</th>                            
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($statusts as $resultado)
                        <tr>
                            <td>{{ $resultado->Tasa }}</td>
                            <td style="background-color:{{ $resultado->color }}; color:#FFF;">{{ $resultado->color }}</td>
                            <td width="20">
                              @can('status_t.edit')
                                <a href="#" type="button" data-toggle="modal" data-target="#modal_statust" class="btn-transition btn btn-outline-success" data-record-id="{{ $resultado['id_Status_Tasa'] }}" onclick="loading_show();">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                              @endcan
                              @can('status_t.destroy')
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete13" data-record-id="{{$resultado->id_Status_Tasa}}" data-record-title="{{$resultado->Tasa}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
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
    @include('admin.configuracion.status.statusT.modal_statust')
    @include('admin.modales.elimina_statust')
@endsection

@section('js')
  @include('admin.configuracion.status.statusT.js.js')
@endsection