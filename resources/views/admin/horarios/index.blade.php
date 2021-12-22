@extends('layouts.Base')
@section('css')
@include('admin.horarios.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Horarios'}}</h5>
      <p class="m-b-0">{{'Listado de Horarios Disponibles'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('horario')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Horarios'}}</a>
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
                @can('horario')
                <a href="{{ route('horario.create') }}" class="btn-transition btn btn-outline-primary" onclick="loading_show();">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                    {{'Agregar'}}
                </a>
                @endcan
              </div>
            </div>
            <div class="card">
              @if(count($horarios) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_horarios" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Lunes'}}</th>
                            <th>{{'Martes'}}</th>
                            <th>{{'Miércoles'}}</th>
                            <th>{{'Jueves'}}</th>
                            <th>{{'Viernes'}}</th>
                            <th>{{'Sábado'}}</th>
                            <th>{{'Domingo'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($horarios as $resultado)
                        <tr>
                          @if($resultado->Lunes == 1)
                            <td>{{ 'Si' }}</td>
                          @else
                            <td>{{ 'No' }}</td>
                          @endif
                          @if($resultado->Martes == 1)
                            <td>{{ 'Si' }}</td>
                          @else
                            <td>{{ 'No' }}</td>
                          @endif
                          @if($resultado->Miercoles == 1)
                            <td>{{ 'Si' }}</td>
                          @else
                            <td>{{ 'No' }}</td>
                          @endif
                          @if($resultado->Jueves == 1)
                            <td>{{ 'Si' }}</td>
                          @else
                            <td>{{ 'No' }}</td>
                          @endif
                          @if($resultado->Viernes == 1)
                            <td>{{ 'Si' }}</td>
                          @else
                            <td>{{ 'No' }}</td>
                          @endif
                          @if($resultado->Sabado == 1)
                            <td>{{ 'Si' }}</td>
                          @else
                            <td>{{ 'No' }}</td>
                          @endif
                          @if($resultado->Domingo == 1)
                            <td>{{ 'Si' }}</td>
                          @else
                            <td>{{ 'No' }}</td>
                          @endif                            
                            <td width="20">
                              @can('horario.edit')
                                <a href="#" type="button" data-toggle="modal" data-target="#modal_horario" class="btn-transition btn btn-outline-success" data-record-id="{{ $resultado['id_Horario_Cita'] }}" onclick="loading_show();">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                              @endcan
                              @can('horario.destroy')
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete32" data-record-id="{{$resultado->id_Horario_Cita}}" data-record-title="{{$resultado->id_Horario_Cita}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
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
    @include('admin.modales.elimina_horario')
@endsection
@section('js')
  @include('admin.horarios.js.js')
@endsection