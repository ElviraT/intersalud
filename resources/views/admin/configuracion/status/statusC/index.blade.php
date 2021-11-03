@extends('layouts.Base')
@section('css')
@include('admin.configuracion.status.statusC.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Status'}}</h5>
      <p class="m-b-0">{{'Consulta'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('status_c')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Status Consulta'}}</a>
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
                @can('status_c')
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
              @if(count($statuscs) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_statuscs" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Nombre'}}</th>
                            <th>{{'Color'}}</th>                            
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($statuscs as $resultado)
                        <tr>
                            <td>{{ $resultado->Consulta }}</td>
                            <td style="background-color:{{ $resultado->color }}; color:#FFF;">{{ $resultado->color }}</td>
                            <td>
                              @can('status_c.edit')
                                <a href="#" type="button" data-toggle="modal" data-target="#modal_statusc" class="btn-transition btn btn-outline-success" data-record-id="{{ $resultado['id_Consulta'] }}" onclick="loading_show();">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                            @endcan
                            @can('status_c.destroy')
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete11" data-record-id="{{$resultado->id_Consulta}}" data-record-title="{{$resultado->Consulta}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
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
    @include('admin.configuracion.status.statusC.modal_statusc')
    @include('admin.modales.elimina_statusc')
@endsection

@section('js')
  @include('admin.configuracion.status.statusC.js.js')
@endsection