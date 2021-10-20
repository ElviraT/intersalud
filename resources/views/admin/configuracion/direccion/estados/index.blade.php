@extends('layouts.Base')
@section('css')
@include('admin.configuracion.direccion.estados.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Dirección'}}</h5>
      <p class="m-b-0">{{'Estados'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('estado')}}"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Estados'}}</a>
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
                <button type="button" class="btn-transition btn btn-outline-primary" data-toggle="modal" data-target=".bd-example-modal-sm">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                    {{'Agregar'}}
                </button>

              </div>
            </div>
            <div class="card">
              @if(count($estados) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_estados" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Nombre'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($estados as $resultado)
                        <tr>
                            <td>{{ $resultado->Estado }}</td>
                            <td>
                                <a href="#" type="button" data-toggle="modal" data-target="#modal_estado" class="btn-transition btn btn-outline-success" data-record-id="{{ $resultado['id_Estado'] }}">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                            
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete2" data-record-id="{{$resultado->id_Estado}}" data-record-title="{{$resultado->Estado}}" class="btn-transition btn btn-outline-danger">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="ti-eraser"></i>
                                        </span>{{'Eliminar'}}
                                </a>
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
    @include('admin.configuracion.direccion.estados.modal_estado')
    @include('admin.modales.elimina_estado')
@endsection

@section('js')
  @include('admin.configuracion.direccion.estados.js.js')
@endsection
