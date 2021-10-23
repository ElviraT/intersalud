@extends('layouts.Base')
@section('css')
@include('admin.configuracion.usuarios.usuariosM.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Usuarios'}}</h5>
      <p class="m-b-0">{{'Usuarios Medicos'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('usuario_m')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#">{{'Usuarios Médicos'}}</a>
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
                <a href="{{ route('usuario_m.create')}}" type="button" class="btn-transition btn btn-outline-primary" onclick="loading_show();">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fa fa-plus-circle"></i>
                    </span>
                    {{'Agregar'}}
                </a>

              </div>
            </div>
            <div class="card">
              @if(count($usuariosM) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_usuarioM" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Nombre'}}</th>
                            <th>{{'Foto Perfil'}}</th>
                            <th>{{'N° Colegio de Médicos'}}</th>
                            <th>{{'Registro MPPS'}}</th>
                            <th>{{'Status'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($usuariosM as $resultado)
                      {{--dd($resultado->StatusM->color)--}}
                        <tr>
                            <td>{{ $resultado->Nombres_Medico.' '.$resultado->Apellidos_Medicos }}</td>
                            <td class="avatar"><img alt="avatar" @if($resultado['Foto_Medico']  == '') src="{{ Avatar::create($resultado->Nombres_Medico.' '.$resultado->Apellidos_Medicos)->toBase64() }}" @else src="{{ ("avatars/".str_replace('\\','/', $resultado->Foto_Medico)) }}" @endif ></td>
                            <td>{{ $resultado->Numero_Colegio_de_Medico }}</td>
                            <td>{{ $resultado->Registro_MPPS }}</td>
                              <td style="background-color: {{$resultado->StatusM->color}}; color: #fff">{{ $resultado->StatusM->Status_Medico }}</td>
                            <td>
                                <a href="{{ route('usuario_m.edit', $resultado['id_Medico'])}}" type="button" onclick="loading_show();" class="btn-transition btn btn-outline-success">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a>
                            
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete6" data-record-id="{{$resultado->id_Medico}}" data-record-title="{{$resultado->Nombres_Medico .' '.$resultado->Apellidos_Medicos}}" class="btn-transition btn btn-outline-danger">
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
  @include('admin.modales.elimina_usuariosM')
@endsection

@section('js')
  @include('admin.configuracion.usuarios.usuariosM.js.js')
@endsection
