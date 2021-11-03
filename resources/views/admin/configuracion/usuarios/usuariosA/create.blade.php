@extends('layouts.Base')
@section('css')
@include('admin.configuracion.usuarios.usuariosA.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Agregar Usuario'}}</h5>
      <p class="m-b-0">{{'Asistente'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('usuario_a')}}"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#">{{'Usuario Asistente'}}</a>
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
              @include('admin.configuracion.usuarios.usuariosA.fields')
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
  @include('admin.configuracion.usuarios.usuariosA.js.js')
@endsection