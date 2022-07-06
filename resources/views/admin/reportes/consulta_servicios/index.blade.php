@extends('layouts.Base')
@section('css')
@include('admin.reportes.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Reportes'}}</h5>
      <p class="m-b-0">{{'Consulta de Servicios'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('cservicios')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Reportes Consulta de Servicios'}}</a>
      </li>
  </ul>
</div>
@endsection

@section('content')
<div class="container">
      <div class="card">
        <div class="col-md-12 mt-3">
          {!! Form::open(['route' => ['cservicios'],  'method' => 'post', 'autocomplete' =>'off','name'=>'form_consulta_servicio','id'=>'form' ]) !!}
          <div class="row">
              <div class="col-md-3 mb-3">
                {!! Form::label('servicio', 'Servicio:') !!}
                {!! Form::select('id_servicio',$servicio, $id_servicio, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control',
                    'id' => 'id_servicio'
                    ]) !!}
              </div>
              <div class="col-md-3 mb-3">
                {!! Form::label('status', 'Estatus:') !!}
                {!! Form::select('id_status',$status, $id_status, [
                    'placeholder' => 'Seleccione', 
                    'class' => 'select2 form-control',
                    'id' => 'id_status'
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
              @if(count($cservicios) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else
            <div class="col-md-12 mt-3">
                <table id="table_cservicios" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Descripción'}}</th>
                            <th>{{'Fecha'}}</th>                       
                            <th>{{'Cantidad'}}</th>
                            <th>{{'Valor $'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($cservicios as $resultado)
                        <tr>
                            <td>{{ $resultado->Servicio }}</td>
                            <td>{{ date('Y-m-d', strtotime($resultado->Fecha)) }}</td>
                            <td>{{ $resultado->cantidad }}</td>
                            <td>{{ $resultado->costo }}</td>
                        </tr>
                      @endforeach

                    </tbody> 
                    <tfoot>
            <tr>
                <th colspan="3">{{'Total General:'}}</th>
                <th>Total:</th>
            </tr>
        </tfoot>                  
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