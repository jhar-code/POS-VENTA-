<style>
    table {
        width: 100%;
        border-collapse: collapse;
        font-family: Arial, sans-serif;
        font-size: 14px;
    }
    
    thead {
        background-color: #6200ea;
        color: #ffffff;
        font-weight: bold;
    }

    th, td {
        border: 1px solid #dddddd;
        padding: 10px;
        text-align: left;
    }

    tbody tr:nth-child(even) {
        background-color: #f3f3f3;
    }

    tfoot {
        background-color: #3700b3;
        color: #ffffff;
        font-weight: bold;
    }

    .text-right {
        text-align: right;
    }

    .report-title {
        text-align: center;
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .logo {
        height: 90px;
    }
</style>

<table>
    <tr>
        <td colspan="2">
            <img src="{{ public_path('/img/logo.png') }}" alt="Logo" class="logo" />
        </td>
        <td colspan="7" class="report-title">
            REPORTE DE VENTAS
        </td>
    </tr>
</table>

<table>
    <thead>
        <tr>
            <th>Id</th>
            <th>Cliente</th>
            <th>Teléfono</th>
            <th>Método</th>
            <th>Forma Pago</th>
            <th class="text-right">Monto</th>
            <th class="text-right">Pago con</th>
            <th class="text-right">Cambio</th>
            <th>Fecha/Hora</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalMonto = 0;
            $totalPagoCon = 0;
            $totalCambio = 0;
        @endphp
        @foreach ($ventas as $venta)
            @php
                $cambio = $venta->pago_con - $venta->total;
                $totalMonto += $venta->total;
                $totalPagoCon += $venta->pago_con;
                $totalCambio += $cambio;
            @endphp
            <tr>
                <td>{{ $venta->id }}</td>
                <td>{{ $venta->cliente->nombre }}</td>
                <td>{{ $venta->cliente->telefono }}</td>
                <td>{{ $venta->metodo }}</td>
                <td>{{ $venta->formapago->nombre }}</td>
                <td class="text-right">{{ number_format($venta->total, 2) }}</td>
                <td class="text-right">{{ number_format($venta->pago_con, 2) }}</td>
                <td class="text-right">{{ number_format($cambio, 2) }}</td>
                <td>{{ $venta->created_at }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">Totales:</td>
            <td class="text-right">{{ number_format($totalMonto, 2) }}</td>
            <td class="text-right">{{ number_format($totalPagoCon, 2) }}</td>
            <td class="text-right">{{ number_format($totalCambio, 2) }}</td>
            <td></td>
        </tr>
    </tfoot>
</table>
