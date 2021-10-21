@extends('layouts.Base')
@section('css')
@include('admin.configuracion.direccion.municipios.css.css')
@endsection

@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Dirección'}}</h5>
      <p class="m-b-0">{{'Municipios'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('municipio')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Municipios'}}</a>
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
                <button type="button" class="btn-transition btn btn-outline-primary" data-toggle="modal" data-target=".bd-example-modal-sm" onclick="loading_show();">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                    {{'Agregar'}}
                </button>

              </div>
            </div>
            <div class="card">
              @if(count($municipios) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_municipios" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Estado'}}</th>
                            <th>{{'Municipio'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($municipios as $resultado)
                      @php($estado = DB::select('select Estado from estados where id_Estado ='.$resultado['Estado_id']))
                        <tr>
                            <td>{{ $estado[0]->Estado }}</td>
                            <td>{{ $resultado->Municipio }}</td>
                            <td>
                                <a href="#" type="button" data-toggle="modal" data-target="#modal_municipio" class="btn-transition btn btn-outline-success" data-record-id="{{ $resultado['id_Municipio'] }}" onclick="loading_show();">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                            
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete4" data-record-id="{{$resultado->id_Municipio}}" data-record-title="{{$resultado->Municipio}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="ti-eraser"></i>
                                        </span>{{'Eliminar'}}
                                </a>
                            </td>
                        </tr>
                      @endforeach

                    </tbody> 
                    <tfoot>
                        <tr>
                            <th>{{'Estado'}}</th>
                            <th>{{'Municipio'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </tfoot>                  
                </table>
              </div>
               @endif
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
    @include('admin.configuracion.direccion.municipios.modal_municipio')
    @include('admin.modales.elimina_municipio')
@endsection

@section('js')
  @include('admin.configuracion.direccion.municipios.js.js')
@endsection
