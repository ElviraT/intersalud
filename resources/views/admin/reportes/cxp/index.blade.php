@extends('layouts.Base')
@section('css')
@include('admin.reportes.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Reportes'}}</h5>
      <p class="m-b-0">{{'Consulta CxP'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('cxp')}}" onclick="loading_show();"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{'Reportes Consulta CxP'}}</a>
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
              @if(count($cxps) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else
            <div class="col-md-12 mt-3">
                <table id="table_cxps" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Razón Social'}}</th>
                            <th width="10%">{{'Total Facturado'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($cxps as $resultado)
                        <tr>
                            <td>{{ $resultado->nombre }}</td>
                            <td width="10%">{{ $resultado->total }}</td>
                        </tr>
                      @endforeach

                    </tbody> 
                    <tfoot>
                        <tr>
                            <th>{{'Total General:'}}</th>
                            <th>Total General:</th>
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