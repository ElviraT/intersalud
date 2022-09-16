@extends('layouts.Base')
@section('css')
@include('admin.configuracion.usuarios.usuariosP.css.css')
@endsection
@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{'Agregar Usuario'}}</h5>
      <p class="m-b-0">{{'Paciente'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="{{ route('usuario_p')}}"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#">{{'Usuario Paciente'}}</a>
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
              @include('admin.configuracion.usuarios.usuariosP.fields')
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
  @include('admin.configuracion.usuarios.usuariosP.js.js')
  <script type="text/javascript">
    var xhr;
var xhr2;
var xhr3;
var select_state, $select_state;
var select_city, $select_city;
var select_municipality, $select_municipality;
var select_parish, $select_parish;

$select_state = $('#estado').selectize({
    loadingClass: 'loading',
    onChange: function(value) {
        if (!value.length) return;
        /*listar ciudades*/
        select_city.disable();
        select_city.clearOptions();
        select_city.load(function(callback) {
            xhr && xhr.abort();
            xhr = $.ajax({
                url: '{{ route('ciudad_dependiente') }}?estado='+value,
                success: function(results) {
                    select_city.enable();
                    callback(results);
                },
                error: function() {
                    callback();
                }
            })
        });
        /*listar municipios*/
        select_municipality.disable();
        select_municipality.clearOptions();
        select_municipality.load(function(callback) {
            xhr2 && xhr2.abort();
            xhr2 = $.ajax({
                url: '{{ route('municipio_dependiente') }}?estado='+value,
                success: function(results) {
                    select_municipality.enable();
                    callback(results);
                },
                error: function() {
                    callback();
                }
            })
        });
    }
});

$select_city = $('#ciudad').selectize({
                    labelField: 'Ciudad',
                    valueField: 'id_Ciudad',
                    searchField: ['Ciudad'],
                    loadingClass: 'loading',
                });

$select_municipality = $('#municipio').selectize({
                    labelField: 'Municipio',
                    valueField: 'id_Municipio',
                    searchField: ['Municipio'],
                    loadingClass: 'loading',
                    preload: true,

                    onChange: function(value) {
                    if (!value.length) return;
                    /*listar parroquias*/
                    select_parish.disable();
                    select_parish.clearOptions();
                    select_parish.load(function(callback) {
                        xhr3 && xhr3.abort();
                        xhr3 = $.ajax({
                            url: '{{ route('parroquia_dependiente') }}?municipio='+value,
                            success: function(results) {
                                select_parish.enable();
                                callback(results);
                            },
                            error: function() {
                                callback();
                            }
                        })
                    });
                }
     });

$select_parish = $('#parroquia').selectize({
                    labelField: 'Parroquia',
                    valueField: 'id_Parroquia',
                    searchField: ['Parroquia'],
                    loadingClass: 'loading',
                });

                select_city  = $select_city[0].selectize;
                select_parish  = $select_parish[0].selectize;
                select_municipality = $select_municipality[0].selectize;
                select_state = $select_state[0].selectize;

                select_city.disable();
                select_municipality.disable();
                select_parish.disable();
  </script>
@endsection