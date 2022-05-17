@extends('layouts.base_login')
@section('css')
<!-- Select2 -->
<link href="{{ asset('css/select2.min.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
           @include('flash::message')
            <div class="card">
              {!! Form::open(['route' => ['limites.store'],  'method' => 'post', 'autocomplete' =>'off' ]) !!}
                @include('limites.fields')
              {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
  @include('limites.js.js')
@endsection