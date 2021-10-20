@extends('layouts.Base')
@section('css')
@include('admin.configuracion.usuarios.usuariosM.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Editar Usuario'}}</h5>
      <p class="m-b-0">{{'Médico - '}}<strong>{{$medico->Nombres_Medico.' '.$medico->Apellidos_Medicos}}</strong></p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('usuario_m')}}"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#">{{'Usuario Médico'}}</a>
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
              @include('admin.configuracion.usuarios.usuariosM.fields')
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
  @include('admin.configuracion.usuarios.usuariosM.js.js')
@endsection