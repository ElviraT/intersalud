@extends('layouts.Base')
@section('css')
@include('admin.reportes.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Reporte'}}</h5>
      <p class="m-b-0">{{'Histórico de factura'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('facturaH')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Reporte Histórico de Factura'}}</a>
      </li>
  </ul>
</div>
@endsection

@section('content')
<div class="container">
      <div class="card">
        <div class="col-md-12 mt-3">
          {!! Form::open(['route' => ['facturaH'],  'method' => 'post', 'autocomplete' =>'off','name'=>'form_transaction','id'=>'form' ]) !!}
          <div class="row">
                    <div class="col-md-3 mb-3">
                      {!! Form::label('id_medico', 'Medico:') !!}
                      {!! Form::select('id_medico',$medico, $id_medico, [
                          'placeholder' => 'Seleccione', 
                          'class' => 'select2 form-control',
                          'id' => 'id_medico'
                          ]) !!}
                    </div>
                    <div class="col-md-3 mb-3">
                        <label>{{ 'Fecha' }}</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                             {!!
                                Form::text('fecha', $fecha, [
                                     'id' => 'fecha',
                                     'placeholder'=>'Y-M-D',
                                     'class' => 'form-control pull-right datepicker',
                                ] )
                              !!}
                         </div>
                    </div> 
                    <div class="col-md-3 mt-4">
                      <button type="submit" class="mt-1 btn btn-outline-success" id="submit">
                          <span class="btn-icon-wrapper pr-2 opacity-7">
                          </span>{{'Buscar'}}
                      </button>
                      <button type="submit" class="mt-1 btn btn-outline-info" onclick="limpiar();">
                          <span class="btn-icon-wrapper pr-2 opacity-7">
                          </span>{{'Limpiar'}}
                      </button>                   
                    </div>
          </div>
                  {!! Form::close() !!}       
        </div>
      </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
          @include('flash::message')
            <div class="card">
              @if(count($factura) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else
            <div class="col-md-12 mt-3">
                <table id="table_factura" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'N Factura'}}</th>
                            <th>{{'Medico'}}</th>
                            <th>{{'Especialidad'}}</th>
                            <th>{{'Paciente'}}</th>
                            <th>{{'Fecha'}}</th>
                            @can('facturaH.add')                            
                            <th>{{'Descargar'}}</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($factura as $resultado)
                        <tr>
                            <td>{{ $resultado->id_Factura }}</td>
                            <td>{{ $resultado->UsuarioM->Nombres_Medico.' '.$resultado->UsuarioM->Apellidos_Medicos }}</td>
                            <td>{{ $resultado->UsuarioM->ControlEspecialidades->Especialidad->Espacialiadad_Medica }}</td>
                            <td>{{ $resultado->UsuarioP->Nombres_Paciente.' '.$resultado->UsuarioP->Apellidos_Paciente }}</td>
                            <td>{{ date('Y-m-d', strtotime($resultado->Fecha)) }}</td>
                            @can('facturaH.add')
                            <td><a href="{{ route('factura.pdf', $resultado->id_Factura) }}" class="btn btn-outline-primary"><i class="ti-download"></i></a></td>
                            @endcan
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