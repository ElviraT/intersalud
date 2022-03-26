@extends('layouts.Base')
@section('css')
@include('admin.reportes.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Reportes'}}</h5>
      <p class="m-b-0">{{'Consultas'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('reporte_consulta')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Reportes Consulta'}}</a>
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
              @if(count($reportes) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_reportesc" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Medico'}}</th>
                            <th>{{'Especialidad'}}</th>
                            <th>{{'Servicio'}}</th>
                            <th>{{'Costo'}}</th>
                            <th>{{'Cerrado'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($reportes as $resultado)
                        <tr>
                            <td>{{ $resultado->UsuarioM->Nombres_Medico.' '.$resultado->UsuarioM->Apellidos_Medicos }}</td>
                            <td>{{ $resultado->Especialidad->Espacialiadad_Medica }}</td>
                            <td>{{ $resultado->Servicio->Servicio }}</td>
                            <td>{{ $resultado->Servicio->Costos }}</td>
                            @if($resultado->cerrado == 1)
                            <td>{{'Si'}}</td>
                            @else
                            <td>{{'No'}}</td>
                            @endif
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
@section('js')
  @include('admin.reportes.js.js')
@endsection