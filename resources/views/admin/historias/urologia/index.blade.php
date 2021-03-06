@extends('layouts.Base')
@section('css')
@include('admin.historias.urologia.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Historias Clinicas'}}</h5>
      <p class="m-b-0">{{'Urología'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="index.html"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Historias Clinicas'}}</a>
      </li>
  </ul>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
              <div class="col-md-4 mt-2 mb-2">
                <a href="{{ route('urologia.create')}}" class="btn btn-outline-primary">
                  <i class="fa fa-plus-square"></i>
                  {{'Agregar'}}
                </a>
              </div>
            </div>
            <div class="card">
            <div class="col-md-12 mt-3">
                <table id="example" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Cedula</th>
                            <th>Sexo</th>
                            <th>Teléfono</th>
                            <th>Dirección</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{'Jon Doe'}}</td>
                            <td>{{'5.246.009'}}</td>
                            <td>{{'Masculino'}}</td>
                            <td>{{'555-555-55-55'}}</td>
                            <td>{{'.........'}}</td>
                            <td width="20">
                              <button class="btn-transition btn btn-outline-success" type="button"><i class="ti-pencil"></i> {{'Editar'}}</button>
                       
                              <button class="btn-transition btn btn-outline-danger" type="button"><i class="ti-eraser"></i> {{'Eliminar'}}</button>
                            </td>
                        </tr>
                    </tbody>                   
                </table>
              </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
  @include('admin.historias.urologia.js.js')
@endsection
