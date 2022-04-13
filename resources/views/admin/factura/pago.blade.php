@extends('layouts.base_login')
@section('css')
<!-- Select2 -->
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<style type="text/css">
  #tabla{
    margin-top: 20px; 
    border-collapse: collapse;
    width: 100%;
  }

#tabla td, #tabla th {
  border: 1px solid #ddd;
  padding: 8px;
}

#tabla tr:nth-child(even){background-color: #f2f2f2;}

#tabla tr:hover {background-color: #ddd;}

#tabla th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #88D939;
  color: #0852B5;
}
</style>
@endsection
@section('content')
  <div class="card">
    <input type="hidden" name="Factura_id" value="{{$Factura_id}}">
    <div class="col-md-12 p-3">
      <div class="row">
        <div class="col-md-4 mt-3">
          {!! Form::label('tipoP', 'Tipo de pago:') !!}
          {!! Form::select('tipoP',$tipoP,  null, [
              'placeholder' => 'Seleccione', 
              'class' => 'select2 form-control',
              'id' => 'tipoP',
              'required'=>'required'
              ])
          !!}
        </div>
      </div>
    </div>
  </div>
@endsection
@section('js')
<!-- Select2 -->
<script src="{{ asset('js/select2.min.js') }}" type="text/javascript"></script>

<script type="text/javascript">
  $(document).ready(function() {
    $('.select2').select2({ 
        theme : "classic",
        closeOnSelect: true,
         });
    });
</script>
@endsection