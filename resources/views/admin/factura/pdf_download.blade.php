<!DOCTYPE html>
<html>
<head>
	<title>{{'Factura'}}</title>
	 <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap/css/bootstrap.min.css')}}">
	
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
		.content{
			font-family: sans-serif;
			font-size: 15px !important;
		}

		table{
		    table-layout: fixed;
		    width: 100%;
		}

		th, td {
		    width: 100px;
		    word-wrap: break-word;
		}
	</style>
</head>
<body>
	<div class="content">
		 {{--ENCABEZADO DE FACTURA MOSTRAR--}}
		<div align="center" style="top: 0 !important;">
            <img src="{{ asset('img/Logo.png')}}" width="50%">          
        </div>
		 <table width="100%">
		 	<thead>
		 		<tr>
		 			<td width="50%">
		              <label><strong>{{$data['factura']->UsuarioM->Nombres_Medico}}{{' '}}{{$data['factura']->UsuarioM->Apellidos_Medicos}}</strong></label><br>
		              <label>{{$data['factura']->UsuarioM->User->email}}</label><br>
		              <label>{{$data['factura']->UsuarioM->Seniat->Direccion}}</label><br>
		              <label>{{$data['factura']->UsuarioM->ControlEspecialidades->Especialidad->Consultorio->Telefono}}</label><br>
		              <label>{{$data['factura']->UsuarioM->Seniat->RIF}}</label>			            
			        </td>
		 			<td width="50%" style="vertical-align:top;" align="right">
		 				<h5><strong>{{'N Factura:'}}</strong></h5>
			            <h1>{{$data['factura']->id_Factura}}</h1>			            
			        </td>
		 		</tr>
		 	</thead>
		 </table>
                <div class="col-md-12" align="center">
                	<h5>{{'Datos del cliente'}}</h5>
                </div>
                <table width="100%">
                	<thead>
                		<tr>
                			<th>{{'Fecha de emisión:'}}</th>
                			<th>{{'Nombre o razón social:'}}</th>
                			<th>{{'DNI:'}}</th>
                			<th>{{'Sexo:'}}</th>

                		</tr>
                	</thead>
                	<tbody>
                		<tr>
                			<td>{{ date('Y-m-d') }}</td>
                			<td>{{ $data['factura']->UsuarioP->Nombres_Paciente}}&nbsp;{{$data['factura']->UsuarioP->Apellidos_Paciente }}</td>
                			<td>{{ $data['factura']->UsuarioP->PrefijoDNI->Prefijo_CIDNI }}&nbsp;{{$data['factura']->UsuarioP->CIDNI }}</td>
                			<td>{{ $data['factura']->UsuarioP->Sexo->Sexo}}</td>
                		</tr>
                	</tbody>
                </table>
                <table width="100%">
                	<thead>
                		<tr>
                			<th colspan="2">{{'Dirección:'}}</th>
                			<th>{{'Teléfono:'}}</th>
                			<th>{{'Correo:'}}</th>
                		</tr>
                	</thead>
                	<tbody>
                		<tr>
                			<td>{{ $data['factura']->UsuarioP->DireccionPaciente->Direccion}}</td>
                			<td></td>
                			<td>{{ $data['factura']->UsuarioP->DireccionPaciente->Telefono}}</td>
                			<td>{{ $data['factura']->UsuarioP->DireccionPaciente->Correo}}</td>
                		</tr>
                	</tbody>
                </table>
        {{-- FIN DE ENCABEZADO MOSTRAR--}}
		{{--DETALLE DE FACTURA MOSTRAR--}}
	       <table id="tabla" style="margin-top: 10px;">
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
	            @foreach($data['factura']->FacturaDetalle as $fact)
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
	         @if(isset($data['factura_moneda']->impuesto)) <div id="imp"><h5>{{'Impuesto 3%: '}}<span>{{$data['factura_moneda']->impuesto}}</span></h5></div>@endif
	          <h4><strong>{{'Total a Pagar en '}}<span>{{$data['factura']->moneda_cancela}}</span>:</strong>&nbsp;<span id="total" style="font-weight: bold;">{{$data['factura_moneda']->Total_Cancelado}}</span></h4>  
	        </div>
	    </div>
	    {{--FIN DE MONEDA DE PAGO--}}
	</div>
</body>
</html>