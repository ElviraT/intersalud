@extends('layouts.Base')

@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Agregar Historias Clinicas'}}</h5>
      <p class="m-b-0">{{'Urología'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('home')}}"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Historias Clinicas Urología'}}</a>
      </li>
  </ul>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              @include('admin.historias.urologia.fields')
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
  @include('admin.historias.urologia.js.js')
@endsection
