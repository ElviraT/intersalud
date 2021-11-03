@extends('layouts.Base')
@section('css')
@include('admin.configuracion.roles.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Editar Rol'}}</h5>
      <p class="m-b-0">{{'Rol - '}}<strong>{{$role->name}}</strong></p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('rol')}}"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#">{{'Rol'}}</a>
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
              {!! Form::model($role ,['route' => ['rol.update', $role],  'method' => 'put', 'autocomplete' =>'off' ]) !!}
                @include('admin.configuracion.roles.fields')
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
  @include('admin.configuracion.roles.js.js')
@endsection