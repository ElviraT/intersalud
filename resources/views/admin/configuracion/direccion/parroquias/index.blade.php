@extends('layouts.Base')
@section('css')
@include('admin.configuracion.direccion.parroquias.css.css')
@endsection

@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Dirección'}}</h5>
      <p class="m-b-0">{{'Parroquias'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('parroquia')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Parroquias'}}</a>
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
                @can('parroquia')
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
              @if(count($parroquias) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_parroquias" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Municipio'}}</th>
                            <th>{{'Nombre'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($parroquias as $resultado)
                      @php($municipio = DB::select('select Municipio from municipios where id_Municipio ='.$resultado['Municipio_id']))
                        <tr>
                            <td>{{ $municipio[0]->Municipio }}</td>
                            <td>{{ $resultado->Parroquia }}</td>
                            <td width="20">
                              @can('parroquia.edit')
                                <a href="#" type="button" data-toggle="modal" data-target="#modal_parroquia" class="btn-transition btn btn-outline-success" data-record-id="{{ $resultado['id_Parroquia'] }}" onclick="loading_show();">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                              @endcan
                              @can('parroquia.destroy')
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete5" data-record-id="{{$resultado->id_Parroquia}}" data-record-title="{{$resultado->Parroquia}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
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
                            <th>{{'Parroquia'}}</th>
                            <th>{{'Nombre'}}</th>
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
    @include('admin.configuracion.direccion.parroquias.modal_parroquia')
    @include('admin.modales.elimina_parroquia')
@endsection

@section('js')
  @include('admin.configuracion.direccion.parroquias.js.js')
@endsection
