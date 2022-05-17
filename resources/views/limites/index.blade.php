@extends('layouts.base_login')
@section('css')
	<!--Datatable-->
      <link href="{{ asset('css/dataTables.bootstrap4.min.css') }}" rel="stylesheet"> 
      <link href="{{ asset('css/responsive.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mt-5">
          @include('flash::message')
           <div class="card">
              <div class="col-md-4 mt-2 mb-2">
                <a href="{{ route('limites.create') }}" type="button" class="btn-transition btn btn-outline-primary" onclick="loading_show();">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fa fa-plus-circle"></i>
                        </span>
                    {{'Agregar'}}
                </a>
              </div>
            </div>
            <div class="card">
              @if(count($limites) == 0)
                  <br>
                    <p class="text-center">No se encontraron registros coincidentes</p>
              @else

            <div class="col-md-12 mt-3">
                <table id="table_limites" class="table table-striped table-bordered" width="100%">
                    <thead>
                        <tr>
                            <th>{{'Administrativo'}}</th>
                            <th>{{'Medico'}}</th>
                            <th>{{'Asistente'}}</th>
                            <th>{{'Paciente'}}</th>
                            <th>{{'Status'}}</th>
                            <th>{{'Acción'}}</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($limites as $limite)
                        <tr>
                            <td>{{ $limite->administrativo }}</td>
                            <td>{{ $limite->medico }}</td>
                            <td>{{ $limite->asistente }}</td>
                            <td>{{ $limite->paciente }}</td>
                            <td style="background-color: {{$limite->Status->color}}; color: #fff">{{ $limite->Status->Status }}</td>                            
                            <td width="20">
                                <a href="{{ route('limites.edit', $limite) }}" type="button" class="btn-transition btn btn-outline-success" onclick="loading_show();">
                                    <span class="btn-icon-wrapper pr-2 opacity-7">
                                        <i class="ti-pencil"></i>
                                    </span>
                                    {{'Editar'}}
                                </a> 
                            </td>
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
  @include('limites.js.js')
@endsection