@extends('layouts.Base')
@section('css')
@include('admin.configuracion.status.status.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Status'}}</h5>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('status_t')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Status'}}</a>
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
                @can('status')
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
              @if(count($status) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_status" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Nombre'}}</th>
                            <th>{{'Color'}}</th>                            
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($status as $resultado)
                        <tr>
                            <td>{{ $resultado->Status }}</td>
                            <td style="background-color:{{ $resultado->color }}; color:#FFF;">{{ $resultado->color }}</td>
                            <td width="20">
                              @can('status.edit')
                                <a href="#" type="button" data-toggle="modal" data-target="#modal_status" class="btn-transition btn btn-outline-success" data-record-id="{{ $resultado['id_Status'] }}" onclick="loading_show();">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                            @endcan
                            @can('status.destroy')
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete14" data-record-id="{{$resultado->id_Status}}" data-record-title="{{$resultado->Status}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
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
    @include('admin.configuracion.status.status.modal_status')
    @include('admin.modales.elimina_status')
@endsection

@section('js')
  @include('admin.configuracion.status.status.js.js')
@endsection