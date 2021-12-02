@extends('layouts.Base')
@section('css')
@include('admin.configuracion.usuarios.usuariosPE.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Usuarios'}}</h5>
      <p class="m-b-0">{{'Pacientes Especiales'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('usuario_pe' ,$id)}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Pacientes Especiales'}}</a>
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
                @can('usuario_pe.add')
                <a href="{{ route('usuario_pe.agregar', $id)}}" type="button" class="btn-transition btn btn-outline-primary btn-sm" onclick="loading_show();">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    {{'AGREGAR'}}
                </a>
                @endcan
              </div>
            </div>
            <div class="card">
              @if(count($usuariosPE) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_usuariosPE" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Nombre'}}</th>
                            <th>{{'DNI'}}</th>
                            <th>{{'Sexo'}}</th>
                            <th>{{'Parentesco'}}</th>
                            <th>{{'Status'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($usuariosPE as $resultado)
                        <tr>
                            <td>{{ $resultado->Nombre_Paciente_Especial.' '.$resultado->Apellido_Paciente_Especial}}</td>
                            <td>{{ $resultado->Prefijo_CIDNI_id.' '.$resultado->CIDNI }}</td>
                            <td>{{ $resultado->Sexo->Sexo }}</td>
                            <td>{{ $resultado->Parentesco_Familiar }}</td>
                            <td style="background-color: {{$resultado->Status->color}}; color: #fff">{{ $resultado->Status->Status }}</td>
                            <td width="20">
                              @can('usuario_pe.edit')
                                <a href="{{ route('usuario_pe.edit', $resultado['id_Pacientes_Especiales'])}}" type="button" onclick="loading_show();" class="btn-transition btn btn-outline-success btn-sm">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'EDITAR'}}
                                </a>
                              @endcan
                              @can('usuario_pe.destroy')
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete28" data-record-id="{{$resultado->id_Pacientes_Especiales}}" data-record-title="{{$resultado->Nombre_Paciente_Especial.' '.$resultado->Apellido_Paciente_Especial}}" class="btn-transition btn btn-outline-danger btn-sm" onclick="loading_show();">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-eraser"></i>
                                    </span>{{'ELIMINAR'}}
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
    @include('admin.modales.elimina_paciente_especial')
@endsection

@section('js')
  @include('admin.configuracion.usuarios.usuariosPE.js.js')
@endsection