@extends('layouts.Base')
@section('css')
@include('admin.configuracion.roles.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Roles'}}</h5>
      <p class="m-b-0">{{'Listado de Roles'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('rol')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Roles'}}</a>
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
                @can('rol.create')
                <a href="{{ route('rol.create') }}" type="button" class="btn-transition btn btn-outline-primary" onclick="loading_show();">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                    {{'Agregar'}}
                </a>
                @endcan
              </div>
            </div>
            <div class="card">
              @if(count($roles) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_roles" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Nombre'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($roles as $role)
                        <tr>
                            <td>{{ $role->name }}</td>
                            
                            <td width="10px">
                              @can('rol.edit')
                                <a href="{{ route('rol.edit', $role) }}" type="button" class="btn-transition btn btn-outline-success" onclick="loading_show();">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a> 
                              @endcan
                              @can('rol.destroy')                           
                                <a href="#" type="button" data-toggle="modal" data-target="#confirm-delete15" data-record-id="{{$role->id}}" data-record-title="{{$role->name}}" class="btn-transition btn btn-outline-danger" onclick="loading_show();">
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
    @include('admin.modales.elimina_rol')
@endsection

@section('js')
  @include('admin.configuracion.roles.js.js')
@endsection
