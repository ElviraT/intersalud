@extends('layouts.Base')
@section('css')
@include('admin.configuracion.usuarios.usuariosP.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Usuarios'}}</h5>
      <p class="m-b-0">{{'Pacientes'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('usuario_p')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Pacientes'}}</a>
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
                @can('usuario_p.create')
                <a href="{{ route('usuario_p.create')}}" type="button" class="btn-transition btn btn-outline-primary" onclick="loading_show();">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    {{'Agregar'}}
                </a>
                @endcan
              </div>
            </div>
            <div class="card">
              @if(count($usuariosP) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_usuariosP" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Nombre'}}</th>
                            <th>{{'DNI'}}</th>
                            <th>{{'Sexo'}}</th>
                            <th>{{'Status'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($usuariosP as $resultado)
                        <tr>
                            <td>{{ $resultado->Nombres_Paciente.' '.$resultado->Apellidos_Paciente}}</td>
                            <td>{{ $resultado->PrefijoDNI->Prefijo_CIDNI.' '.$resultado->CIDNI }}</td>
                            <td>{{ $resultado->Sexo->Sexo }}</td>
                            <td style="background-color: {{$resultado->Status->color}}; color: #fff">{{ $resultado->Status->Status }}</td>
                            <td width="20">
                              @can('usuario_p.edit')
                                <a href="{{ route('usuario_p.edit', $resultado['id_Paciente'])}}" type="button" onclick="loading_show();" class="btn-transition btn btn-outline-success">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                      <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                              @endcan
                              @can('usuario_pe')
                                <a href="{{ route('usuario_pe', $resultado['id_Paciente'])}}" type="button" onclick="loading_show();" class="btn-transition btn btn-outline-info">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                      <i class="fa fa-plus-circle"></i>
                                    </span>
                                    {{'Familiar'}}
                                </a>
                              @endcan
                              @can('usuario_p.destroy')
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete17" data-record-id="{{$resultado->id_Paciente}}" data-record-title="{{$resultado->Nombres_Paciente.' '.$resultado->Apellidos_Paciente}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
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
    @include('admin.modales.elimina_paciente')
@endsection

@section('js')
  @include('admin.configuracion.usuarios.usuariosP.js.js')
@endsection