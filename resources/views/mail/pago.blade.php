<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>{{'Pago enviado'}}</title>
</head>
<body>
    <div style="padding: 7px; text-align: center; background-color: #88D939; color: #0852B5;">
        <h3>{{'Hola! Se ha reportado un nuevo pago de'}} <strong>{{ $pago->monto }} {{$pago->moneda_id}}.</strong></h3>
        <h4>{{'Estos son los datos del pago:'}}</h4>        
    </div>
    <div style="background-color: #E0E0DC; padding: 7px;">
        <ul>
            <li><strong> {{'Referencia: '}} </strong>{{ $pago->referencia }}</li>
            <li><strong>{{'Fecha: '}}</strong> {{ $pago->fecha_pago }}</li>
            <li><strong>{{'Comprobante: '}}</strong> <img src="{{ Request::root().'/avatars/'.str_replace('\\','/', $pago->comprobante) }}" width="40%"></li>
            
        </ul>        
    </div>
</body>
</html>