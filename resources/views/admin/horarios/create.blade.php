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
  <script type="text/javascript">
    var xhr;
var select_medico, $select_medico;
var select_especialidad, $select_especialidad;

$select_medico = $('#medico').selectize({
    loadingClass: 'loading',
    onChange: function(value) {
        if (!value.length) return;
        /*listar especialidades*/
        select_especialidad.disable();
        select_especialidad.clearOptions();
        select_especialidad.load(function(callback) {
            xhr && xhr.abort();
            xhr = $.ajax({
                url: '{{ route('especialidad_dependiente') }}?medico='+value,
                success: function(results) {
                    select_especialidad.enable();
                    if (!results[0]) {
                        $('#negacion').attr('hidden', false);
                    }else{
                        callback(results);
                        select_especialidad.setValue(results[0].id);
                        $('#negacion').attr('hidden', true);
                    }
                },
                error: function() {
                    callback();
                }
            })
        });
    }
});

$select_especialidad = $('#especialidad').selectize({
                    labelField: 'name',
                    valueField: 'id',
                    searchField: ['name'],
                    loadingClass: 'loading',
                });


                select_especialidad  = $select_especialidad[0].selectize;
                select_medico = $select_medico[0].selectize;

                select_especialidad.disable();
  </script>
@endsection
