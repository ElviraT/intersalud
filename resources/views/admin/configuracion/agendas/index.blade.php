@extends('layouts.Base')
@section('css')
@include('admin.configuracion.agendas.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Agenda'}}</h5>
      <p class="m-b-0">{{'Agenda Disponibles'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('agenda')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Agenda'}}</a>
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
             <div id='calendar'></div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('modal')
   @include('admin.configuracion.agendas.modal_agenda')
@endsection

@section('js')
  @include('admin.configuracion.agendas.js.js')
@endsection