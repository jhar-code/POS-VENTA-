<!DOCTYPE html>
<html>

<head>
    <title>Reporte Ticket</title>
    <style>
        * {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .ticket {
            width: 92%;
            padding: 10px;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo img {
            max-width: 80px;
            height: auto;
        }

        .business-info {
            text-align: center;
            font-size: 12px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .separator {
            text-align: center;
            font-size: 10px;
            margin: 5px 0;
            border-bottom: 1px dashed #000;
        }

        .ticket-details {
            font-size: 11px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 11px;
        }

        th, td {
            padding: 2px;
            text-align: left;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="ticket">
        <div class="business-info">
            <h3>{{ $company->nombre }}</h3>
            <p>{{ $company->direccion }}</p>
            <p>Tel: {{ $company->telefono }}</p>
            <p>Email: {{ $company->correo }}</p>
        </div>
        
        <div class="separator"></div>
        
        <div class="ticket-details">
            <p><strong>Fecha:</strong> {{ $fecha . ' ' . $hora }}</p>
            <p><strong>Folio:</strong> {{ $venta->id }}</p>
            <div class="separator"></div>
            <p><strong>Cliente:</strong> {{ $venta->cliente->nombre }}</p>
            <p><strong>Teléfono:</strong> {{ $venta->cliente->telefono }}</p>
            <p><strong>Dirección:</strong> {{ $venta->cliente->direccion }}</p>
        </div>
        
        <table>
            <thead>
                <tr>
                    <th>Cant</th>
                    <th>Producto</th>
                    <th class="text-right">Importe</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{ $producto->cantidad }}</td>
                        <td>{{ $producto->nombre_producto }}</td>
                        <td class="text-right">$ {{ number_format($producto->precio, 2) }}</td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <div class="separator"></div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        
        <table>
            <tr>
                <td><strong>Vendedor</strong></td>
                <td class="text-right">{{ $venta->user->name }}</td>
            </tr>
            <tr>
                <td><strong>Método</strong></td>
                <td class="text-right">{{ $venta->metodo }}</td>
            </tr>
            <tr>
                <td><strong>Forma Pago</strong></td>
                <td class="text-right">{{ $venta->formapago->nombre }}</td>
            </tr>
            <tr>
                <td><strong>Pago con</strong></td>
                <td class="text-right">$ {{ number_format($venta->pago_con, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Cambio</strong></td>
                <td class="text-right">$ {{ number_format($venta->pago_con - $venta->total, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td class="text-right"><strong>$ {{ number_format($venta->total, 2) }}</strong></td>
            </tr>
        </table>

        <div class="ticket-details">
            <p><strong>Nota:</strong> {{ $venta->nota }}</p>
        </div>
        
    </div>
</body>

</html>

@php
    header('Content-type: application/pdf');
@endphp

