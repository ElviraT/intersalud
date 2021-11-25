@extends('layouts.Base')
@section('css')
@include('admin.configuracion.usuarios.usuariosA.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Usuarios'}}</h5>
      <p class="m-b-0">{{'Asistentes'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('usuario_a')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Asistentes'}}</a>
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
                @can('usuario_a.add')
                <a href="{{ route('usuario_a.create')}}" type="button" class="btn-transition btn btn-outline-primary" onclick="loading_show();">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    {{'Agregar'}}
                </a>
                @endcan
              </div>
            </div>
            <div class="card">
              @if(count($usuariosA) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_usuariosA" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Nombre'}}</th>
                            <th>{{'Medico'}}</th>
                            <th>{{'Status'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($usuariosA as $resultado)
                        <tr>
                            <td>{{ $resultado->Nombre_Asistente.' '.$resultado->Apellidos_Asistente}}</td>
                            <td>{{ $resultado->UsuarioM->Nombres_Medico.' '.$resultado->UsuarioM->Apellidos_Medicos}}</td>
                            <td style="background-color: {{$resultado->Status->color}}; color: #fff">{{ $resultado->Status->Status }}</td>
                            <td width="20">
                              @can('usuario_a.edit')
                                <a href="{{ route('usuario_a.edit', $resultado['id_asistente'])}}" type="button" onclick="loading_show();" class="btn-transition btn btn-outline-success">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                              @endcan
                              @can('usuario_a.destroy')
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete16" data-record-id="{{$resultado->id_asistente}}" data-record-title="{{$resultado->Nombre_Asistente.' '.$resultado->Apellidos_Asistente}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
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
    @include('admin.modales.elimina_asistente')
@endsection

@section('js')
  @include('admin.configuracion.usuarios.usuariosA.js.js')
@endsection