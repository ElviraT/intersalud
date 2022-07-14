@extends('layouts.Base')

@section('banner')
<div class="col-md-8">
  <div class="page-header-title">
      <h5 class="m-b-10">{{ __('Dashboard') }}</h5>
      <p class="m-b-0">{{'Bienvenido a Intersalud'}}</p>
  </div>
</div>
<div class="col-md-4">
  <ul class="breadcrumb-title">
      <li class="breadcrumb-item">
          <a href="index.html"> <i class="fa fa-home"></i> </a>
      </li>
      <li class="breadcrumb-item"><a href="#!">{{ __('Dashboard') }}</a>
      </li>
  </ul>
</div>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{'Hora Actual '}}-{{ date('g:ia') }}
                </div>
                @if($diff)
                  <div class="card" align="center">
                   @if($diff->invert == 1)
                    <h2>{{'Su última cita programada ya pasó'}}</h2>
                   @else
                    <h2>{{'Faltan'}}&nbsp;{{$diff->days}}&nbsp;{{'para su cita'}}</h2>
                   @endif
                  </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
