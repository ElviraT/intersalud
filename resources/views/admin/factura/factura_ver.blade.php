<!DOCTYPE html>
<html>
<head>
	<title>{{'Factura'}}</title>
	 <link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
	 <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap/css/bootstrap.min.css')}}">
	 <link rel="stylesheet" type="text/css" href="{{ asset('assets/icon/font-awesome/css/font-awesome.min.css')}}">
	 <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/style.css')}}">
	<style type="text/css">  
	    #tabla{
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
</head>
<body>
	<div class="content">
		 {{--ENCABEZADO DE FACTURA MOSTRAR--}}
            <div class="col-md-12">
              <div class="row">
               <div class="col-md-3 pt-3 pl-3">
                    <img src="{{ asset('img/Logo.png')}}" width="100%">          
                </div>
                <div class="col-md-5 pt-3 pl-3" style="border: 1px solid grey; border-radius: 20px;">
                  <label><strong>{{$factura->UsuarioM->Nombres_Medico}}{{' '}}{{$factura->UsuarioM->Apellidos_Medicos}}</strong></label><br>
                  <label>{{$factura->UsuarioM->User->email}}</label><br>
                  <label>{{$factura->UsuarioM->Seniat->Direccion}}</label><br>
                  <label>{{$factura->UsuarioM->ControlEspecialidades->Especialidad->Consultorio->Telefono}}</label><br>
                  <label>{{$factura->UsuarioM->Seniat->RIF}}</label>
                </div>
                <div class="col-md-3 pt-3 pl-3" style="border: 1px solid grey; border-radius: 20px;">
                  <h5><strong>{{'N Factura: '}}</strong></h5>
                  <h1>{{$factura->id_Factura}}</h1>
                </div>
              </div>
            </div>
            <div class="col-md-12 m-1" style="border: 1px solid grey; border-radius: 20px;">
              <div class="row">
                <div class="col-md-12 mt-2" align="center">
                <h5>{{'Datos del cliente'}}</h5>
                </div>
                <div class="col-md-6 p-3">
                  <label>{{'Fecha de emisión:'}}</label> &nbsp;{{ date('Y-m-d') }}<br>
                  <label>{{'Nombre o razón social:'}}</label> &nbsp;{{ $factura->UsuarioP->Nombres_Paciente}}&nbsp;{{$factura->UsuarioP->Apellidos_Paciente }}<br>
                  <label>{{'DNI:'}}</label> &nbsp;{{ $factura->UsuarioP->PrefijoDNI->Prefijo_CIDNI }}&nbsp;{{$factura->UsuarioP->CIDNI }}<br>
                  <label>{{'Sexo:'}}</label> &nbsp;{{ $factura->UsuarioP->Sexo->Sexo}}                
                </div>
                <div class="col-md-6 p-3">
                  <label>{{'Dirección:'}}</label> &nbsp;{{ $factura->UsuarioP->DireccionPaciente->Direccion}}<br>
                  <label>{{'Edad:'}}</label> &nbsp;<span id="edad"></span>&nbsp; {{'Años'}}<br>                
                  <label>{{'Teléfono:'}}</label> &nbsp;{{ $factura->UsuarioP->DireccionPaciente->Telefono}}<br>                
                  <label>{{'Correo:'}}</label> &nbsp;{{ $factura->UsuarioP->DireccionPaciente->Correo}}                
                </div>
              </div>
            </div>
        {{-- FIN DE ENCABEZADO MOSTRAR--}}
		{{--DETALLE DE FACTURA MOSTRAR--}}
	       <table id="tabla">
	          <thead>
	            <tr>
	              <th>{{'Cant'}}</th>
	              <th>{{'Descripción'}}</th>
	              <th>{{'Precio uni.'}}</th>
	              <th>{{'Total'}}</th>
	            </tr>
	          </thead>
	          <tbody>
	            @php($sub= 0)
	            @foreach($factura->FacturaDetalle as $fact)
		            <tr>
		                <td>{{ $fact->Cantidad }}</td>
		                <td>{{ $fact->Servicio->Servicio }}</td>
		                <td>{{ $fact->Costo_Servicio }}&nbsp;{{ $fact->moneda }}</td>
		                <td>{{ $fact->Costo_Servicio }}&nbsp;{{ $fact->moneda }}</td>             
		            </tr>
	              @php($sub= $sub + $fact->Costo_Servicio)
	            @endforeach

	              <td colspan="3">{{'Subtotal'}}</td>
	              <td>{{$sub}}&nbsp;{{ $fact->moneda }}</td>
	            </tr>
	            <tr>
	              <td colspan="3">{{'IVA 12%'}}</td>
	              <td>{{$fact->iva}}</td>
	            </tr>
	            <tr>
	              <td colspan="3">{{'Total a Pagar'}}</td>
	              <td>{{$sub + $fact->iva}}&nbsp;{{ $fact->moneda }}</td>
	            </tr>
	          </tbody>
	       </table>
	    {{--FIN DE DETALLE--}} 
	    {{--MONEDA DE PAGO--}}
	    <div class="col-md-12 mt-4">
	        <div class="card row p-3" style="border: 2px solid #dd0000;">
	          <div id="imp" hidden><h5>{{'Impuesto 3%: '}}@if(isset($factura_moneda->impuesto))<span>{{$factura_moneda->impuesto}}</span>@endif</h5></div>
	          <h4><strong>{{'Total a Pagar en '}}<span>{{$factura->moneda_cancela}}</span>:</strong>&nbsp;<span id="total" style="font-weight: bold;">{{$factura_moneda->Total_Cancelado}}</span></h4>  
	        </div>
	    </div>
	    {{--FIN DE MONEDA DE PAGO--}}
	</div>
</body>
<script type="text/javascript" src="{{ asset('assets/js/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap/js/bootstrap.min.js')}} "></script>
<script type="text/javascript">
	$(document).ready(function() {
	    var hoy = new Date();
	    var cumpleanos = new Date('{{$factura->UsuarioP->Fecha_Nacimiento_Paciente}}');
	    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
	    var m = hoy.getMonth() - cumpleanos.getMonth();

	    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
	        edad--;
	    }

	    $('#edad').html(edad);
	    var moneda = '{{$factura->moneda_cancela}}';
	    if (moneda == 'USD') {
	        $('#imp').attr('hidden', false);
	      }else{
	        $('#imp').attr('hidden', true);
	      }
	});
</script>
</html>