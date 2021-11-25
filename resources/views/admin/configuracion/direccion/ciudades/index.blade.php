@extends('layouts.Base')
@section('css')
@include('admin.configuracion.direccion.ciudades.css.css')
@endsection

@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Dirección'}}</h5>
      <p class="m-b-0">{{'Ciudades'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('ciudad')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Ciudades'}}</a>
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
                @can('ciudad.add')
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
              @if(count($ciudades) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_ciudades" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Estado'}}</th>
                            <th>{{'Ciudad'}}</th>
                            <th>{{'Capital'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($ciudades as $resultado)
                      @php($estado = DB::select('select Estado from estados where id_Estado ='.$resultado['Estado_id']))
                        <tr>
                            <td>{{ $estado[0]->Estado }}</td>
                            <td>{{ $resultado->Ciudad }}</td>
                            @if($resultado->Capital == '1')
                            <td>{{ 'Si' }}</td>
                            @else
                            <td>{{ 'No' }}</td>
                            @endif
                            <td width="20">
                              @can('ciudad.edit')
                                <a href="#" type="button" data-toggle="modal" data-target="#modal_ciudad" class="btn-transition btn btn-outline-success" data-record-id="{{ $resultado['id_Ciudad'] }}" onclick="loading_show();">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                              @endcan
                              @can('ciudad.destroy')
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete3" data-record-id="{{$resultado->id_Ciudad}}" data-record-title="{{$resultado->Ciudad}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
                                        <span class="btn-icon-wrapper pr-2 opacity-7">
                                            <i class="ti-eraser"></i>
                                        </span>{{'Eliminar'}}
                                </a>
                              @endcan
                            </td>
                        </tr>
                      @endforeach

                    </tbody> 
                    <tfoot>
                        <tr>
                            <th>{{'Estado'}}</th>
                            <th>{{'Ciudad'}}</th>
                            <th>{{'Capital'}}</th>
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
    @include('admin.configuracion.direccion.ciudades.modal_ciudad')
    @include('admin.modales.elimina_ciudad')
@endsection

@section('js')
  @include('admin.configuracion.direccion.ciudades.js.js')
@endsection
