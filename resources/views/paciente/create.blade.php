@extends('layouts.base_login')
@section('css')
@include('admin.configuracion.usuarios.usuariosP.css.css')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
           @include('flash::message')
            <div class="card">
              @include('paciente.fields')
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
  @include('admin.configuracion.usuarios.usuariosP.js.js')
@endsection