@extends('layouts.Base')
@section('css')
@include('admin.horarios.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Agregar Horario'}}</h5>
      <p class="m-b-0">{{'Citas'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('horario')}}"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#" onclick="loading_show();">{{'Horario de Citas'}}</a>
      </li>
  </ul>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              @include('admin.horarios.fields')
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
  @include('admin.horarios.js.js')
@endsection
